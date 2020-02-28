import { getConnection, FindConditions, In } from 'typeorm';
import Joi from 'joi';
import Timetable from '../../entity/Timetable';
import TimeIndexLecture from '../../entity/TimeIndexLecture';

export const getLectureByKeywords = async (req, res, next) => {
  const { school_id } = res.locals.user;

  try {
    const { error, value: inputs } = searchSchema.validate(req.query);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { keywords, year, term, timetable_id, page, count } = inputs;

    let lectureIdList = await searchByKeywords(keywords);

    // 겹치는 시간대 강의 제외
    if (timetable_id)
      lectureIdList = await filterWithTimetable(
        timetable_id,
        lectureIdList,
        school_id,
        year,
        term
      );

    if (!lectureIdList || lectureIdList.length === 0) {
      res.json({ data: [] });
      return;
    }

    let query = `
      SELECT lecture_id, name, year, term, code, professor, school_id
      FROM lectures
      WHERE school_id = ?
        AND lectures.lecture_id IN (?)
    `;
    let parameters: any[] = [school_id, lectureIdList];

    [query, parameters] = await filterByOptions(query, parameters, req.query);

    // 정렬 및 페이지네이션
    query += `
      ORDER BY lecture_id DESC
      LIMIT ? OFFSET ?
    `;
    parameters.push(count, (page - 1) * count);

    const lectures = await getConnection().query(query, parameters);

    res.json({ data: lectures });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간대에 해당하는 강의목록 반환
 * @route GET /api/timetables/search/times
 * @group timetables - 시간표 관련
 * @param {string} year.query.required - 연도
 * @param {enum} term.query.required - 학기 - eg: 1학기, 2학기
 * @param {string} college.query.required - 대분류 - eg: 정보대학, 교양
 * @param {string} department.query.required - 소분류 - eg: 컴퓨터학과, 선택교양
 * @param {Array.<string>} times.query.required - 선택된 시간대들 - eg: ['월1', '수1', '목6']
 * @param {number} only.query - !!!현재 지원 안됨!!! 해당 시간대'만' 포함인지 여부 (없거나 0이면 해당 시간대'를' 포함) - eg: 1, 0
 * @param {number} timetable_id.query - 시간표 ID (있으면 시간대 겹치는 강의 제외 / 없으면 제외 안함)
 * @param {number} page.query - 현재 페이지 번호
 * @param {number} count.query - 가져올 개수
 * @returns {Array.<Lecture>} 200 - 검색된 강의들 (강의명, 학수번호, 교수명 등)
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 * @returns {Error} 404	- 19401	존재하지 않는 시간표입니다.
 * @returns {Error} 404	- 19402	존재하지 않는 강의가 포함되어 있습니다.
 */
export const getLecturesByTimes = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { school_id } = res.locals.user;

  try {
    const { error, value: inputs } = searchTimeSchema.validate(req.query);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const {
      year,
      term,
      college,
      department,
      times,
      only,
      timetable_id,
      page,
      count
    } = inputs;

    const spreadLectureIDs: number[][] = await Promise.all(
      times.map(async (datetime: string) => {
        const date = datetime.slice(0, 1);
        const time = datetime.slice(1);

        const lectures = await TimeIndexLecture.findOne({
          where: { school_id, year, term, date, time }
        });

        if (!lectures) return [];
        return lectures.list;
      })
    );

    let lectureIdList: number[] = spreadLectureIDs.reduce(
      (arr: number[], lectureIDs: number[]): number[] => {
        return arr.concat(lectureIDs);
      },
      []
    );

    // 겹치는 시간대 강의 제외
    if (timetable_id)
      lectureIdList = await filterWithTimetable(
        timetable_id,
        lectureIdList,
        school_id,
        year,
        term
      );

    if (!lectureIdList || lectureIdList.length === 0) {
      res.json({ data: [] });
      return;
    }

    const lectures = await Lecture.find({
      select: [
        'lecture_id',
        'name',
        'year',
        'term',
        'code',
        'professor',
        'school_id'
      ],
      where: {
        school_id,
        college,
        department,
        lecture_id: In(lectureIdList)
      },
      order: { lecture_id: 'DESC' },
      skip: (page - 1) * count,
      take: count
    });

    res.json({ data: lectures });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간표에 존재하는 시간대의 강의들 제외
 */
const filterWithTimetable = async (
  timetable_id: string,
  lectureIdList: number[],
  school_id: string,
  year: string,
  term: string
): Promise<number[]> => {
  const timetable = await Timetable.findOne(timetable_id);
  if (!timetable) throw new Error('TIMETABLES_NO_TIMETABLE');

  //제외할 시간대 수합
  const exceptTimeStr = (
    await Promise.all(
      timetable.lecture_list.map(async lectureId => {
        return await parseLectureTimes(lectureId);
      })
    )
  ).reduce((exceptTimes, exceptTime) => {
    return exceptTimes.concat(exceptTime);
  }, []);

  //제외 시간대 중복 제거
  const exceptDatetimes = Array.from(new Set(exceptTimeStr)).map(datetime => {
    return {
      date: datetime.slice(0, 1),
      time: datetime.slice(1)
    };
  });

  // 제외될 Lecture ID 들
  const exceptLectureIdList = (
    await Promise.all(
      exceptDatetimes.map(async exceptDatetime => {
        const { date, time } = exceptDatetime;

        const lecturesByTime = await TimeIndexLecture.findOne({
          where: { school_id, year, term, date, time }
        });

        if (!lecturesByTime) return [];
        return lecturesByTime.list;
      })
    )
  ).reduce((arr, exceptLectureIDs) => {
    return arr.concat(exceptLectureIDs);
  }, []);

  // 중복 제거 및 차집합
  const exceptLectureIdSet = Array.from(new Set(exceptLectureIdList));
  return lectureIdList.filter(id => !exceptLectureIdSet.includes(id));
};

/**
 * 강의의 시간대 파싱
 */
const parseLectureTimes = async (lectureId: number) => {
  // => ['월1', '월2', '월3', '화1', ...]
  const lecture = await Lecture.findOne(lectureId);
  if (!lecture) throw new Error('TIMETABLES_NO_LECTURE');

  const { time } = lecture;

  return time
    .map(datetime => {
      // 월(1-5) => 월, [1, 5, 2, 3, 4] (사잇값들을 추가함)
      // 월(1) => 월, [1]
      const date = datetime.slice(0, 1);
      const times = datetime
        .slice(1)
        .replace('(', '')
        .replace(')', '')
        .split('-')
        .map(t => Number(t));

      if (times.length > 1) {
        const last = times[1];

        for (let i = times[0] + 1; i < last; i++) times.push(i);
      }

      return times.map(time => {
        return date + time;
      });
    })
    .reduce((arr, datetime) => {
      return arr.concat(datetime);
    }, []);
};

/**
 * 분류 가져오기 (구분, 대분류, 소분류)
 * @route GET /api/timetables/filters
 * @group timetables - 시간표 관련
 * @param {string} year.query.required - 연도
 * @param {enum} term.query.required - 학기 - eg: 1학기, 2학기
 * @param {string} category.query - 구분 (있으면 대분류 반환) - eg: 전공, 교양
 * @param {string} college.query - 대분류 (있으면 소분류 반환) - eg: 정보대학, 교양
 * @param {number} school_id.token.required - 사용자의 학교 id
 * @returns {Array.<string>} 200 - 구분 or 대분류 or 소분류 목록
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 */
export const getFilters = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { school_id } = res.locals.user;

  try {
    const { error, value: inputs } = filterSchema.validate(req.query);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { year, term, category, college } = inputs;

    let query = `
      FROM lectures
      WHERE school_id = ?
        AND year = ?
        AND term = ?
    `;
    const parameters: any[] = [school_id, year, term];

    if (college) {
      query = `SELECT DISTINCT(department) AS data
        ${query}
        AND college = ?
      `;
      parameters.push(college);
    } else if (category) {
      query = `SELECT DISTINCT(college) AS data 
      ${query} 
      AND category = ? 
      `;
      parameters.push(category);
    } else query = `SELECT DISTINCT(category) AS data ${query}`;

    const result = await getConnection().query(query, parameters);
    const data = result.map((row: { data: string }) => row.data);

    res.json({ data });
  } catch (error) {
    next(error);
  }
};

// 시간표 관련 CRUD API

/**
 * 내 시간표들
 * @route GET /api/timetables
 * @group timetables - 시간표 관련
 * @param {string} year.query.required - 연도
 * @param {enum} term.query.required - 학기 - eg: 1학기, 2학기
 * @param {number} user_id.token.required - 사용자의 id
 * @returns {Array.<Timetable>} 200 - 해당 사용자의 시간표 목록 (id, 시간표제목만)
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 */
export const getTimetables = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { user_id } = res.locals.user;

  try {
    const { error, value: inputs } = periodSchema.validate(req.query);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { year, term } = inputs;

    const timetables = await Timetable.find({
      select: ['timetable_id', 'name'],
      where: {
        user_id,
        year,
        term
      }
    });

    res.json({
      data: timetables
    });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간표 조회
 * @route GET /api/timetables/:timetable_id
 * @group timetables - 시간표 관련
 * @param {number} timetable_id.params.required - timetable_id
 * @param {number} user_id.token.required - 사용자의 id
 * @returns {Timetable.model} 200 - 특정 시간표 정보
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 * @returns {Error} 404	- 19401	존재하지 않는 시간표입니다.
 * @returns {Error} 403	- 19301	다른 사용자의 시간표에 접근할 수 없습니다.
 */
export const getTimetableById = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { user_id } = res.locals.user;

  try {
    const { error, value: inputs } = timetableIdSchema.validate(req.params);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { timetable_id } = inputs;

    const timetableWithLectureID = await Timetable.findOne(timetable_id);
    if (!timetableWithLectureID) throw new Error('TIMETABLES_NO_TIMETABLE');
    if (timetableWithLectureID.user_id !== user_id)
      throw new Error('TIMETABLES_WRONG_USER');

    const { year, term, name, lecture_list } = timetableWithLectureID;
    const timetable = {
      timetable_id,
      year,
      term,
      name,
      lectures: await getLectures(lecture_list)
    };

    res.json({
      data: { timetable }
    });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간표 생성 및 초기화
 * @route POST /api/timetables
 * @group timetables - 시간표 관련
 * @param {string} year.body.required - 연도 - eg: 2019, 2018
 * @param {enum} term.body.required - 학기 - eg: 1학기, 2학기
 * @param {string} name.body - 시간표 이름 (default 무제)
 * @param {number} user_id.token.required - 사용자의 id
 * @returns {number} 200 - timetable_id
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 * @returns {Error} 403	- 19901	같은 연도, 학기에는 최대 개의 시간표만 등록할 수 있습니다.
 */
export const postTimetables = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { user_id } = res.locals.user;

  try {
    const { error, value: inputs } = initTimetableSchema.validate(req.body);
    console.log(error);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { year, term, name } = inputs;

    const timetableCount = await Timetable.count({ year, term });
    // 같은 연도, 학기에 3개까지 생성 가능
    if (timetableCount >= 3) throw new Error('TIMETABLES_TOO_MANY_TABLES');

    const timetable = new Timetable();
    timetable.year = year;
    timetable.term = term;
    timetable.name = name;
    timetable.user_id = user_id;
    await timetable.save();

    res.json({
      data: {
        timetable_id: timetable.timetable_id
      }
    });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간표 이름, 강의 목록 수정
 * @route PUT /api/timetables/:timetable_id
 * @group timetables - 시간표 관련
 * @param {number} timetable_id.params.required - 시간표 id
 * @param {string} name.body - 변경할 이름 (주의할 점은 name만 수정하려고 해도 저장된 lectures를 모두 넘겨줘야한다)
 * @param {integer[]} lectures.body.required - lecture_id 배열. 그대로 받아서 저장함 (없으면 날라간다는 뜻). 무조건 줘야함
 * @returns {number} 200 - timetable_id
 * @returns {Error} 400	- 19001	입력이 올바르지 않습니다.
 * @returns {Error} 404	- 19401	존재하지 않는 시간표입니다.
 * @returns {Error} 403	- 19301	다른 사용자의 시간표에 접근할 수 없습니다.
 * @returns {Error} 404	- 19402	존재하지 않는 강의가 포함되어 있습니다.
 */
export const putTimetableById = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { user_id } = res.locals.user;
  const { timetable_id } = req.params;

  try {
    const { error, value: inputs } = putTimetableSchema.validate(req.body);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { name, lectures } = inputs;

    const timetable = await Timetable.findOne(timetable_id);
    if (!timetable) throw new Error('TIMETABLES_NO_TIMETABLE');
    if (timetable.user_id !== user_id) throw new Error('TIMETABLES_WRONG_USER');

    // Lecture ID 검증
    const isValidLectures = (
      await Promise.all(
        lectures.map(async (lectureID: number) => {
          return Lecture.findOne(lectureID);
        })
      )
    ).reduce((isValid, lecture) => {
      if (!lecture) return false;
      return isValid;
    }, true);
    if (!isValidLectures) throw new Error('TIMETABLES_NO_LECTURE');

    // name 있으면 UPDATE
    if (name) timetable.name = name;
    timetable.lecture_list = lectures;
    await timetable.save();

    res.json({
      data: {
        timetable_id: timetable.timetable_id
      }
    });
  } catch (error) {
    next(error);
  }
};

/**
 * 시간표 삭제
 * @route DELETE /api/timetables/:timetable_id
 * @group timetables - 시간표 관련
 * @param {number} timetable_id.params.required - timetable_id
 * @param {number} user_id.token.required - 사용자의 id
 * @returns {object} 200 - 삭제 성공
 * @returns {Error} 400 - 19001	입력이 올바르지 않습니다.
 * @returns {Error} 404 - 19401	존재하지 않는 시간표입니다.
 * @returns {Error} 403 - 19301	다른 사용자의 시간표에 접근할 수 없습니다.
 */
export const deleteTimetableById = async (
  req: Request,
  res: Response,
  next: NextFunction
) => {
  const { user_id } = res.locals.user;

  try {
    const { error, value: inputs } = timetableIdSchema.validate(req.params);
    if (error) throw new Error('TIMETABLES_INVALID_INPUT');
    const { timetable_id } = inputs;

    const timetable = await Timetable.findOne(timetable_id);
    if (!timetable) throw new Error('TIMETABLES_NO_TIMETABLE');
    if (timetable.user_id !== user_id) throw new Error('TIMETABLES_WRONG_USER');

    await timetable.remove();

    res.json({
      data: {}
    });
  } catch (error) {
    next(error);
  }
};

/**
 * 강의 정보 가공 함수
 * lecture_id[] => TimetableLecture[]
 */
const getLectures = async (
  lecture_list: number[]
): Promise<TimetableLecture[]> => {
  const lectures = await lecture_list.reduce(
    async (lecturesPromise: Promise<TimetableLecture[]>, lectureID) => {
      const lectures = await lecturesPromise.then();

      const lecture = await Lecture.findOne(lectureID);
      if (!lecture) return lectures;

      const { lecture_id, name, time, location, credit } = lecture;

      lectures.push({
        lecture_id,
        name,
        time,
        location,
        credit
      });
      return lectures;
    },
    Promise.resolve([])
  );

  return lectures;
};

type TimetableLecture = {
  lecture_id: number,
  name: string,
  time: string[],
  location: string[],
  credit: number
};

const searchSchema = Joi.object({
  keywords: Joi.string()
    .trim()
    .min(2)
    .required(),
  year: Joi.string()
    .trim()
    .length(4)
    .required(),
  term: Joi.string()
    .trim()
    .valid('1학기', '2학기', '여름학기', '겨울학기')
    .required(),
  timetable_id: Joi.number()
    .integer()
    .min(1),
  page: Joi.number()
    .integer()
    .default(1),
  count: Joi.number()
    .integer()
    .default(10)
});

const searchTimeSchema = Joi.object({
  year: Joi.string()
    .trim()
    .length(4)
    .required(),
  term: Joi.string()
    .trim()
    .valid('1학기', '2학기', '여름학기', '겨울학기')
    .required(),
  college: Joi.string()
    .trim()
    .required(),
  department: Joi.string()
    .trim()
    .required(),
  times: Joi.array()
    .items(
      Joi.string()
        .trim()
        .min(2)
    )
    .single()
    .unique()
    .required(),
  only: Joi.number()
    .integer()
    .default(0),
  timetable_id: Joi.number()
    .integer()
    .min(1),
  page: Joi.number()
    .integer()
    .default(1),
  count: Joi.number()
    .integer()
    .default(10)
});

const filterSchema = Joi.object({
  year: Joi.string()
    .trim()
    .length(4)
    .required(),
  term: Joi.string()
    .trim()
    .valid('1학기', '2학기', '여름학기', '겨울학기')
    .required(),
  category: Joi.string().trim(),
  college: Joi.string().trim()
});

const periodSchema = Joi.object({
  year: Joi.string()
    .trim()
    .length(4)
    .required(),
  term: Joi.string()
    .trim()
    .valid('1학기', '2학기', '여름학기', '겨울학기')
    .required()
});

const timetableIdSchema = Joi.object({
  timetable_id: Joi.number()
    .integer()
    .min(1)
});

const initTimetableSchema = Joi.object({
  year: Joi.string()
    .trim()
    .length(4)
    .required(),
  term: Joi.string()
    .trim()
    .valid('1학기', '2학기', '여름학기', '겨울학기')
    .required(),
  name: Joi.string()
    .trim()
    .default('무제')
});

const putTimetableSchema = Joi.object({
  name: Joi.string().trim(),
  lectures: Joi.array()
    .items(
      Joi.number()
        .integer()
        .min(1)
    )
    .single()
    .unique()
    .default([])
});

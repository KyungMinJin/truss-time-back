import { Entity, PrimaryGeneratedColumn, BaseEntity, Column, JoinColumn, ManyToOne } from 'typeorm';
import User from './User';

/**
 * @typedef Timetable
 * @property {number} timetable_id
 * @property {string} year
 * @property {string} term
 * @property {string} name
 * @property {Array.<Lecture>} lectures
 */

/**
 * 사용자가 저장한 시간표 테이블
 */
@Entity({ name: 'timetables' })
class Timetable extends BaseEntity {
  @PrimaryGeneratedColumn()
  timetable_id!: number;

  /**
   * 연도
   * 2019, 2018, ...
   */
  @Column({
    type: 'varchar',
    length: 4,
  })
  year!: string;

  /**
   * 학기(2종류)
   * 1학기, 2학기
   */
  @Column({
    type: 'varchar',
    length: 12,
  })
  term!: string;

  /**
   * 시간표 이름
   * 사용자 지정.
   */
  @Column({
    type: 'varchar',
    length: 20,
  })
  name!: string;

  /**
   * 시간표 주인의 user_id
   */
  @ManyToOne(type => User)
  @JoinColumn({ name: 'user_id' })
  user!: User;

  @Column()
  user_id!: number;

  /**
   * 시간표에 포함된 강의 목록
   * text에 저장된 lecture_id 배열
   * 특이사항: 2017년 1학기, 2학기에는 lecture_id가 아니라 code와 class로 구별된 값이 저장됨.
   * lecture_list: [{"code": "COSE212", "class": "01"}, {"code": "COSE214", "class": "03"}, {"code": "CNCE120", "class": "03"}]
   */
  @Column({
    type: 'simple-json',
    default: '[]',
  })
  lecture_list!: number[];

  /**
   * ???. backend 코드에도 없고 DB에도 내용을 찾을 수 없음.
   * 모든 레코드의 값이 NULL
   * 삭제해도 될 듯.
   */
  // @Column({
  //   type: 'varchar',
  //   length: 45,
  //   nullable: true,
  // })
  // option!: string;
}
export default Timetable;
import Express from 'express';
import * as timetablesCtrl from './timetables.ctrl';

const router = Express.Router();

router.get('/filters', timetablesCtrl.getFilters);
router.get('/search/keywords', timetablesCtrl.getLectureByKeywords);
router.get('/search/times', timetablesCtrl.getLecturesByTimes);

router.get('/', timetablesCtrl.getTimetables);
router.post('/', timetablesCtrl.postTimetables);

router.get('/:timetable_id', timetablesCtrl.getTimetableById);
router.put('/:timetable_id', timetablesCtrl.putTimetableById);
router.delete('/:timetable_id', timetablesCtrl.deleteTimetableById);

export default router;

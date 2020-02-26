import { Router } from 'express';
// import { checkLoggedIn } from '../lib/authentication';

const router = Router();

// router.use('/timetable', checkLoggedIn, lectures);
router.use('/timetable', (req, res) => {
  res.send('timetable page');
});

export default router;

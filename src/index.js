import Express from 'express';
import api from './api';

const app = Express();
const PORT = process.env.PORT ? process.env.PORT : 3000;

// Routing 설정
app.use('/api', api);

app.listen(PORT, () => {
  console.log(`${PORT} port에 http server를 띄웠습니다.`);
});

import Express from 'express';

const app = Express();

app.get('/', (req, res) => {
  res.send('index page');
});
app.get('/test', (req, res) => {
  res.send('test page');
});
app.get('/member', (req, res) => {
  res.send('member page');
});
app.get('/board', (req, res) => {
  res.send('board page');
});

app.post('/write', function(req, res) {
  res.send(req.body);
});

app.listen(3000, () => {
  console.log(`3000번 port에 http server를 띄웠습니다.`);
});

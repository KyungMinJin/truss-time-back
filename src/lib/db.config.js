import MySQL from 'mysql';

const connection = MySQL.createConnection({
  host: 'us-cdbr-iron-east-04.cleardb.net',
  user: 'b36fc57ade02f1',
  password: '8489c862',
  database: 'heroku_e1b46640afdb0f1'
});

async function createMemberTable(conn) {
  await conn.query(
    'create table if not exists member (id varchar(20), password char(64), ' +
      'class int, email varchar(50), name varchar(10), phone_number varchar(11), ' +
      'primary key(id));'
  );
  console.log('Create member table');
}

async function createBoardTable(conn) {
  await conn.query(
    'create table if not exists board (board_id int auto_increment, board_class int, ' +
      'title varchar(80), start_at datetime, created_at datetime, day_of_week char(2), end_at datetime, id varchar(20), ' +
      'primary key(board_id), foreign key(id) references member(id));'
  );
  console.log('Create board table');
}
connection.connect();

export default async function DBConfig() {
  let conn, code;
  try {
    // conn = await connection.connect();
    connection.query('SELECT * from member', function(err, rows, fields) {
      if (!err) console.log('The solution is: ', rows);
      else console.log('Error while performing Query.', err);
    });

    connection.end();
    console.log('Initialized!');
    // createMemberTable(conn);
    // createBoardTable(conn);
    code = 0;
  } catch (err) {
    code = 1;
  } finally {
    if (conn) {
      await conn.end();
      console.log('db connect');
      process.exit(code);
    }
  }
}

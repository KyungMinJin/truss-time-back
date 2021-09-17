<!DOCTYPE html>
<html>
<head><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Gowun+Dodum&family=IBM+Plex+Sans+KR&family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">
<title>고려대학교 TRUSS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
	include 'db_info.php';

	$no = (int) $_GET['no'];
	$no = $no + 1;
	$teamname = $_GET['teamname'];
	$writer = $_POST['writer'];
	$content = $_POST['content'];

	$query = "INSERT INTO reply (teamname, no, writer, content) VALUES('$teamname', '$no', '$writer', '$content')";
	mysqli_query($connect, $query);

	echo "<script>location.href='search.php?teamname=$teamname';</script>";
	mysqli_close($connect);
?>
</body>
</html>
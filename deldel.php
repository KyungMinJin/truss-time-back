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
	$isitOK = true;

	include 'db_info.php';

	$teamname = $_GET['teamname'];
	$teampw = $_POST['teampw'];

	$query = "SELECT * FROM team WHERE teamname='$teamname'";
	$data = mysqli_query($connect,$query);
	$result = mysqli_fetch_array($data);
	$temp_old = $result['isTemp'];
	$pw = $result['teampw'];

	if($teampw != $result['teampw']){
		echo "<script>alert('관리용 비밀번호가 맞지 않습니다.'); history.go(-1);</script>";
		mysqli_free_result($data);
		$isitOK = false;
	}

	$truss_ck = $_POST['truss_ck'];
	if($truss_ck != "carbon12" && $truss_ck != "CARBON12"){ // not trussian
		echo "<script>alert('TRUSS 인증에 실패하였습니다.'); history.go(-1);</script>";
		$isitOK = false;
	}//if

	$week = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");

	if($isitOK){
		// 드랍
		$query = "DELETE FROM `team` WHERE `teamname`='$teamname'";
		mysqli_query($connect, $query);
		$query = "DELETE FROM `teamtime` WHERE `teamname`='$teamname'";
		mysqli_query($connect, $query);
		for($i=0;$i<7;$i++){
			if($temp_old == "true") $query = "UPDATE timetable_temp SET $week[$i]='' WHERE $week[$i]='$teamname'";
			else $query = "UPDATE timetable SET $week[$i]='' WHERE $week[$i]='$teamname'";
			mysqli_query($connect, $query);
		}
		echo "<script>alert('삭제가 완료되었습니다ㅠㅠ'); location.href='timetable.php';</script>";
	}
	mysqli_close($connect);
?>
</body>
</html>
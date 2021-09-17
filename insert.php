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

	$week = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
	$count=0;
	
	include 'db_info.php';

	$start = array();
	$end = array();

	for($i=0;$i<7;$i++){ // time vaild check
		$dayday = $week[$i];
		$start_time = $_POST[$week[$i]."_start"];
		$end_time = $_POST[$week[$i]."_end"];
		$start[$i] = $start_time;
		$end[$i] = $end_time;

		if($_POST[$dayday."_end"] == 0){
			$count++;
			continue;
		}
		//db check
		$query = "SELECT * FROM teamtime WHERE $dayday"."_start < $end_time and $dayday"."_end > $start_time";
		$time_check = mysqli_query($connect, $query);
		if(mysqli_num_rows($time_check) != 0){
			mysqli_free_result($time_check);
			echo "<script>alert('합주시간이 다른 팀과 겹칩니다.'); history.go(-1);</script>";
			$isitOK = false;
		}
	}
	if($count == 7){
		echo "<script>alert('합주 시간이 지정되지 않았습니다.'); history.go(-1);</script>";
		$isitOK = false;
	}

	// get data from 'write.php' by 'POST' method
	$teamname = $_POST['teamname'];
	$teampw = $_POST['teampw'];
	$teampw2 = $_POST['teampw2'];
	$vocal = $_POST['vocal'];
	$first = $_POST['first'];
	$second = $_POST['second'];
	$bass = $_POST['bass'];
	$drum = $_POST['drum'];
	$keyboard = $_POST['keyboard'];
	$memo = $_POST['memo'];
	$isTemp = $_POST['isTemp'];
	$timelim = $_POST['timelimit'];

	date_default_timezone_set("Asia/Seoul");
	
	if ($teamname == ""){
		echo "<script>alert('합주팀 이름을 적어주세요'); history.go(-1);</script>";
		$isitOK = false;
	}
	if ( strpos($teamname, "\"") || strpos($teamname, "'")){
		echo "<script>alert('팀 이름에 따옴표를 포함할 수 없습니다'); history.go(-1);</script>";
		$isitOK = false;
	}
	if ($teampw == ""){
		echo "<script>alert('합주팀 관리용 비밀번호를 적어주세요'); history.go(-1);</script>";
		$isitOK = false;
	}
	if ($teampw != $teampw2){
		echo "<script>alert('팀 비밀번호 확인이 같지 않습니다.'); history.go(-1);</script>";
		$isitOK = false;
	}
	
	$teamname_check = mysqli_query($connect, "SELECT * FROM team WHERE teamname='$teamname'");
	if ( mysqli_num_rows($teamname_check) != 0 ) {
		mysqli_free_result($teamname_check);
		echo "<script>alert('이미 사용중인 팀이름입니다'); history.go(-1);</script>";
		$isitOK = false;
	}
	if($isTemp == "true"){
		if($timelim == 50){
			echo "<script>alert('임시 합주팀의 경우 팀 유효기한을 정하셔야 합니다.'); history.go(-1);</script>";
			$isitOK = false;
		}
		else{
			$timelimit = date("Y년 m월 d일", strtotime("+".$timelim." days"));
		}
	}
	else{
		$isTemp = "false";
		$timelimit = "";
	}

	$truss_ck = $_POST['truss_ck'];
	if($truss_ck != "carbon12" && $truss_ck != "CARBON12"){ // not trussian
		echo "<script>alert('TRUSS 인증에 실패하였습니다.'); history.go(-1);</script>";
		$isitOK = false;
	}//if

	if($isitOK){
		// team
		$query = "INSERT INTO team (teamname, teampw, vocal, first, second, bass, drum, keyboard, memo, isTemp, timelimit) VALUES('$teamname', '$teampw', '$vocal', '$first', '$second', '$bass', '$drum', '$keyboard', '$memo', '$isTemp', '$timelimit')";
		mysqli_query($connect, $query);

		// teamtime
		$query = "INSERT INTO teamtime (teamname, monday_start, monday_end, tuesday_start, tuesday_end, wednesday_start, wednesday_end, thursday_start, thursday_end, friday_start, friday_end, saturday_start, saturday_end, sunday_start, sunday_end) VALUES('$teamname', '$start[0]', '$end[0]', '$start[1]', '$end[1]', '$start[2]', '$end[2]', '$start[3]', '$end[3]', '$start[4]', '$end[4]', '$start[5]', '$end[5]', '$start[6]', '$end[6]')";
		mysqli_query($connect, $query);
		
		// timetable
		for($i=0;$i<7;$i++){
			if($end[$i] == 0) continue;
			for($j=$start[$i];$j<$end[$i];$j+=50){
				if($isTemp == "true") $query = "UPDATE timetable_temp SET $week[$i]='$teamname' WHERE time='$j'";
				else $query = "UPDATE timetable SET $week[$i]='$teamname' WHERE time='$j'";
				mysqli_query($connect, $query);
			}
		}

	echo "<script>alert('등록에 성공하였습니다.'); location.href='timetable.php';</script>";
	}
	mysqli_close($connect);
?>
</body>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : TwoColours 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130811

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>고려대학교 TRUSS</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="menu" class="container">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="miguhyun.php">공지사항</a></li>
				<li class="current_page_item"><a href="timetable.php">합주시간표</a></li>
				<li><a href="phones_auth.php">연락처</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#" class="icon icon-music"> TRUSS</a></h1>
				<p>True Romance under the six strings</p>
			</div>
			<div id="banner"> <a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a> </div>
		</div>
	</div>
	<div>
	<br>

<?php
include 'db_info.php';
$teamname = $_GET['teamname'];
$query = "SELECT * FROM team WHERE teamname='$teamname'";
$data = mysqli_query($connect, $query);
$result = mysqli_fetch_array($data);
?>
<br>
<div id="header" class="container">
<h1 class="icon icon-search" style="text-align:center"> <?php echo $teamname; if($result['isTemp'] == "true") echo " (임시) ".$result['timelimit']." 까지"; ?></h1>
<br></div>
<div id="header" class="container" style="width:70%"><!-- style="width:100%; margin:0 auto;">-->
<p style="text-align:left; float:left;"><a style="text-align:left; color:red;" onclick="window.history.go(-1); return false;" href="timetable.php">돌아가기</a></p>
<p style="text-align:right; float:right"><a style="text-align:right; color:red;" href=<?php echo '"edit.php?teamname='.$teamname.'"'; ?>>합주팀 관리</a> / <a style="text-align:right; color:red;" href=<?php echo '"delete.php?teamname='.$teamname.'"'; ?>>합주팀 삭제</a></p>
<?php
$pattern = '/(?:https?:\/\/)?(?:www\.)?(?:m\.)?(?:youtube\.com|youtu\.be)\/(?:watch\?v=|embed\/)?([0-9a-zA-Z_\-]{11})/';
$replacement = '<br><iframe width="800" height="450" src="https://www.youtube.com/embed/$1" frameborder="0" allowfullscreen></iframe><br>';
?>

<table class="table table-bordered" style="width:100%; margin:0 auto;">
<tr>
	<td class="danger" align="right">팀 이름</td>
	<td align="left">
	<?php
		echo $result['teamname'];
		$truss_ck = $_POST['truss_ck'];
		if($truss_ck == "carbon12" || $truss_ck == "CARBON12"){ // not trussian
			$show = true;
			echo '</td><td class="danger" style="width:30%">연락처</td>';
		}//if
		else{
			$show = false;
			echo '</td><td class="danger" style="width:30%">연락처(인증필요)</td>';
		}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">보컬</td><td align="left"><?php $findphone = $result['vocal']; echo $result['vocal']; ?></td>
	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL';
		}
		echo '</td>';
	}
	else{
		echo '<form action="search.php?teamname='.$teamname.'" method="post" enctype="multipart/form-data" /><td rowspan="6">TRUSS 인증번호:<br><input type="password" name="truss_ck" size="30" style="ime-mode:disabled;"><br><input type="submit" name="b_insert" value="인증" style="width:50px"></td></form>';
	}
	?>
	<!--<td align="left"><textarea name="memo" cols="60" rows="10"></textarea></td>-->
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">퍼스트기타</td><td align="left"><?php $findphone = $result['first']; echo $result['first']; ?></td>
	<!--<td align="right">첨부파일</td><td align="left"><input type="file" name="upfile"></td>-->
	
	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL</td>';
		}
	}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">세컨드기타</td><td align="left"><?php $findphone = $result['second']; echo $result['second']; ?></td>
	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL</td>';
		}
	}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">베이스기타</td><td align="left"><?php $findphone = $result['bass']; echo $result['bass']; ?></td>
	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL</td>';
		}
	}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">드럼</td><td align="left"><?php $findphone = $result['drum']; echo $result['drum']; ?></td>

	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL</td>';
		}
	}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right">키보드</td><td align="left"><?php $findphone = $result['keyboard']; echo $result['keyboard']; ?></td>

	<?php // find phone number
	if($show){
		echo '<td style="width:30%">';
		$query = "SELECT * FROM phone WHERE name='$findphone'";
		$data_hp = mysqli_query($connect, $query);
		$count = 0;
		while($result_hp = mysqli_fetch_array($data_hp)){
			if($count > 0){
				echo '<br>';
			}
			echo $result_hp[2].'기 '.$result_hp[0].' : '.$result_hp[1];
			$count += 1;
		}
		if($count == 0){
			echo 'NULL</td>';
		}
	}
	?>
</tr>
<tr>
	<td style="width:20%" class="danger" align="right"><br><br>선곡 리스트<br>또는 하고 싶은 말</td>
	<td align="left" colspan="2">
		<?php echo preg_replace($pattern,$replacement,$result['memo']); ?>
	</td>
</tr>

</table>
</form>

</div>
<div id="header" class="container">
<br><br><h1 class="icon icon-pencil" style="text-align:center">댓글</h1><br>
<table class="table table-bordered table-hover" style="width:70%; margin:0 auto;">
<?php
	$query = "SELECT no, writer, content FROM reply WHERE teamname='".$teamname."' ORDER BY no ASC";
	$data = mysqli_query($connect, $query);
	$reply = 0;
	while($result = mysqli_fetch_array($data)){
		$reply += 1;
		if($reply == 1){
			echo '<tr><td style="width:10%" class="info">no</td><td style="width:15%">이름</td><td style="width:75%">내용</td></tr>';
		}
		echo '<tr><td class="info">'.$reply.'</td><td>'.$result[1].'</td><td>'.$result[2].'</td></tr>';
	}
	if($reply == 0){
		echo '<tr><td style="width:100%">댓글이 없습니다!</td></tr>';
	}
	$query = "SELECT max(no) from reply;";
	$data = mysqli_query($connect, $query);
	$realno = mysqli_fetch_array($data)[0];
?>
</table>
<br>
<form action=<?php echo '"reply.php?teamname='.$teamname.'&no='.$realno.'"'; ?> method="post" enctype="multipart/form-data" />
<table class="table table-bordered table-hover" style="width:70%; margin:0 auto;">
<tr><td>댓글 남기기</td></tr>
<tr><td>이름: <input type="text" name="writer" style="width:15%">  내용: <input type="text" name="content" style="width:65%">  <input type="submit" name="b_insert" value="등록" style="width:50px"></td></tr>
</table>
</form>
</div>
<div id="header" class="container">
<br><br>
</div>
</div>
</div>
<?php
	mysqli_free_result($data);
	mysqli_free_result($data_hp);
	mysqli_close($connect);
?>
</body>
</html>
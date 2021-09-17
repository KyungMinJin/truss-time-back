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
<head><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Gowun+Dodum&family=IBM+Plex+Sans+KR&family=Noto+Sans+KR:wght@500&display=swap" rel="stylesheet">

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
				<li ><a href="timetable.php">합주시간표</a></li>
				<li class="current_page_item"><a href="muni.php">문의</a></li>
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
	<h1  style="text-align:center"> 문의 사항(버그 제보)<br><br></h1>
<form action="send_muni.php" method="post" enctype="multipart/form-data" />
<table class="table table-bordered" style="width:75%; margin:0 auto;">
<tr>
	<td class="danger" align="right">이름</td><td align="left"><input type="text" name="sender" size="30"></td>
</tr>
<tr>
	<td class="danger" align="right">제목</td><td align="left"><input type="text" name="sub" size="30"></td>
</tr>
<tr>
	<td class="danger" align="right">문의 사항</td>
	<td align="left"><textarea name="muni" cols="60" rows="10"></textarea></td>
</tr>
<tr>
	<td colspan="2">TRUSS 인증 비밀번호: <input type="password" name="truss_ck" size="30" style="ime-mode:disabled;"><input type="submit" name="b_insert" value="등록" style="width:50px">
        <button type="button" onclick="location.href='index.php'" style="width:50px">취소</button></td>
</tr>
</table>
</form>
</body>
</html>	
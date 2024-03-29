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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

    <!-- Optional theme -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> -->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>고려대학교 TRUSS</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>
<?php
		$isitOK = true;

		$truss_ck = $_POST['truss_ck'];
		if($truss_ck != "carbon12" && $truss_ck != "CARBON12"){ // not trussian
			echo "<script>alert('TRUSS 인증에 실패하였거나 잘못된 접근입니다.'); location.href='phones_auth.php'; </script>";
			$isitOK = false;
		}//if
?>

<body>
    <div id="wrapper">
        <!-- <div id="header-wrapper">
		<div id="menu" class="container">
			<ul>
				<li><a href="index.php"><h1>Home</h1></a></li>
				<li><a href="miguhyun.php">공지사항</a></li>
				<li><a href="timetable.php"><h2>합주시간표</h2></a></li>
				<li class="current_page_item"><a href="phones_auth.php"><h2>연락처</h2></a></li>
			</ul>
		</div>
		end #menu
		<div id="header" class="container">
			<div id="logo">
				<h1><a href="#"> TRUSS</a></h1>
				<p>True Romance under the six strings</p>
			</div>
			<div id="banner"> <a href="#" class="image"><img src="images/pic01.jpg" alt="" /></a> </div>
		</div>
	</div> -->
        <div id="header-wrapper">
            <div id="menu" class="container" sty;e="margin: 0">
                <div id="header-inner"
                    style="display:flex; max-width: 1110px; justify-content: space-between; align-items:center; margin: 0 auto; height: 100%;">
                    <div style="font-size: 2em; ">
                        <div OnClick="location.href='index.php'">TRUSS</div>
                    </div>
                    <div style="display:flex; align-items: center;">
                        <!-- <li><a href="miguhyun.php">공지사항</a></li> -->
                        <!-- <li class="current_page_item"> -->
                        <a href="timetable.php" class="current_page_item" style="height: 100px; line-height: 100px;">
                            <h2>합주시간표</h2>
                        </a>
                        <!-- </li> -->
                        <!-- <li> -->
                        <a href="phones_auth.php" style="height: 100px; line-height: 100px;">
                            <h2>연락처</h2>
                        </a>
                    </div>
                    <!-- </li> -->
                </div>
                <!-- end #menu -->
                <!-- <div id="header" class="container">
					<div id="logo">
						<h1><a href="#"> TRUSS</a></h1>
						<p>True Romance under the six strings</p>
					</div>
				</div> -->
            </div>
        </div>
        <div>
            <br>
            <div id="header" class="container">
                <h1 style="text-align:center"> 연락처 목록<br><br></h1>
                <form action="insert.php" method="post" enctype="multipart/form-data"></form>
                <div id="header" class="container" style="width:75%; text-align:left;">
                    <a href="addphone.php">
                        <p style="text-align:right; color:red;">연락처 등록</p>
                    </a>
                    <table class="table table-bordered" style="margin:0 auto;">
                        <tr class="danger">
                            <td style="width:20%">기수</td>
                            <td style="width:25%">이름</td>
                            <td style="width:45%">연락처</td>
                            <td></td>
                        </tr>
                        <!-- <?php
        // if($isitOK){
        // 	include 'db_info.php';
        // 	$query = "SELECT * FROM phone ORDER BY th DESC";
        // 	$data = mysqli_query($connect, $query);
        // 	while($result = mysqli_fetch_array($data)){
        // 		echo '<tr><td>'.$result[2].'</td><td>'.$result[0].'</td><td>'.$result[1].'</td><td>삭제</td></tr>';
        // 	}
        // 	mysqli_free_result($data);
        // }
    ?> -->
                    </table>
                </div>
            </div>
            </form>
            <br><br>
            <div id="copyright" class="container" style="padding: 2em 0em;">
                <p>&copy; Untitled. All rights reserved. | Photos by TRUSS | Design by <a href="http://templated.co"
                        rel="nofollow">TEMPLATED</a></p>
                <ul class="contact">
                    <!--<li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>-->
                    <li><a href="https://www.facebook.com/profile.php?id=100009047977821"><img src="images/facebook-logo.png"
                        style="height:40px;" /></a></li>
                    <!--<li><a href="#" class="icon icon-dribbble"><span>Pinterest</span></a></li>
			<li><a href="#" class="icon icon-tumblr"><span>Google+</span></a></li>
			<li><a href="#" class="icon icon-rss"><span>Pinterest</span></a></li>
			-->
                </ul>
            </div>
</body>

</html>
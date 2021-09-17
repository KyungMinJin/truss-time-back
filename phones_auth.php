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
    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    <link href="default.css" rel="stylesheet" type="text/css" media="all" />
    <link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

    <!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->

</head>

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
                    <div>
                        <h1 id="truss-header" OnClick="location.href='index.php'">TRUSS</h1>
                    </div>
                    <div style="display:flex; align-items: center;">
                        <!-- <li><a href="miguhyun.php">공지사항</a></li> -->
                        <!-- <li class="current_page_item"> -->
                        <a href="timetable.php" style="height: 100px; line-height: 100px;">
                            <h2>합주시간표</h2>
                        </a>
                        <!-- </li> -->
                        <!-- <li> -->
                        <a href="phones_auth.php" class="current_page_item" style="height: 100px; line-height: 100px;">
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
                <form action="phones.php" method="post" enctype="multipart/form-data">
                    <table class="table table-bordered" style="width:30%; margin:0 auto;">
                        <tr>
                            <td class="danger" style="text-align: center;">TRUSS 인증</td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">TRUSS 인증번호: <input type="password" name="truss_ck" size="30"
                                    style="ime-mode:disabled;"></td>
                        </tr>
                        <tr>
                            <td style="text-align: center;"><input type="submit" name="b_insert" value="인증"
                                    style="width:50px">
                                <button type="button" onclick="window.history.go(-1); return false;"
                                    style="width:50px">취소</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
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
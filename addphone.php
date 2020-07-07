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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

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
                <div id="header-wrapper">
            <div id="menu" class="container" sty;e="margin: 0">
                <div id="header-inner"
                    style="display:flex; max-width: 1080px; justify-content: space-between; align-items:center; margin: 0 auto; height: 100%;">
                    <div style="font-size: 3em; font-weight:600; color:white;">
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
            <h1 class="icon icon-pencil" style="text-align:center"> 연락처 등록(최대 10명)<br><br></h1>
            <form action="addadd.php" method="post" enctype="multipart/form-data" />
            <table class="table table-bordered" style="width:75%; margin:0 auto;">
                <tr class="danger">
                    <td style="width:20%">기수</td>
                    <td style="width:25%">이름</td>
                    <td>연락처</td>
                </tr>
                <?php
	for($i=0;$i<10;$i++){
		echo '<tr> <td align="left"><input type="text" maxlength="2" onkeydown="return onlyNumber(event)" onkeyup="removeChar(event)" style="ime-mode:disabled; width:100%;" name="th_'.$i.'">	<td align="left"><input type="text" name="name_'.$i.'" style="width:100%"></td> <td align="left"><input type="text" maxlength="11" onkeydown="return onlyNumber(event)" onkeyup="removeChar(event)" style="ime-mode:disabled; width:100%;" name="hp_'.$i.'"></td> </tr>';
	}
?>
                <tr>
                    <td colspan="3">TRUSS 인증 비밀번호: <input type="password" name="truss_ck" size="30"
                            style="ime-mode:disabled;"><input type="submit" name="b_insert" value="등록"
                            style="width:50px">
                        <button type="button" onclick="window.history.go(-1); return false;"
                            style="width:50px">취소</button></td>
                </tr>
            </table>
            </form>
            <script>
            function onlyNumber(event) {
                event = event || window.event;
                var keyID = (event.which) ? event.which : event.keyCode;
                if ((keyID >= 48 && keyID <= 57) || (keyID >= 96 && keyID <= 105) || keyID == 8 || keyID == 9 ||
                    keyID == 46 || keyID == 37 || keyID == 39)
                    return;
                else
                    return false;
            }

            function removeChar(event) {
                event = event || window.event;
                var keyID = (event.which) ? event.which : event.keyCode;
                if (keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39)
                    return;
                else
                    event.target.value = event.target.value.replace(/[^0-9]/g, "");
            }
            </script>
</body>

</html>
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
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->

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

            <?php
include 'db_info.php';
// temp team check and destroy
$color;
date_default_timezone_set("Asia/Seoul");
$today = date("Y년 m월 d일");
$query = "SELECT teamname FROM team WHERE istemp='true' and timelimit<'$today'";
$data = mysqli_query($connect, $query);
$week = array("monday", "tuesday", "wednesday", "thursday", "friday", "saturday", "sunday");
while($result = mysqli_fetch_array($data)){
	$query = "DELETE FROM team WHERE teamname='$result[0]'";
	mysqli_query($connect, $query);
	echo "<script>alert('$query');</script>";
	$query = "DELETE FROM teamtime WHERE teamname='$result[0]'";
	mysqli_query($connect, $query);
	for($i=0;$i<7;$i++){
		$query = "UPDATE timetable_temp SET $week[$i]='' WHERE $week[$i]='$result[0]'";
		mysqli_query($connect, $query);
	}
}
// trash value delete
$query = "SELECT * FROM timetable_temp";
$data = mysqli_query($connect, $query);
while($result = mysqli_fetch_array($data)){
	for($i=1;$i<8;$i++){
		$query = "SELECT teamname FROM team WHERE teamname='".$result[$i]."'";
		$data2 = mysqli_query($connect, $query);
		if($result[$i] == ''){
			continue;
		}
		if(!($result2 = mysqli_fetch_array($data2))){
			$i = $i - 1;
			$query = "UPDATE timetable_temp SET $week[$i]='' WHERE time=$result[0]";
			$i = $i + 1;
			mysqli_query($connect, $query);
		}
	}
}
mysqli_free_result($data);
mysqli_free_result($data2);
?>
            <br>
            <div id="header" class="container">
                <!-- style="width:100%; margin:0 auto;">-->
                <h1 style="text-align:center"> 합주 시간표</h1>
                <div
                    style="display: flex; flex-direction: row-reverse; max-width: 1080px; margin: 10px auto; vertical-align:middle;">
                    <div
                        style="width: 100px; height: 40px; border: 1px solid black; border-radius: 20px; display: flex; justify-content: center; align-items: center;">
                        <a href="write.php">합주팀 등록</a>
                    </div>
                </div>
                <div class="timetable" style="width: 100vw">
                    <table class="table">
                        <tr align="center">
                            <th width="80">시작 시간</td>
                            <th width="110">월</th>
                            <th width="110">화</th>
                            <th width="110">수</th>
                            <th width="110">목</th>
                            <th width="110">금</th>
                            <th width="110">토</th>
                            <th width="110">일</th>
                        </tr>
                        <?php
	$query = "SELECT * FROM timetable";
	$data = mysqli_query($connect, $query);
	$query = "SELECT * FROM timetable_temp";
	$data_temp = mysqli_query($connect,$query);

	for($clock=900; $clock<2400; $clock+=50){
		$result = mysqli_fetch_array($data);
		$result_temp = mysqli_fetch_array($data_temp);

		$hour = (int)($clock / 100);
		$min = $clock % 100;
		$time = "오후 ";
		if($hour < 12){
			$time = "오전 ";
		}
		if($hour > 12){
			$hour = $hour - 12;
		}
		if($min == 0){
			$minute = "00";
		}
		else{
			$minute = "30";
		}
		$time .= $hour.":".$minute;
?>

                        <tr align="center">
                            <td align="right"><?php echo $time; ?></td>

                            <?php
		for($i=1;$i<8;$i++){
			// regular
			if($result[$i] != ""){
				echo '<script>console.log('.$color[$result[$i]].')</script>';

				if ($color[$result[$i]] == null){
					$color[$result[$i]] = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
				}
				$reply = mysqli_query($connect, "SELECT * FROM reply WHERE teamname='".$result[$i]."'");
				$r_count = mysqli_num_rows($reply);
				echo "<td class=".$result[$i]." style=\"background: ".$color[$result[$i]]."; color: white;\"><a href=\"search.php?teamname=$result[$i]\">".$result[$i]."</a></td>";
				mysqli_free_result($reply);
			}
			// temp
			else if($result_temp[$i] != ""){
				$reply = mysqli_query($connect, "SELECT * FROM reply WHERE teamname='".$result_temp[$i]."'");
				$r_count = mysqli_num_rows($reply);
				echo "<td class='danger' style=\"background: #f2738c; color: white;\"><a href=\"search.php?teamname=$result_temp[$i]\">".$result_temp[$i]."</a></td>";
				mysqli_free_result($reply);
			}
			// no team
			else echo "<td><a href=\"search.php?teamname=$result[$i]\">".$result[$i]."</a></td>";

		}// for day
	}// for clock
	echo "</tr>";

	mysqli_free_result($data);
	mysqli_close($connect);

?>
                    </table>
                </div>
            </div>
        </div>
    </div>
                <div id="copyright" class="container" style="padding: 2em 0em;">
        <p>&copy; Truss. All rights reserved. | Photos by TRUSS | Design by <a href="http://templated.co"
                rel="nofollow">TEMPLATED</a> | Edited by 28기 진경민</p>
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
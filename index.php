<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Scoreboard 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20130602

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>고려대학교 TRUSS 합주게시판</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="./default.css" rel="stylesheet" type="text/css" media="all" />
<!-- <link href="./fonts.css" rel="stylesheet" type="text/css" media="all" /> -->
<!--[if IE 6]>
<link href="default_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
</head>
<body>
<div id="wrapper">
	<div id="header-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="#"><h1>Home</h1></a></li>
				<!-- <li><a href="miguhyun.php">공지사항</a></li> -->
				<li><a href="timetable.php"><h1>합주시간표</h1></a></li>
				<li><a href="phones_auth.php"><h1>연락처</h1></a></li>
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
	<div id="page" class="container">
		<div id="content">
			<div class="title">
				<h2>고려대학교 밴드동아리 TRUSS</h2>
				<span class="byline">오픈밴드 크오와아아아앙</span> </div>
			<span class="image image-full"><img src="images/pic05.jpg" alt="" /></span>

			<p>This is 그냥존나 <strong>Rock Band</strong>! 현재 트러스의 슬로건인 오픈밴드라는 명칭은 중앙 밴드 동아리 중 가입 오디션이 없으며 <del style="color:gray">보컬뽑는다면서 노래방 단체로 가서 못부르는사람은 악기세션으로 돌리자나</del> 가입이 자유로운 밴드라는 점에 기인하여 붙은 명칭이다. 실제로 신입생 가입 기준이 없으며 매년 초에 한 번 신입기수를 뽑지만 학번 제한 같은 것도 없어 신입생과 4~5학번 차이나는 고학번이 동아리 신입으로 가입하기도 한다.</p>
			<!-- youtube default 800:450 -->
			<span><br><iframe width="680" height="400" src="https://www.youtube.com/embed/UyvpFIXx04c" frameborder="0" allowfullscreen></iframe></span>
		
		</div>
		<div id="sidebar">
			<div class="box1">
				<div class="title">
					<h2>최근 공지사항</h2>
				</div>
				<ul class="style2">
					<li><a href="#">(2019.08.18)합주시간표에 댓글이 달리지 않던 버그를 수정하였습니다.</a></li>
					<li><a href="#">(2017.05.28)합주팀 상세정보에 세션별 연락처가 표시됩니다.</a></li>
					<li><a href="#">&#54633;&#51452;&#54016; &#48324; &#45843;&#44544; &#44592;&#45733;&#51060; &#52628;&#44032;&#46104;&#50632;&#49845;&#45768;&#45796;!</a></li>
					<!--
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
					<li><a href="#">Consequat etiam lorem phasellus</a></li>
					<li><a href="#">Amet turpis, feugiat et sit amet</a></li>
					<li><a href="#">Semper mod quisturpis nisi</a></li>
					-->
				</ul>
			</div>
			<!-- <div class="box2">
				<div class="title">
					<h2>행사 일정</h2>
				</div>
				<ul class="style2">
					<li><a href="#">다음 행사가 뭐있징</a></li> -->
					<!--
					<li><a href="#">Ornare in hendrerit in lectus</a></li>
					<li><a href="#">Semper mod quis eget mi dolore</a></li>
					<li><a href="#">Quam turpis feugiat sit dolor</a></li>
					<li><a href="#">Amet ornare in hendrerit in lectus</a></li>
					<li><a href="#">Consequat etiam lorem phasellus</a></li>
					-->
				<!-- </ul>
			</div>
			<br><br><br> -->
			<div class="box3">
				<div class="title">
					<h2>오늘 합주</h2>
				</div>
					<?php
						include 'db_info.php';
						date_default_timezone_set("Asia/Seoul");
						$week = array("sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday");
						$today = $week[date('w')];
						$query = "SELECT ".$today."_start, ".$today."_end, teamname FROM teamtime WHERE ".$today."_start > 0 ORDER BY ".$today."_start";
						$data = mysqli_query($connect, $query);
						$none = 0;
						while($result = mysqli_fetch_array($data)){
							$none++;
							echo '<ul class="style2">';
							$clock = $result[0];
							$hour = (int)($clock / 100);
							$min = $clock % 100;
							$time = "오후 ";
							if($hour < 12){
								$time = "오전 ";
							}
							else if($hour >12){
								$hour -= 12;
							}
							if($min == 0){
								$minute = "00";
							}
							else{
								$minute = "30";
							}
							$time .= $hour.":".$minute;

							$clock = $result[1];
							$hour = (int)($clock / 100);
							$min = $clock % 100;
							$time2 = "오후 ";
							if($hour < 12){
								$time2 = "오전 ";
							}
							else if($hour >12){
								$hour -= 12;
							}
							if($min == 0){
								$minute = "00";
							}
							else{
								$minute = "30";
							}
							$time2 .= $hour.":".$minute;

							echo '<li>'.$time." ~ ".$time2.' : <a href="search.php?teamname='.$result[2].'">'.$result[2].'</a> 팀</li></ul>';
						}
						mysqli_free_result($data);
						if($none == 0){
							echo '<ul class="style2"><li>오늘은 합주가 없습니다.</li></ul>';
						}
					?>
			</div>
			<!-- <div class="box4">
				<div class="title">
					<h2>다운로드</h2>
				</div> -->
				<!--
				<ul class="style2">
					<li><a href="https://www.dropbox.com/s/6w5rucv6k1hf3hy/kutruss_install_android.apk?dl=0"><img width="150px" src="download/android.png" /></a></li>
				</ul>
				-->
			</div>
		</div>
	</div>
</div>
<div id="portfolio-wrapper">
	<div id="portfolio" class="container">
		<h1 class="icon icon-tasks" align="center"> 주요 행사</h2>
		<br><br><br><br>
		<div id="column1">
			<div class="title">
				<h2>신입생 환영회 / 총 MT</h2>
			</div>
			<p>신입생이 바글거릴 3월 말즈음 고학번 선배까지 불러모아서 신입생과 술을 마시는 행사이다. 뭐 대단한건 아니고 일종의 대면식이라고 봐도 된다. 커팅이 시작되기 전 선배들에게 얼굴 도장 찍을 몇 안 되는 기회다.</p>
			<p>신환회가 끝나고 4월 초중순 즈음 우이동에서 진행한다. 말 그대로 MT. 총MT만의 특징이라면 MT주제에 고학번 선배들까지 바글바글 온다는 점과 '오배주'를 들 수 있다. 기장 및 부기장 즉, 감투를 쓴자들은 후술할 기장선거 MT에서 오배주의 업그레이드 버전인 십(十)배주를 마시게 된다. </p>
			<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
		<div id="column2">
			<div class="title">
				<h2>워크샵 / 주점</h2>
			</div>
			<p>4월 말 즈음 진행하며 신입생과 현역이 팀을 이루어 하는 첫 공연이다. 공연이라기보다는 합주 맛보기 및 재롱잔치에 가깝다. 뭘 해도 까이지 않고 좋다꾸나 하는 편. </p>
			<p>5월즈음 해서 여는 행사로 캠퍼스 길바닥에서 하는 타 과 및 타 동아리와 다르게 건물을 빌려다 한다. 마침 안암오거리에 적절한 건물이 있어 매년 그 곳을 애용한다. 창렬푸드를 주로 팔며 공연도 같이 한다.</p>
			<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
		<div id="column3">
			<div class="title">
				<h2>대천 합숙 / 정기공연</h2>
			</div>
			<p>주점이 끝나고나면 10월말 또는 11월 초에 있을 정기공연에 대비하여 정기공연 팀을 편성하고 합주를 진행하게 된다. 그러다 여름방학이 끝나가고 개강이 다가올 무렵 (주로 8월 중~말) 고려대학교 대천수련원에 가서 3박4일 합숙훈련을 한다.</p>
			<p>매년 10월 말 또는 11월 초에 418 기념관에서 1년차 신입과 2년차 현역들로 구성된 팀들과 5년차 OB팀으로 구성된 공연을 한다.입장료는 무료다. 친구 중에 트러스를 하는 친구가 있다면 이건 꼭 가서 봐주도록 하자.</p>
			<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
		<div id="column4">
			<div class="title">
				<h2>기장선거 MT</h2>
			</div>
			<p>일년 행사 중 현역이 주관하는 마지막 행사이다. 워크샵부터 정기공연까지 무사히 살아남아서 다음 해의 현역이 될 신입생들의 일년 간의 행적을 기반으로 그 기수의 대표인 기장을 뽑는 중요한 자리이다. 기장의 성격에 따라 그 다음 신입생들의 성향이나 소규모공연을 끌어오는 빈도 등이 달라지기 때문에 평소에는 좀 제정신이 아닌 것 같이 살던 사람도 이 날 만큼은 정상인의 스펙트럼에 가까워진다. </p>
			<a href="#" class="icon icon-arrow-right button">Read More</a> </div>
	</div>
</div>
<div id="copyright" class="container">
	<p>&copy; Untitled. All rights reserved. | Photos by TRUSS | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a> |  Edited by 28기 진경민</p>
		<ul class="contact">
			<!--<li><a href="#" class="icon icon-twitter"><span>Twitter</span></a></li>-->
			<li><a href="https://www.facebook.com/profile.php?id=100009047977821" class="icon icon-facebook"><span></span></a></li>
			<!--<li><a href="#" class="icon icon-dribbble"><span>Pinterest</span></a></li>
			<li><a href="#" class="icon icon-tumblr"><span>Google+</span></a></li>
			<li><a href="#" class="icon icon-rss"><span>Pinterest</span></a></li>
			-->
		</ul>
</div>
</body>
</html>
			
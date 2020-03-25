<?php
include 'db_info.php';

$query = "DELETE FROM `teamtime` WHERE 1";
mysqli_query($connect, $query);
$query = "DELETE FROM `timetable_temp` WHERE 1";
mysqli_query($connect, $query);
$query = "DELETE FROM `timetable` WHERE 1";
mysqli_query($connect, $query);
$query = "DELETE FROM `team` WHERE 1";
mysqli_query($connect, $query);


for($j=900;$j<2400;$j+=50){
	$query = "INSERT INTO `timetable` (`time`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES ('".$j."', '', '', '', '', '', '', '')";
	mysqli_query($connect,$query);
	$query = "INSERT INTO `timetable_temp` (`time`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`) VALUES ('".$j."', '', '', '', '', '', '', '')";
	mysqli_query($connect,$query);
}
echo "<script> alert('Done!'); history.go(-1);</script>";

?>
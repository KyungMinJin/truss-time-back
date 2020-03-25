<?
// mysql access information
//$mysql_host = "mysql.hostinger.kr";
//$mysql_database = "u221597977_table";
//$mysql_user = "u221597977_truss";
//$mysql_password = "voy091011";
$mysql_host = "us-cdbr-iron-east-03.cleardb.net";
$mysql_database = "heroku_86026cc2c546d7c";
$mysql_user = "b961c4cc84e119";
$mysql_password = "d155f17e";


$connect = mysqli_connect("$mysql_host", "$mysql_user", "$mysql_password", "$mysql_database");
mysqli_query($connect, "SET NAMES utf8");
?>
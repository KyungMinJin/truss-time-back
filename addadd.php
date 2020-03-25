<!DOCTYPE html>
<html>
<head>
<title>고려대학교 TRUSS</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<form action="addadd.php" method="post" enctype="multipart/form-data" />
<input name="truss_ck" value="carbon12" type="hidden">
<?php
	include 'db_info.php';
	$isitOK = true;
	$truss_ck = $_POST['truss_ck'];
	if($truss_ck != "carbon12" && $truss_ck != "CARBON12"){ // not trussian
		echo "<script>alert('TRUSS 인증에 실패하였습니다.'); history.go(-1);</script>";
		$isitOK = false;
	}//if
	if($isitOK){
		$count = 0;
		for($i=0;$i<10;$i++){
			$name = $_POST['name_'.$i];
			$hp = $_POST['hp_'.$i];
			$th = $_POST['th_'.$i];
			if($name == '' || $hp == '' || $th == ''){
				continue;
			}
			else{
				$query = "INSERT INTO phone (name, hp, th) VALUES('$name', '$hp', '$th')";
				mysqli_query($connect, $query);
				$count = $count + 1;
			}
		}
		if($count == 0){
			echo "<script>alert('등록할 내용이 없습니다.'); history.go(-1);</script>";
		}
		else{
			echo "<script>alert('등록에 성공하였습니다.'); location.href='phones_auth.php';</script>";
		}
	}
	mysqli_close($connect);
?>
</form>
</body>
</html>
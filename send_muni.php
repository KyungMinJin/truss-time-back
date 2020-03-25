<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>고려대학교 TRUSS</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />

<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Asia/Seoul');

require 'PHPMailer-master/PHPMailerAutoload.php';

$isitOK = true;

$sender = $_POST['sender'];
$sub = $_POST['sub'];
$muni = $_POST['muni'];

$truss_ck = $_POST['truss_ck'];
if($truss_ck != "carbon12" && $truss_ck != "CARBON12"){ // not trussian
	echo "<script>alert('TRUSS 인증에 실패하였습니다.'); history.go(-1);</script>";
	$isitOK = false;
}//if

if($isitOK){
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "lhsbobob@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "asdf1234zxcv";

//Set who the message is to be sent from
$mail->setFrom('from@example.com', $sender.' ');

//Set who the message is to be sent to
$mail->addAddress('lhsbobob@gmail.com', '관리자');

//Set the subject line
$mail->Subject = $sub.' ';

$mail->Body = $muni.' ';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "<script>alert('메시지를 발송하지 못했습니다.\nMailer Error: " . $mail->ErrorInfo . "'); history.go(-1);</script>";
} else {
    echo "<script>alert('관리자에게 메시지를 발송했습니다.'); location.href='index.php';</script>";
}
}
?>
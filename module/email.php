<?
//보내는이
$from_email = 'master@relivedent.com';
$from_name = '=?UTF-8?B?'.base64_encode($name).'?=';

//메일제목
$subject = '리라이브치과 빠른상담신청';
$subject = '=?UTF-8?B?'.base64_encode($subject).'?=';

//실제전송파일
$file_name = '/home/mokyang/www/module/email.html';




if($buffer = file_exists($file_name)){
	$sMessage = '';

	$fp = fopen($file_name, "r");

	if ($fp != NULL) {
		while(!feof($fp)){
			$sMessage .=  fread($fp,100);
		}
	}

	$to_name = '=?UTF-8?B?'.base64_encode('관리자').'?=';
	$to_email = 'master@relivedent.com';

	$sMessage = str_replace("#user_name", $name, $sMessage);
	$sMessage = str_replace("#data02", $data02, $sMessage);
	$sMessage = str_replace("#data01", $data01, $sMessage);
	$sMessage = str_replace("#title", $title, $sMessage);
	$sMessage = str_replace("#ment", $ment, $sMessage);
	$sMessage = str_replace("#rDate", $rDate, $sMessage);

	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "To: ".$to_name." <".$to_email.">\r\n";
	$headers .= "From: ".$from_name." <".$from_email.">\r\n";

	mail($to_email, $subject, $sMessage, $headers);
}
?>
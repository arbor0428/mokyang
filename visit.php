<?
$refel = $_SERVER['HTTP_REFERER'];		//이전url
$nurl = $_SERVER['HTTP_HOST'];				//현재접속url
$userip = $_SERVER['REMOTE_ADDR'];		//접속아이피

if(!strpos(strtolower($refel),$nurl)){

	if($nurl){
		if($_SERVER['SERVER_PORT'] == '443')	$nurl = 'https://'.$nurl;
		else														$nurl = 'http://'.$nurl;

		if($_SERVER['QUERY_STRING'])	$nurl .= $_SERVER['REQUEST_URI'];

	//	$UserAgent = $_SERVER['HTTP_USER_AGENT'];
		$rDate = date('Y-m-d H:i:s');
		$rTime = time();

		$sql = "insert into tb_visit_log (refel,nurl,UserOS,userip,rDate,rTime) values ('$refel','$nurl','$UserOS','$userip','$rDate','$rTime')";
		$result = mysql_query($sql);
	}
}
?>
<?
if($_SERVER['SERVER_PORT'] == '443'){
	$siteLogo = "https://".$_SERVER['HTTP_HOST']."/images/sns.jpg";
	$siteShortcut = "https://".$_SERVER['HTTP_HOST']."/images/shortcut.png";
}else{
	$siteLogo = "http://".$_SERVER['HTTP_HOST']."/images/sns.jpg";
	$siteShortcut = "http://".$_SERVER['HTTP_HOST']."/images/shortcut.png";
}
?>

<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/images/ico.ico"><!--파비콘-->
<meta property="og:image" content="/images/sns.png">

<!--
<meta name="naver-site-verification" content="ebb512c47e26ac00bd8ea43dc2d5f690ff250f0b" />
<meta name="description" content="발산역치과, 마곡동치과, 독일&연세대 출신 전문의 진료, 월목 야간진료, 임플란트, 무삭제 라미네이트, 충치치료, 사랑니발치, 디지털 진료">

<meta property="og:url" content="http://www.relivedent.com/">
<meta property="og:title" content="리라이브치과">
<meta property="og:type" content="website">
<meta property="og:image" content="/images/sns.png">
<meta property="og:description" content="발산역치과, 마곡동치과, 독일&연세대 출신 전문의 진료, 월목 야간진료, 임플란트, 무삭제 라미네이트, 충치치료, 사랑니발치, 디지털 진료">

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="리라이브치과">
<link rel="apple-touch-icon-precomposed" href="<?=$siteShortcut?>">


-->
<link rel="canonical" href="https://togethertoo.co.kr/">



<?
/*
if($_SERVER['SERVER_PORT'] != '443'){
	$sslUrl = "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	echo ("<script>location.href='$sslUrl';</script>");
	exit;
}
*/
?>
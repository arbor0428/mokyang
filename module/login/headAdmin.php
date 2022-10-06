<?
session_cache_limiter('');
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

//글로벌 변수 설정
$GBL_USERID	= strtolower($_SESSION['ses_member_id']);
$GBL_NAME	= $_SESSION['ses_member_name'];
$GBL_MTYPE = $_SESSION['ses_member_type'];
$GBL_PASSWORD = $_SESSION['ses_member_pwd'];

$SYSTEM_DATE = date('Y-m-d');

$strRoot = '../';
$boardRoot = '../board/';

?>

<!doctype html>
	<html lang="ko">
		<head>


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
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<link rel="shortcut icon" href="/images/ico.ico"><!--파비콘-->
			
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

			<link rel="canonical" href="http://www.relivedent.com/">
			-->

			
			<link rel="stylesheet" type="text/css" href="/css/style.css?v=1">
			<link rel="stylesheet" type="text/css" href="/css/board.css?v=2">


			
			<link rel="stylesheet" type="text/css" href="/module/popupoverlay/popupoverlay.css">
			
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.11.3.js"></script>	
			<script src="/module/js/common.js"></script>
			<script src="/module/popupoverlay/jquery.popupoverlay.js"></script>

			<script src="/js/jquery.easing.min.js"></script>
			
			<!-- 나눔스퀘어 -->
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@1.0/nanumsquare.css">

			<!-- aos animation -->
			<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
			<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>



			<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

			<title>목양비젼지역아동센터</title>

		</head>
	<body >
<?
session_cache_limiter('');
session_start();
Header("p3p: CP=\"CAO DSP AND SO ON\" policyref=\"/w3c/p3p.xml\"");

//글로벌 변수 설정
$GBL_USERID	= strtolower($_SESSION['ses_member_id']);
$GBL_NAME	= $_SESSION['ses_member_name'];
$GBL_MTYPE = $_SESSION['ses_member_type'];
$GBL_PASSWORD = $_SESSION['ses_member_pwd'];

if($GBL_MTYPE == '')			$GBL_MCODE = 99;
elseif($GBL_MTYPE == 'M')	$GBL_MCODE = 4;
elseif($GBL_MTYPE == 'C')	$GBL_MCODE = 3;
elseif($GBL_MTYPE == 'S')	$GBL_MCODE = 2;
elseif($GBL_MTYPE == 'A')	$GBL_MCODE = 1;

$SYSTEM_DATE = date('Y-m-d');

$strRoot = '../';
$boardRoot = '../board/';

$nTime = time();
?>

<!doctype html>
	<html lang="ko">
		<head>


			<?
				include "/home/mokyang/www/module/login/metaTag.php";
			?>
			

			
			<link rel="stylesheet" type="text/css" href="/css/style.css?v=1">
			<link rel="stylesheet" type="text/css" href="/css/sub.css?v=2">
			<link rel="stylesheet" type="text/css" href="/css/responsive.css?v=3">
			<link rel="stylesheet" type="text/css" href="/css/board.css?v=4">
			<link rel="stylesheet" type="text/css" href="/css/new_board.css?v=5">
			<link rel="stylesheet" type="text/css" href="/css/animation.css">


			<link rel="stylesheet" type="text/css" href="/module/popupoverlay/popupoverlay.css">
			
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
			<!--<script src="https://code.jquery.com/jquery-1.11.3.js"></script>-->
			<script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
			<script src="/module/js/common.js"></script>
			<script src="/module/popupoverlay/jquery.popupoverlay.js"></script>

			<script src="/js/jquery.easing.min.js"></script>
			

			<!-- 나눔스퀘어 -->
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@1.0/nanumsquare.css">

			<!-- aos animation -->
			<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
			<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>


			<!-- Swiper-->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/css/swiper.css"/> 
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.1/js/swiper.js"></script>

			<!-- slick 불러오기 -->
			<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
			<!--<script src="/js/slick.min.js"></script>-->
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">

            <!--gsap-->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.6.1/gsap.min.js"></script>



            <script src="/js/script.js"></script>
			<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

			<script language='javascript' src='/module/js/common.js'></script>
			<script type="text/javascript" src="/module/popupoverlay/jquery.popupoverlay.js"></script>
			<link type='text/css' rel='stylesheet' href='/module/popupoverlay/style.css'>
			<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
			<link rel="stylesheet" href="/css/button.css?v=1.1">
			<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->

			<title>목양비젼지역아동센터</title>

		</head>
	<body>


<?
	$sNum01 = '#s'.$sNum01;
?>


<div class="sm_menu_list" style='padding:15px 0;'>

	<div class="adm-logo txt-C">
		<img src="/images/adm-logo.png" alt="리라이브치과">
	</div>
<?
	if($GBL_MTYPE == 'A'){
?>

	<ul id='s1'>
		<li><a href='/adm/'>관리자 기본정보</a></li>
		<li><a href='/adm/visit/up_index.php'>홈페이지 방문자분석</a></li>
		<li><a href='/adm/popup/up_index.php'>팝업관리</a></li>
<?
	if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
?>
		<li><a href='/adm/board/up_index.php'>게시판관리(사내)</a></li>
<?
	}
?>

	</ul>
	<!--
	<div class='smDot'></div>
	<p class="sm_ttl">이용자</p> 
	<ul id='s2'>
		<li><span class="disc"></span><a href='/adm/member/up_index.php'>회원정보 관리</a></li>
		<li><span class="disc"></span><a href='/adm/member/up_index2.php'>판매회원관리</a></li>
	</ul>
	
	<div class='smDot'></div>
	-->
<?
	}
?>


</div>

<script language='javascript'>
$('.sm_menu_list <?=$sNum01?> li:nth-child(<?=$sNum02?>)').addClass('msel')
</script>
<?
	//총방문자
	$sql = "select count(*) from tb_visit_log";
	$result = mysql_query($sql);
	$visit_tot = mysql_result($result,0,0);
	$visit_tot = number_format($visit_tot).'명';

	//오늘방문자
	$datey = date('Y');
	$datem = date('m');
	$dated = date('d');
	$sql = "select count(*) from tb_visit_log where datey='$datey' and datem='$datem' and dated='$dated'";
	$result = mysql_query($sql);
	$visit_today = mysql_result($result,0,0);
	$visit_today = number_format($visit_today).'명';
?>
<!--
<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align='center' style='padding:10px;border-bottom:1px solid #ccc;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' style='font-size:14px;'>
				<tr>
					<td>오늘방문자</td>
					<td align='right'><?=$visit_today?></td>
				</tr>
				<tr>
					<td>총방문자</td>
					<td align='right'><?=$visit_tot?></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
-->


<?
	$sNum01 = '#s'.$sNum01;
?>


<div class="sm_menu_list" style='padding:15px 0 30px 0;'>


	<p class="sm_ttl">기본관리</p> 
	<ul id='s1'>
		<li><!--<span class="disc"></span>--><a href='/admin/'>관리자 기본정보</a></li>
		<li><!--<span class="disc"></span>--><a href='/admin/popup/up_index.php'>팝업관리</a></li>
		<li><!--<span class="disc"></span>--><a href='/admin/log/up_index.php'>방문자기록</a></li>
	<?
		if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	?>
		<li><!--<span class="disc"></span>--><a href='/admin/board/up_index.php'>게시판관리</a></li>
	<?
		}
	?>
	</ul>

	<div class='smDot'></div>

	<p class="sm_ttl">이용자 관리</p> 
	<ul id='s2'>
		<li><!--<span class="disc"></span>--><a href='/admin/member/up_index.php'>회원정보 관리</a></li>
	</ul>

	<div class='smDot'></div>

	<p class="sm_ttl">인적자원 관리</p> 
	<ul id='s2'>
		<li><!--<span class="disc"></span>--><a href='/admin/vCode/up_index.php'>봉사분야 관리</a></li>
	</ul>


</div>

<script language='javascript'>
$('.sm_menu_list <?=$sNum01?> li:nth-child(<?=$sNum02?>)').addClass('msel')
</script>






<script language='javascript'>

//양도,양수 리스트용 상단에 붙는 네비게이션  (리스트의 경우 1100 / 등록페이지 및 기타페이지의 경우 1320 )




function sidemenu(){
	st = $(window).scrollTop();	//현재스크롤양
	winW=$(window).width();//윈도우 가로길이

	if(st >= 100 && winW<=1320){
		$(".aCon").css({"padding-left":"220px"})
		$(".sm_menu_list").css({"position":"fixed","top":"0","-webkit-transform":"translateZ(0)","height":"100%","border-right":"1px solid #d2d2d2"})
		
	}else if(st >= 100 && winW>=1320){
		$(".sm_menu_list").css({"position":"fixed","top":"0","-webkit-transform":"translateZ(0)"})
		$(".aCon").css({"padding-left":"20px"})

	}else if(winW>=1320){
		$(".aCon").css({"padding-left":"20px"})
		$(".sm_menu_list").css({"position":"relative","height":"auto","border-right":"none"})
	}
	
	else{
		$(".sm_menu_list").css({"position":"relative","height":"auto","border-right":"none"})
		$(".aCon").css({"padding-left":"20px"})
	}
}
</script>
<?
	include "../header.php";

	$on06 = 'on';
	include "./subtop.php";
?>


<div class="center sub" style="position:static;">

	<ul class="tab-link">
		<li class="active br-n f18"><a href="/sub06/sub06.php">다함께 돌봄</a></li>
		<li class="br-n f18"><a href="/sub06/sub06_2.php">지역아동센터</a></li>
		<li class="f18"><a href="/sub06/sub06_3.php">학교 돌봄</a></li>
	</ul>

<?
	$table_id = 'table_1640048675';	

	if(!$table_id){
		Msg::backMsg('접근오류입니다.');
	}
	
	if(!$type)	$type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";

	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query.php';	//게시판 내용 쿼리
							include $boardRoot.$list_file;	//게시판 리스트
							include $boardRoot.'pagination.php';	//게시판 페이지번호
							break;

		case 'view' :
							include $boardRoot.$view_file;
							break;

		case 're_write' :
		case 're_edit' :
							include $boardRoot.'re_write.php';
							break;

		case 're_view' :
							include $boardRoot.'re_view.php';
							break;
	}
?>

	<div class="txt_c">
		<a class="map-bt" href="/sub06/sub01.php">신청안내</a>
	</div>

</div>

<?
	include "../footer.php";
?>
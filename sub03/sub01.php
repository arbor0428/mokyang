<?
	include "../header.php";

	$on01 = 'on';
	include "./subtop.php";
?>

<div class="center sub">
<?
	$table_id = 'table_1639985002';	

	if(!$table_id){
		Msg::backMsg('접근오류입니다.');
	}
	
	if(!$type)	$type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";

	if($_SERVER['REMOTE_ADDR'] == '116.122.201.95'){
				
		echo$write_file.'<br>';
		echo$list_file.'<br>';
		echo$view_file.'<br>';
	
	}

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
</div>

<?
	include "../footer.php";
?>
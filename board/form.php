<?
	$mNum=1;
	$sNum=1;

	$table_id = '';	

	if(!$table_id){
		Msg::backMsg('접근오류입니다.');
	}
	
	if(!$type)	$type = 'list';

	if($type=='list')	 $bgcolor= '#000000';
	else	$bgcolor = '#000000';

	//게시판 환경설정
	include $boardRoot."config.php";

	//플래시 출력용 문자치환
	$table_txt = eregi_replace("&", "|", $table_title);
?>



<?

	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query.php';	//게시판 내용 쿼리
							include $boardRoot.$list_file;	//게시판 리스트
							include $boardRoot.'page.php';	//게시판 페이지번호
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

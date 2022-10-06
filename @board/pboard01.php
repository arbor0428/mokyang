<?
	include "../module/login/head.php";
	include $strRoot."module/class/class.DbCon.php";
	include $strRoot."module/class/class.Msg.php";
	include $strRoot."module/class/class.Util.php";

	$table_id = 'table_1606872464';	

	if(!$table_id){
		Msg::backMsg('접근오류입니다.');
	}
	
	if(!$type)	 $type = 'list';

	//게시판 환경설정
	include $boardRoot."config.php";

	$write_file = 'pwrite01a.php';
	$list_file = 'plist01a.php';
	$view_file = 'pview01a.php';

	$path = '../upfile/';


	require_once '../module/Mobile-Detect-master/Mobile_Detect.php';
	$detect = new Mobile_Detect;

	if($detect->isMobile()){
		$UserOS = 'mobile';
	}else{
		$UserOS = 'pc';
	}	
?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

<?
	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'pquery.php';	//게시판 내용 쿼리
							include $boardRoot.$list_file;	//게시판 리스트
							include $boardRoot.'pageNum.php';	//게시판 페이지번호
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
		</td>
	</tr>
</table>

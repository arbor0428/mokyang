<?
	include "../header.php";

	$on02 = 'on';
	include "./subtop.php";
?>

<div class="center sub">
<?
	$sRange = '0';
	$eRange = '1';

	$cancleBtnID = "";
	include '../module/Calendar.php';

	$table_id = 'table_1639985732';	

	if(!$table_id){
		Msg::backMsg('���ٿ����Դϴ�.');
	}
	
	if(!$type)	$type = 'list';

	//�Խ��� ȯ�漳��
	include $boardRoot."config.php";

	$write_file = 'write_share02.php';
	$list_file = 'list_share02.php';
	$view_file = 'view_share02.php';

	switch($type){
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query.php';	//�Խ��� ���� ����
							include $boardRoot.$list_file;	//�Խ��� ����Ʈ
							include $boardRoot.'pagination.php';	//�Խ��� ��������ȣ
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
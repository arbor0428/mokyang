<?
	include "../header.php";

	$on01 = 'on';
	include "./subtop.php";
?>

<div class="center sub">
<?
	$table_id = 'table_1640048601';	

	if(!$table_id){
		Msg::backMsg('���ٿ����Դϴ�.');
	}
	
	if(!$type)	$type = 'list';

	//�Խ��� ȯ�漳��
	include $boardRoot."config.php";

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
<?
	include "../header.php";

	$on02 = 'on';
	include "./subtop.php";
?>

<div class="center sub">
<?
	$table_id = 'table_1639985025';	

	if(!$table_id){
		Msg::backMsg('���ٿ����Դϴ�.');
	}
	
	if(!$type)	$type = 'list';

	//�Խ��� ȯ�漳��
	include $boardRoot."config.php";

	if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
				
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
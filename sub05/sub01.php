<?
	include "../header.php";

	$on01 = 'on';
	include "./subtop.php";
?>

<div class="center sub">
<?
	$sRange = '0';
	$eRange = '1';

	$cancleBtnID = "";
	include '../module/Calendar.php';

	$table_id = 'table_1639985724';	

	if(!$table_id){
		Msg::backMsg('���ٿ����Դϴ�.');
	}
	
	if(!$type)	$type = 'list';

	//�Խ��� ȯ�漳��
	include $boardRoot."config.php";

	$write_file = 'write_share01.php';
	$list_file = 'list_share01.php';
	$view_file = 'view_share01.php';

	switch($type){
	
		case 'write' :
		case 'edit' :
							include $boardRoot.$write_file;
							break;

		case 'list' :
							include $boardRoot.'query_bongsa01.php';	//�Խ��� ���� ����
							include $boardRoot.$list_file;	//�Խ��� ����Ʈ
							include $boardRoot.'pagination.php';	//�Խ��� ��������ȣ
							break;

		case 'view' :
							include $boardRoot.$view_file;
							break;
	}
?>
</div>

<?
	include "../footer.php";
?>
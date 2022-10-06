<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$sql = "select * from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$status = $row['status'];

	if($status == '1')	$status = '2';
	else					$status = '1';

	$sql = "update ks_userlist set status='$status' where uid='$uid'";
	$result = mysql_query($sql);

	echo $status;
?>
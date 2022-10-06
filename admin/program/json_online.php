<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$sql = "select * from ks_program where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$online = $row['online'];

	if($online)	$online = '';
	else			$online = '1';

	$sql = "update ks_program set online='$online' where uid='$uid'";
	$result = mysql_query($sql);

	echo $online;
?>
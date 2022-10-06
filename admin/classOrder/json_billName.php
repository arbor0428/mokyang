<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	if($billName)	$billName = '';
	else				$billName = '1';

	$sql = "update ks_userClass set billName='$billName' where uid='$uid'";
	$result = mysql_query($sql);
?>
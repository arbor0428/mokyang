<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

if($type == 'del'){
	$sql = "delete from ks_waitList where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>
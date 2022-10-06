<?
	include '../module/login/headAdmin.php';
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Msg.php";
	include "../module/class/class.Util.php";

	if($GBL_MTYPE=='A'){
		echo ("<meta name='viewport' content='width=1280'>");
		include 'main.php';

	}else{
		echo ("<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'/>");
		include 'login.php';
	}
?>
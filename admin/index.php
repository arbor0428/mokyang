<?
	include '../module/login/head.php';
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Msg.php";
	include "../module/class/class.Util.php";

	if($GBL_MTYPE){
		include 'main.php';

	}else{
		include 'login.php';
	}
?>
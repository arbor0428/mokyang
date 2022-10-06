<?
include "../module/login/head.php";
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";

	$sql = "select * from tb_member where userid='$GBL_USERID' and pwd='$old_pwd'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$sql = "update tb_member set pwd='$new_pwd' where userid='$GBL_USERID'";
		$result = mysql_query($sql);

		session_start();

		unset($_SESSION["ses_member_id"]);
		unset($_SESSION["ses_member_name"]);
		unset($_SESSION["ses_member_type"]);
		unset($_SESSION["ses_member_site"]);



		echo ("<script>
					alert('비밀번호가 변경되었습니다. 다시 로그인을 해주시기 바랍니다');
					parent.location.href='/adm/';
					</script>");

	}else{
		Msg::backMsg('현재 사용중인 비밀번호를 확인해 주십시오');
	}


unset($dbconn);


?>

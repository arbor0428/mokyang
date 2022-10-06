<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";





switch($type){
	case 'write' :

		$ip = $_SERVER['REMOTE_ADDR'];


		$coment = eregi_replace("<", "&lt;", $coment);
		$coment = eregi_replace(">", "&gt;", $coment);
		$coment = eregi_replace("\"", "&quot;", $coment);
		$coment = eregi_replace("\|", "&#124;", $coment);
		$coment = eregi_replace("\r\n\r\n", "<P>", $coment);
		$coment = eregi_replace("\r\n", "<BR>", $coment);


		$reg_date = mktime();
		$sql = "insert into tb_board_coment (pid,userid,name,pwd,coment,ip,reg_date) values ";
		$sql .= "('$uid','$co_userid','$co_name','$co_pwd','$coment','$ip','$reg_date')";
		$result = mysql_query($sql);

		break;



	case 'del' :
		
		$sql = "delete from tb_board_coment where uid=$pid";
		$result = mysql_query($sql);


		break;



	case 'pwd_del' :

		$sql = "select * from tb_board_coment where uid=$pid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		if($row[pwd] != ${'co_pwd_chk_'.$pid}){
			Msg::backMsg("비밀번호가 일치하지 않습니다.");
			exit;

		}else{
			$sql = "delete from tb_board_coment where uid=$pid";
			$result = mysql_query($sql);

		}


		break;



}


unset($dbconn);

?>



<form name="FRM" method="post" action="<?=$next_url?>">
<input type="hidden" name="type" value="view">
<input type="hidden" name="uid" value="<?=$uid?>">
<input type="hidden" name="record_start" value="<?=$record_start?>">
<input type="hidden" name="word" value="<?=$word?>">
<input type="hidden" name="field" value="<?=$field?>">
<input type="hidden" name="table_id" value="<?=$table_id?>">
</form>
<SCRIPT LANGUAGE="JavaScript">
	document.FRM.submit();	
</SCRIPT>

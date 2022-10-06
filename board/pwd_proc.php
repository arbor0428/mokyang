<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";



if($type == 'view'){
	$sql = "select * from tb_board_list where uid=$uid and passwd='$chk_pwd'";
	$action = $next_url;

}elseif($type == 'edit'){
	$sql = "select * from tb_board_list where uid=$uid and passwd='$mod_pwd'";
	$action = $next_url;
	
}elseif($type == 'del'){
	$sql = "select * from tb_board_list where uid=$uid and passwd='$mod_pwd'";
	$action = $boardRoot.'proc.php';

}elseif($type == 're_view'){
	$sql = "select * from tb_board_reply where uid=$uid";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$upid = $row[upid];

	$sql = "select * from tb_board_list where uid=$upid and passwd='$chk_pwd'";
	$action = $next_url;

}elseif($type == 're_edit'){
	$sql = "select * from tb_board_reply where uid=$uid and passwd='$mod_pwd'";
	$action = $next_url;

}elseif($type == 're_del'){
	$sql = "select * from tb_board_reply where uid=$uid and passwd='$mod_pwd'";
	$action = $boardRoot.'proc.php';

}



$result = mysql_query($sql);
$num = mysql_num_rows($result);

if($num){
}else{
	Msg::backMsg('비밀번호가 틀립니다.');
	exit;
}


unset($dbconn);



?>

<form name="FRM" method="post" action="<?=$action?>">
<input type="hidden" name="type" value="<?=$type?>">
<input type="hidden" name="uid" value="<?=$uid?>">
<input type="hidden" name="record_start" value="<?=$record_start?>">
<input type="hidden" name="word" value="<?=$word?>">
<input type="hidden" name="field" value="<?=$field?>">
<input type="hidden" name="table_id" value="<?=$table_id?>">
<input type="hidden" name="next_url" value="<?=$next_url?>">
</form>
<SCRIPT LANGUAGE="JavaScript">
	document.FRM.submit();	
</SCRIPT>
<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";



if($type == 'write'){

	$sql = "select count(*) from tb_member where userid='$userid'";
	$result = mysql_query($sql);
	$record_cnt = mysql_result($result,0,0);

	//가입된 아이디 중복확인 및 관리자 아이디와 중복확인
	if($record_cnt > 0){
		$msg = "중복된 아이디입니다.";
		Msg::backMsg($msg);
		exit;
	}

	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();

	$sql = "insert into tb_member (mtype,status,userid,pwd,name,sex,bDate,bTime,email01,email02,phone01,company,zipcode,addr01,addr02,getDate,getTime,userip,rDate,rTime) values ";
	$sql .= "('C','$status','$userid','$pwd','$name','$sex','$bDate','$bTime','$email01','$email02','$phone01','$company','$zipcode','$addr01','$addr02','$getDate','$getTime','$userip','$rDate','$rTime')";
	$result = mysql_query($sql);

	$msg = "가입되었습니다.";

}elseif($type == 'edit'){

	$sql = "update tb_member set ";
	$sql .= "status='$status',";
	if($pwd){
		$sql .= "pwd='$pwd',";
	}
	$sql .= "company='$company',";
	$sql .= "name='$name',";
	$sql .= "sex='$sex',";
	$sql .= "email01='$email01',";
	$sql .= "email02='$email02',";
	$sql .= "bDate='$bDate',";
	$sql .= "bTime='$bTime',";
	$sql .= "phone01='$phone01',";
	$sql .= "zipcode='$zipcode',";
	$sql .= "addr01='$addr01',";
	$sql .= "addr02='$addr02' ";
	$sql .= "where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '수정되었습니다.';


}elseif($type == 'del'){

	$sql = "delete from tb_member where uid='$uid'";
	$result = mysql_query($sql);
	
	$msg = '';
}
?>

<form name='frm' action="<?=$next_url?>" method='post' target='_parent'>
<input type='hidden' name='type' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_mtype' value='<?=$f_mtype?>'>
<input type='hidden' name='f_manager' value='<?=$f_manager?>'>
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_email' value='<?=$f_email?>'>
<input type='hidden' name='f_mobile01' value='<?=$f_mobile01?>'>
<input type='hidden' name='f_mobile02' value='<?=$f_mobile02?>'>
<input type='hidden' name='f_mobile03' value='<?=$f_mobile03?>'>
</form>

<script language='javascript'>
if('<?=$msg?>'){
	alert('<?=$msg?>');
}

document.frm.submit();
</script>
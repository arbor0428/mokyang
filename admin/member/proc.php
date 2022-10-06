<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.Util.php";

if($type == 'edit'){
	$sql = "update tb_member set ";

	if($pwd){
		$sql .= "pwd='$pwd', ";
	}

	$sql .= "mtype='$mtype', ";
	$sql .= "name='$name', ";
	$sql .= "gender='$gender', ";
	$sql .= "bDate='$bDate', ";
	$sql .= "bTime='$bTime', ";
	$sql .= "email01='$email01', ";
	$sql .= "email02='$email02', ";
	$sql .= "phone='$phone', ";
	$sql .= "company='$company', ";
	$sql .= "zipcode='$zipcode', ";
	$sql .= "addr01='$addr01', ";
	$sql .= "addr02='$addr02' ";
	$sql .= " where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '수정되었습니다.';




}elseif($type == 'del'){

	$sql = "delete from tb_member where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '삭제되었습니다.';
}
?>

<?
	if($msg){
?>

<script language='javascript'>
function OrderSave(){
	parent.GblMsgBox("<?=$msg?>","reg_list();");
}

OrderSave();
</script>

<?
	}
?>

<?
	include "./class/class.DbCon.php";
	include "./class/class.Msg.php";
	include "./class/class.FileUpload.php";
	include "./class/class.gd.php";
	include "./class/class.Util.php";

	$reg_date = mktime();
	$rDate=date('Y-m-d');
	$user_ip = $_SERVER['REMOTE_ADDR'];
	if(!$userid)	$userid = '비회원';

	$sql = "insert into tb_board_list  (userid,table_id,title,name,data02,data01,ment,ip,reg_date,rDate) values ";
	$sql .= "('$userid','table_1628232234','$title','$name','$data02','$data01','$ment','$user_ip','$reg_date','$rDate')";
	$result = mysql_query($sql);

	include './email.php';
?>

<script language='javascript'>
	alert('빠른상담신청이 접수되었습니다');
	parent.document.frm_counsel.reset();
</script>
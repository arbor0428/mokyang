<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

if($type == 'write' || $type == 'edit'){
	//프로그램정보
	$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' and title='$title' order by uid desc";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$periodID = $row['periodID'];
	$programID = $row['uid'];

	if($etcMsg)	$etcMsg = Util::textareaEncodeing($etcMsg);

	$etcID = $GBL_USERID;
	$userip = $_SERVER[REMOTE_ADDR];
	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();


	if($type == 'write'){
		$sql = "insert into ks_cartList (userid,userNum,name,programID,userip,rDate,rTime,etcID,etcMsg,etcAmt,saleChk,saleAmt) values ";
		$sql .= "('$userid','$userNum','$name','$programID','$userip','$rDate','$rTime','$etcID','$etcMsg','$etcAmt','$saleChk','$saleAmt')";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("등록되었습니다.","location.href='up_index.php';");
		exit;




	}elseif($type == 'edit'){
		$sql = "update ks_cartList set ";
		$sql .= "userid='$userid', ";
		$sql .= "userNum='$userNum', ";
		$sql .= "name='$name', ";
		$sql .= "programID='$programID', ";
		$sql .= "userip='$userip', ";
		$sql .= "rDate='$rDate', ";
		$sql .= "rTime='$rTime', ";
		$sql .= "etcID='$etcID', ";
		$sql .= "etcMsg='$etcMsg', ";
		$sql .= "etcAmt='$etcAmt', ";
		$sql .= "saleChk='$saleChk', ";
		$sql .= "saleAmt='$saleAmt' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("수정되었습니다.","parent.reg_list();");
		exit;

	}



}elseif($type == 'del'){
	$sql = "delete from ks_cartList where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>
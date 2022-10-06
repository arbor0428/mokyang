<?
include '../module/login/head.php';
include '../module/class/class.DbCon.php';
include '../module/class/class.Util.php';
include '../module/class/class.Msg.php';

if($type == 'write'){
	$userid = strtolower(addslashes(trim($_POST['userid'])));
	$userid = str_replace(' ','',$userid);

	$sql = "select count(*) from tb_member where userid='$userid'";
	$result = mysql_query($sql);
	$record_cnt = mysql_result($result,0,0);


	//가입된 아이디 중복확인 및 관리자 아이디와 중복확인
	if($record_cnt > 0){
		$msg = "사용할 수 없는 아이디입니다.";
		Msg::GblMsgBoxParent($msg);
		exit;
	}
}



if($type == 'write' || $type == 'edit'){

	//생년월일
	$bTime = strtotime($bDate);


	if($type == 'write'){
		$mtype = 'M';
		$rDate = date('Y-m-d H:i:s');
		$rTime = time();

		$sql = "insert into tb_member (mtype,userid,pwd,name,gender,bDate,bTime,email01,email02,phone,company,zipcode,addr01,addr02,userip,rDate,rTime) values ";
		$sql .= "('$mtype','$userid','$pwd','$name','$gender','$bDate','$bTime','$email01','$email02','$phone','$company','$zipcode','$addr01','$addr02','$userip','$rDate','$rTime')";
		$result = mysql_query($sql);


		Msg::GblMsgBoxParent("가입이 완료되었습니다.","location.href='/';");



	}elseif($type == 'edit'){
		$sql = "select * from tb_member where userid='$userid' and pwd='$pwd'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		if(!$num){
			$msg = "비밀번호를 확인해주세요.";
			Msg::GblMsgBoxParent($msg);
			exit;
		}


		$sql = "update tb_member set ";

		if($new_pwd){
			$sql .= "pwd='$new_pwd', ";
		}


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
		$sql .= " where userid='$userid'";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent('회원정보가 수정되었습니다.',"location.href='/';");

	}



}elseif($type == 'del'){
	$sql = "select * from tb_member where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$upfile01 = $row['upfile01'];
	if($upfile01){
		$UPLOAD_DIR = '../upfile/user/';
		@unlink($UPLOAD_DIR.$upfile01);
	}

	$sql = "delete from tb_member where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}elseif($type == 'secede'){

	$secedeDate = date('Y-m-d H:i:s');
	$secedeTime = mktime();

	$sql = "update tb_member set status=3, memo2='$memo2', secedeDate='$secedeDate', secedeTime='$secedeTime' where uid='$uid'";
	$result = mysql_query($sql);

	Msg::GblMsgBoxParent("정상적으로 탈퇴처리되었습니다..","location.href='/module/login/logout_proc.php';");
	exit;

}
?>
<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';

if($type == 'write'){
	$sql = "select count(*) from tb_member where userid='$userid'";
	$result = mysql_query($sql);
	$record_cnt = mysql_result($result,0,0);

	if($record_cnt == 0){
		$sql = "select count(*) from ks_userlist where userid='$userid'";
		$result = mysql_query($sql);
		$record_cnt = mysql_result($result,0,0);
	}

	//가입된 아이디 중복확인 및 관리자 아이디와 중복확인
	if($record_cnt > 0){
		$msg = "사용할 수 없는 아이디입니다.";
		Msg::GblMsgBoxParent($msg);
		exit;
	}
}









if($type == 'write' || $type == 'edit'){
	if($userType == '일반'){
		$reduction = '';
	}

	//파일업로드
	include 'fileChk.php';

	//감면대상자


	//생년월일
	$bArr = explode('-',$bDate);
	$bTime = mktime(0,0,0,$bArr[1],$bArr[2],$bArr[0]);

	//차량보유
	if($car == '')	$carNum = '';

	//비고
	if($memo)	$memo = Util::textareaEncodeing($memo);


	//질병 및 건강상태
	$health = '';
	$healthBabyChk = '';
	$healthEtcChk = '';
	for($i=0; $i<count($healthList); $i++){
		$healthTxt = $healthList[$i];

		if($healthTxt == '임산부')	$healthBabyChk = true;
		if($healthTxt == '기타')		$healthEtcChk = true;

		if($health)	$health .= ',';
		$health .= $healthTxt;
	}

	if(!$healthBabyChk)	$healthBaby = '';		//임산부를 선택하지 않았을 경우 임신주차수 정보를 삭제
	if(!$healthEtcChk)		$healthEtc = '';		//기타를 선택하지 않았을 경우 기타정보를 삭제






	if($type == 'write'){

		//접수일
		$gArr = explode('-',$getDate);
		$getTime = mktime(0,0,0,$gArr[1],$gArr[2],$gArr[0]);

		//기존회원
		if($oldUser){
			$sql = "update zz_member set userid='$userid' where uid='$oldUser'";
			$result = mysql_query($sql);
			$userOrder = '';

		}else{
			$sql = "select max(userOrder) from ks_userlist";
			$result = mysql_query($sql);
			$max = mysql_result($result,0,0);
			$userOrder = $max + 1;

			$userNum = sprintf('%08d',$userOrder);
		}

		//생년월일
		$bArr = explode('-',$bDate);
		$bTime = mktime(0,0,0,$bArr[1],$bArr[2],$bArr[0]);

		//차량보유
		if($car == '')	$carNum = '';

		//비고
		if($memo)	$memo = Util::textareaEncodeing($memo);

		//대상자 자료제공
		if($cok == ''){
			$cokPost = '';
			$cokSms = '';
			$cokEmail = '';
			$cokPhone = '';
		}

		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into ks_userlist (status,userid,pwd,name,userNum,userOrder,sex,bDate,bTime,userType,car,carNum,zipcode,addr01,addr02,bank,accName,account,email01,email02,phone01,phone01Txt,phone02,phone02Txt,memo,reduction,upfile01,realfile01,cok,cokPost,cokSms,cokEmail,cokPhone,health,healthBaby,healthEtc,joinType,getDate,getTime,rDate,rTime) values ";
		$sql .= "('$status','$userid','$pwd','$name','$userNum','$userOrder','$sex','$bDate','$bTime','$userType','$car','$carNum','$zipcode','$addr01','$addr02','$bank','$accName','$account','$email01','$email02','$phone01','$phone01Txt','$phone02','$phone02Txt','$memo','$reduction','$arr_new_file[1]','$real_name[1]','$cok','$cokPost','$cokSms','$cokEmail','$cokPhone','$health','$healthBaby','$healthEtc','$joinType','$getDate','$getTime','$rDate','$rTime')";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("이용자가 등록되었습니다.","location.href='up_index.php';");
		exit;



	}elseif($type == 'edit'){
		$editDate = date('Y-m-d H:i:s');
		$editTime = mktime();

		$sql = "update ks_userlist set ";
		$sql .= "status='$status', ";
		$sql .= "pwd='$pwd', ";
		$sql .= "name='$name', ";
		$sql .= "sex='$sex', ";
		$sql .= "bDate='$bDate', ";
		$sql .= "bTime='$bTime', ";
		$sql .= "userType='$userType', ";
		$sql .= "car='$car', ";
		$sql .= "carNum='$carNum', ";
		$sql .= "zipcode='$zipcode', ";
		$sql .= "addr01='$addr01', ";
		$sql .= "addr02='$addr02', ";
		$sql .= "bank='$bank', ";
		$sql .= "accName='$accName', ";
		$sql .= "account='$account', ";
		$sql .= "email01='$email01', ";
		$sql .= "email02='$email02', ";
		$sql .= "phone01='$phone01', ";
		$sql .= "phone01Txt='$phone01Txt', ";
		$sql .= "phone02='$phone02', ";
		$sql .= "phone02Txt='$phone02Txt', ";
		$sql .= "memo='$memo', ";
		$sql .= "reduction='$reduction', ";
		$sql .= "upfile01='$arr_new_file[1]',";
		$sql .= "realfile01='$real_name[1]',";
		$sql .= "cok='$cok', ";
		$sql .= "cokPost='$cokPost', ";
		$sql .= "cokSms='$cokSms', ";
		$sql .= "cokEmail='$cokEmail', ";
		$sql .= "cokPhone='$cokPhone', ";
		$sql .= "health='$health', ";
		$sql .= "healthBaby='$healthBaby', ";
		$sql .= "healthEtc='$healthEtc', ";
		$sql .= "joinType='$joinType', ";
		$sql .= "editDate='$editDate', ";
		$sql .= "editTime='$editTime' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("회원정보가 수정되었습니다.","javascript:parent.reg_list();");
		exit;
	}



}elseif($type == 'del'){
	$sql = "select * from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userNum = $row['userNum'];
	$upfile01 = $row['upfile01'];
	if($upfile01){
		$UPLOAD_DIR = '../../upfile/user/';
		@unlink($UPLOAD_DIR.$upfile01);
	}

	$sql = "delete from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);

	//이전자료 > 회원목록 아이디발급 정보 초기화
	$sql = "update zz_member set userid='' where userNum='$userNum'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>
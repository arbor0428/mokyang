<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';

if($type == 'write' || $type == 'edit'){
	//교육기간
	$eduArr = explode(' ~ ',$eDate);
	$eDate01 = $eduArr[0];
	$eDate02 = $eduArr[1];

	$eArr = explode('-',$eDate01);
	$eTime01 = mktime(0,0,0,$eArr[1],$eArr[2],$eArr[0]);
	$eArr = explode('-',$eDate02);
	$eTime02 = mktime(23,59,59,$eArr[1],$eArr[2],$eArr[0]);

	//환불 불가일
	if($cDate01){
		$cArr = explode('-',$cDate01);
		$cTime01 = mktime(0,0,0,$cArr[1],$cArr[2],$cArr[0]);
	}

	//신청일
	$sArr = explode('-',$getDate);
	$getTime = mktime(0,0,0,$sArr[1],$sArr[2],$sArr[0]);

	//수납정보
	if($payAmt == 0){
//		$payMode = '';
		$payAmt = '';
		$payDate = '';
		$payTime = '';
		$billNum = '';
		$cashBill = '';

	}else{
		$pArr = explode('-',$payDate);
		$payTime = mktime($payHour,$payMin,$paySec,$pArr[1],$pArr[2],$pArr[0]);
		$payDate = date('Y-m-d H:i:s',$payTime);
	}


	//프로그램정보
	$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' and title='$title' order by uid desc";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$periodID = $row['periodID'];
	$programID = $row['uid'];
	$packageChk = $row['package'];
	$pid = $row['pid'];		//기존프로그램

	if($packageChk == '')	$package = '';



	if($season == '상시' && $cade01 == '휘트니스센터'){
		$fitnessType = $row["fitnessType"];

		//이용시작일
		$sArr = explode('-',$fitnessDate01);
		$fitnessTime01 = mktime(0,0,0,$sArr[1],$sArr[2],$sArr[0]);

		//이용종료일
		$sArr = explode('-',$fitnessDate02);
		$fitnessTime02 = mktime(23,59,59,$sArr[1],$sArr[2],$sArr[0]);
/*
		$fitnessDate02 = Util::lastDate($fitnessDate01,$fitnessType);
		$sArr = explode('-',$fitnessDate02);
		$fitnessTime02 = mktime(23,59,59,$sArr[1],$sArr[2],$sArr[0]);
*/

		//중도휴예기간
		if($breakDate01){
			$sArr = explode('-',$breakDate01);
			$breakTime01 = mktime(0,0,0,$sArr[1],$sArr[2],$sArr[0]);
		}
		if($breakDate02){
			$sArr = explode('-',$breakDate02);
			$breakTime02 = mktime(23,59,59,$sArr[1],$sArr[2],$sArr[0]);
		}

	}else{
		$fitnessDate01 = '';		//이용시작일
		$fitnessTime01 = '';
		$fitnessDate02 = '';		//이용종료일
		$fitnessTime02 = '';
		$breakDate01 = '';		//중도휴예기간
		$breakTime01 = '';
		$breakDate02 = '';
		$breakTime02 = '';
	}


	if($memo)		$memo = Util::textareaEncodeing($memo);
	if($payMemo)	$payMemo = Util::textareaEncodeing($payMemo);

	if($payMode == '단말기' || $payMode == '현금' || $payMode == '계좌이체' || $payMode == '신용카드')	$payOk = '결제확인';

	$orderType = '';

	if($pid){
		//기존프로그램을 수강했는지 확인
		$usql = "select * from ks_userClass where userid='$userid' and programID='$pid' and reFund=''";
		$uresult = mysql_query($usql);
		$unum = mysql_num_rows($uresult);

		if($unum)	$orderType = '1';
	}


	if($type == 'write'){
		$userip = $_SERVER[REMOTE_ADDR];
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into ks_userClass (userid,name,userNum,year,season,cade01,period,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,title,fitnessDate01,fitnessTime01,fitnessDate02,fitnessTime02,periodID,programID,programAmt,mTarget,reduction,health,getDate,getTime,breakDate01,breakTime01,breakDate02,breakTime02,payMode,payOk,payAmt,payDate,payTime,billNum,cardName,cashBill,cashBillNum,memo,payMemo,userip,rDate,rTime,saleChk,saleAmt,package,orderType,posID) values ";
		$sql .= "('$userid','$name','$userNum','$year','$season','$cade01','$period','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$title','$fitnessDate01','$fitnessTime01','$fitnessDate02','$fitnessTime02','$periodID','$programID','$programAmt','$mTarget','$reduction','$health','$getDate','$getTime','$breakDate01','$breakTime01','$breakDate02','$breakTime02','$payMode','$payOk','$payAmt','$payDate','$payTime','$billNum','$cardName','$cashBill','$cashBillNum','$memo','$payMemo','$userip','$rDate','$rTime','$saleChk','$saleAmt','$package','$orderType','$posID')";
		$result = mysql_query($sql);

		//개별프로그램 장바구니삭제
		if($etcID){
			$sql = "delete from ks_cartList where uid='$etcID'";
			$result = mysql_query($sql);
		}

		Msg::GblMsgBoxParent("등록되었습니다.","location.href='up_index.php';");
		exit;



	}elseif($type == 'edit'){
		$sql = "update ks_userClass set ";
		$sql .= "userid='$userid', ";
		$sql .= "name='$name', ";
		$sql .= "userNum='$userNum', ";
		$sql .= "year='$year', ";
		$sql .= "season='$season', ";
		$sql .= "cade01='$cade01', ";
		$sql .= "period='$period', ";
		$sql .= "eDate01='$eDate01', ";
		$sql .= "eTime01='$eTime01', ";
		$sql .= "eDate02='$eDate02', ";
		$sql .= "eTime02='$eTime02', ";
		$sql .= "cDate01='$cDate01', ";
		$sql .= "cTime01='$cTime01', ";
		$sql .= "title='$title', ";
		$sql .= "fitnessDate01='$fitnessDate01', ";
		$sql .= "fitnessTime01='$fitnessTime01', ";
		$sql .= "fitnessDate02='$fitnessDate02', ";
		$sql .= "fitnessTime02='$fitnessTime02', ";		
		$sql .= "periodID='$periodID', ";
		$sql .= "programID='$programID', ";
		$sql .= "programAmt='$programAmt', ";
		$sql .= "mTarget='$mTarget', ";		
		$sql .= "reduction='$reduction', ";
		$sql .= "health='$health', ";
		$sql .= "getDate='$getDate', ";
		$sql .= "getTime='$getTime', ";
		$sql .= "breakDate01='$breakDate01', ";
		$sql .= "breakTime01='$breakTime01', ";
		$sql .= "breakDate02='$breakDate02', ";
		$sql .= "breakTime02='$breakTime02', ";
		$sql .= "payMode='$payMode', ";
		$sql .= "payAmt='$payAmt', ";
		$sql .= "payDate='$payDate', ";
		$sql .= "payTime='$payTime', ";
		$sql .= "billNum='$billNum', ";
		$sql .= "cardName='$cardName', ";		
		$sql .= "cashBill='$cashBill', ";
		$sql .= "cashBillNum='$cashBillNum', ";		
		$sql .= "memo='$memo', ";
		$sql .= "payMemo='$payMemo', ";		
		$sql .= "saleChk='$saleChk', ";
		$sql .= "saleAmt='$saleAmt', ";
		$sql .= "package='$package', ";
		$sql .= "orderType='$orderType', ";
		$sql .= "posID='$posID' ";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("수정되었습니다.","parent.reg_list();");
		exit;

	}


//환불/취소처리
}elseif($type == 'recan'){
	if($reFund == ''){
		$reAmt = '';
		$reEtc = '';
		$reUse = '';
		$reDate = '';
		$reTime = '';
	}else{
		$rArr = explode('-',$reDate);
		$reTime = mktime(0,0,0,$rArr[1],$rArr[2],$rArr[0]);
	}

	if($reMemo)	$reMemo = Util::textareaEncodeing($reMemo);

	$sql = "update ks_userClass set ";
	$sql .= "reFund='$reFund', ";
	$sql .= "reAmt='$reAmt', ";
	$sql .= "reEtc='$reEtc', ";
	$sql .= "reUse='$reUse', ";
	$sql .= "reDate='$reDate', ";
	$sql .= "reTime='$reTime', ";
	$sql .= "reMemo='$reMemo', ";	
	$sql .= "newAmt='$newAmt', ";	
	$sql .= "newNum='$newNum', ";	
	$sql .= "newCard='$newCard' ";	
	$sql .= " where uid=$uid";
	$result = mysql_query($sql);

	Msg::GblMsgBoxParent("환불/취소 정보가 수정되었습니다.","parent.reg_list();");
	exit;




}elseif($type == 'del'){
	$sql = "select * from ks_userClass where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
	$name = $row['name'];
	$userNum = $row['userNum'];
	$phone01 = $row['phone01'];
	$year = $row['year'];
	$season = $row['season'];
	$cade01 = $row['cade01'];
	$period = $row['period'];
	$eDate01 = $row['eDate01'];
	$eTime01 = $row['eTime01'];
	$eDate02 = $row['eDate02'];
	$eTime02 = $row['eTime02'];
	$cDate01 = $row['cDate01'];
	$cTime01 = $row['cTime01'];
	$title = $row['title'];
	$fitnessDate01 = $row['fitnessDate01'];
	$fitnessTime01 = $row['fitnessTime01'];
	$fitnessDate02 = $row['fitnessDate02'];
	$fitnessTime02 = $row['fitnessTime02'];
	$periodID = $row['periodID'];
	$programID = $row['programID'];
	$programAmt = $row['programAmt'];
	$mTarget = $row['mTarget'];
	$reduction = $row['reduction'];
	$health = $row['health'];
	$getDate = $row['getDate'];
	$getTime = $row['getTime'];
	$breakDate01 = $row['breakDate01'];
	$breakTime01 = $row['breakTime01'];
	$breakDate02 = $row['breakDate02'];
	$breakTime02 = $row['breakTime02'];
	$payMode = $row['payMode'];
	$payAmt = $row['payAmt'];
	$payDate = $row['payDate'];
	$payTime = $row['payTime'];
	$kcpAmt = $row['kcpAmt'];
	$billNum = $row['billNum'];
	$cashBill = $row['cashBill'];
	$cashBillNum = $row['cashBillNum'];
	$payOk = $row['payOk'];
	$paynum = $row['paynum'];
	$cardName = $row['cardName'];
	$bankname = $row['bankname'];
	$depositor = $row['depositor'];
	$account = $row['account'];
	$va_date = $row['va_date'];
	$cash_yn = $row['cash_yn'];
	$cash_authno = $row['cash_authno'];
	$vaDate = $row['vaDate'];
	$vaTime = $row['vaTime'];
	$reFund = $row['reFund'];
	$reAmt = $row['reAmt'];
	$reEtc = $row['reEtc'];
	$reUse = $row['reUse'];
	$reDate = $row['reDate'];
	$reTime = $row['reTime'];
	$reMemo = $row['reMemo'];
	$reMsg = $row['reMsg'];
	$memo = $row['memo'];
	$payMemo = $row['payMemo'];
	$backName = $row['backName'];
	$backBank = $row['backBank'];
	$backAccount = $row['backAccount'];
	$upfile01 = $row['upfile01'];
	$realfile01 = $row['realfile01'];
	$billName = $row['billName'];
	$userip = $row['userip'];
	$rDate = $row['rDate'];
	$rTime = $row['rTime'];
	$device = $row['device'];
	$package = $row['package'];
	$newAmt = $row['newAmt'];
	$newNum = $row['newNum'];
	$newCard = $row['newCard'];
	$saleChk = $row['saleChk'];
	$saleAmt = $row['saleAmt'];
	$cid = $row['cid'];




	//삭제정보저장
	$del_uid = $uid;
	$del_manager = $GBL_USERID;
	$delDate = date('Y-m-d H:i:s');
	$delTime = mktime();
	$delAuto = '';

	$sql = "insert into ks_userClass_del (userid,name,userNum,phone01,year,season,cade01,period,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,title,fitnessDate01,fitnessTime01,fitnessDate02,fitnessTime02,periodID,programID,programAmt,mTarget,reduction,health,getDate,getTime,breakDate01,breakTime01,breakDate02,breakTime02,payMode,saleAmt,payAmt,payDate,payTime,kcpAmt,billNum,cashBill,cashBillNum,payOk,paynum,cardName,bankname,depositor,account,va_date,cash_yn,cash_authno,vaDate,vaTime,reFund,reAmt,reEtc,reUse,reDate,reTime,reMemo,reMsg,memo,payMemo,backName,backBank,backAccount,upfile01,realfile01,billName,userip,rDate,rTime,device,package,newAmt,newNum,newCard,saleChk,cid,del_uid,del_manager,delDate,delTime,delAuto) values ('$userid','$name','$userNum','$phone01','$year','$season','$cade01','$period','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$title','$fitnessDate01','$fitnessTime01','$fitnessDate02','$fitnessTime02','$periodID','$programID','$programAmt','$mTarget','$reduction','$health','$getDate','$getTime','$breakDate01','$breakTime01','$breakDate02','$breakTime02','$payMode','$saleAmt','$payAmt','$payDate','$payTime','$kcpAmt','$billNum','$cashBill','$cashBillNum','$payOk','$paynum','$cardName','$bankname','$depositor','$account','$va_date','$cash_yn','$cash_authno','$vaDate','$vaTime','$reFund','$reAmt','$reEtc','$reUse','$reDate','$reTime','$reMemo','$reMsg','$memo','$payMemo','$backName','$backBank','$backAccount','$upfile01','$realfile01','$billName','$userip','$rDate','$rTime','$device','$package','$newAmt','$newNum','$newCard','$saleChk','$cid','$del_uid','$del_manager','$delDate','$delTime','$delAuto')";
	$result = mysql_query($sql);





	$sql = "delete from ks_userClass where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>
<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';


if($type == 'write'){
	//기간 이름 중복확인
	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$title'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		Msg::GblMsgBoxParent("동일한 기간 이름이 등록되어있습니다.","");
		exit;
	}

	//접수기간(기존)
	if($aDate01){
		$Arr = explode('-',$aDate01);
		$aTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($aDate02){
		$Arr = explode('-',$aDate02);
		$aTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//접수기간(신규)
	if($oDate01){
		$Arr = explode('-',$oDate01);
		$oTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($oDate02){
		$Arr = explode('-',$oDate02);
		$oTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//교육기간
	if($eDate01){
		$Arr = explode('-',$eDate01);
		$eTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($eDate02){
		$Arr = explode('-',$eDate02);
		$eTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//환불불가일
	if($cDate01){
		$Arr = explode('-',$cDate01);
		$cTime01 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	$rDate = date('Y-m-d H:i:s');
	$rTime = mktime();

	$sql = "insert into ks_programPeriod (year,season,cade01,title,aDate01,aTime01,aDate02,aTime02,oDate01,oTime01,oDate02,oTime02,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,rDate,rTime) values ";
	$sql .= "('$year','$season','$cade01','$title','$aDate01','$aTime01','$aDate02','$aTime02','$oDate01','$oTime01','$oDate02','$oTime02','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$rDate','$rTime')";
	$result = mysql_query($sql);

	echo ("<script language='javascript'>parent.addContinue();</script>");
	exit;



}elseif($type == 'edit'){
	//기간 이름 중복확인
	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$title' and uid!='$uid'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		Msg::GblMsgBoxParent("동일한 기간 이름이 등록되어있습니다.","");
		exit;
	}

	//접수기간(기존)
	if($aDate01){
		$Arr = explode('-',$aDate01);
		$aTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($aDate02){
		$Arr = explode('-',$aDate02);
		$aTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//정규접수기간
	if($oDate01){
		$Arr = explode('-',$oDate01);
		$oTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($oDate02){
		$Arr = explode('-',$oDate02);
		$oTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//교육기간
	if($eDate01){
		$Arr = explode('-',$eDate01);
		$eTime01 = mktime(0,0,0,$Arr[1],$Arr[2],$Arr[0]);
	}
	if($eDate02){
		$Arr = explode('-',$eDate02);
		$eTime02 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	//환불불가일
	if($cDate01){
		$Arr = explode('-',$cDate01);
		$cTime01 = mktime(23,59,59,$Arr[1],$Arr[2],$Arr[0]);
	}

	$sql = "update ks_programPeriod set ";
	$sql .= "year='$year', ";	
	$sql .= "season='$season', ";	
	$sql .= "cade01='$cade01', ";
	$sql .= "title='$title', ";
	$sql .= "aDate01='$aDate01', ";
	$sql .= "aTime01='$aTime01', ";
	$sql .= "aDate02='$aDate02', ";
	$sql .= "aTime02='$aTime02', ";
	$sql .= "oDate01='$oDate01', ";
	$sql .= "oTime01='$oTime01', ";
	$sql .= "oDate02='$oDate02', ";
	$sql .= "oTime02='$oTime02', ";
	$sql .= "eDate01='$eDate01', ";
	$sql .= "eTime01='$eTime01', ";
	$sql .= "eDate02='$eDate02', ";
	$sql .= "eTime02='$eTime02', ";
	$sql .= "cDate01='$cDate01', ";
	$sql .= "cTime01='$cTime01' ";
	$sql .= " where uid=$uid";
	$result = mysql_query($sql);


	//해당기간에 등록된 프로그램 정보수정
	$sql = "update ks_program set ";
	$sql .= "year='$year', ";	
	$sql .= "season='$season', ";	
	$sql .= "cade01='$cade01', ";
	$sql .= "period='$title', ";
	$sql .= "aDate01='$aDate01', ";
	$sql .= "aTime01='$aTime01', ";
	$sql .= "aDate02='$aDate02', ";
	$sql .= "aTime02='$aTime02', ";
	$sql .= "oDate01='$oDate01', ";
	$sql .= "oTime01='$oTime01', ";
	$sql .= "oDate02='$oDate02', ";
	$sql .= "oTime02='$oTime02', ";
	$sql .= "eDate01='$eDate01', ";
	$sql .= "eTime01='$eTime01', ";
	$sql .= "eDate02='$eDate02', ";
	$sql .= "eTime02='$eTime02', ";
	$sql .= "cDate01='$cDate01', ";
	$sql .= "cTime01='$cTime01' ";
	$sql .= " where periodID=$uid";
	$result = mysql_query($sql);


	//해당기간의 프로그램을 신청 수강정보수정
	$sql = "update ks_userClass set ";
	$sql .= "year='$year', ";	
	$sql .= "season='$season', ";	
	$sql .= "cade01='$cade01', ";
	$sql .= "period='$title', ";
	$sql .= "eDate01='$eDate01', ";
	$sql .= "eTime01='$eTime01', ";
	$sql .= "eDate02='$eDate02', ";
	$sql .= "eTime02='$eTime02', ";
	$sql .= "cDate01='$cDate01', ";
	$sql .= "cTime01='$cTime01' ";
	$sql .= " where periodID=$uid";
	$result = mysql_query($sql);


	Msg::GblMsgBoxParent("수정되었습니다.","parent.reg_list();");
	exit;



}elseif($type == 'del'){
	$sql = "delete from ks_programPeriod where uid='$uid'";
	$result = mysql_query($sql);

	Msg::goKorea('up_index.php');
	exit;

}
?>
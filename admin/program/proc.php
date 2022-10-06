<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';

if($type == 'write' || $type == 'edit'){
	//파일업로드
	include 'fileChk.php';

	//선택한 기간 uid 확인
	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$period'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$periodID = $row['uid'];
	$aDate01 = $row['aDate01'];
	$aTime01 = $row['aTime01'];
	$aDate02 = $row['aDate02'];
	$aTime02 = $row['aTime02'];
	$oDate01 = $row['oDate01'];
	$oTime01 = $row['oTime01'];
	$oDate02 = $row['oDate02'];
	$oTime02 = $row['oTime02'];
	$eDate01 = $row['eDate01'];
	$eTime01 = $row['eTime01'];
	$eDate02 = $row['eDate02'];
	$eTime02 = $row['eTime02'];
	$cDate01 = $row['cDate01'];
	$cTime01 = $row['cTime01'];

	$yoilList = '';

	//휘트니스 프로그램 확인
	if($season == '상시' && $cade01 == '휘트니스센터'){
		$eduNum = '';
		$oneAmt = '';
		$package = '';

	}else{
		$fitnessType = '';
		$yoilCnt = count($yoil);

		for($i=0; $i<$yoilCnt; $i++){
			$yoilTxt = $yoil[$i];
			if($yoilList != '')	$yoilList .= ',';
			$yoilList .= $yoilTxt;
		}

		//교육횟수(설정한 요일이 교육기간내에 몇번인지..) = 수동입력으로 변경
//		$eduNum = Util::yoilChk($eTime01,$eTime02,$yoilList);

		//회기별 단가 (프로그램금액 / 교육횟수)
		$oneAmt = round($amt / $eduNum);

		//주2회 또는 주3회 프로그램만 패키지 등록이 가능
		if($yoilCnt != 2 && $yoilCnt != 3){
			$package = '';
		}
	}

	//내용
	if($ment01)		$ment01 = Util::textareaEncodeing($ment01);

	//비고
	if($ment02)		$ment02 = Util::textareaEncodeing($ment02);

	if($type == 'write'){
		$rDate = date('Y-m-d H:i:s');
		$rTime = mktime();

		$sql = "insert into ks_program (online,package,pid,pTitle,year,season,cade01,period,mTarget,mTargetEtc,periodID,room,title,fitnessType,tutorID,tutor,maxNum,amt,oneAmt,eduNum,sEduHour,sEduMin,eEduHour,eEduMin,yoilList,ment01,ment02,aDate01,aTime01,aDate02,aTime02,oDate01,oTime01,oDate02,oTime02,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,upfile01,realfile01,rDate,rTime) values ";
		$sql .= "('$online','$package','$pid','$pTitle','$year','$season','$cade01','$period','$mTarget','$mTargetEtc','$periodID','$room','$title','$fitnessType','$tutorID','$tutor','$maxNum','$amt','$oneAmt','$eduNum','$sEduHour','$sEduMin','$eEduHour','$eEduMin','$yoilList','$ment01','$ment02','$aDate01','$aTime01','$aDate02','$aTime02','$oDate01','$oTime01','$oDate02','$oTime02','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$arr_new_file[1]','$real_name[1]','$rDate','$rTime')";
		$result = mysql_query($sql);

	if($oldProgram){
		//복사수 증가
		$sql = "update zz_program set copyNum=copyNum+1 where uid='$oldProgram'";
		$result = mysql_query($sql);

		//다음 프로그램
		$sql = "select * from zz_program where uid<$oldProgram order by uid desc limit 1";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num){
			$row = mysql_fetch_array($result);
			$oldProgram = $row['uid'];
			Msg::goKorea("./up_index.php?type=write&oldProgram=$oldProgram");
			exit;

		}else{
			Msg::goKorea("/admin/oldProgram/up_index.php");
			exit;
		}
	}else{
		Msg::GblMsgBoxParent("등록되었습니다.","location.href='up_index.php';");
		exit;
	}



	}elseif($type == 'edit'){
		$sql = "update ks_program set ";
		$sql .= "online='$online', ";
		$sql .= "package='$package', ";		
		$sql .= "pid='$pid', ";
		$sql .= "pTitle='$pTitle', ";
		$sql .= "year='$year', ";
		$sql .= "season='$season', ";
		$sql .= "cade01='$cade01', ";
		$sql .= "period='$period', ";
		$sql .= "periodID='$periodID', ";
		$sql .= "mTarget='$mTarget', ";
		$sql .= "mTargetEtc='$mTargetEtc', ";
		$sql .= "room='$room', ";
		$sql .= "title='$title', ";
		$sql .= "fitnessType='$fitnessType', ";		
		$sql .= "tutorID='$tutorID', ";
		$sql .= "tutor='$tutor', ";
		$sql .= "maxNum='$maxNum', ";
		$sql .= "amt='$amt', ";
		$sql .= "oneAmt='$oneAmt', ";
		$sql .= "eduNum='$eduNum', ";
		$sql .= "sEduHour='$sEduHour', ";
		$sql .= "sEduMin='$sEduMin', ";
		$sql .= "eEduHour='$eEduHour', ";
		$sql .= "eEduMin='$eEduMin', ";		
		$sql .= "yoilList='$yoilList', ";
		$sql .= "ment01='$ment01', ";
		$sql .= "ment02='$ment02', ";
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
		$sql .= "cTime01='$cTime01', ";
		$sql .= "upfile01='$arr_new_file[1]',";
		$sql .= "realfile01='$real_name[1]'";
		$sql .= " where uid=$uid";
		$result = mysql_query($sql);

		//해당 프로그램을 수강신청 정보변경
		$sql = "update ks_userClass set ";
		$sql .= "year='$year', ";	
		$sql .= "season='$season', ";	
		$sql .= "cade01='$cade01', ";
		$sql .= "period='$period', ";
		$sql .= "title='$title', ";
		$sql .= "eDate01='$eDate01', ";
		$sql .= "eTime01='$eTime01', ";
		$sql .= "eDate02='$eDate02', ";
		$sql .= "eTime02='$eTime02', ";
		$sql .= "cDate01='$cDate01', ";
		$sql .= "cTime01='$cTime01' ";
		$sql .= " where programID=$uid";
		$result = mysql_query($sql);

		Msg::GblMsgBoxParent("수정되었습니다.","location.href='up_index.php';");
		exit;

	}



}elseif($type == 'del'){
	//해당 프로그램을 신청한 수강정보가 있는지 확인한다.
	$sql = "select * from ks_userClass where programID=$uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		Msg::GblMsgBoxParent("해당 프로그램의 수강신청 정보가 있습니다.","location.href='up_index.php';");
		exit;

	}else{
		$sql = "delete from ks_program where uid='$uid'";
		$result = mysql_query($sql);

		Msg::goKorea('up_index.php');
		exit;
	}

}
?>
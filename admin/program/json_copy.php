<?
	include '../../module/class/class.DbCon.php';

	$oyear = $_POST['oyear'];
	$oseason = iconv("utf-8","euc-kr",$oseason);
	$year = $_POST['year'];
	$season = iconv("utf-8","euc-kr",$season);

	$req = Array();


	//기존프로그램 학기내 코드(분류) 확인
	$sql = "select distinct(cade01) from ks_program where year='$oyear' and season='$oseason' order by cade01";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	//기존프로그램없음
	if($num == 0){
		$req[0] = 'empty1';
		$json = json_encode($req);
		echo $json;
		exit;
	}


	//기존프로그램 코드(분류)정보
	$arr1 = Array();
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$arr1[$i] = $row['cade01'];
	}

	//신규프로그램 학기내 코드(분류) 확인
	$sql = "select cade01 from ks_programCode where season='$season'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	$arr2 = Array();
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$arr2[$i] = $row['cade01'];
	}

	//코드비교(신규프로그램 학기내 코드(분류)가 없으면 오류발생
	$codeChk = '';
	foreach($arr1 as $k => $v){
		if(!in_array($v,$arr2)){
			if($codeChk)	$codeChk .= ',';
			$codeChk .= iconv("euc-kr","utf-8",$v);
		}
	}

	//코드오류
	if($codeChk){
		$req[0] = 'code';
		$req[1] = urlencode($codeChk);		//없는 코드정보
		$json = json_encode($req);
		echo $json;
		exit;

	}else{
		//기존프로그램 기간정보
		$sql = "select * from ks_program where year='$oyear' and season='$oseason' group by periodID";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		//기존프로그램 기간정보없음
		if($num == 0){
			$req[0] = 'empty2';
			$json = json_encode($req);
			echo $json;
			exit;

		}else{
			//기간확인
			$periodChk = '';

			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);
				$ocade01 = $row['cade01'];
				$operiod = $row['period'];

				//기간 이름의 첫글자가 숫자인 경우(1월~12월프로그램)
				if(preg_match("/^[0-9]/",$operiod)){
					$otitle = $operiod;
				
				//첫글자가 숫자가 아닌경우(봄,여름,가을,겨울,상시프로그램)
				}else{
					if($season == '상시')	$otitle = '상시프로그램';
					else							$otitle = $season.'학기프로그램';
				}

				//신규프로그램 기간확인
				$nsql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$ocade01' and title='$otitle'";
				$nresult = mysql_query($nsql);
				$nnum = mysql_num_rows($nresult);

				if($nnum == 0){
					if($periodChk)	$periodChk .= ',';
					$periodChk .= iconv("euc-kr","utf-8",$ocade01.'/'.$otitle);
				}
			}

			//기간오류
			if($periodChk){
				$req[0] = 'period';
				$req[1] = urlencode($periodChk);		//없는 기간정보
				$json = json_encode($req);
				echo $json;
				exit;

			//프로그램 복사등록
			}else{
				//기존프로그램
				$sql01 = "select * from ks_program where year='$oyear' and season='$oseason' order by uid";
				$result01 = mysql_query($sql01);
				$num01 = mysql_num_rows($result01);

				for($i=0; $i<$num01; $i++){
					$row01 = mysql_fetch_array($result01);

					$online = $row01['online'];
					$package = $row01['package'];
//					$pid = '';
//					$pTitle = '';
//					$year = '';
//					$season = '';
					$cade01 = $row01['cade01'];
//					$period = '';
					$mTarget = $row01['mTarget'];
					$mTargetEtc = $row01['mTargetEtc'];
//					$periodID = '';
					$room = $row01['room'];
					$title = $row01['title'];
					$fitnessType = $row01['fitnessType'];
					$tutorID = $row01['tutorID'];
					$tutor = $row01['tutor'];
					$maxNum = $row01['maxNum'];
					$amt = $row01['amt'];
					$oneAmt = $row01['oneAmt'];
					$eduNum = $row01['eduNum'];
					$sEduHour = $row01['sEduHour'];
					$sEduMin = $row01['sEduMin'];
					$eEduHour = $row01['eEduHour'];
					$eEduMin = $row01['eEduMin'];
					$yoilList = $row01['yoilList'];
					$ment01 = $row01['ment01'];
					$ment02 = $row01['ment02'];
/*
					$aDate01 = '';
					$aTime01 = '';
					$aDate02 = '';
					$aTime02 = '';
					$oDate01 = '';
					$oTime01 = '';
					$oDate02 = '';
					$oTime02 = '';
					$eDate01 = '';
					$eTime01 = '';
					$eDate02 = '';
					$eTime02 = '';
					$cDate01 = '';
					$cTime01 = '';
*/
					$upfile01 = '';
					$realfile01 = '';

					$rDate = date('Y-m-d H:i:s');
					$rTime = mktime();

					//이전프로그램정보
					$pid = $row['uid'];
					$pTitle = $row01['title'];

					//기간 이름의 첫글자가 숫자인 경우(1월~12월프로그램)
					$operiod = $row['period'];
					if(preg_match("/^[0-9]/",$operiod)){
						$period = $operiod;
					
					//첫글자가 숫자가 아닌경우(봄,여름,가을,겨울,상시프로그램)
					}else{
						if($season == '상시')	$period = '상시프로그램';
						else							$period = $season.'학기프로그램';
					}

					//신규프로그램 기간정보
					$nsql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$period'";
					$nresult = mysql_query($nsql);
					$nrow = mysql_fetch_array($nresult);

					$periodID = $nrow['uid'];
					$aDate01 = $nrow['aDate01'];
					$aTime01 = $nrow['aTime01'];
					$aDate02 = $nrow['aDate02'];
					$aTime02 = $nrow['aTime02'];
					$oDate01 = $nrow['oDate01'];
					$oTime01 = $nrow['oTime01'];
					$oDate02 = $nrow['oDate02'];
					$oTime02 = $nrow['oTime02'];
					$eDate01 = $nrow['eDate01'];
					$eTime01 = $nrow['eTime01'];
					$eDate02 = $nrow['eDate02'];
					$eTime02 = $nrow['eTime02'];
					$cDate01 = $nrow['cDate01'];
					$cTime01 = $nrow['cTime01'];

					$sql02 = "insert into ks_program (online,package,pid,pTitle,year,season,cade01,period,mTarget,mTargetEtc,periodID,room,title,fitnessType,tutorID,tutor,maxNum,amt,oneAmt,eduNum,sEduHour,sEduMin,eEduHour,eEduMin,yoilList,ment01,ment02,aDate01,aTime01,aDate02,aTime02,oDate01,oTime01,oDate02,oTime02,eDate01,eTime01,eDate02,eTime02,cDate01,cTime01,upfile01,realfile01,rDate,rTime) values ";
					$sql02 .= "('$online','$package','$pid','$pTitle','$year','$season','$cade01','$period','$mTarget','$mTargetEtc','$periodID','$room','$title','$fitnessType','$tutorID','$tutor','$maxNum','$amt','$oneAmt','$eduNum','$sEduHour','$sEduMin','$eEduHour','$eEduMin','$yoilList','$ment01','$ment02','$aDate01','$aTime01','$aDate02','$aTime02','$oDate01','$oTime01','$oDate02','$oTime02','$eDate01','$eTime01','$eDate02','$eTime02','$cDate01','$cTime01','$upfile01','$realfile01','$rDate','$rTime')";
					$result02 = mysql_query($sql02);
				}
			}

			$req[0] = 'suc';
			$req[1] = $num01;
			$json = json_encode($req);
			echo $json;
			exit;
		}
	}
?>
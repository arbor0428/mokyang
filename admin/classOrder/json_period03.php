<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	if (!function_exists('json_decode')) {  
		function json_decode($content, $assoc=false) {  
			require_once '../../module/JSON.php';  
		   if ($assoc) {  
			   $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);  
		   }  
		   else {  
			   $json = new Services_JSON;  
		   }  
		   return $json->decode($content);  
	   }  
	}  
	  
	if (!function_exists('json_encode')) {  
	   function json_encode($content) {  
		   require_once '../../module/JSON.php';  
		   $json = new Services_JSON;  
		   return $json->encode($content);  
	   }  
	}

	//장바구니정보(개별프로그램)
	if($etcID){
		$sql = "select * from ks_cartList where uid='$etcID'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$etcProgramID = $row["programID"];
		$etcAmt = $row["etcAmt"];
	}

	
	$year = iconv("utf-8","euc-kr",$year);
	$season = iconv("utf-8","euc-kr",$season);
	$cade01 = iconv("utf-8","euc-kr",$c1);
	$period = iconv("utf-8","euc-kr",$period);
	$title = iconv("utf-8","euc-kr",$title);

	//수강신청일
	$getArr = explode('-',$getDate);
	$getTime = mktime(0,0,0,$getArr[1],$getArr[2],$getArr[0]);


	$pList = Array();


	//프로그램정보
	$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' and title='$title' order by uid";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$uid = $row['uid'];
	$maxNum = $row['maxNum'];
	$mTarget = iconv("euc-kr","utf-8",$row['mTarget']);
	$yoilList = $row['yoilList'];
	$amt = $row['amt'];
	$oneAmt = $row['oneAmt'];
	$eduNum = $row['eduNum'];
	$eTime01 = $row['eTime01'];
	$eTime02 = $row['eTime02'];
	$package = $row['package'];
	$tutor = iconv("euc-kr","utf-8",$row['tutor']);

	//개별프로그램에서 등록한 금액
	if($etcProgramID == $uid)	$amt = $etcAmt;

	//감면금액
	$saleAmt = 0;


	//휘트니스 프로그램
	if($season == '상시' && $cade01 == '휘트니스센터'){
		//이용종료일
		$fitnessDate02 = Util::lastDate($fitnessDate,$row['fitnessType']);

	//일반프로그램
	}else{
		//수강신청일을 기준으로 지난 교육을 제외한 남은 교육횟수
		$realNum = Util::classOrderChk($eTime01,$eTime02,$yoilList,$getTime);

		//남은 교육횟수 * 프로그램 회당단가
		if($realNum < $eduNum)	$amt = $realNum * $oneAmt;

		//패키지신청
		if($packageChk && $package){
			$weeKNum = count(explode(',',$yoilList));
			if($weeKNum == 2)		$amt = 50000;
			elseif($weeKNum == 3)	$amt = 70000;
		}

		//감면비율
		if($rate){
			//개별프로그램에서 등록한 금액
			if($etcProgramID == $uid)	$amt = $etcAmt;

			$saleAmt = round($amt * ($rate/100));
			$amt = $amt - $saleAmt;
		}

		$fitnessDate02 = '';
	}



	$maxChk = '';


	//정원확인
	if($maxNum > 0){
		//납부회원수
		$f = "count(if((c.payMode!='' || c.payOk='결제확인') and c.reFund='', c.payMode, null)) as cnt";
		$sql = "select $f from ks_userClass as c left join ks_program as p on c.programID=p.uid where p.uid='$uid'";
		if($userid)	$sql .= " and c.userid!='$userid'";
		$result = mysql_query($sql);
		$cnt = mysql_result($result,0,0);
		if($cnt >= $maxNum)	$maxChk = '1';
	}
	

	$pList[0] = urlencode($mTarget);	//대상
	$pList[1] = $amt;							//프로그램 금액
	$pList[2] = $fitnessDate02;			//휘트니스 이용종료일
	$pList[3] = $package;					//헬스1개월 패키지
	$pList[4] = $maxChk;					//정원초과여부
	$pList[5] = urlencode($tutor);			//강사명
	$pList[6] = $saleAmt;					//감면금액

	$json = json_encode($pList);
	echo $json;
?>
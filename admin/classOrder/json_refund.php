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

	
	//환불수수료 및 환불금액
	$reArr = explode('-',$reDate);
	$reTime = mktime(0,0,0,$reArr[1],$reArr[2],$reArr[0]);

	//수강신청정보
	$sql = "select * from ks_userClass where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$programID = $row["programID"];
	$eDate01 = $row["eDate01"];
	$eTime01 = $row["eTime01"];
	$eDate02 = $row["eDate02"];
	$eTime02 = $row["eTime02"];
	$payAmt = $row["payAmt"];		//결제금액

	//프로그램정보
	$sql = "select * from ks_program where uid='$programID'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

//	$amt = $row['amt'];				//프로그램 금액
	$eduNum = $row['eduNum'];	//프로그램의 교육횟수
	$oneAmt = $row['oneAmt'];	//회기별 단가
	$yoilList = $row['yoilList'];		//프로그램 강의요일

	//남은 교육횟수
	$realNum = Util::classOrderChk($eTime01,$eTime02,$yoilList,$reTime);

	//교육시작전
	if($reTime <= $eTime01){
		$autoAmt = $payAmt;
		$autoEtc = 0;
		$autoUse = 0;

	}else{
/*
		//감면비율을 적용한 회기별 단가
		if($rate){
			$oneAmt = $oneAmt - round($oneAmt * ($rate/100));
		}

		//수강횟수
		$useNum = $eduNum - $realNum;

		//이용금액
		$autoUse = $oneAmt * $useNum;

		if($autoUse < 0)	$autoUse = 0;

		//수수료(결제금액의 10%)
		$autoEtc = round($payAmt * 0.1);

		//환불금액(결제금액 - 이용금액 - 수수료)
		$autoAmt = $payAmt - $autoUse - $autoEtc;
*/
		//교육기간내 일수(3개월 기준 90일 또는 91일)
		$days = ((strtotime($eDate02) - strtotime($eDate01)) / 86400) + 1;

		//1일당 이용료
		$oneAmt = round($payAmt / $days,2);

		//환불일과 시작일의 차이(지난일수)
		$useNum = ((strtotime($reDate) - strtotime($eDate01)) / 86400) + 1;

		//이용금액
		$autoUse = $oneAmt * $useNum;

		//수수료(결제금액의 10%)
		$autoEtc = $payAmt * 0.1;

		//환불금액(결제금액 - 이용금액 - 수수료)
		$autoAmt = $payAmt - $autoUse - $autoEtc;
	}

	$pList = Array();

	//1의자리 반올림
	$pList[0] = round($autoAmt/10)*10;	//환불금액
	$pList[1] = round($autoEtc/10)*10;	//환불수수료
	$pList[2] = round($autoUse/10)*10;	//이용금액

	$json = json_encode($pList);
	echo $json;
?>
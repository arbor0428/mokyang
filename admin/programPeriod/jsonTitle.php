<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$year = iconv("utf-8","euc-kr",$year);
	$title = iconv("utf-8","euc-kr",$title);

	$monthUnit = 3;

	if($title == '봄학기프로그램')				$month = 3;
	elseif($title == '여름학기프로그램')		$month = 6;
	elseif($title == '가을학기프로그램')		$month = 9;
	elseif($title == '겨울학기프로그램')		$month = 12;
	else{
		$month = str_replace('월프로그램','',$title);
		$monthUnit = 1;
	}

	$setDate = Array();

	if($month){
		//기존접수기간(전달 2째주 월요일~말일)
		$aTime = Util::yoilDate($year,$month-1,1,2);				//전달 2째주 월요일
		$aLast = date(t,mktime(0, 0, 0, $month-1, 1, $year));	//전달 말일

		$aYear = date('Y',$aTime);
		$aMonth = date('m',$aTime);

		$aDate01 = date('Y-m-d',$aTime);
		$aDate02 = $aYear.'-'.$aMonth.'-'.$aLast;

		$setDate[0] = $aDate01;
		$setDate[1] = $aDate02;





		//신규접수기간(전달 3째주 월요일~말일)
		$oTime = Util::yoilDate($year,$month-1,1,3);			//전달 3째주 월요일
		$oLast = date(t,mktime(0, 0, 0, $month-1, 1, $year));	//전달 말일

		$oYear = date('Y',$oTime);
		$oMonth = date('m',$oTime);

		$oDate01 = date('Y-m-d',$oTime);
		$oDate02 = $oYear.'-'.$oMonth.'-'.$oLast;

		$setDate[2] = $oDate01;
		$setDate[3] = $oDate02;




		//교육기간 3개월(1일~말일)
		if($monthUnit == 3){
			$eTime = mktime(0,0,0,$month+2,1,$year);
			$eLast = date('t',$eTime);

			$eDate01 = $year.'-'.sprintf('%02d',$month).'-01';
			$eDate02 = date('Y-m',$eTime).'-'.$eLast;

		//교육기간 1개월(1일~말일)
		}else{
			$eLast = date(t,mktime(0, 0, 0, $month, 1, $year));

			$eDate01 = $year.'-'.sprintf('%02d',$month).'-01';
			$eDate02 = $year.'-'.sprintf('%02d',$month).'-'.$eLast;
		}

		$setDate[4] = $eDate01;
		$setDate[5] = $eDate02;




		//환불불가일
//		$cDate01 = $year.'-'.sprintf('%02d',$month).'-20';
		$cDate01 = $eDate01;

		$setDate[6] = $cDate01;
	}

	$json = json_encode($setDate);
	echo $json;
?>
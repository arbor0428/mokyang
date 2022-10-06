<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$cols = 5;
	
	if($uid){
		$sql = "select p.*, e.eDate01, e.eDate02, e.eTime01, e.eTime02 from ks_program as p left join ks_programPeriod as e on p.periodID=e.uid where p.uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$title = $row["title"];
		$maxNum = $row["maxNum"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$eTime01 = $row["eTime01"];
		$eTime02 = $row["eTime02"];
		$yoilList = $row["yoilList"];
		$sEduHour = $row["sEduHour"];
		$sEduMin = $row["sEduMin"];	
		$eEduHour = $row["eEduHour"];
		$eEduMin = $row["eEduMin"];	

		//공휴일확인
		include 'holiday.php';

		//이전 프로그램
		$pid = $row["pid"];
		$pTitle = $row["pTitle"];

		$maxNumTxt = number_format($maxNum);

		if($yoilList){
			$yoilListTxt = $yoilList;
			$yoilListTxt = str_replace('1','월',$yoilListTxt);
			$yoilListTxt = str_replace('2','화',$yoilListTxt);
			$yoilListTxt = str_replace('3','수',$yoilListTxt);
			$yoilListTxt = str_replace('4','목',$yoilListTxt);
			$yoilListTxt = str_replace('5','금',$yoilListTxt);
			$yoilListTxt = str_replace('6','토',$yoilListTxt);
		}

		//교육기간내 회기요일에 해당하는 일자설정
		$yoilArr = explode(',',$yoilList);
		$monthArr = Array();
		$dayArr = Array();

		for($i=$eTime01; $i<=$eTime02; $i+=86400){
			$yoil = date('w',$i);

			if(in_array($yoil,$yoilArr)){
				$ymd = date('Ymd',$i);
				$month = date('Yn',$i);
				$day = date('j',$i);

				//공휴일 제외
				$holidayChk = $HOLIDAY[$ymd];
				if($holidayChk == ''){
					$monthArr[] = $month;

					$dayChk = $dayArr[$month];
					if($dayChk)		$dayChk .= ',';
					$dayChk .= $day;
					$dayArr[$month] = $dayChk;

					$cols++;
				}
			}
		}

		$monthArr = array_unique($monthArr);

		//이전프로그램 수강자 명단
		$pArr = Array();
		if($pid){
			$psql = "select * from ks_userClass where programID='$pid'";
			$presult = mysql_query($psql);
			$pnum = mysql_num_rows($presult);

			for($i=0; $i<$pnum; $i++){
				$prow = mysql_fetch_array($presult);

				$pArr[$i] = $prow["userid"];
			}
		}
	}

	$title = str_replace(',','',$title);
	$title = str_replace('.','',$title);


	$file_name = $title.'-출석부('.date('YmdHis').')';

	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$file_name.xls"); 

?>






<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>


<style>
br{mso-data-placement:same-cell;}
</style>

<table cellpadding='0' cellspacing='0' border='0'>
	<tr>
		<td colspan='<?=$cols?>'>
			연도/학기 : <?=$year?> / <?=$season?><br>
			분류/기간 : <?=$cade01?> / <?=$period?><br>
			프로그램명 : <?=$title?><br>
			정원 : <?=$maxNumTxt?><br>
			교육기간 : <?=$eDate01?> ~ <?=$eDate02?> (<?=$yoilListTxt?>)<br>
			교육시간 : <?=$sEduHour?>:<?=$sEduMin?> ~ <?=$eEduHour?>:<?=$eEduMin?><br>
			요일 : <?=$yoilListTxt?><br>
		<!--
			이전 프로그램 : <?=$pTitle?>
		-->
		</td>
	</tr>
</table>


<table cellpadding='0' cellspacing='0' border='1'>
	<tr>
		<th width='50' rowspan='2'>번호</th>
		<th width='100' rowspan='2'>회원명</th>
	<!--
		<th width='180' rowspan='2'>회원번호</th>
	-->
		<th width='100' rowspan='2'>연락처1</th>
	<!--
		<th width='150' rowspan='2'>연락처2</th>
		<th width='50' rowspan='2'>성별</th>
	-->
		<th width='100' rowspan='2'>신청일자</th>
		<th width='100' rowspan='2'>환불일자</th>
	<?
		$totDay = 0;
		foreach($monthArr as $k => $v){
			$dayList = $dayArr[$v];
			$dayEx = explode(',',$dayList);
			$dayCnt = count($dayEx);
			$totDay += $dayCnt;

			if(strlen($v) == 5)		$monthTxt = substr($v,4,1);
			else						$monthTxt = substr($v,4,2);

			echo ("<th colspan='$dayCnt' style=mso-number-format:'\@'>{$monthTxt}월</th>");
		}
	?>
	</tr>

	<tr>
	<?
		foreach($monthArr as $k => $v){
			$dayList = $dayArr[$v];
			$dayEx = explode(',',$dayList);

			for($i=0; $i<count($dayEx); $i++){
				$days = sprintf('%02d',$dayEx[$i]);
				echo "<th width='40' style=mso-number-format:'\@'>$days</th>";
			}
		}
	?>
	</tr>





<?
	//해당 프로그램 수강신청 정보
	$sql = "select c.*, m.phone01, m.phone02, m.sex from ks_userClass as c left join ks_userlist as m on c.userNum=m.userNum where c.programID='$uid' and (c.payMode!='' || c.payOk='결제확인') and (c.reTime=0 || c.reTime>$eTime01) order by c.name";
//	$sql = "select c.*, m.phone01, m.phone02, m.sex from ks_userClass as c left join ks_userlist as m on c.userNum=m.userNum where c.programID='$uid' and (c.payMode!='' || c.payOk='결제확인') order by c.name";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($p=0; $p<$num; $p++){
		$no = $p + 1;
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$phone01 = $row["phone01"];
		$phone02 = $row["phone02"];
		$sex = $row["sex"];
		$reDate = $row["reDate"];
		$reFund = $row["reFund"];
		$payOk = $row["payOk"];
		$getDate = $row["getDate"];

		if($reFund == '환불' || $reFund == '취소'){
			$nameTxt = "<strike>$name</strike>";
		}else{
			$nameTxt = $name;
			if($payOk == '입금대기')	$reDate = '입금대기';
			else								$reDate = '';
		}

		//이전 프로그램 수강자 표시
		$eq = '';
		if($pid){
			if(in_array($userid,$pArr))	$eq = "*";
		}
?>
	<tr align='center'>
		<td style=mso-number-format:'\@'><?=$no?></td>
		<td><?=$eq?><?=$nameTxt?></td>
	<!--
		<td><?=$userNum?></td>
	-->
		<td style=mso-number-format:'\@'><?=$phone01?></td>
	<!--
		<td style=mso-number-format:'\@'><?=$phone02?></td>
		<td><?=$sex?></td>
	-->
		<td style=mso-number-format:'\@'><?=$getDate?></td>
		<td style=mso-number-format:'\@'><?=$reDate?></td>
	<?
		foreach($monthArr as $k => $v){
			$dayList = $dayArr[$v];
			$dayEx = explode(',',$dayList);

			for($i=0; $i<count($dayEx); $i++){
				$days = sprintf('%02d',$dayEx[$i]);
				echo "<td width='40'></td>";
			}
		}
	?>

	</tr>

<?
	}
?>
</table>
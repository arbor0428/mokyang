<?
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";

	if($uid == ''){
		Msg::goMsg('접근오류','/');
		exit;
	}
?>
<html >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="euc-kr">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />

<title>은평문화재단</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/css/button.css">
</head>

<style type='text/css'>
.zTable th {
	height:30px !important;
	font-weight:normal  !important;
	font-size:12px !important;
}

.zTable td {
	height:30px !important;
	font-size:12px !important;
}

.pTable th {
	height:30px !important;
	font-weight:normal  !important;
}

.pTable td {
	height:30px !important;
}

.mCadeTit02{
	color:#317cc1;
	font-weight:bold;
	font-size:18px;
	margin-bottom:4px;
}

.eqc2{
	margin-top:-5px;
	margin-left:-5px;
	position:absolute;
	color:#ff0000;
}
</style>


<?
	if($_SERVER[REMOTE_ADDR] != '106.246.92.237'){		
?>
<script language='javascript'>
function printPage(){
	if(window.print){
		agree = confirm('현재 페이지를 출력하시겠습니까?');
		if (agree) window.print();
	}
}
</script>
<?
	}
?>

<body onload='printPage();'>

<?
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
?>

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>프로그램 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>연도</th>
			<td width='33%'><?=$year?></td>
			<th width='17%'>학기</th>
			<td width='33%'><?=$season?></td>
		</tr>

		<tr>
			<th>분류</th>
			<td><?=$cade01?></td>
			<th>기간</th>
			<td><?=$period?></td>
		</tr>

		<tr>
			<th>프로그램명</th>
			<td colspan='3'><?=$title?></td>
		</tr>

		<tr>
			<th>정원</th>
			<td colspan='3'><?=$maxNumTxt?></td>
		</tr>

		<tr>
			<th>교육기간</th>
			<td><?=$eDate01?> ~ <?=$eDate02?> (<?=$yoilListTxt?>)</td>
			<th>교육시간</th>
			<td><?=$sEduHour?>:<?=$sEduMin?> ~ <?=$eEduHour?>:<?=$eEduMin?></td>
		</tr>

		<tr>
			<th>이전 프로그램</th>
			<td colspan='3'><?=$pTitle?></td>
		</tr>
	</table>
</div>

<table cellpadding='0' cellspacing='0' border='0' style='margin:30px 0 3px 0;'>
	<tr>
		<td><div class='mCadeTit02'>수강자 명단</div></td>
	<?
		if($pid){
	?>
		<td style='padding:0 0 0 10px;font-size:12px;'>(<span style='color:#ff0000;'>*</span>표시는 이전 프로그램 수강자 입니다.)</td>
	<?
		}
	?>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' class='pTable'>
	<tr>
		<th width='50' rowspan='2'>번호</th>
		<th width='140' rowspan='2'>회원명</th>
	<!--
		<th width='180' rowspan='2'>회원번호</th>
	-->
		<th width='150' rowspan='2'>연락처</th>
	<!--
		<th width='150' rowspan='2'>연락처2</th>
		<th width='50' rowspan='2'>성별</th>
	-->
		<th width='150' rowspan='2'>신청일자</th>
		<th width='150' rowspan='2'>환불일자</th>
	<?
		$totDay = 0;
		foreach($monthArr as $k => $v){
			$dayList = $dayArr[$v];
			$dayEx = explode(',',$dayList);
			$dayCnt = count($dayEx);
			$totDay += $dayCnt;

			if(strlen($v) == 5)		$monthTxt = substr($v,4,1);
			else						$monthTxt = substr($v,4,2);

			echo ("<th colspan='$dayCnt'>{$monthTxt}월</th>");
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
				echo "<th width='40'>$days</th>";
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
			if(in_array($userid,$pArr))	$eq = "<div class='eqc2'>*</div>";
		}
?>
	<tr align='center'>
		<td><?=$no?></td>
		<td><?=$eq?><?=$nameTxt?></td>
	<!--
		<td><?=$userNum?></td>
	-->
		<td><?=$phone01?></td>
	<!--
		<td><?=$phone02?></td>
		<td><?=$sex?></td>
	-->
		<td><?=$getDate?></td>
		<td><?=$reDate?></td>
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


<?
	$TableWidth = 640 + (40 * $totDay);
?>

<script>
$(document).ready(function () {
	$('.pTable').width('<?=$TableWidth?>px');
});
</script>
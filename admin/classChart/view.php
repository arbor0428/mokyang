<?
if($type == 'view' && $uid){
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

}else{
	Msg::backMsg('접근오류');
	exit;
}
?>

<script language='javascript'>
function reg_list(uid){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function orderInfo(uid){
	document.getElementById("multiFrame").innerHTML = "<iframe src='orderInfo.php?uid="+uid+"' id='ifra_oinfo' name='ifra_oinfo' width='1020' height='700' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>

<?
	for($i=0; $i<count($f_prolist); $i++){
		$f_proID = $f_prolist[$i];
		echo ("<input type='hidden' name='f_prolist[]' value='$f_proID'>");
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
			<td><?=$eDate01?> ~ <?=$eDate02?></td>
			<th>요일</th>
			<td><?=$yoilListTxt?></td>
		</tr>

		<tr>
			<th>이전 프로그램</th>
			<td colspan='3'><?=$pTitle?></td>
		</tr>
	</table>


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
			<th width='50'>번호</th>
			<th width='150'>회원명</th>
			<th width='170'>회원번호</th>
			<th width='160'>연락처</th>
			<th width='50'>성별</th>
			<th width='150'>신청일자</th>
			<th width='150'>환불일자</th>
			<th width='120'>신청정보</th>
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

			$orderID = $row["uid"];
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
				if(in_array($userid,$pArr))	$eq = "<span style='color:#ff0000;'>*</span>";
			}
	?>
		<tr align='center'>
			<td><?=$no?></td>
			<td><?=$eq?><?=$nameTxt?></td>
			<td><?=$userNum?></td>
			<td><?=$phone01?></td>
			<td><?=$sex?></td>
			<td><?=$getDate?></td>
			<td><?=$reDate?></td>
			<td><a href="javascript:orderInfo('<?=$orderID?>');" class="small cbtn blue">보기</a></td>
		</tr>

	<?
		}
	?>
	</table>

	<div style="width:100px;text-align:center;margin:40px auto;"><a href="javascript:reg_list();" class="big cbtn black">목록보기</a></div>

</div>
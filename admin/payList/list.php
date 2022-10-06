<?
	if(!$f_year)	$f_year = date('Y');

	if(!$f_payDate01)	$f_payDate01 = date('Y-m-d');
	if(!$f_payDate02)	$f_payDate02 = date('Y-m-d');

	//쿼리조건
	$query_ment = " where c.payMode!='미납'";

	//검색기간
	$f_sArr = explode('-',$f_payDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_payDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);



	//수납일 또는 환불일 기준검색
//	$query_ment .= " and ((c.payTime>='$start_date' and c.payTime<='$end_date') or (c.reTime>='$start_date' and c.reTime<='$end_date'))";


	//미환불건은 수납일 기준
	$query_ment .= " and (((c.reFund='' or c.reFund='환불신청') and c.payTime>='$start_date' and c.payTime<='$end_date') or";

	//환불건은 환불일 기준
	$query_ment .= " ((c.reFund='환불' or c.reFund='취소') and c.reTime>='$start_date' and c.reTime<='$end_date'))";





	//회원자명
	if($f_name)		$query_ment .= " and c.name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and c.userNum like '%$f_userNum%'";

	//결제상태
	if($f_payMode)	$query_ment .= " and c.payMode='$f_payMode'";

	//연도
	if($f_year)		$query_ment .= " and c.year='$f_year'";

	//학기
	if($f_season)		$query_ment .= " and c.season='$f_season'";

	//분류
	if($f_cade01)		$query_ment .= " and c.cade01='$f_cade01'";

	//기간
	if($f_period)		$query_ment .= " and c.period='$f_period'";

	//프로그램
	$f_proCnt = count($f_prolist);
	if($f_proCnt){
		$proQuery = '';
		for($i=0; $i<$f_proCnt; $i++){
			$f_proID = $f_prolist[$i];
			if($proQuery)	$proQuery .= " or ";
			$proQuery .= "c.programID='$f_proID'";
		}
		$query_ment .= " and (".$proQuery.")";
	}


	//프로그램명 직접입력
	if($f_title)		$query_ment .= " and c.title like '%$f_title%'";

//	$query = "select c.*, p.mTarget from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment order by c.reTime desc, c.payTime desc";

	$query = "select c.*, p.mTarget from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment order by c.uid desc";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);
?>

<style type='text/css'>
.pTable td table td{border:0;margin:0;padding:0;}
</style>

<script language='javascript'>
function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excel.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<?
	include 'search.php';
?>

<?
	if($total_record){
?>
<div style='margin:10px 0;float:right;'>
	<a href="javascript:ifra_xls();" class="super cbtn green">엑셀변환</a>
</div>
<?
	}
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>회원명</th>
			<th>회원번호</th>
			<th>분류</th>
			<th>프로그램명</th>
			<th>결제방법</th>
			<th>수납금액</th>
			<th>수납일자</th>
			<th>카드사</th>
			<th>승인번호</th>
			<th>환불금액</th>
			<th>환불일자</th>
			<th>재결제금액</th>
			<th>카드사</th>
			<th>승인번호</th>
		</tr>
	</thead>

<?
$i = $total_record;
if($total_record){
	$payAmtTatal = 0;
	$reAmtTotal = 0;
	$newAmtTotal = 0;

	while($row = mysql_fetch_array($result)){
		$name = $row['name'];
		$userNum = $row['userNum'];
		$title = $row['title'];
		$payMode = $row['payMode'];
		$payAmt = $row['payAmt'];
		$payTime = $row['payTime'];
		$reFund = $row['reFund'];
		$reAmt = $row['reAmt'];
		$reDate = $row['reDate'];
		$reTime = $row['reTime'];
		$mTarget = $row['mTarget'];
		$cade01 = $row['cade01'];
		$cardName = $row['cardName'];
		$billNum = $row['billNum'];
		$package = $row["package"];
		$newAmt = $row["newAmt"];
		$newNum = $row["newNum"];
		$newCard = $row["newCard"];

		if($package)	$title = "<span class='packIco'>P</span> ".$title;

		$payAmtTxt = number_format($payAmt);

		$payDate = date('Y-m-d',$payTime);

		if($reFund == '환불' || $reFund == '취소'){
			//환불일자가 검색기간내 포함되는 경우에만 표시
			if($reTime >= $start_date && $reTime <= $end_date){
				$reAmtTxt = '-'.number_format($reAmt);
				if($newAmt)	$newAmtTxt = number_format($newAmt);
				else			$newAmtTxt = '';

			}else{
				$reAmt = 0;
				$reDate = '';
				$reAmtTxt = '';
				$newAmt = 0;
				$newAmtTxt = '';
				$newNum = '';
				$newCard = '';
			}


		}else{
			$reAmt = 0;
			$reDate = '';
			$reAmtTxt = '';
			$newAmt = 0;
			$newAmtTxt = '';
			$newNum = '';
			$newCard = '';
		}

		if($payMode == '단말기')			$payModeTxt = "<span class='ico02'>단말기</span>";
		elseif($payMode == '신용카드')	$payModeTxt = "<span class='ico04'>신용카드</span>";
		elseif($payMode == '가상계좌')	$payModeTxt = "<span class='ico06'>가상계좌</span>";
		elseif($payMode == '현금')		$payModeTxt = "<span class='ico10'>현금</span>";
		elseif($payMode == '계좌이체')	$payModeTxt = "<span class='ico12'>계좌이체</span>";
		else										$payModeTxt = '';

		if($reFund == '환불신청')			$payModeTxt .= "<p style='margin-top:5px;'><a href='../classOrder/up_index.php?f_reFund=환불신청'><span class='ico03'>환불신청</span></a></p>";


		//결제금액 0원
		if($payAmt == 0 && $payTime == 0){
			$payDate = date('Y-m-d',$row['rTime']);
			$reAmtTxt = '';
			$reDate = '';
		}
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?=$userNum?></td>
		<td><?=$cade01?></td>
		<td><?=$title?></td>
		<td><?=$payModeTxt?></td>
		<td><span style="color:#52809a;"><?=$payAmtTxt?></span></td>
		<td><?=$payDate?></td>
		<td><?=$cardName?></td>
		<td><?=$billNum?></td>
		<td><span style="color:#de712e;"><?=$reAmtTxt?></span></td>
		<td><?=$reDate?></td>
		<td><span style="color:#52809a;"><?=$newAmtTxt?></span></td>
		<td><?=$newCard?></td>
		<td><?=$newNum?></td>
	</tr>


<?
		$i--;
		$payAmtTatal += $payAmt;
		$reAmtTotal += $reAmt;
		$newAmtTotal += $newAmt;
	}

	$payAmtTatalTxt = number_format($payAmtTatal);
	$reAmtTotalTxt = number_format($reAmtTotal);
	if($reAmtTotalTxt > 0)	$reAmtTotalTxt = '-'.$reAmtTotalTxt;
	$newAmtTotalTxt = number_format($newAmtTotal);
?>

	<tr>
		<th>-</th>
		<th>-</th>
		<th>-</th>
		<th>-</th>
		<th>-</th>
		<th>-</td>
		<th><span style="color:#52809a;"><?=$payAmtTatalTxt?></span></td>
		<th>-</td>
		<th>-</td>
		<th>-</td>
		<th><span style="color:#de712e;"><?=$reAmtTotalTxt?></span></td>
		<th>-</td>
		<th><span style="color:#52809a;"><?=$newAmtTotalTxt?></span></td>
		<th>-</td>
		<th>-</td>
	</tr>

<?
}else{
?>
	<tr> 
		<td colspan="15" align='center' height='50'>등록된 수납내역이 없습니다</td>
	</tr>
<?
}
?>

</table>



</form>


<?
	include '../../module/TableFix.php';
?>
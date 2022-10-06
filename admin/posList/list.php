<?
	if(!$f_payDate01)	$f_payDate01 = date('Y-m-d');
	if(!$f_payDate02)	$f_payDate02 = date('Y-m-d');

	//쿼리조건(proccode=000050 은 현금영수증)
	$query_ment = " where proccode='000010'";

	//검색기간
	$f_sArr = explode('-',$f_payDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_payDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);



	//결제일 또는 취소일 기준검색
	$query_ment .= " and ((payTime>='$start_date' and payTime<='$end_date') or (reTime>='$start_date' and reTime<='$end_date'))";


	//카드번호
	if($f_cdno)		$query_ment .= " and cdno like '%$f_cdno%'";

	//승인번호
	if($f_authno)	$query_ment .= " and (authno like '%$f_authno%' or cancel_authno like '%$f_authno%')";



	$query = "select * from kcp_pos $query_ment order by payTime desc";

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
if($total_record > 0){
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
			<th>승인번호</th>
			<th>카드번호</th>
			<th>거래금액</th>
			<th>승인일자</th>
			<th>카드사</th>
			<th>KCP 거래번호</th>
			<th>취소금액</th>
			<th>취소일자</th>
		<!--
			<th>승인번호</th>
		-->
		</tr>
	</thead>

<?
$i = $total_record;
if($total_record){
	$payAmtTatal = 0;
	$reAmtTotal = 0;
	$newAmtTotal = 0;

	while($row = mysql_fetch_array($result)){
		$mtrsno = $row['mtrsno'];
		$cdno = $row['cdno'];
		$amt1 = $row['amt1'];
		$authdate = $row['authdate'];
		$hid = $row['hid'];
		$authno = $row['authno'];
		$authtime = $row['authtime'];

		$cancel_amt1 = $row['cancel_amt1'];
		$cancel_authdate = $row['cancel_authdate'];
		$cancel_authtime = $row['cancel_authtime'];
		$cancel_authno = $row['cancel_authno'];
		$reTime = $row['reTime'];

		$amt1Txt = number_format($amt1);
		$authdateTxt = substr($authdate,0,4).'-'.substr($authdate,4,2).'-'.substr($authdate,6,2).'<br>';
		$authdateTxt .= substr($authtime,0,2).':'.substr($authtime,2,2).':'.substr($authtime,4,2);
		$hidTxt = $cardArr[$hid];

		//취소관련
		if($cancel_amt1)	$cancel_amt1Txt = number_format($cancel_amt1);
		else					$cancel_amt1Txt = '';

		if($cancel_authdate){
			$cancel_authdateTxt = substr($cancel_authdate,0,4).'-'.substr($cancel_authdate,4,2).'-'.substr($cancel_authdate,6,2).'<br>';
			$cancel_authdateTxt .= substr($cancel_authtime,0,2).':'.substr($cancel_authtime,2,2).':'.substr($cancel_authtime,4,2);
		}else{
			$cancel_authdateTxt = '';
		}



		if($cancel_authno){
			//취소일자가 검색기간내 포함되는 경우에만 표시
			if($reTime >= $start_date && $reTime <= $end_date){
				$cancel_amt1Txt = '-'.number_format($cancel_amt1);

			}else{
				$cancel_amt1 = 0;
				$cancel_amt1Txt = '';
			}


		}else{
			$cancel_amt1 = 0;
			$cancel_amt1Txt = '';
		}

?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td><?=$i?></td>
		<td><?=$authno?></td>
		<td><?=$cdno?></td>
		<td><?=$amt1Txt?></td>
		<td><?=$authdateTxt?></td>
		<td><?=$hidTxt?></td>
		<td><?=$mtrsno?></td>
		<td><span style="color:#de712e;"><?=$cancel_amt1Txt?></span></td>
		<td><?=$cancel_authdateTxt?></td>
	<!--
		<td><?=$cancel_authno?></td>
	-->
	</tr>


<?
		$i--;
		$payAmtTatal += $amt1;
		$reAmtTotal += $cancel_amt1;
	}

	$payAmtTatalTxt = number_format($payAmtTatal);
	$reAmtTotalTxt = number_format($reAmtTotal);
	if($reAmtTotalTxt > 0)	$reAmtTotalTxt = '-'.$reAmtTotalTxt;
?>

	<tr>
		<th>-</td>
		<th>-</td>
		<th>-</td>
		<th><span style="color:#52809a;"><?=$payAmtTatalTxt?></span></td>
		<th>-</td>
		<th>-</td>
		<th>-</td>
		<th><span style="color:#de712e;"><?=$reAmtTotalTxt?></span></td>
		<th>-</td>
	<!--
		<th>-</td>
	-->
	</tr>

<?
}else{
?>
	<tr> 
		<td colspan="9" align='center' height='50'>등록된 결제내역이 없습니다</td>
	</tr>
<?
}
?>

</table>



</form>


<?
	include '../../module/TableFix.php';
?>
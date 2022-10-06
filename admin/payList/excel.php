<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';


	//쿼리조건
	$query_ment = " where c.payMode!='미납'";

	//검색기간
	$f_sArr = explode('-',$f_payDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_payDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);



	//수납일 또는 환불일 기준검색
	$query_ment .= " and ((c.payTime>='$start_date' and c.payTime<='$end_date') or (c.reTime>='$start_date' and c.reTime<='$end_date'))";

/*
	//미환불건은 수납일 기준
	$query_ment .= " and (((c.reFund='' or c.reFund='환불신청') and c.payTime>='$start_date' and c.payTime<='$end_date') or";

	//환불건은 환불일 기준
	$query_ment .= " ((c.reFund='환불' or c.reFund='취소') and c.reTime>='$start_date' and c.reTime<='$end_date'))";
*/




	//회원자명
	if($f_name)		$query_ment .= " and c.name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and c.userNum like '%$f_userNum%'";

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


//	$query = "select c.*, p.mTarget from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment order by c.reTime desc, c.payTime desc";

	$query = "select c.*, p.mTarget from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment order by c.uid desc";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);


	$file_name = '일별수납내역('.date('YmdHis').')';
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$file_name.xls"); 

?>






<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table cellpadding='0' cellspacing='0' border='1'>
	<tr align='center' height='30'>
		<th bgcolor='eeeeee'>번호</th>
		<th bgcolor='eeeeee'>회원명</th>
		<th bgcolor='eeeeee'>회원번호</th>
		<th bgcolor='eeeeee'>분류</th>
		<th bgcolor='eeeeee'>프로그램명</th>
		<th bgcolor='eeeeee'>결제방법</th>
		<th bgcolor='eeeeee'>수납금액</th>
		<th bgcolor='eeeeee'>수납일자</th>
		<th bgcolor='eeeeee'>카드사</th>
		<th bgcolor='eeeeee'>승인번호</th>
		<th bgcolor='eeeeee'>환불금액</th>
		<th bgcolor='eeeeee'>환불일자</th>
		<th bgcolor='eeeeee'>재결제금액</th>
		<th bgcolor='eeeeee'>카드사</th>
		<th bgcolor='eeeeee'>승인번호</th>
	</tr>



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

		if($reFund == '환불신청')		$payMode .= "<p style='margin-top:5px;'>환불신청</p>";
?>


	<tr align='center' height='30'>
		<td><?=$i?></td>
		<td><?=$name?></td>
		<td><?=$userNum?></td>
		<td><?=$cade01?></td>
		<td><?=$title?> <?if($package){echo "(패키지)";}?></td>
		<td><?=$payMode?></td>
		<td><span style="color:#52809a;"><?=$payAmtTxt?></span></td>
		<td style=mso-number-format:'\@'><?=$payDate?></td>
		<td><?=$cardName?></td>
		<td style=mso-number-format:'\@'><?=$billNum?></td>
		<td><span style="color:#de712e;"><?=$reAmtTxt?></span></td>
		<td style=mso-number-format:'\@'><?=$reDate?></td>
		<td><span style="color:#52809a;"><?=$newAmtTxt?></span></td>
		<td style=mso-number-format:'\@'><?=$newCard?></td>
		<td style=mso-number-format:'\@'><?=$newNum?></td>
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
}
?>

</table>
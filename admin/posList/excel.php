<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$cardArr = Array();
	$cardArr['CCBC'] = '비씨';
	$cardArr['CCKM'] = '국민';
	$cardArr['CCNH'] = '농협';
	$cardArr['CCSU'] = '수협';
	$cardArr['CCHM'] = '한미';
	$cardArr['CCPH'] = '평화';
	$cardArr['CCCT'] = '씨티';
	$cardArr['CCSG'] = '신세계';
	$cardArr['CCKE'] = '외환';
	$cardArr['CCCJ'] = '제주';
	$cardArr['CCHN'] = '하나';
	$cardArr['CCSS'] = '삼성';
	$cardArr['CCLG'] = '신한';
	$cardArr['CCKJ'] = '광주';
	$cardArr['CCJB'] = '전북';
	$cardArr['CJCF'] = '해외JCB';
	$cardArr['CCDI'] = '현대';
	$cardArr['CDIF'] = '해외다이너스';
	$cardArr['CCAM'] = '롯데';
	$cardArr['CAMF'] = '해외아멕스';
	$cardArr['CCLO'] = '롯데';
	$cardArr['CVSF'] = '해외비자';
	$cardArr['CMCF'] = '해외마스타';


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


	$file_name = '단말기 결제내역('.date('Ymd',$start_date).'_'.date('Ymd',$end_date).')';
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
		<th bgcolor='eeeeee'>승인번호</th>
		<th bgcolor='eeeeee'>카드번호</th>
		<th bgcolor='eeeeee'>거래금액</th>
		<th bgcolor='eeeeee'>승인일자</th>
		<th bgcolor='eeeeee'>카드사</th>
		<th bgcolor='eeeeee'>KCP 거래번호</th>
		<th bgcolor='eeeeee'>취소금액</th>
		<th bgcolor='eeeeee'>취소일자</th>
	</tr>



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
		$authdateTxt = substr($authdate,0,4).'-'.substr($authdate,4,2).'-'.substr($authdate,6,2).' ';
		$authdateTxt .= substr($authtime,0,2).':'.substr($authtime,2,2).':'.substr($authtime,4,2);
		$hidTxt = $cardArr[$hid];

		//취소관련
		if($cancel_amt1)	$cancel_amt1Txt = number_format($cancel_amt1);
		else					$cancel_amt1Txt = '';

		if($cancel_authdate){
			$cancel_authdateTxt = substr($cancel_authdate,0,4).'-'.substr($cancel_authdate,4,2).'-'.substr($cancel_authdate,6,2).' ';
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
		<td style=mso-number-format:'\@'><?=$authno?></td>
		<td style=mso-number-format:'\@'><?=$cdno?></td>
		<td style=mso-number-format:'\@'><?=$amt1Txt?></td>
		<td style=mso-number-format:'\@'><?=$authdateTxt?></td>
		<td><?=$hidTxt?></td>
		<td style=mso-number-format:'\@'><?=$mtrsno?></td>
		<td style=mso-number-format:'\@'><span style="color:#de712e;"><?=$cancel_amt1Txt?></span></td>
		<td style=mso-number-format:'\@'><?=$cancel_authdateTxt?></td>
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
}
?>

</table>
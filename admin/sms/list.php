<form name='frm_list' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>






<?
	include 'search.php';


	//문자사용 가능건수
	$msql = "select * from ks_user where userid='$SMS_ADMIN'";
	$mresult = mysql_query($msql);
	$mrow = mysql_fetch_array($mresult);
	$mTot = $mrow['point'];
	$mTotTxt = $mTot / 20;

	//문자전송내역 테이블명
	$table_name = 'SMS_SEND_REPORT_'.$f_year.$f_month;



//테이블 존재유무 확인
if(mysql_num_rows(mysql_query("SHOW TABLES LIKE '$table_name'"))==1){


	$record_count = 25;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where RESERVED1='$SMS_ADMIN'";

	//메세지검색
	if($f_msg)	 $query_ment .= " and SMS_MSG like '%$f_msg%'";

	//수신번호검색
	if($f_phone)	 $query_ment .= " and CALLEE_NO like '%$f_phone%'";

	$sort_ment = "order by SEND_TIME desc";

	$query = "select * from $table_name $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from $table_name $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);



}else{
	$total_record = 0;
}

?>


				
<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:50px;'>
	<tr>
		<td align='right' style='color:#52809a;'>사용가능건수 : <?=number_format($mTotTxt)?> 건</td>
	</tr>
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable1'>
				<tr>
					<th width="5%">번호</th>
					<th width="10%">상태</th>
					<th width="15%">수신번호</th>
					<th width="*">메세지</th>
					<th width="15%">발신일시</th>
				</tr>



<?

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$status = $row["RESULT"];
		$phone = $row["CALLEE_NO"];
		$msg = $row["SMS_MSG"];
		$sdate = $row["SEND_TIME"];

		$syear = substr($sdate,0,4);
		$smonth = substr($sdate,4,2);
		$sday = substr($sdate,6,2);
		$shour = substr($sdate,8,2);
		$smin = substr($sdate,10,2);

		if($status == 0)		$resultTxt = '대기';
		elseif($status == 2)	$resultTxt = "<font color='#52809a'>성공</font>";
		else						$resultTxt = "<font color='#de712e'>실패</font>";



?>
				<tr> 
					<td><?=$i?></td>
					<td><?=$resultTxt?></td>
					<td><?=$phone?></td>
					<td><?=$msg?></td>
					<td><?=$syear?>-<?=$smonth?>-<?=$sday?><br><?=$shour?>:<?=$smin?></td>
				</tr>

<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="5" align='center'>전송내역이 없습니다.</td>
				</tr>
<?
}
?>
			</table>									
		</td>
	</tr>
</table>



</form>



<?
	$fName = 'frm_list';
	include '../../module/pageNum.php';
?>


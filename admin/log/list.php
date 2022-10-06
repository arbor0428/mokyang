<form name='frm_list' method='post' action='<?=$PHP_SELF?>'>

<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>






<?
//	include 'search.php';
?>















<?

	$record_count = 25;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where reg_date > 0";


	

	//날짜검색
	if($f_sy){
		$start_date = mktime(0,0,0,$f_sm,$f_sd,$f_sy);
		$end_date = mktime(23,59,59,$f_em,$f_ed,$f_ey);

		$query_ment .= " and (reg_date>='$start_date' and reg_date<='$end_date')";
	}





	$sort_ment = "order by reg_date desc";

	$query = "select * from tb_visit_log $query_ment $sort_ment";



	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_visit_log $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>
				
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable1'>
	<tr>
		<th width="5%"><span class="smooth dp_ir">번호</span></th>
		<th width="75%"><span class="smooth dp_ir">접속경로</span></th>
		<th width="10%"><span class="smooth dp_ir">IP</span></th>
		<th width="10%"><span class="smooth dp_ir">접속일시</span></th>
	</tr>

<?

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];

		$refel = $row['refel'];

		$uip = $row['uip'];
		$reg_date=$row["reg_date"];
		$reg_dateTxt01 = date("Y-m-d",$reg_date);
		$reg_dateTxt02 = date("H:i:s",$reg_date);

		if($mobile)	$mobileTxt = "<br><font color='#de712e'>mobile</font>";
		else			$mobileTxt = '';



		
?>
	<tr height='30' align='center'>
		<td><?=$i?><?=$mobileTxt?></td>
		<td style="text-align:left;word-wrap:break-word;word-break:break-all;">
		<?
			if($refel){
				$refel_txt = iconv('utf-8','euc-kr',urldecode($refel));
		?>
			<a href="<?=$refel?>" target='_blank'><?=$refel_txt?></a>
		<?
			}else{
				echo "<span style='color:#ccc;'>직접입력 또는 즐겨찾기</span>";
			}
		?>
		</td>
		<td><?=$uip?></td>
		<td><?=$reg_dateTxt01?><br><?=$reg_dateTxt02?></td>
	</tr>

<?
		$line_num++;
		$i--;
	}
}else{
?>

	<tr>
		<td colspan="4" height='50' align='center'>접속내역이 없습니다.</td>
	</tr>

<?
}
?>
</table>


</form>


<?
	$fName = 'frm_list';
	include '../../module/pageNum.php';
?>

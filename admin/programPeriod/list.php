<?
	if(!$f_year)	$f_year = date('Y');

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where uid>0";

	//연도
	if($f_year)			$query_ment .= " and year='$f_year'";
	if($f_season)		$query_ment .= " and season='$f_season'";
	if($f_cade01)		$query_ment .= " and cade01='$f_cade01'";
	if($f_title)			$query_ment .= " and title='$f_title'";

	//접수기간(기존)
	if($f_aDate01){
		$f_sArr = explode('-',$f_aDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and aTime01>='$start_date'";
	}

	if($f_aDate02){
		$f_eArr = explode('-',$f_aDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and aTime02<='$end_date'";
	}

	//접수기간(신규)
	if($f_oDate01){
		$f_sArr = explode('-',$f_oDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and oTime01>='$start_date'";
	}

	if($f_oDate02){
		$f_eArr = explode('-',$f_oDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and oTime02<='$end_date'";
	}

	//교육기간
	if($f_eDate01){
		$f_sArr = explode('-',$f_eDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and getTime>='$start_date'";
	}

	if($f_eDate02){
		$f_eArr = explode('-',$f_eDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and getTime<='$end_date'";
	}

	//정렬방식
	$sort_ment = "order by uid desc";

	$query = "select * from ks_programPeriod $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_programPeriod $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script language='javascript'>
function cwrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = 'up_index.php';
	form.submit();
}

function cedit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = 'up_index.php';
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

<div style='margin:10px 0;'><a href="javascript:cwrite();" class="super cbtn blue">신규등록</a></div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>연도</th>
			<th>학기</th>
			<th>분류</th>
			<th>이름</th>
			<th>접수기간(기존)</th>
			<th>접수기간(신규)</th>
			<th>교육기간</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$title = $row["title"];
		$aDate01 = $row["aDate01"];
		$aDate02 = $row["aDate02"];
		$oDate01 = $row["oDate01"];
		$oDate02 = $row["oDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
?>

	<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="cedit('<?=$uid?>');">
		<td><?=$i?></td>
		<td><?=$year?></td>
		<td><?=$season?></td>
		<td><?=$cade01?></td>
		<td><?=$title?></td>
		<td><?=$aDate01?> ~ <?=$aDate02?></td>
		<td><?=$oDate01?> ~ <?=$oDate02?></td>
		<td><?=$eDate01?> ~ <?=$eDate02?></td>
	</tr>


<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan='8' align='center' height='50'>등록된 정보가 없습니다</td>
	</tr>
<?
}
?>

</table>



</form>


<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
	include '../../module/TableFix.php';
?>
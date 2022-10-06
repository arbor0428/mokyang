<?
	if(!$f_record)	$f_record = 100;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where uid>0";

	//종목명
	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";

	//강습반명
	if($f_title)	$query_ment .= " and title like '%$f_title%'";

	//강사명
	if($f_tutor)	$query_ment .= " and tutor like '%$f_tutor%'";


	//정렬방식
	$sort_ment = "order by uid";

	$query = "select * from zz_program $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from zz_program $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function programSave(uid){
	form = document.frm01;
	form.type.value = 'write';
	form.oldProgram.value = uid;
	form.record_start.value = '';

	form.target = '';
	form.action = '/admin/program/up_index.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='oldProgram' value=''>

<?
	include 'search.php';
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>종목명</th>
			<th>강습반명</th>
			<th>강사명</th>
			<th>강습요일</th>
			<th>시작시간</th>
			<th>종료시간</th>
			<th>정원</th>
			<th>강습대상</th>
			<th>수강료</th>
		<?
			if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
		?>
			<th>등록수</th>
			<th>-</th>
		<?
			}
		?>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$cade01 = $row["cade01"];
		$title = $row["title"];
		$tutor = $row["tutor"];
		$yoil = $row["yoil"];
		$sHour = $row["sHour"];
		$sMin = $row["sMin"];
		$eHour = $row["eHour"];
		$eMin = $row["eMin"];
		$maxNum = $row["maxNum"];
		$target = $row["target"];
		$amt = $row["amt"];
		$copyNum = $row["copyNum"];

		$amtTxt = number_format($amt);
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td><?=$i?></td>
		<td><?=$cade01?></td>
		<td><?=$title?></td>		
		<td><?=$tutor?></td>
		<td><?=$yoil?></td>
		<td><?=$sHour?>:<?=$sMin?></td>
		<td><?=$eHour?>:<?=$eMin?></td>
		<td><?=$maxNum?></td>
		<td><?=$target?></td>
		<td><?=$amtTxt?></td>
	<?
		if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	?>
		<td><?=$copyNum?></td>
		<td><a href="javascript:programSave('<?=$uid?>');" class="small cbtn green">프로그램등록</a></td>
	<?
		}
	?>
	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="12" align='center' height='50'>프로그램 정보가 없습니다</td>
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
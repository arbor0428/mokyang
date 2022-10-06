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
	if($f_year)		$query_ment .= " and year='$f_year'";
	if($f_season)	$query_ment .= " and season='$f_season'";

	if($f_cade01)		$query_ment .= " and cade01='$f_cade01'";
	if($f_period)		$query_ment .= " and period='$f_period'";

	//프로그램명
	if($f_title)		$query_ment .= " and title like '%$f_title%'";

	//정렬방식
	$sort_ment = "order by uid desc";

	$query = "select * from ks_program $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_program $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<style type='text/css'>
.pTable td table td{border:0;margin:0;padding:0;}
</style>

<script language='javascript'>
function cview(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
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


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>접수</th>
			<th>연도</th>
			<th>학기</th>
			<th>분류</th>
			<th>기간</th>
			<th>대상</th>
			<th>프로그램명</th>
			<th>강의실</th>
			<th>교육시간</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$online = $row['online'];
		$package = $row['package'];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$mTarget = $row["mTarget"];
		$mTargetEtc = $row["mTargetEtc"];
		$title = $row["title"];
		$fitnessType = $row["fitnessType"];
		$room = $row["room"];
		$yoilList = $row["yoilList"];

		if($online)	$onlineTxt = "<span class='ico01'>ON</span>";
		else			$onlineTxt = "<span class='ico06'>OFF</span>";

		if($season == '상시' && $cade01 == '휘트니스센터'){
			if($fitnessType == '1day')	$yoilList = '일일권';
			elseif($fitnessType == '1month')	$yoilList = '1개월권';
			elseif($fitnessType == '3month')	$yoilList = '3개월권';
			elseif($fitnessType == '6month')	$yoilList = '6개월권';

		}else{
			$yoilList = str_replace('1','월',$yoilList);
			$yoilList = str_replace('2','화',$yoilList);
			$yoilList = str_replace('3','수',$yoilList);
			$yoilList = str_replace('4','목',$yoilList);
			$yoilList = str_replace('5','금',$yoilList);
			$yoilList = str_replace('6','토',$yoilList);
		}
?>

	<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="cview('<?=$uid?>');">
		<td><?=$i?></td>
		<td><?=$onlineTxt?></td>
		<td><?=$year?></td>
		<td><?=$season?></td>
		<td><?=$cade01?></td>
		<td><?=$period?></td>
		<td>
		<?
			if($mTarget == $mTargetEtc)	echo $mTarget;
			else									echo $mTarget.'<br>'.$mTargetEtc;
		?>
		</td>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
				<?
					if($package){
				?>
					<td style='padding-right:5px;'>
						<div class="hp_q">P</div>
					</td>
				<?
					}
				?>
					<td><?=$title?></td>
				</tr>
			</table>
		</td>
		<td><?=$room?></td>
		<td><?=$yoilList?></td>
	</tr>


<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan='10' align='center' height='50'>등록된 정보가 없습니다</td>
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
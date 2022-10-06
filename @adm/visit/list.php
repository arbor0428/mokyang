<?
	if(!$f_rDate01)		$f_rDate01 = date("Y-m-d");
	if(!$f_rDate02)		$f_rDate02 = date("Y-m-d");

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));


	//쿼리조건
	$query_ment = "where userip!='106.246.92.237'";

	//접속기기
	if($f_UserOS)	$query_ment .= " and UserOS='$f_UserOS'";

	//접속주소
	if($f_nurl)		 $query_ment .= " and nurl like '%$f_nurl%'";
	
	//접속일
	$f_sArr = explode('-',$f_rDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_rDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
	$query_ment .= " and rTime>=$start_date and rTime<=$end_date";


	$sort_ment = "order by uid desc";

	$query = "select * from tb_visit_log $query_ment $pmQuery $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_visit_log $query_ment $pmQuery $sort_ment limit $record_start, $record_count";
//echo$query2.'/';
	$result = mysql_query($query2);
?>

<style>
.totBox{float:right;overflow:hidden;}
.totBox li{margin-bottom:10px;font-size:12px;}
</style>

<script>
function excel(){
	form = document.frm01;
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
	//검색
	include 'search.php';
?>

<section class='member_list'>

<li style='float:right;margin-bottom:5px;display:none;'><a href="javascript:excel();" class="super cbtn green">엑셀다운로드</a></li>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix' style=''>
	<thead>
		<tr>
			<th width='80'>번호</th>
			<th>검색어</th>
			<th>접속기기</th>
			<th>접속IP</th>
			<th>접속일시</th>
		</tr>
	</thead>


<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$refel = $row['refel'];
		$nurl = $row['nurl'];
		$UserOS = $row["UserOS"];
		$userip = $row["userip"];
		$rDate = $row["rDate"];

		if(!$refel)	$refel = '직접입력';

		if($UserOS == 'pc')	$UOS = "<span class=''>PC</span>";
		else						$UOS = "<span class=''>MOBILE</span>";
?>

	<tr align='center' class='<?=$lineClass?>'>
		<td data-th="번호"><?=$i?></td>
		<td data-th="접속주소" style="text-align:left;word-wrap:break-word;word-break:break-all;"><?=$refel?></td>
		<td data-th="접속기기"><?=$UOS?></td>
		<td data-th="접속IP"><?=$userip?></td>
		<td data-th="접속일시"><?=$rDate?></td>
	</tr>


<?
		$i--;
	}
}
?>
</table>

<?
if($total_record == 0){
?>
<div style='width:100%;padding:50px 0;text-align:center;border-radius:10px;color:#777;display:block;'>방문 정보가 없습니다.</div>
<?
}
?>

</section>

</form>

<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
//	include '../../module/TableFix.php';
?>

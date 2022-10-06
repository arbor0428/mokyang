<?
	if(!$f_pDate01)	$f_pDate01 = '2019-12-01';
	if(!$f_pDate02)	$f_pDate02 = '2019-12-31';

	if(!$f_record)	$f_record = 30;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//검색기간
	$f_sArr = explode('-',$f_pDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_pDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);

	//쿼리조건
	$query_ment = " where pTime>='$start_date' and pTime<='$end_date'";

	//회원번호
	if($f_userNum)	$query_ment .= " and userNum like '%$f_userNum%'";
	
	//회원자명
	if($f_name)	$query_ment .= " and name like '%$f_name%'";

	//연락처
	if($f_mobile)	$query_ment .= " and mobile like '%$f_mobile%'";

	//종목
	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";
	
	//강습반명
	if($f_title)	$query_ment .= " and title like '%$f_title%'";


	//정렬방식
	$sort_ment = "order by pTime desc, uid desc";

	$query = "select * from zz_classSale $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from zz_classSale $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function cedit(userNum){
	form = document.frm01;
	form.type.value = 'edit';
	form.userNum.value = userNum;
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function payList(userNum){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='1000' height='700' frameborder='0' scrolling='auto'></iframe>";

	form = document.frm01;
	
	form.userNum.value = userNum;
	form.record_start.value = 0;
	form.target = 'ifra_mlist';
	form.action = 'payList.php';
	form.submit();

	$(".multiBox_open").click();
}
</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='userNum' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<?
	include 'search.php';
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>매출일자</th>
			<th>회원번호</th>
			<th>회원자명</th>
			<th>연락처</th>
			<th>종목명</th>
			<th>중분류</th>
			<th>강습반명</th>
			<th>프로그램명</th>
			<th>할인내역</th>
			<th>할인금액</th>
			<th>판매금액</th>
			<th>-</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$pDate = $row["pDate"];
		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$className = $row["className"];
		$title = $row["title"];
		$saleType = $row["saleType"];
		$saleAmt = $row["saleAmt"];
		$amt = $row["amt"];

		$saleAmtTxt = number_format($saleAmt);
		$amtTxt = number_format($amt);
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td><?=$i?></td>
		<td><?=$pDate?></td>
		<td><?=$userNum?></td>		
		<td><?=$name?></td>
		<td><?=$mobile?></td>
		<td><?=$cade01?></td>
		<td><?=$cade02?></td>
		<td><?=$className?></td>
		<td><?=$title?></td>
		<td><?=$saleType?></td>
		<td><?=$saleAmtTxt?></td>
		<td><?=$amtTxt?></td>
		<td><a href="javascript:payList('<?=$userNum?>');" class="small cbtn black">감면내역</a></td>
	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="13" align='center' height='50'>감면 정보가 없습니다</td>
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
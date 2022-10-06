<?
	if(!$f_record)	$f_record = 30;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where mtype!='A'";

	//아이디
	if($f_userid)	$query_ment .= " and userid like '%$f_userid%'";

	//회원명
	if($f_name)	$query_ment .= " and name like '%$f_name%'";
	
	$sort_ment = "order by rTime desc";

	$query = "select * from tb_member $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_member $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script>
function cedit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}
</script>


<form name='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">

<?
	include 'search.php';
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th><span class="smooth dp_ir">번호</span></th>
			<th><span class="smooth dp_ir">등급</span></th>
			<th><span class="smooth dp_ir">아이디</span></th>
			<th><span class="smooth dp_ir">회원명</span></th>
			<th><span class="smooth dp_ir">성별</span></th>
			<th><span class="smooth dp_ir">이메일</span></th>
			<th><span class="smooth dp_ir">연락처</span></th>
			<th><span class="smooth dp_ir">가입일자</span></th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$mtype = $row["mtype"];
		$userid = $row["userid"];
		$name = $row["name"];
		$gender = $row["gender"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone = $row["phone"];
		$rDate = $row["rDate"];

		$level = '';

		if($mtype == 'M')			$level = "<span class='ico04'>일반</span>";
		elseif($mtype == 'C')		$level = "<span class='ico07'>실무자</span>";
		elseif($mtype == 'S')		$level = "<span class='ico02'>실무담당자</span>";

		$email = '';
		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}
?>

	<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" onclick="cedit('<?=$uid?>');">
		<td><span class="smooth dp_ir"><?=$i?></span></td>
		<td><span class="smooth dp_ir"><?=$level?></span></td>
		<td><span class="smooth dp_ir"><?=$userid?></span></td>
		<td><span class="smooth dp_ir"><?=$name?></span></td>
		<td><span class="smooth dp_ir"><?=$gender?></span></td>
		<td><span class="smooth dp_ir"><?=$email?></span></td>
		<td><span class="smooth dp_ir"><?=$phone?></span></td>
		<td><span class="smooth dp_ir"><?=$rDate?></span></td>
	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="7" align='center' height='50'>등록된 회원 정보가 없습니다</td>
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
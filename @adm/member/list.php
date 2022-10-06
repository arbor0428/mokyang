<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where mtype!='A'";

	//상태
	if($f_status == '1')		 $query_ment .= " and status='1'";
	elseif($f_status == '2')	 $query_ment .= " and status=''";

	//등급
	if($f_mtype)		 $query_ment .= " and mtype='$f_mtype'";

	//부관리자
	if($f_manager)	 $query_ment .= " and managerID='$f_manager'";

	//아이디
	if($f_userid)		 $query_ment .= " and userid like '%$f_userid%'";

	//성명
	if($f_name)		 $query_ment .= " and name like '%$f_name%'";

	//이메일
	if($f_email)		 $query_ment .= " and email like '%$f_email%'";

	//연락처
	if($f_mobile01)	 $query_ment .= " and phone01='$f_mobile01'";
	if($f_mobile02)	 $query_ment .= " and phone01 like '%$f_mobile02%'";
	if($f_mobile03)	 $query_ment .= " and phone01 like '%$f_mobile02%'";

	$sort_ment = "order by uid desc";

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

<script language='javascript'>
function cview(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
function check_form(){
	form = document.frm01;
	form.type.value = 'write';
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
	//검색
	include 'search.php';
?>


<a href='javascript:check_form();' class='small cbtn black'>등록</a>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th width='80'>번호</th>
			<th>상태</th>
			<th>등급</th>
			<th>아이디</th>
			<th>성명</th>
			<th>이메일</th>
			<th>연락처</th>
			<th>가입일시</th>
		</tr>
	</thead>


<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$mtype = $row["mtype"];
		$status = $row["status"];
		$userid = $row["userid"];
		$name = $row["name"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$bDate = $row["bDate"];
		$rDate = $row["rDate"];
		
		$email = '';
		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}

		//상태
		if($status=='1')	$statusTxt = "<span class='ico06'>승인</span>";
		else			$statusTxt = "<span class='ico09'>미승인</span>";

		//등급
		if($mtype=='M')	$mtypeTxt = "<span class='ico03'>일반회원</span>";
		else			$mtypeTxt = "<span class='ico06'>판매회원</span>";

?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;' onclick="cview('<?=$uid?>');">
		<td><?=$i?></td>
		<td><?=$statusTxt?></td>
		<td><?=$mtypeTxt?></td>
		<td><?=$userid?></td>
		<td><?=$name?></td>
		<td><?=$email?></td>
		<td><?=$phone01?></td>
		<td><?=$rDate?></td>
	</tr>


<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="10" align='center' style='height:100px;'>이용자 정보가 없습니다.</td>
	</tr>
<?
}
?>

</table>


</form>

<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
	//include '../../module/TableFix.php';
?>
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
	$query_ment = " where uid>0";

	//가입연도
	if($f_year)	$query_ment .= " and year='$f_year'";

	//아이디발급유무
	if($f_join == '1')		$query_ment .= " and userid!=''";
	elseif($f_join == '2')	$query_ment .= " and userid=''";

	//회원번호
	if($f_userNum)	$query_ment .= " and userNum like '%$f_userNum%'";
	
	//회원자명
	if($f_name)	$query_ment .= " and name like '%$f_name%'";

	//연락처
	if($f_mobile)	$query_ment .= " and mobile like '%$f_mobile%'";
	
	//주소
	if($f_addr01)	$query_ment .= " and addr01 like '%$f_addr01%'";


	//정렬방식
	$sort_ment = "order by uid desc";

	$query = "select * from zz_member $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from zz_member $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function cedit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function makeUserID(uid){
	form = document.frm01;
	form.type.value = 'write';
	form.uid.value = '';
	form.oldUser.value = uid;
	form.record_start.value = '';
	form.f_year.value = '';
	form.f_userNum.value = '';
	form.f_name.value = '';
	form.f_mobile.value = '';
	form.f_addr01.value = '';

	form.target = '';
	form.action = '/admin/userlist/up_index.php';
	form.submit();
}
</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='oldUser' value=''>

<?
	include 'search.php';
?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead style='z-index:9;'>
		<tr>
			<th>번호</th>
			<th>가입연도</th>
			<th>회원번호</th>
			<th>회원자명</th>
			<th>연락처</th>
			<th>이메일</th>
			<th>생년월일</th>
			<th>주소</th>
			<th>아이디</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$year = $row["year"];
		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$bDate = $row["bDate"];
		$addr01 = $row["addr01"];
		$userid = $row["userid"];

		$email = '';
		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td><?=$i?></td>
		<td><?=$year?></td>
		<td><?=$userNum?></td>
		<td><?=$name?></td>
		<td><?=$mobile?></td>
		<td><?=$email?></td>
		<td><?=$bDate?></td>
		<td><?=$addr01?></td>
		<td>
		<?
			if($userid){
				echo $userid;
			}else{
		?>
			<a href="javascript:makeUserID('<?=$uid?>');" class="small cbtn green" style='z-index:1;'>아이디 생성</a>
		<?
			}
		?>
		</td>
	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="9" align='center' height='50'>등록된 이용자 정보가 없습니다</td>
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
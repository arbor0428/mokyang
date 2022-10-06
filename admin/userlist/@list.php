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

	//회원자명
	if($f_name)	$query_ment .= " and name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and userNum like '%$f_userNum%'";

	//성별
	if($f_sex)		$query_ment .= " and sex='$f_sex'";

	//생년월일
	if($f_bDate01){
		$f_sArr = explode('-',$f_bDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and bTime>='$start_date'";
	}

	if($f_bDate02){
		$f_eArr = explode('-',$f_bDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and bTime<='$end_date'";
	}

	//가입상태
	if($f_status)		$query_ment .= " and status='$f_status'";

	//감면구분
	if($f_reduction == '일반' || $f_reduction == '감면대상자')	$query_ment .= " and userType='$f_reduction'";
	elseif($f_reduction)														$query_ment .= " and reduction='$f_reduction'";

	//차량번호
	if($f_carNum)	$query_ment .= " and carNum like '%$f_carNum%'";

	//연락처
	if($f_phone)	$query_ment .= " and (phone01 like '%$f_phone%' || phone02 like '%$f_phone%')";


	//정렬방식
	if($f_sort == 'nameUp')					$sort_ment = "order by name";
	elseif($f_sort == 'nameDown')			$sort_ment = "order by name desc";
	elseif($f_sort == 'userNumUp')		$sort_ment = "order by userNum";
	elseif($f_sort == 'userNumDown')		$sort_ment = "order by userNum desc";
	else											$sort_ment = "order by getTime desc";

	$query = "select * from ks_userlist $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_userlist $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function cwrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function cedit(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function ifra_xls(){
	form = document.frm01;
	form.type.value = '';
	form.target = '';
	form.action = 'excel.php';
	form.submit();
}

function statusChk(uid){
	$.post('json_status.php',{'uid':uid}, function(c){
		if(c == '1')	$('#on'+uid).html("<span class='ico04'>승인</span>");
		else			$('#on'+uid).html("<span class='ico07'>미승인</span>");
	});
}

function classList(userid){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='900' height='700' frameborder='0' scrolling='auto'></iframe>";

	form = document.FRM;
	
	form.userid.value = userid;

	form.target = 'ifra_mlist';
	form.action = '../classOrder/classList.php';
	form.submit();

	$(".multiBox_open").click();
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='userid' value=''>
</form>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<?
	include 'search.php';
?>

<div style='margin:10px 0;float:left;'>
	<a href="javascript:cwrite();" class="super cbtn blue">신규회원등록</a>
</div>
<?
	if($total_record){
?>
<div style='margin:10px 0;float:right;'>
	<a href="javascript:ifra_xls();" class="super cbtn green">엑셀변환</a>
</div>
<?
	}
?>



<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>가입상태</th>
			<th>회원자명</th>
			<th>회원번호</th>
			<th>성별</th>
			<th>생년월일</th>
			<th>회원구분</th>
			<th>이메일</th>
			<th>연락처</th>
			<th>가입일자</th>
			<th>정보수정일</th>
			<th>수강내역</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$status = $row["status"];
		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$getDate = $row["getDate"];
		$editTime = $row["editTime"];

		if($status == '1')			$statusTxt = "<span class='ico04'>승인</span>";
		elseif($status == '2')		$statusTxt = "<span class='ico07'>미승인</span>";

		$email = '';
		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}

		if($editTime)	$editDate = date('Y-m-d',$editTime);
		else				$editDate = '';

		//수강내역
		$osql = "select count(*) from ks_userClass where userid='$userid'";
		$oresult = mysql_query($osql);
		$onum = mysql_result($oresult,0,0);
?>

	<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td onclick="cedit('<?=$uid?>');"><?=$i?></td>
		<td onclick="statusChk('<?=$uid?>');" id='on<?=$uid?>'><?=$statusTxt?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$name?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$userNum?></td>		
		<td onclick="cedit('<?=$uid?>');"><?=$sex?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$bDate?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$userType?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$email?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$phone01?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$getDate?></td>
		<td onclick="cedit('<?=$uid?>');"><?=$editDate?></td>
		<td>
		<?if($onum){?>
			<a href="javascript:classList('<?=$userid?>');" class="small cbtn black">수강내역</a>
		<?}else{?>
			 -
		<?}?>
		</td>
	</tr>

<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="11" align='center' height='50'>등록된 이용자 정보가 없습니다</td>
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
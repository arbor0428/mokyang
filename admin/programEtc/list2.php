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
	$query_ment = " where c.etcID!=''";

	//회원자명
	if($f_name)		$query_ment .= " and c.name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and c.userNum like '%$f_userNum%'";

	//연도
	if($f_year)		$query_ment .= " and p.year='$f_year'";

	//학기
	if($f_season)		$query_ment .= " and p.season='$f_season'";

	//분류
	if($f_cade01)		$query_ment .= " and p.cade01='$f_cade01'";

	//기간
	if($f_period)		$query_ment .= " and p.period='$f_period'";

	//프로그램
	$f_proCnt = count($f_prolist);
	if($f_proCnt){
		$proQuery = '';
		for($i=0; $i<$f_proCnt; $i++){
			$f_proID = $f_prolist[$i];
			if($proQuery)	$proQuery .= " or ";
			$proQuery .= "programID='$f_proID'";
		}
		$query_ment .= " and (".$proQuery.")";
	}

	//프로그램명 직접입력
	if($f_title)		$query_ment .= " and p.title like '%$f_title%'";

	//정렬방식
	$sort_ment = "order by c.uid desc";

	$query = "select c.uid as cid, c.userid, c.name,c.userNum, c.etcAmt, p.* from ks_cartList as c left join ks_program as p on c.programID=p.uid $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select c.uid as cid, c.userid, c.name,c.userNum, c.etcAmt, p.* from ks_cartList as c left join ks_program as p on c.programID=p.uid $query_ment $sort_ment limit $record_start, $record_count";

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

function smsPhone(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		GblMsgBox('문자를 발송할 회원을 선택해 주십시오.','');
		return;
	}

	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_slist' class='bgtp' name='ifra_slist' width='260' height='530' frameborder='0' scrolling='auto'></iframe>";

	form = document.frm01;

	form.target = 'ifra_slist';
	form.action = '/module/smsPhone.php';
	form.submit();

	$(".multiBox_open").click();

	$('.bgtp').parents('.popup_background').css({'background':'transparent'})
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

<div style='margin:10px 0;'>
	<a href="javascript:cwrite();" class="super cbtn blue">신규등록</a>
	<a href="javascript:smsPhone();" class="super cbtn blood">문자보내기</a>
</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>
				<div class="sChkBox">
					<input type="checkbox" value="" id="sL0" name="all_chk" onclick="All_chk('all_chk','chk[]');">
					<label for="sL0"></label>
				</div>
			</th>
			<th>번호</th>
			<th>회원자명</th>
			<th>회원번호</th>
			<th>연도</th>
			<th>학기</th>
			<th>분류</th>
			<th>기간</th>
			<th>프로그램명</th>
			<th>수강료</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$cid = $row["cid"];
		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$period = $row["period"];
		$title = $row["title"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$getDate = $row["getDate"];
		$etcAmt = $row["etcAmt"];

		//기간
		$periodTxt = str_replace('프로그램','',$period);


		if($season == '상시' && $cade01 == '휘트니스센터'){
			$periodDate = $fitnessDate01.' ~ '.$fitnessDate02;
		}else{
			$periodDate = $eDate01.' ~ '.$eDate02;
		}

		$etcAmtTxt = number_format($etcAmt).'원';

		$javaLink = "cedit('$cid');";

		if($userid){
			$usql = "select * from ks_userlist where userid='$userid'";
			$uresult = mysql_query($usql);
			$urow = mysql_fetch_array($uresult);

			$phone = $urow["phone01"];
		}
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;'>
		<td style='padding:0 5px !important;cursor:default;'>
			<div class="sChkBox">
				<input type="checkbox" value="<?=$phone?>" id="sL<?=$i?>" name="chk[]">
				<label for="sL<?=$i?>"></label>
			</div>
		</td>
		<td onclick="<?=$javaLink?>"><?=$i?></td>
		<td onclick="<?=$javaLink?>"><?=$name?></td>
		<td onclick="<?=$javaLink?>"><?=$userNum?></td>		
		<td onclick="<?=$javaLink?>"><?=$year?></td>
		<td onclick="<?=$javaLink?>"><?=$season?></td>
		<td onclick="<?=$javaLink?>" style='line-height:20px;'><?=$cade01?><br><?=$cade02?></td>
		<td onclick="<?=$javaLink?>"><?=$periodTxt?></td>
		<td onclick="<?=$javaLink?>"><?=$title?></td>
		<td onclick="<?=$javaLink?>"><?=$etcAmtTxt?></td>
	</tr>


<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="10" align='center' height='50'>등록된 개별 프로그램 정보가 없습니다</td>
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
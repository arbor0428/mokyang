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
	$query_ment = " where c.uid>0";

	if($GBL_MTYPE == 'P1' || $GBL_MTYPE == 'P2')	$query_ment .= " and p.tutorID='$GBL_USERID'";

	$searchQuery = '';

	//연도
	if($f_year)		$searchQuery .= " and c.year='$f_year'";

	//학기
	if($f_season)		$searchQuery .= " and c.season='$f_season'";

	//분류
	if($f_cade01)		$searchQuery .= " and c.cade01='$f_cade01'";

	//기간
	if($f_period)		$searchQuery .= " and c.period='$f_period'";

	//프로그램
	$f_proCnt = count($f_prolist);
	if($f_proCnt){
		$proQuery = '';
		for($i=0; $i<$f_proCnt; $i++){
			$f_proID = $f_prolist[$i];
			if($proQuery)	$proQuery .= " or ";
			$proQuery .= "programID='$f_proID'";
		}
		$searchQuery .= " and (".$proQuery.")";
	}

	//프로그램명 직접입력
	if($f_title)		$searchQuery .= " and c.title like '%$f_title%'";

	if($searchQuery == '')	$query_ment = "where c.uid=0";		//검색전에는 리스트를 불러올 필요가 없다.
	else							$query_ment .= $searchQuery;

	//정렬방식
	$sort_ment = "order by p.uid desc";

	//납부회원수
//	$cnt01 = "count(if(c.payMode='단말기' || c.payMode='신용카드' || c.payMode='현금' || c.payMode='계좌이체' || c.payAmt=0 || c.payOk='결제확인', c.payMode, null)) as cnt01";
	$cnt01 = "count(if((c.payMode!='' || c.payOk='결제확인') and (c.reFund='' || c.reFund='환불신청'), c.payMode, null)) as cnt01";

	//환불회원수
	$cnt02 = "count(if(c.reFund='환불' || c.reFund='취소', c.payMode, null)) as cnt02";

	$query = "select c.*, count(*) as tot, $cnt01, $cnt02, p.uid as pid, p.maxNum from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment group by c.programID";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select c.*, count(*) as tot, $cnt01, $cnt02, p.uid as pid, p.maxNum from ks_userClass as c left join ks_program as p on c.programID=p.uid $query_ment group by c.programID $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<script language='javascript'>
function ifra_xls(uid){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = '';
	form.target = '';
	form.action = 'excel.php';
	form.submit();
}

function student(uid){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = 'view';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function chart(uid){
	form = document.frm01;
	form.uid.value = uid;
	form.type.value = 'chart';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function smsPhone(){
    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		GblMsgBox('문자를 발송할 프로그램을 선택해 주십시오.','');
		return;
	}

	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_slist' class='bgtp' name='ifra_slist' width='260' height='530' frameborder='0' scrolling='auto'></iframe>";

	form = document.frm01;

	form.target = 'ifra_slist';
	form.action = '/module/smsClass.php';
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
<input type='hidden' name='smsID' value='<?=$GBL_USERID?>'>

<?
	include 'search.php';
?>

<!--
<div style='margin:10px 0;'>
	<a href="javascript:smsPhone();" class="super cbtn blood">문자보내기</a>
</div>
-->

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
			<th>연도</th>
			<th>학기</th>
			<th>분류</th>
			<th>기간</th>
			<th>프로그램명</th>
			<th>정원</th>
			<th>신청자 수</th>
			<th>납부<br>회원 수</th>
			<th>환불/취소<br>회원 수</th>
			<th>출석부</th>
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$pid = $row["pid"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$title = $row["title"];
		$maxNum = $row['maxNum'];
		$tot = $row['tot'];
		$cnt01 = $row['cnt01'];
		$cnt02 = $row['cnt02'];

		//기간
		$periodTxt = str_replace('프로그램','',$period);

		if($maxNum)	$maxNumTxt = number_format($maxNum);
		else				$maxNumTxt = '-';

		$totTxt = number_format($tot);
		$cnt01Txt = number_format($cnt01);
		$cnt02Txt = number_format($cnt02);

?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
		<td style='padding:0 5px !important;cursor:default;'>
			<div class="sChkBox">
				<input type="checkbox" value="<?=$pid?>" id="sL<?=$pid?>" name="chk[]">
				<label for="sL<?=$pid?>"></label>
			</div>
		</td>
		<td><?=$i?></td>
		<td><?=$year?></td>
		<td><?=$season?></td>
		<td><?=$cade01?></td>
		<td><?=$periodTxt?></td>
		<td><?=$title?></td>
		<td><?=$maxNumTxt?></td>
		<td><?=$totTxt?></td>
		<td><?=$cnt01Txt?></td>
		<td><?=$cnt02Txt?></td>
		<td>
			<a href="javascript://" onclick="window.open('print.php?uid=<?=$pid?>','ieprint','width=1020,height=900,scrollbars=yes','_blank')" class="small cbtn blue">출력</a>
			<a href="javascript:ifra_xls('<?=$pid?>');" class="small cbtn green">엑셀</a>
			<a href="javascript:student('<?=$pid?>');" class="small cbtn black">수강자</a>
		<!--
			<a href="javascript:chart('<?=$pid?>');" class="small cbtn blood">통계</a>
		-->
		</td>
	</tr>


<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="12" align='center' height='50'>등록된 수강신청 정보가 없습니다</td>
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
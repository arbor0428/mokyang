<?
	if(!$f_year)	$f_year = '2018';

	if(!$f_record)	$f_record = 30;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where c.uid>0";

	$searchQuery = '';

	//회원자명
	if($f_name)		$searchQuery .= " and c.name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$searchQuery .= " and c.userNum like '%$f_userNum%'";

	//결제상태
	if($f_payMode)	$searchQuery .= " and c.payMode='$f_payMode'";

	//환불/취소
	if($f_reFund)	$searchQuery .= " and c.reFund='$f_reFund'";

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
			$proQuery .= "c.programID='$f_proID'";
		}
		$searchQuery .= " and (".$proQuery.")";
	}

	//프로그램명 직접입력
	if($f_title)		$searchQuery .= " and c.title like '%$f_title%'";
	
	//패키지 프로그램
	if($f_package)	$searchQuery .= " and c.package!=''";

	//정렬방식
	if($f_reFund == '환불신청')	$sort_ment = "order by c.reTime desc";
	else									$sort_ment = "order by c.uid desc";

	if($searchQuery == '')	$query_ment = "where c.uid=0";		//검색전에는 리스트를 불러올 필요가 없다.
	else							$query_ment .= $searchQuery;

	$query = "select c.*, m.phone01 as phone from ks_userClass as c left join ks_userlist as m on c.userid=m.userid $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select c.*, m.phone01 as phone from ks_userClass as c left join ks_userlist as m on c.userid=m.userid $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);


?>

<style type='text/css'>
.pTable td table td{border:0;margin:0;padding:0;}
</style>

<script language='javascript'>
function cwrite(){
	form = document.frm01;
	form.type.value = 'write';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function cview(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
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
<input type='hidden' name='smsID' value='<?=$GBL_USERID?>'>


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
		<!--
			<th>학기</th>
		-->
			<th>분류</th>
			<th>기간</th>
			<th>프로그램명</th>
		<!--
			<th>교육기간</th>
		-->
			<th>결제금액</th>
			<th>결제수단</th>
			<th>신청일</th>
			<th>이용일</th>
		<!--
			<th>환불/취소</th>
		-->
		</tr>
	</thead>

<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$period = $row["period"];
		$title = $row["title"];
		$phone = $row["phone"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$getDate = $row["getDate"];
		$payMode = $row["payMode"];
		$payAmt = $row["payAmt"];
		$reFund = $row["reFund"];
		$package = $row["package"];
		$payOk = $row["payOk"];
		$multiChk = $row["multiChk"];

		if($package)	$title = "<span class='packIco'>P</span> ".$title;

		//기간
		$periodTxt = str_replace('프로그램','',$period);

		$payAmtTxt = number_format($payAmt);

		$periodDate = '';

		if($season == '상시' && $cade01 == '휘트니스센터'){
			$periodDate = $fitnessDate01.' ~ '.$fitnessDate02;
		}

		if($payMode == '단말기')			$payModeTxt = "<span class='ico02'>단말기</span>";
		elseif($payMode == '신용카드')	$payModeTxt = "<span class='ico04'>신용카드</span>";
		elseif($payMode == '가상계좌')	$payModeTxt = "<span class='ico06'>가상계좌</span>";
		elseif($payMode == '현금')		$payModeTxt = "<span class='ico10'>현금</span>";
		elseif($payMode == '계좌이체')	$payModeTxt = "<span class='ico12'>계좌이체</span>";
		else										$payModeTxt = '';

		if($payMode == '가상계좌' && $payOk == '입금대기'){
			$payModeTxt .= "<br>(입금대기)";
		}

		if($reFund){
			if($payModeTxt)	$payModeTxt .= '<br>';

			if($reFund == '환불')				$payModeTxt .= "<span class='ico09'>환불</span>";
			elseif($reFund == '취소')		$payModeTxt .= "<span class='ico07'>취소</span>";
			elseif($reFund == '환불신청')	$payModeTxt .= "<span class='ico03'>환불신청</span>";

			$getDate = "<strike>".$getDate."</strike><br>".date('Y-m-d',$row['reTime']);

			$javaLink = "cview('$uid');";
		}else{
			$javaLink = "cedit('$uid');";
		}

		//장바구니를 통해 동시에 신청한 강좌표시
		if($multiChk)	$mChk = "style='background:url(/img/top_br3.png) no-repeat left top;background-size:25px 18px;'";
		else				$mChk = '';
?>

	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;'>
		<td style='padding:0 5px !important;cursor:default;'>
			<div class="sChkBox">
				<input type="checkbox" value="<?=$phone?>" id="sL<?=$uid?>" name="chk[]">
				<label for="sL<?=$uid?>"></label>
			</div>
		</td>
		<td onclick="<?=$javaLink?>"><?=$i?></td>
		<td onclick="<?=$javaLink?>"><?=$name?></td>
		<td onclick="<?=$javaLink?>"><?=$userNum?></td>		
		<td onclick="<?=$javaLink?>"><?=$year?></td>
	<!--
		<td><?=$season?></td>
	-->
		<td onclick="<?=$javaLink?>" style='line-height:20px;'><?=$cade01?><br><?=$cade02?></td>
		<td onclick="<?=$javaLink?>"><?=$periodTxt?></td>
		<td onclick="<?=$javaLink?>"><?=$title?></td>
	<!--
		<td><?=$periodDate?></td>
	-->
		<td onclick="<?=$javaLink?>" <?=$mChk?>><?=$payAmtTxt?></td>
		<td onclick="<?=$javaLink?>" style='line-height:25px;'><?=$payModeTxt?></td>
		<td onclick="<?=$javaLink?>"><?=$getDate?></td>
		<td onclick="<?=$javaLink?>"><?=$periodDate?></td>
	<!--
		<td width='125'>
			<a href="javascript:cview('<?=$uid?>');" class='small cbtn green'>환불/취소</a>
		<?
			if($reFund == ''){
		?>
			<a href="javascript:cedit('<?=$uid?>');" class='small cbtn blue'>정보수정</a>
		<?
			}
		?>
		</td>
	-->
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
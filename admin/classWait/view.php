<?
	if($type=='view' && $uid){
		//대기접수정보
		$sql = "select * from ks_waitList where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$programID = $row["programID"];

		//프로그램정보
		$sql = "select * from ks_program where uid='$programID'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$cDate01 = $row["cDate01"];
		$title = $row["title"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$programAmt = $row["amt"];
		$mTarget = $row["mTarget"];
		$reduction = $row["reduction"];
		$health = $row["health"];
		$getDate = $row["getDate"];
		$breakDate01 = $row["breakDate01"];
		$breakDate02 = $row["breakDate02"];


		$eDate = $eDate01.' ~ '.$eDate02;

		$programAmtTxt = number_format($programAmt).' 원';


		//회원정보
		$sql = "select * from ks_userlist where name='$name' and userNum='$userNum'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$sex = $row['sex'];
		$bDate = $row['bDate'];
		$userType = $row['userType'];
		$carNum = $row['carNum'];
		$zipcode = $row['zipcode'];
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$email01 = $row['email01'];
		$email02 = $row['email02'];
		$phone01 = $row['phone01'];
		$phone01Txt = $row['phone01Txt'];
		$phone02 = $row['phone02'];
		$phone02Txt = $row['phone02Txt'];

		$addr = '['.$zipcode.'] '.$addr01.' '.$addr02;

		$email = $email01.'@'.$email02;

		if($phone01)	$phone01Str = $phone01;
		if($phone01Txt){
			if($phone01Str) $phone01Str .= ' ';
			$phone01Str .= '('.$phone01Txt.')';
		}

		if($phone02)	$phone02Str = $phone02;
		if($phone02Txt){
			if($phone02Str) $phone02Str .= ' ';
			$phone02Str .= '('.$phone02Txt.')';
		}
	}
?>

<script language='javascript'>
function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.FRM;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<input type='hidden' name='chkUserName' value=''>
<input type='hidden' name='chkUserNum' value=''>


<input type='hidden' name='userid' id='userid' value='<?=$userid?>'>
<input type='hidden' name='userNum' id='userNum' value='<?=$userNum?>'>
<input type='hidden' name='reduction' id='reduction' value='<?=$reduction?>'>
<input type='hidden' name='health' id='health' value='<?=$health?>'>
<input type='hidden' name='eDate' id='eDate' value='<?=$eDate?>'>
<input type='hidden' name='cDate01' id='cDate01' value='<?=$cDate01?>'>
<input type='hidden' name='mTarget' id='mTarget' value='<?=$mTarget?>'>
<input type='hidden' name='programAmt' id='programAmt' value='<?=$programAmt?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<?
	for($i=0; $i<count($f_prolist); $i++){
		$f_proID = $f_prolist[$i];
		echo ("<input type='hidden' name='f_prolist[]' value='$f_proID'>");
	}
?>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>이용자 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'><span class='eq'></span> >회원자명</th>
			<td width='33%'><?=$name?></td>
			<th width='17%'><span class='eq'></span> >회원번호</th>
			<td width='33%'><span id="userNumTxt"><?=$userNum?></span></td>
		</tr>

		<tr>
			<th>성별</th>
			<td><span id='sexTxt'><?=$sex?></span></td>
			<th>생년월일</th>
			<td><span id="bDateTxt"><?=$bDate?></span></td>
		</tr>

		<tr>
			<th>회원구분</th>
			<td><span id="userTypeTxt"><?=$userType?></span></td>
			<th>주차권 발급</th>
			<td><span id="carNumTxt"><?=$carNum?></span></td>
		</tr>

		<tr>
			<th>주소</th>
			<td colspan='3'><span id="addrTxt"><?=$addr?></span></td>
		</tr>

		<tr>
			<th>이메일</th>
			<td colspan='3'><span id="emailTxt"><?=$email?></span></td>
		</tr>

		<tr>
			<th>연락처1</th>
			<td><span id="phone01Txt"><?=$phone01Str?></span></td>
			<th>연락처2</th>
			<td><span id="phone02Txt"><?=$phone02Str?></span></td>
		</tr>

		<tr>
			<th>감면구분</th>
			<td colspan='3'><span id="reductionTxt"><?=$reduction?></span></td>
		</tr>

		<tr>
			<th>질병 및 건강상태</th>
			<td colspan='3'><span id="healthTxt"><?=$health?></span></td>
		</tr>
	</table>





	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수강신청 프로그램</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><span class='eq'></span> >연도</th>
			<td colspan='3'><?=$year?></td>
		</tr>

		<tr>
			<th width='17%'><span class='eq'></span> >학기</th>
			<td width='33%'><?=$season?></td>
			<th width='17%'><span class='eq'></span> >분류</th>
			<td width='33%'><?=$cade01?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >기간</th>
			<td colspan='3'><?=$period?></td>
		</tr>

		<tr id='periodTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th>교육기간</th>
			<td><span id='eDateTxt'><?=$eDate?></span></td>
			<th>환불 불가일</th>
			<td><span id='cDateTxt'><?=$cDate01?></span></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >프로그램명</th>
			<td colspan='3'><?=$title?></td>
		</tr>


		<tr>
			<th>대상</th>
			<td><span id='mTargetTxt'><?=$mTarget?></span></td>
			<th>금액</th>
			<td><span id='programAmtTxt'><?=$programAmtTxt?></span></td>
		</tr>
	</table>




	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>삭제</a></td>
		</tr>
	</table>
</div>






</form>
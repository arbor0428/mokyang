<?
	//휘트니스 프로그램용 필드
	$fitnessChk = false;

	if($type=='edit' && $uid){
		//장바구니정보
		$sql = "select * from ks_cartList where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$programID = $row["programID"];
		$etcMsg = $row["etcMsg"];
		$etcAmt = $row["etcAmt"];
		$saleChk = $row['saleChk'];
		$saleAmt = $row['saleAmt'];
		if($etcMsg)	$etcMsg = Util::textareaDecodeing($etcMsg);

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
//		$programAmt = $row["amt"];
		$mTarget = $row["mTarget"];
		$health = $row["health"];
		$getDate = $row["getDate"];
		$breakDate01 = $row["breakDate01"];
		$breakDate02 = $row["breakDate02"];


		$eDate = $eDate01.' ~ '.$eDate02;


		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;


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
		$reduction = $row["reduction"];

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

	}else{
		$year = date('Y');
		$month = date('n');

		if(!$season){
			if($month == 3 || $month == 4 || $month == 5)				$season = '봄';
			elseif($month == 6 || $month == 7 || $month == 8)		$season = '여름';
			elseif($month == 9 || $month == 10 || $month == 11)	$season = '가을';
			elseif($month == 12 || $month == 1 || $month == 2)		$season = '겨울';
		}

		$fitnessDate01 = date('Y-m-d');

		$getDate = date('Y-m-d');
	}

	include 'script.php';
?>

<script language='javascript'>
function billNameChk(billName){
	uid = '<?=$uid?>';
	$.post('json_billName.php',{'uid':uid,'billName':billName}, function(){
	});
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
<input type='hidden' name='saleAmt' id='saleAmt' value='<?=$saleAmt?>'>

<!-- 검색관련 -->
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
			<td width='33%'><input name="name" id="name" style="width:140px;" type="text" value="<?=$name?>" readonly onclick="userSearch();"> <a href="javascript:userSearch();" class="super cbtn black">검색</a></td>
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
			<td colspan='3'>
				<select name='year' id='year' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
				<?
					for($i=date('Y')+1; $i>=2017; $i--){
						if($i == $year)	$chk = 'selected';
						else				$chk = '';

						echo ("<option value='$i' $chk>$i</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th width='17%'><span class='eq'></span> >학기</th>
			<td width='33%'>
				<select name='season' id='season' onchange='selChk();' style='border:1px solid #ccc;height:30px;'>
					<option value='봄' <?if($season == '봄'){echo 'selected';}?>>봄(3~5월)</option>
					<option value='여름' <?if($season == '여름'){echo 'selected';}?>>여름(6~8월)</option>
					<option value='가을' <?if($season == '가을'){echo 'selected';}?>>가을(9~11월)</option>
					<option value='겨울' <?if($season == '겨울'){echo 'selected';}?>>겨울(12~2월)</option>
					<option value='상시' <?if($season == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> >분류</th>
			<td width='33%'>
				<select name='cade01' id='cade01' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					$sql = "select * from ks_programCode where season='$season' order by sort";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);

					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$txt = $row['cade01'];

						if($txt == $cade01)	$chk = 'selected';
						else						$chk = '';

						echo ("<option value='$txt' $chk>$txt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> >기간</th>
			<td colspan='3'>
				<select name='period' id='period' onchange='periodSet();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' order by title";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);

					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$ptxt = $row['title'];

						if($period == $ptxt){
							$chk = 'selected';
							$eDate = $row['eDate01'].' ~ '.$row['eDate02'];
						}else{
							$chk = '';
						}

						echo ("<option value='$ptxt' $chk>$ptxt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr id='periodTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th>교육기간</th>
			<td><span id='eDateTxt'><?=$eDate?></span></td>
			<th>환불 불가일</th>
			<td><span id='cDateTxt'><?=$cDate01?></span></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >프로그램명</th>
			<td colspan='3'>
				<select name='title' id='title' onchange='programChk();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' order by uid desc";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);

					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$ptxt = $row['title'];

						if($title == $ptxt)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$ptxt' $chk>$ptxt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr id='fitnessTime' <?if(!$fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> >이용 시작일</th>
			<td><input type='text' name='fitnessDate01' id='fpicker3' value='<?=$fitnessDate01?>' readonly onchange='programChk();'></td>
			<th><span class='eq'></span> >이용 종료일</th>
			<td><input type='text' name='fitnessDate02' id='fpicker4' value='<?=$fitnessDate02?>'></td>
		</tr>

		<tr>
			<th>대상</th>
			<td><span id='mTargetTxt'><?=$mTarget?></span></td>
			<th>수강료</th>
			<td>
				<input name="etcAmt" id="etcAmt" style="width:120px;" type="text" value="<?=$etcAmt?>" class='numberOnly'>원
				<span id='saleAmtTxt' style="color:#ff0000;font-weight:600;">
				<?
					if($saleAmt){
						echo "&nbsp;&nbsp;(감면금액 : ".number_format($saleAmt)." 원)";
					}
				?>
				</span>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> >감면적용</th>
			<td colspan='3'>
				<div class="squaredThree">
					<input type="checkbox" value="1" id="saleChk" name="saleChk" onclick='programChk();' <?if($saleChk){echo 'checked';}?>>
					<label for="saleChk"></label>
				</div>
				<p style='margin:2px 0 0 25px;font-size:14px;'>회원의 감면구분에 따라 감면율이 적용합니다.</p>
				<input type='hidden' name='rateChk' id='rateChk' value=''>
			</td>
		</tr>


		<tr>
			<th>알림사항</th>
			<td colspan='3'><textarea name='etcMsg' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$etcMsg?></textarea></td>
		</tr>
	</table>




<?
	if($type == 'write'){
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
		</tr>
	</table>

<?
	}else{
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'><a href="../classOrder/up_index.php?type=write&etcID=<?=$uid?>" class='big cbtn green'>수강신청</a></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>삭제</a></td>
		</tr>
	</table>
<?
	}
?>
</div>






</form>
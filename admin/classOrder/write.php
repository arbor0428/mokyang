<?
	//휘트니스 프로그램용 필드
	$fitnessChk = false;

	if($type=='edit' && $uid){
		$sql = "select c.*, p.package as packageProgram, p.tutor from ks_userClass as c left join ks_program as p on c.programID=p.uid where c.uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$phone01 = $row['phone01'];
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
		$programID = $row["programID"];
		$programAmt = $row["programAmt"];
		$mTarget = $row["mTarget"];
		$health = $row["health"];
		$getDate = $row["getDate"];
		$breakDate01 = $row["breakDate01"];
		$breakDate02 = $row["breakDate02"];
		$payOk = $row["payOk"];						//결제상태
		$paynum = $row['paynum'];					//kcp 거래번호
		$payMode = $row["payMode"];
		$payAmt = $row["payAmt"];
		$payTime = $row["payTime"];
		$billNum = $row["billNum"];
		$cashBill = $row["cashBill"];					//현금영수증 발행유무
		$cashBillNum = $row["cashBillNum"];		//현금영수증번호
		$memo = $row["memo"];
		$payMemo = $row["payMemo"];
		$billName = $row["billName"];					//영수증내 이름표시
		$cardName = $row["cardName"];				//결제한 카드사
		$saleChk = $row["saleChk"];					//감면적용
		$package = $row["package"];					//헬스1개월 패키지
		$packageProgram = $row["packageProgram"];
		$rTime = $row["rTime"];
		$kcpAmt = $row["kcpAmt"];
		$tutor = $row["tutor"];
		$saleAmt = $row["saleAmt"];	//감면금액
		$posID = $row["posID"];		//단말기 결제정보(ks_pos) uid값

		$eDate = $eDate01.' ~ '.$eDate02;

		$programAmtTxt = number_format($programAmt).' 원';

		if($payTime){
			$payDate = date('Y-m-d',$payTime);
			$payHour = date('H',$payTime);
			$payMin = date('i',$payTime);
			$paySec = date('s',$payTime);
		}

		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;

		if($memo)		$memo = Util::textareaDecodeing($memo);
		if($payMemo)	$payMemo = Util::textareaDecodeing($payMemo);

		if($payMode == '가상계좌'){

			$bankname = $row["bankname"];			//가상계좌(입금은행)
			$depositor = $row["depositor"];				//가상계좌(입금자)
			$account = $row["account"];					//가상계좌(입금액)
			$va_date = $row["va_date"];					//가상계좌(입금기한)
			$vaDate = $row["vaDate"];					//가상계좌 입금일시
		}

		//회원정보
		$sql = "select * from ks_userlist where name='$name' and userNum='$userNum'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);

		if($num){
			$row = mysql_fetch_array($result);
			$sex = $row['sex'];
			$bDate = $row['bDate'];
			$userType = $row['userType'];
			$reduction = $row["reduction"];
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

		//회원정보가 없는 경우 과거 프로그램에서 넘어온 결제자료이기 때문..
		}else{
			$phone01Str = $phone01;
		}


		if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
			echo $userid.'<br>'.$row['pwd'].'<Br>uid => '.$uid.'<br>pid => '.$programID;
		}




	//개별프로그램관리에서 넘어온경우
	}elseif($type == 'write' && $etcID){
		//장바구니정보
		$sql = "select * from ks_cartList where uid='$etcID'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$programID = $row["programID"];
		$etcMsg = $row["etcMsg"];
		$etcAmt = $row["etcAmt"];
		$saleChk = $row['saleChk'];
		$saleAmt = $row['saleAmt'];

		if($etcMsg)		$memo = Util::textareaDecodeing($etcMsg);

		//회원정보
		$sql = "select * from ks_userlist where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row['sex'];
		$bDate = $row['bDate'];
		$userType = $row['userType'];
		$reduction = $row["reduction"];
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

		if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
			echo $userid.'<br>'.$row['pwd'].'<br>';
		}

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
		$tutor = $row["tutor"];

		$fitnessDate01 = date('Y-m-d');

		$getDate = date('Y-m-d');

		$payMode = '단말기';
		$payDate = date('Y-m-d');





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

		$payMode = '단말기';
		$payDate = date('Y-m-d');
	}

	include 'script.php';
?>

<script language='javascript'>
function billNameChk(billName){
	uid = '<?=$uid?>';
	$.post('json_billName.php',{'uid':uid,'billName':billName}, function(){
	});
}

function classList(){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='900' height='700' frameborder='0' scrolling='auto'></iframe>";

	form = document.FRM;
	
	form.chkUserName.value = form.name.value;
	form.chkUserNum.value = form.userNum.value;

	form.target = 'ifra_mlist';
	form.action = 'classList.php';
	form.submit();

	$(".multiBox_open").click();
}

function smsPhone(){
	phone01 = $('#phone01Txt').text();
	if(phone01 == ''){
		GblMsgBox('연락처 정보가 없습니다.','');
		return;
	}

	userid = $('#userid').val();

	action = '/module/smsPhone.php?userid='+userid+'&smsID=<?=$GBL_USERID?>';

	document.getElementById("multiFrame").innerHTML = "<iframe src='"+action+"' id='ifra_slist' class='bgtp' name='ifra_slist' width='260' height='530' frameborder='0' scrolling='auto'></iframe>";

	$(".multiBox_open").click();

	$('.bgtp').parents('.popup_background').css({'background':'transparent'})
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
<input type='hidden' name='saleAmt' id='saleAmt' value='<?=$saleAmt?>'>
<input type='hidden' name='etcID' id='etcID' value='<?=$etcID?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_payMode' value='<?=$f_payMode?>'>
<input type='hidden' name='f_reFund' value='<?=$f_reFund?>'>
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_package' value='<?=$f_package?>'>
<input type='hidden' name='f_record' value='<?=$f_record?>'>
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
			<th width='17%'><span class='eq'></span> 회원자명</th>
			<td width='33%'>
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td><input name="name" id="name" style="width:140px;" type="text" value="<?=$name?>" readonly onclick="userSearch();"> <a href="javascript:userSearch();" class="super cbtn black">검색</a></td>
						<td align='right'>
							<div id='classListDiv' <?if($name == '' || $userNum == ''){?>style="display:none;"<?}?>>
								<a href="javascript:classList();" class="super cbtn green">수강내역</a>
							</div>
						</td>
					</tr>
				</table>
			</td>
			<th width='17%'><span class='eq'></span> 회원번호</th>
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
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td><span id="carNumTxt"><?=$carNum?></span></td>
					<?
						if($carNum){
					?>
						<td style='padding:0 0 0 10px;'><a href="javascript://" onclick="window.open('/mypage/parking.php?uid=<?=$uid?>','ieprint','width=500,height=500,scrollbars=yes','_blank')" class="small cbtn black">주차권 출력하기</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
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
			<td><span id="phone01Txt"><?=$phone01Str?></span>
			<?
				//사용안함
				if($type == 'editeditediteditediteditedit'){
			?>
				&nbsp;&nbsp;<a href="javascript:smsPhone();" class="small cbtn blood">문자보내기</a>
			<?
				}
			?>
			</td>
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
			<th><span class='eq'></span> 연도</th>
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
			<th width='17%'><span class='eq'></span> 학기</th>
			<td width='33%'>
				<select name='season' id='season' onchange='selChk();' style='border:1px solid #ccc;height:30px;'>
					<option value='봄' <?if($season == '봄'){echo 'selected';}?>>1학기</option>
					<option value='여름' <?if($season == '여름'){echo 'selected';}?>>2학기</option>
					<option value='가을' <?if($season == '가을'){echo 'selected';}?>>3학기</option>
					<option value='겨울' <?if($season == '겨울'){echo 'selected';}?>>4학기</option>
					<option value='상시' <?if($season == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> 분류</th>
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
			<th><span class='eq'></span> 기간</th>
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
			<th><span class='eq'></span> 프로그램명</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<select name='title' id='title' onchange='programChk();' style='border:1px solid #ccc;height:30px;'>
								<option value=''>:: 선택 ::</option>
							<?
								$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' order by title";
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

						<td style='padding:0 0 0 30px;'>
							<div id="packageDiv" <?if(!$packageProgram){?>style='display:none;'<?}?>>
								<div class="squaredThree">
									<input type="checkbox" value="1" id="package" name="package" onclick='programChk(1);' <?if($package){echo 'checked';}?>>
									<label for="package"></label>
								</div>
								<p style='margin:3px 0 0 25px;font-size:14px;'><span class='packIco'>헬스 1개월 패키지신청</span></p>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>강사명</th>
			<td colspan='3'><span id='tutorTxt'><?=$tutor?></span></td>
		</tr>

		<tr id='fitnessTime' <?if(!$fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> 이용 시작일</th>
			<td><input type='text' name='fitnessDate01' id='fpicker3' value='<?=$fitnessDate01?>' readonly onchange='programChk();'></td>
			<th><span class='eq'></span> 이용 종료일</th>
			<td><input type='text' name='fitnessDate02' id='fpicker4' value='<?=$fitnessDate02?>'></td>
		</tr>

		<tr>
			<th>대상</th>
			<td><span id='mTargetTxt'><?=$mTarget?></span></td>
			<th>금액</th>
			<td><span id='programAmtTxt'><?=$programAmtTxt?></span></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 신청일</th>
			<td colspan='3'><input type='text' name='getDate' id='fpicker1' value='<?=$getDate?>' readonly onchange='programChk();'></td>
		</tr>

		<tr>
			<th>알림사항</th>
			<td colspan='3'><textarea name='memo' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$memo?></textarea></td>
		</tr>
	</table>

<?
	if($type == 'edit' && $fitnessChk == true){
?>
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>중도휴예</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>휴예기간</th>
			<td width='83%'><input type='text' name='breakDate01' id='fpicker5' value='<?=$breakDate01?>' readonly> ~ <input type='text' name='breakDate02' id='fpicker6' value='<?=$breakDate02?>' readonly></td>
		</tr>
	</table>
<?
	}
?>

	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수납정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><span class='eq'></span> 감면적용</th>
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
			<th><span class='eq'></span> 결제수단</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="단말기" id="pT0" name="payMode" onclick='setChkBox(this.name,0);' <?if($payMode == '단말기'){echo 'checked';}?>>
								<label for="pT0"></label>
							</div>
							<p style='margin:3px 0 0 25px;'><span class='ico02'>단말기</span></p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="신용카드" id="pT1" name="payMode" onclick='setChkBox(this.name,1);' <?if($payMode == '신용카드'){echo 'checked';}?>>
								<label for="pT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;'><span class='ico04'>신용카드</span></p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="가상계좌" id="pT2" name="payMode" onclick='setChkBox(this.name,2);' <?if($payMode == '가상계좌'){echo 'checked';}?>>
								<label for="pT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;'><span class='ico06'>가상계좌</span></p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="현금" id="pT3" name="payMode" onclick='setChkBox(this.name,3);' <?if($payMode == '현금'){echo 'checked';}?>>
								<label for="pT3"></label>
							</div>
							<p style='margin:3px 0 0 25px;'><span class='ico10'>현금</span></p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="계좌이체" id="pT4" name="payMode" onclick='setChkBox(this.name,4);' <?if($payMode == '계좌이체'){echo 'checked';}?>>
								<label for="pT4"></label>
							</div>
							<p style='margin:3px 0 0 25px;'><span class='ico12'>계좌이체</span></p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 결제금액</th>
			<td colspan='3'>
				<input name="payAmt" id="payAmt" style="width:120px;" type="text" value="<?=$payAmt?>" class='numberOnly'>원
				<span id='saleAmtTxt' style="color:#ff0000;font-weight:600;">
				<?
					if($saleAmt){
						echo "&nbsp;&nbsp;(감면금액 : ".number_format($saleAmt)." 원)";
					}
				?>
				</span>
			</td>
		</tr>
<?
	if($payMode == '가상계좌')	$payTitle = '신청일시';
	else									$payTitle = '결제일시';
?>
		<tr>
			<th><span class='eq'></span> <?=$payTitle?></th>
			<td colspan='3'>
				<div style='display:inline-block;'>
					<input type='text' name='payDate' id='fpicker2' value='<?=$payDate?>' readonly>
					<select name='payHour' id='payHour' style='border:1px solid #ccc;height:30px;'>
				<?
					for($i=0; $i<24; $i++){
						$no = sprintf('%02d',$i);
						if($no == $payHour)	$chk = 'selected';
						else						$chk = '';

						echo ("<option value='$no' $chk>$i</option>");
					}
				?>
					</select> : 
					<select name='payMin' id='payMin' style='border:1px solid #ccc;height:30px;'>
				<?
					for($i=0; $i<60; $i++){
						$no = sprintf('%02d',$i);
						if($no == $payMin)	$chk = 'selected';
						else						$chk = '';

						echo ("<option value='$no' $chk>$i</option>");
					}
				?>
					</select> : 
					<select name='paySec' id='paySec' style='border:1px solid #ccc;height:30px;'>
				<?
					for($i=0; $i<60; $i++){
						$no = sprintf('%02d',$i);
						if($no == $paySec)	$chk = 'selected';
						else						$chk = '';

						echo ("<option value='$no' $chk>$i</option>");
					}
				?>
					</select>
				</div>

				<div id="posBtn" style="display:inline-block;<?if($payMode != '단말기'){echo 'display:none;';}?>">
					<a href="javascript:PosSearch();" class="small cbtn green">단말기 결제내역 보기</a>
					<input type='hidden' name='posID' id='posID' value='<?=$posID?>'>
				</div>
			</td>
		</tr>

		<tr>
			<th width='17%'>
				<span id='payColumn'>
				<?
					if($payMode == '단말기')			echo "<span class='eq'></span> 카드승인번호";
					elseif($payMode == '신용카드')	echo "<span class='eq'></span> 카드승인번호";
					elseif($payMode == '가상계좌')	echo "<span class='eq'></span> 거래번호";
					elseif($payMode == '현금')		echo "<span class='eq'></span> 현금영수증";
					elseif($payMode == '계좌이체')	echo "<span class='eq'></span> 현금영수증";
				?>
				</span>
			</th>
			<td width='33%'>
				<div id='cardDiv' <?if($payMode != '단말기' && $payMode != '신용카드' && $payMode != '가상계좌'){echo "style='display:none;'";}?>>
					<input name='billNum' id='billNum' style='width:140px;' type='text' value='<?=$billNum?>'>
				</div>

				<div id='cashDiv' <?if($payMode != '현금' && $payMode != '계좌이체'){echo "style='display:none;'";}?>>
					<table cellpadding='0' cellspacing='0' border='0'>
						<tr>
							<td>
								<div class="squaredThree">
									<input type="checkbox" value="발행" id="cT1" name="cashBill" onclick='setChkBill(this.name,0);' <?if($cashBill == '발행'){echo 'checked';}?>>
									<label for="cT1"></label>
								</div>
								<p style='margin:3px 0 0 25px;'>발행</p>
							</td>
							<td style='padding:0 0 0 20px;'>
								<div class="squaredThree">
									<input type="checkbox" value="미발행" id="cT2" name="cashBill" onclick='setChkBill(this.name,1);' <?if($cashBill == '미발행'){echo 'checked';}?>>
									<label for="cT2"></label>
								</div>
								<p style='margin:3px 0 0 25px;'>미발행</p>
							</td>
						</tr>
					</table>
				</div>
			</td>

			<th width='17%'>
				<span id='payColumn2'>
				<?
					if($payMode == '단말기' || $payMode == '신용카드')		echo "<span class='eq'></span> 카드사";
					elseif($payMode == '현금' || $payMode == '계좌이체')		echo "현금영수증 번호";
				?>
				</span>
			</th>
			<td width='33%'>
				<div id='cardNameDiv' <?if($payMode != '단말기' && $payMode != '신용카드'){echo "style='display:none;'";}?>>
					<input name='cardName' id='cardName' style='width:140px;' type='text' value='<?=$cardName?>' placeholder='카드사'>
					<select style='border:1px solid #ccc;height:30px;' id='cardNameChk' onchange="document.FRM.cardName.value=this.options[this.selectedIndex].value;">
						<option value="">:: 직접입력 ::</option>
						<option value="삼성">삼성</option>
						<option value="신한">신한</option>
						<option value="BC">BC</option>
						<option value="국민">국민</option>
						<option value="하나(외환)">하나(외환)</option>
						<option value="현대">현대</option>
						<option value="롯데">롯데</option>
						<option value="하나">하나</option>
						<option value="농협">농협</option>
					</select>
				</div>

				<div id='cashBillNumDiv' <?if($payMode != '현금' && $payMode != '계좌이체'){echo "style='display:none;'";}?>>
					<input name='cashBillNum' id='cashBillNum' style='width:140px;' type='text' value='<?=$cashBillNum?>' placeholder='현금영수증 번호'>
				</div>
			</td>
		</tr>

		<?
			if($payMode == '가상계좌' && $paynum){
				$va_date = substr($va_date,0,4).'-'.substr($va_date,4,2).'-'.substr($va_date,6,2).' '.substr($va_date,8,2).':'.substr($va_date,10,2).':'.substr($va_date,12,2);
		?>
		<tr>
			<th>입금일</th>
			<td colspan='3'>
			<?
				if($payOk == '결제확인')	echo $vaDate;
				else								echo '입금대기';
			?>
			</td>
		</tr>
		<tr>
			<th>입금은행</th>
			<td><?=$bankname?></td>
			<th>예금주</th>
			<td><?=$depositor?></td>
		</tr>
		<tr>
			<th>계좌번호</th>
			<td><?=$account?></td>
			<th>입금기한</th>
			<td><?=$va_date?></td>
		</tr>
		<?
			}
		?>

	<?
		if($payOk == '결제확인' || ($programAmt == 0 && $payMode == '')){
	?>
		<tr>
			<th>영수증</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td><a href="javascript://" onclick="window.open('receipt.php?uid=<?=$uid?>','ieprint','width=500,height=500,scrollbars=yes','_blank')" class='small cbtn black'>영수증출력</a></td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="1" id="jT1" name="online" onclick="billNameChk('<?=$billName?>');" <?if($billName){echo 'checked';}?>>
								<label for="jT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;font-size:14px;'>영수증내 회원명 표시</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<?
			if($payMode == '신용카드'){
		?>
		<tr>
			<th>KCP 영수증</th>
			<td colspan='3'><a href="javascript:openCenterWin('http://admin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=card_bill&tno=<?=$paynum?>&order_no=<?=$rTime?>&trade_mony=<?=$kcpAmt?>','kcp','470','815','','');" class="small cbtn black">전표출력하기</a></td>
		</tr>
		<?
			}elseif($payMode == '가상계좌' && $payOk == '결제확인'){
		?>
		<tr>
			<th>KCP 영수증</th>
			<td colspan='3'><a href="javascript:openCenterWin('https://admin8.kcp.co.kr/assist/bill.BillActionNew.do?cmd=vcnt_bill&tno=<?=$paynum?>&&order_no=<?=$rTime?>&trade_mony=<?=$kcpAmt?>','kcp','470','695','','');" class="small cbtn black">출력하기</a></td>
		</tr>
		<?
			}
		?>
	<?
		}
	?>

		<tr>
			<th>비고</th>
			<td colspan='3'><textarea name='payMemo' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$payMemo?></textarea></td>
		</tr>
	</table>

<?
	if($reFund){
		if($reFund == '환불')				$reFundTxt = "<span class='ico09'>환불</span>";
		elseif($reFund == '취소')		$reFundTxt = "<span class='ico07'>취소</span>";

		$reAmtTxt = number_format($reAmt).' 원';
		$reEtcTxt = number_format($reEtc).' 원';
?>
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>환불정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th>상태</th>
			<td colspan='3'><?=$reFundTxt?></td>
		</tr>

		<tr>
			<th width='17%'>환불금액</th>
			<td width='33%'><?=$reAmtTxt?></td>
			<th width='17%'>환불수수료</th>
			<td width='33%'><?=$reEtcTxt?></td>
		</tr>

		<tr>
			<th>처리일</th>
			<td colspan='3'><?=$reDate?></td>
		</tr>

		<tr>
			<th>비고</th>
			<td colspan='3'><?=$reMemo?></td>
		</tr>
	</table>
<?
	}
?>



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
<script language='javascript'>
function refund(){
	form = document.FRM;
	form.type.value = 'view';
	form.action = 'up_index.php';
	form.submit();
}
</script>

	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'><a href="javascript:refund();" class='big cbtn green'>환불</a></td>
			<td width='60%' align='center' style='padding:30px 0;'>
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







<?
if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
	if($type == 'write' && $etcID){
?>
<script language='javascript'>programChk('<?=$etcAmt?>');</script>
<?
	}
}
?>
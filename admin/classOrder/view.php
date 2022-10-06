<?
	//휘트니스 프로그램용 필드
	$fitnessChk = false;

	$nTime = mktime();

	if($type=='view' && $uid){
		$sql = "select * from ks_userClass where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row["name"];
		$userNum = $row["userNum"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$eDate01 = $row["eDate01"];
		$eTime01 = $row["eTime01"];
		$eDate02 = $row["eDate02"];
		$eTime02 = $row["eTime02"];
		$cDate01 = $row["cDate01"];
		$cTime01 = $row["cTime01"];
		$title = $row["title"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$programID = $row["programID"];
		$programAmt = $row["programAmt"];
		$mTarget = $row["mTarget"];
		$reduction = $row["reduction"];
		$health = $row["health"];
		$getDate = $row["getDate"];
		$breakDate01 = $row["breakDate01"];
		$breakDate02 = $row["breakDate02"];
		$payOk = $row["payOk"];						//결제상태
		$payMode = $row["payMode"];
		$payAmt = $row["payAmt"];
		$payDate = $row["payDate"];
		$billNum = $row["billNum"];
		$cardName = $row["cardName"];
		$cashBill = $row["cashBill"];					//현금영수증 발행유무
		$cashBillNum = $row["cashBillNum"];		//현금영수증번호
		$reFund = $row["reFund"];
		$reAmt = $row["reAmt"];
		$reEtc = $row["reEtc"];
		$reUse = $row["reUse"];
		$reDate = $row["reDate"];
		$reTime = $row["reTime"];
		$reMemo = $row["reMemo"];
		$reMsg = $row["reMsg"];			//사용자가 환불신청한 경우 메세지
		$memo = $row["memo"];
		$payMemo = $row["payMemo"];
		$newAmt = $row["newAmt"];		//재결제 금액
		$newNum = $row["newNum"];		//재결제 승인번호
		$newCard = $row["newCard"];	//재결제 카드사
		$saleChk = $row["saleChk"];		//감면적용
		$package = $row["package"];		//패키지신청

		if($package)	$title = "<span class='packIco'>P</span> ".$title;

		if($reUse)	$reUseTxt = number_format($reUse).'원';

		//환불신청정보
		$backName = $row["backName"];
		$backBank = $row["backBank"];
		$backAccount = $row["backAccount"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];

		$eDate = $eDate01.' ~ '.$eDate02;

		//환불불가확인
		if($cTime01 > 0 && $nTime > $cTime01){
			$reBlock = true;
		}

		$reBlock = false;

		$programAmtTxt = number_format($programAmt).' 원';
		$payAmtTxt = number_format($payAmt).' 원';

		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;

		if($reMemo)	$reMemo = Util::textareaDecodeing($reMemo);

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

		//감면적용
		if($saleChk){
			//감면비율
			if($reduction == '국가유공자')			$rate = '50';
			elseif($reduction == '장애인할인')	$rate = '50';
			else											$rate = '';

		}else{
			$rate = '';
		}

		//강사명
		$sql = "select * from ks_program where uid='$programID'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$tutor = $row['tutor'];
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

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk){
				eChk[i].checked = true;
			}else{
				eChk[i].checked = false;
			}
		}

		if(chk == 0 && '<?=$reBlock?>' == true){
			eChk[0].checked = false;
			$('#reAmt').val('');
			$('#reEtc').val('');
			$('#reUse').val('');
			$('#reUseTxt').text('');
			$('#fpicker1').val('');
			GblMsgBox("<?=$cDate01?>일 이후 환불이 불가합니다.",'');
			return;
		}
/*
		if($('#fpicker1').val())	reDate = $('#fpicker1').val();
		else							reDate = "<?=date('Y-m-d')?>";
*/
		reDate = "<?=date('Y-m-d')?>";
		$('#fpicker1').val(reDate);

		refundChk();

	}else{
		$('#reAmt').val('');
		$('#reEtc').val('');
		$('#reUse').val('');
		$('#reUseTxt').text('');
		$('#fpicker1').val('');

		//결제수단
		payMode = '<?=$payMode?>';
		if(payMode == '단말기'){
			$('#newAmt').val('');
			$('#newNum').val('');
			$('#newCard').val('');
			$("#newCardChk option:eq(0)").attr("selected", "selected");
			
		}
	}
}

function refundChk(){
	//휘트니스 프로그램은 환불금액 및 환불수수료를 수동입력
	if('<?=$fitnessChk?>'){
		$('#reAmt').val('');
		$('#reEtc').val('');
		$('#reUse').val('');
		$('#reUseTxt').text('');

	}else{
		//결제수단
		payMode = '<?=$payMode?>';

		chk01 = $('#sT1').is(":checked");
//		chk02 = $('#sT2').is(":checked");
		chk02 = false;

		//환불
		if(chk01){
			uid = $('#uid').val();
			reDate = $('#fpicker1').val();
			rate = $('#rate').val();

			$.post('json_refund.php',{'uid':uid,'reDate':reDate,'rate':rate}, function(c1){
				c1 = urldecode(c1);
				parData = JSON.parse(c1);

				$('#reAmt').val(parData[0]);
				$('#reEtc').val(parData[1]);
				$('#reUse').val(parData[2]);
				$('#reUseTxt').text(number_format(parData[2])+'원');

				//재결제 금액
				if(payMode == '단말기'){
					newAmt = parseInt(parData[2]) + parseInt(parData[1]);
					$('#newAmt').val(newAmt);
				}
			});

		//취소
		}else if(chk02){
			payAmt = $('#payAmt').val();
			if(payAmt == '')	payAmt = 0;
			$('#reAmt').val(payAmt);
			$('#reEtc').val('0');
			$('#reUse').val('');
			$('#reUseTxt').text('0원');

			if(payMode == '단말기'){
				$('#newAmt').val('');
				$('#newNum').val('');
				$('#newCard').val('');
				$("#newCardChk option:eq(0)").attr("selected", "selected");
			}

		//환불신청
		}else{
			$('#reAmt').val('');
			$('#reEtc').val('');
			$('#reUse').val('');
			$('#reUseTxt').text('');

			if(payMode == '단말기'){
				$('#newAmt').val('');
				$('#newNum').val('');
				$('#newCard').val('');
				$("#newCardChk option:eq(0)").attr("selected", "selected");
			}
		}
	}
}

function refund(){
	form = document.FRM;

	chk01 = $('#sT1').is(":checked");
//	chk02 = $('#sT2').is(":checked");

	if(chk01){
		if(isFrmEmptyModal(form.reAmt,"환불금액을 입력해 주십시오."))	return;
		if(isFrmEmptyModal(form.reEtc,"환불수수료를 입력해 주십시오."))	return;
	}

	form.type.value = 'recan';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function reAmtSet(){
	payAmt = parseInt($('#payAmt').val());	//결제금액
	reUse = parseInt($('#reUse').val());		//이용금액
	reAmt = parseInt($("#reAmt").val());		//환불금액
	reEtc = parseInt($("#reEtc").val());		//환불수수료

	if(payAmt == '')	payAmt = 0;
	if(isNaN(reUse))	reUse = 0;
	if(reAmt == '')		reAmt = 0;
	if(isNaN(reEtc))	reEtc = parseFloat(payAmt * 0.1);	//환불수수료(결제금액의 10%)

	//환불금액(결제금액 - (이용금액 + 환불수수료))
	reAmt = payAmt - (reUse + reEtc);

	//재결제금액(
	newAmt = reUse + reEtc;

	$("#reEtc").val(reEtc);
	$("#reUse").val(reUse);
	$("#reAmt").val(reAmt);
	$("#newAmt").val(newAmt);
}

function filedownload(){
	form = document.frm_filedown;
	form.target = 'ifra_gbl';
	form.action = '/module/download.php';
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

<form name='frm_filedown' method='post'>
<input type='hidden' name='file_dir' value='../upfile/refund/'>
<input type='hidden' name='ufile' value="<?=$upfile01?>">
<input type='hidden' name='rfile' value="<?=$realfile01?>">
</form>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' id='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<input type='hidden' name='payAmt' id='payAmt' value='<?=$payAmt?>'><!-- 결제금액 -->
<input type='hidden' name='rate' id='rate' value='<?=$rate?>'><!-- 감면비율 -->

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
			<td width='33%'><?=$name?></td>
			<th width='17%'><span class='eq'></span> 회원번호</th>
			<td width='33%'><?=$userNum?></td>
		</tr>

		<tr>
			<th>성별</th>
			<td><?=$sex?></td>
			<th>생년월일</th>
			<td><?=$bDate?></td>
		</tr>

		<tr>
			<th>회원구분</th>
			<td><?=$userType?></td>
			<th>주차권 발급</th>
			<td><?=$carNum?></td>
		</tr>

		<tr>
			<th>주소</th>
			<td colspan='3'><?=$addr?></td>
		</tr>

		<tr>
			<th>이메일</th>
			<td colspan='3'><?=$email?></td>
		</tr>

		<tr>
			<th>연락처1</th>
			<td><?=$phone01Str?></td>
			<th>연락처2</th>
			<td><?=$phone02Str?></td>
		</tr>

		<tr>
			<th>감면구분</th>
			<td colspan='3'><?=$reduction?></td>
		</tr>

		<tr>
			<th>질병 및 건강상태</th>
			<td colspan='3'><?=$health?></td>
		</tr>
	</table>





	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수강신청 프로그램</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><span class='eq'></span> 연도</th>
			<td colspan='3'><?=$year?></td>
		</tr>

		<tr>
			<th width='17%'><span class='eq'></span> 학기</th>
			<td width='33%'><?=$season?></td>
			<th width='17%'><span class='eq'></span> 분류</th>
			<td width='33%'><?=$cade01?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 기간</th>
			<td colspan='3'><?=$period?></td>
		</tr>
	<?
		if($fitnessChk == false){
	?>
		<tr>
			<th>교육기간</th>
			<td><?=$eDate?></td>
			<th>환불 불가일</th>
			<td><?=$cDate01?></td>
		</tr>
	<?
		}
	?>

		<tr>
			<th><span class='eq'></span> 프로그램명</th>
			<td><?=$title?></td>
			<th>강사명</th>
			<td><?=$tutor?></td>
		</tr>

	<?
		if($fitnessChk){
	?>
		<tr>
			<th><span class='eq'></span> 휘트니스 이용일</th>
			<td colspan='3'><?=$fitnessDate01?> ~ <?=$fitnessDate02?></td>
		</tr>
	<?
		}
	?>

		<tr>
			<th>대상</th>
			<td><?=$mTarget?></td>
			<th>금액</th>
			<td><?=$programAmtTxt?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 신청일</th>
			<td colspan='3'><?=$getDate?></td>
		</tr>

		<tr>
			<th>알림사항</th>
			<td colspan='3'><?=$memo?></td>
		</tr>
	</table>

<?
	if($fitnessChk){
?>
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>중도휴예</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>휴예기간</th>
			<td width='83%'><?=$breakDate01?> ~ <?=$breakDate02?></td>
		</tr>
	</table>
<?
	}
?>


	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수납정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<?
		if($payMode == ''){
	?>
		<tr>
			<th><span class='eq'></span> 수납정보가 없습니다.</th>
		</tr>
	<?
		}else{
	?>
		<tr>
			<th width='17%'><span class='eq'></span> 결제수단</th>
			<td width='33%'><?=$payMode?></td>
			<th width='17%'><span class='eq'></span> 결제금액</th>
			<td width='33%'><?=$payAmtTxt?></td>
		</tr>

		<?
			if($payMode == '단말기' || $payMode == '신용카드'){
		?>
		<tr>
			<th><span class='eq'></span> 결제일</th>
			<td colspan='3'><?=$payDate?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 카드승인번호</th>
			<td><?=$billNum?></td>
			<th><span class='eq'></span> 카드사</th>
			<td><?=$cardName?></td>
		</tr>
		<?
			}elseif($payMode == '가상계좌'){
				$va_date = substr($va_date,0,4).'-'.substr($va_date,4,2).'-'.substr($va_date,6,2).' '.substr($va_date,8,2).':'.substr($va_date,10,2).':'.substr($va_date,12,2);
		?>
		<tr>
			<th><span class='eq'></span> 신청일</th>
			<td><?=$payDate?></td>
			<th><span class='eq'></span> 입금일</th>
			<td>
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
			}elseif($payMode == '현금' || $payMode == '계좌이체'){
		?>
		<tr>
			<th><span class='eq'></span> 결제일</th>
			<td colspan='3'><?=$payDate?></td>
		</tr>
		<tr>
			<th><span class='eq'></span> 현금영수증</th>
			<td><?=$cashBill?></td>
			<th>현금영수증 번호</th>
			<td><?=$cashBillNum?></td>
		</tr>
		<?
			}
		?>

		<tr>
			<th>비고</th>
			<td colspan='3'><?=$payMemo?></td>
		</tr>
	<?
		}
	?>
	</table>


	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>환불정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>상태</th>
			<td width='83%'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr height='40'>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="환불" id="sT1" name="reFund" onclick='setChkBox(this.name,0);' <?if($reFund == '환불'){echo 'checked';}?>>
								<label for="sT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>환불</p>
						</td>
					<!--
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="취소" id="sT2" name="reFund" onclick='setChkBox(this.name,1);' <?if($reFund == '취소'){echo 'checked';}?>>
								<label for="sT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>취소</p>
						</td>
					-->
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="환불신청" id="sT3" name="reFund" onclick='setChkBox(this.name,1);' <?if($reFund == '환불신청'){echo 'checked';}?>>
								<label for="sT3"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>환불신청</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

	<?
		if($reMsg){
	?>
		<tr>
			<th>환불사유</th>
			<td><?=$reMsg?></td>
		</tr>
	<?
		}
	?>
		<tr>
			<th>환불수수료</th>
			<td><input name="reEtc" id="reEtc" style="width:120px;" type="text" value="<?=$reEtc?>" class='numberOnly' onblur="reAmtSet();">원</td>
		</tr>

		<tr>
			<th>이용금액</th>
			<td><input type='text' name='reUse' id='reUse' style="width:120px;" value='<?=$reUse?>' class='numberOnly' onblur="reAmtSet();">원<span id='reUseTxt' style='display:none;'><?=$reUseTxt?></span></td>
		</tr>

		<tr>
			<th>환불금액</th>
			<td><input name="reAmt" id="reAmt" style="width:120px;" type="text" value="<?=$reAmt?>" class='numberOnly'>원</td>
		</tr>

		<tr>
			<th>처리일</th>
			<td><input type='text' name='reDate' id='fpicker1' value='<?=$reDate?>' readonly onchange='refundChk();'></td>
		</tr>

		<tr>
			<th>비고(환불사유)</th>
			<td><textarea name='reMemo' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$reMemo?></textarea></td>
		</tr>
	</table>
<?
	if($payMode == '단말기'){
?>
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>재결제 정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th>결제금액</th>
			<td colspan='3'><input name="newAmt" id="newAmt" style="width:120px;" type="text" value="<?=$newAmt?>" class='numberOnly'>원</td>
		</tr>

		<tr>
			<th width='17%'>카드승인번호</th>
			<td width='33%'><input name='newNum' id='newNum' style='width:140px;' type='text' value='<?=$newNum?>'></td>
			<th width='17%'>카드사</th>
			<td width='33%'>
				<input name='newCard' id='newCard' style='width:140px;' type='text' value='<?=$newCard?>'>
				<select style='border:1px solid #ccc;height:30px;' id='newCardChk' onchange="document.FRM.newCard.value=this.options[this.selectedIndex].value;">
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
			</td>
		</tr>
	</table>
<?
	}
?>

<?
	if($payMode == '가상계좌' && ($reFund == '환불' || $reFund == '환불신청')){
?>
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>환불계좌정보</span></div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th>예금주</th>
			<td colspan='3'><?=$backName?></td>
		</tr>
		<tr>
			<th width='17%'>은행명</th>
			<td width='33%'><?=$backBank?></td>
			<th width='17%'>계좌번호</th>
			<td width='33%'><?=$backAccount?></td>
		</tr>
		<tr>
			<th>관련자료</th>
			<td colspan='3'>
			<?
				if($upfile01){
			?>
				<a href="javascript:filedownload();" class='small cbtn green'>다운로드</a>
			<?
				}
			?>
			</td>
		</tr>
	</table>
<?
	}
?>


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='60%' align='center' style='padding:30px 0;'>
				<a href="javascript:refund();" class='big cbtn blue'>저장하기</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>삭제</a></td>
		</tr>
	</table>
</div>






</form>
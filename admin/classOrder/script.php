<script language='javascript'>
function selChk(){
	season = $('#season').find('option:selected').val();

	//분류
	$.post('json.php',{'season':season}, function(c1){
		//분류 selectbox 초기화
		$('#cade01').empty();
		$('#cade01').append("<option value=''>:: 선택 ::</option>");

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#cade01').append(option);
		}
	});

	//기간 selectbox 설정
	periodChk();
}

function periodChk(){
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();

	//휘트니스 프로그램
	if(season == '상시' && c1 == '휘트니스센터'){
		$('#fitnessTime').fadeIn();
		$('#periodTime').hide();

	}else{
		$('#fitnessTime').hide();
		$('#periodTime').fadeIn();
	}

	//기간 selectbox 초기화
	$('#period').empty();
	$('#period').append("<option value=''>:: 선택 ::</option>");

	//강사명초기화
	$('#tutorTxt').text('');

	//대상 초기화
	$('#mTarget').val('');
	$('#mTargetTxt').text('');

	//교육기간 초기화
	$('#eDate').val('');
	$('#eDateTxt').text('');

	//환불 불가일 초기화
	$('#cDate01').val('');
	$('#cDateTxt').text('');

	//프로그램 selectbox 초기화
	$('#title').empty();
	$('#title').append("<option value=''>:: 선택 ::</option>");

	//패키지신청 초기화
	$('input[name^=package]').prop('checked', false);
	$('#packageDiv').hide();

	//프로그램 금액 초기화
	$('#programAmt').val('');
	$('#programAmtTxt').text('');

	//결제금액 초기화
	$('#payAmt').val('');

	//감면금액 초기화
	$('#saleAmt').val('');
	$('#saleAmtTxt').text('');

	//휘트니스 종료일 초기화
	$('#fpicker4').val('');

	//기간
	$.post('json_period01.php',{'year':year,'season':season,'c1':c1}, function(req){
		req = urldecode(req);
		parData = JSON.parse(req);

		//기간 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#period').append(option);
		}
	});
}

function periodSet(){
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();
	period = $('#period').find('option:selected').val();

	//강사명초기화
	$('#tutorTxt').text('');

	//대상 초기화
	$('#mTarget').val('');
	$('#mTargetTxt').text('');

	//교육기간 초기화
	$('#eDate').val('');
	$('#eDateTxt').text('');

	//환불 불가일 초기화
	$('#cDate01').val('');
	$('#cDateTxt').text('');

	//프로그램 selectbox 초기화
	$('#title').empty();
	$('#title').append("<option value=''>:: 선택 ::</option>");

	//프로그램 금액 초기화
	$('#programAmt').val('');
	$('#programAmtTxt').text('');

	//패키지신청 초기화
	$('input[name^=package]').prop('checked', false);
	$('#packageDiv').hide();

	//결제금액 초기화
	$('#payAmt').val('');

	//감면금액 초기화
	$('#saleAmt').val('');
	$('#saleAmtTxt').text('');

	//휘트니스 종료일 초기화
	$('#fpicker4').val('');

	//프로그램정보
	$.post('json_period02.php',{'year':year,'season':season,'c1':c1,'period':period}, function(c1){
		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		$('#eDate').val(parData[0]);
		$('#eDateTxt').text(parData[0]);

		$('#cDate01').val(parData[1]);
		$('#cDateTxt').text(parData[1]);

		//프로그램 selectbox 옵션설정	
		for(i=2; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#title').append(option);
		}
	});
}

function programChk(c){
	reduction =$('#reduction').val();
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();
	period = $('#period').find('option:selected').val();
	title = $('#title').find('option:selected').val();
	getDate = $('#fpicker1').val();
	fitnessDate = $('#fpicker3').val();	//휘트니스 프로그램 이용시작일

	//강사명초기화
	$('#tutorTxt').text('');

	//대상 초기화
	$('#mTarget').val('');
	$('#mTargetTxt').text('');

	//프로그램 금액 초기화
	$('#programAmt').val('');
	$('#programAmtTxt').text('');

	//패키지신청 초기화
	if(typeof c == "undefined"){
		$('input[name^=package]').prop('checked', false);
		$('#packageDiv').hide();
	}
	
	//결제금액 초기화
	$('#payAmt').val('');

	//감면금액 초기화
	$('#saleAmt').val('');
	$('#saleAmtTxt').text('');

	//휘트니스 종료일 초기화
	$('#fpicker4').val('');

	//감면적용
	if($('#saleChk').is(":checked")){
		//감면비율
		if(reduction == '국가유공자')			rate = '50';
		else if(reduction == '장애인할인')	rate = '50';
		else											rate = '';

	}else{
		rate = '';
	}

	$('#rateChk').val(rate);

	//패키지신청
	if($('#package').is(":checked"))	packageChk = 1;
	else										packageChk = '';

	//개별프로그램에서 등록한 값
	etcID = $('#etcID').val();

	//프로그램정보
	if(title){
		userid = $('#userid').val();
		$.post('json_period03.php',{'rate':rate,'year':year,'season':season,'c1':c1,'period':period,'title':title,'getDate':getDate,'fitnessDate':fitnessDate,'packageChk':packageChk,'etcID':etcID,'userid':userid}, function(req){
			req = urldecode(req);
			parData = JSON.parse(req);		

			mTarget = parData[0];
			amt = parData[1];
			fitnessDate02 = parData[2];
			packageChk = parData[3];
			maxChk = parData[4];
			tutor = parData[5];
			saleAmt = parData[6];

			//정원초과
			if(maxChk == '1'){
//				$("#title option:eq(0)").attr("selected", "selected");
				GblMsgBox('정원이 초과된 프로그램입니다.','');
				return;
			}

			if(amt >= 0)		amtTxt = format_number(amt)+' 원';
			else				amtTxt = '';

			$('#tutorTxt').text(tutor);

			$('#mTarget').val(mTarget);
			$('#mTargetTxt').text(mTarget);

			$('#programAmt').val(amt);
			$('#programAmtTxt').text(amtTxt);

			$('#payAmt').val(amt);

			$('#saleAmt').val(saleAmt);
			if(saleAmt)	saleAmtTxt = "&nbsp;&nbsp;(감면금액 : "+format_number(saleAmt)+" 원)";
			else			saleAmtTxt = '';
			$('#saleAmtTxt').html(saleAmtTxt);

			//100% 감면일 경우 결제수단 현금체크 및 현금영수증 미발행 체크처리
			if(rate == '100'){
				$('#payColumn').html("<span class='eq'></span> 현금영수증");
				$('#payColumn2').html("현금영수증 번호");
				$('#cardNameDiv').hide();
				$('#cashBillNumDiv').show();
				$('#cardDiv').hide();
				$('#cashDiv').show();
				$('#billNum').val('');
				$('#cardName').val('');
				$("#cardNameChk option:eq(0)").attr("selected", "selected");
				$('#pT0').prop('checked', false);
				$('#pT1').prop('checked', false);
				$('#pT2').prop('checked', false);
				$('#pT3').prop('checked', true);
				$('#pT4').prop('checked', false);
				$('#cT1').prop('checked', false);
				$('#cT2').prop('checked', true);
			}

			$('#fpicker4').val(fitnessDate02);

			if(packageChk){
				$('#packageDiv').show();
			}
		});
	}
}

function userSearch(){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='900' height='700' frameborder='0' scrolling='no'></iframe>";

	form = document.FRM;
	
	form.chkUserName.value = form.name.value;
	form.chkUserNum.value = form.userNum.value;

	form.target = 'ifra_mlist';
	form.action = '../user_list.php';
	form.submit();

	$(".multiBox_open").click();
}

function userInfo(uid){
	$('#userid').val('');
	$('#name').val('');
	$('#userNum').val('');
	$('#userNumTxt').text('');
	$('#sexTxt').text('');
	$('#bDateTxt').text('');
	$('#userTypeTxt').text('');
	$('#carNumTxt').text('');
	$('#addrTxt').text('');
	$('#emailTxt').text('');
	$('#phone01Txt').text('');
	$('#phone02Txt').text('');
	$('#reduction').val('');
	$('#reductionTxt').text('');
	$('#health').val('');
	$('#healthTxt').text('');
	$('#classListDiv').hide();

	if(uid){
		$.post('userInfo.php',{'uid':uid}, function(req){
			req = urldecode(req);
			parData = JSON.parse(req);

			userid = parData[0];
			name = parData[1];
			userNum = parData[2];
			sex = parData[3];
			bDate = parData[4];
			userType = parData[5];
			carNum = parData[6];
			addr = parData[7];
			email = parData[8];
			phone01 = parData[9];
			phone02 = parData[10];
			reduction = parData[11];
			healthTxt = parData[12];

			$('#userid').val(userid);
			$('#name').val(name);
			$('#userNum').val(userNum);
			$('#userNumTxt').text(userNum);
			$('#sexTxt').text(sex);
			$('#bDateTxt').text(bDate);
			$('#userTypeTxt').text(userType);
			$('#carNumTxt').text(carNum);
			$('#addrTxt').text(addr);
			$('#emailTxt').text(email);
			$('#phone01Txt').text(phone01);
			$('#phone02Txt').text(phone02);
			$('#reduction').val(reduction);
			$('#reductionTxt').text(reduction);
			$('#health').val(healthTxt);
			$('#healthTxt').text(healthTxt);
			$('#classListDiv').show();

			programChk();
		});
	}else{
		programChk();
	}
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	//단말기 결제내역 찾기버튼
	$('#posBtn').hide();

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}

		programAmt = $('#programAmt').val();
		$('#payAmt').val(programAmt);
		$('#fpicker2').val("<?=date('Y-m-d')?>");

		if(chk == 0 || chk == 1 || chk == 2){
			if(chk == 0)		$('#posBtn').show();

			if(chk == 2){
				$('#payColumn').html("<span class='eq'></span> 거래번호");
				$('#payColumn2').html("");
				$('#cardNameDiv').hide();
				$('#cashBillNumDiv').hide();
				$('#cardName').val('');
				$("#cardNameChk option:eq(0)").attr("selected", "selected");
			}else{
				$('#payColumn').html("<span class='eq'></span> 카드승인번호");
				$('#payColumn2').html("<span class='eq'></span> 카드사");
				$('#cardNameDiv').show();
				$('#cashBillNumDiv').hide();
			}
			$('#cardDiv').show();
			$('#cashDiv').hide();
			$('input[name^=cashBill]').prop('checked', false);
			$('#cashBillNum').val('');

		}else if(chk == 3 || chk == 4){
			$('#payColumn').html("<span class='eq'></span> 현금영수증");
			$('#payColumn2').html("현금영수증 번호");
			$('#cardNameDiv').hide();
			$('#cashBillNumDiv').show();
			$('#cardDiv').hide();
			$('#cashDiv').show();
			$('#billNum').val('');
			$('#cardName').val('');
			$("#cardNameChk option:eq(0)").attr("selected", "selected");

		}

	}else{
		$('#payAmt').val('');
		$('#fpicker2').val('');
		$('#payColumn').text('');
		$('#payColumn2').text("");
		$('#cardNameDiv').hide();
		$('#cashBillNumDiv').hide();
		$('#cardDiv').hide();
		$('#cashDiv').hide();
		$('#billNum').val('');
		$('#cardName').val('');
		$("#cardNameChk option:eq(0)").attr("selected", "selected");
		$('#cashBillNum').val('');
		$('input[name^=cashBill]').prop('checked', false);
	}
}

function PosSearch(){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='900' height='700' frameborder='0' scrolling='auto'></iframe>";

	form = document.FRM;
	
	form.target = 'ifra_mlist';
	form.action = '../pos_list.php';
	form.submit();

	$(".multiBox_open").click();
}

function posInfo(uid){
	$('#posID').val('');
	$('#payAmt').val('');
	$('#fpicker2').val('');
	$("#payHour option:eq(0)").prop("selected", true);
	$("#payMin option:eq(0)").prop("selected", true);
	$("#paySec option:eq(0)").prop("selected", true);
	$('#billNum').val('');
	$('#cardName').val('');

	if(uid){
		$.post('posInfo.php',{'uid':uid}, function(req){
			req = urldecode(req);
			parData = JSON.parse(req);

			payAmt = parData[0];
			payDate = parData[1];
			payHour = parData[2];
			payMin = parData[3];
			paySec = parData[4];
			billNum = parData[5];
			cardName = parData[6];

			$('#posID').val(uid);
			$('#payAmt').val(payAmt);
			$('#fpicker2').val(payDate);
			$('#payHour').val(payHour);
			$('#payMin').val(payMin);
			$('#paySec').val(paySec);
			$('#billNum').val(billNum);
			$('#cardName').val(cardName);
		});
	}
}

function setChkBill(obj,chk){
	eChk = document.getElementsByName(obj);

	for(var i=0;i<eChk.length;i++){
		if(i == chk)	eChk[i].checked = true;
		else			eChk[i].checked = false;
	}
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}
</script>



<?
	if($type == 'write'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.name,"회원자명을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.period,"기간을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"프로그램명을 선택해 주십시오."))	return;

	programAmt = $('#programAmt').val();

	//감면비율
	rateChk = $('#rateChk').val();

	if(programAmt > 0){
		pchk01 = $('#pT0').is(":checked");
		pchk02 = $('#pT1').is(":checked");
		pchk03 = $('#pT2').is(":checked");
		pchk04 = $('#pT3').is(":checked");
		pchk05 = $('#pT4').is(":checked");

		if(pchk01 == false && pchk02 == false && pchk03 == false && pchk04 == false && pchk05 == false){
			GblMsgBox('결제수단을 선택해 주십시오.','');
			return;

		}else{
			if(isFrmEmptyModal(form.payAmt,"결제금액을 입력해 주십시오."))	return;
			if(form.payDate.value == ''){
				GblMsgBox('결제일을 입력해 주십시오.','');
				return;
			}

			if(pchk01 || pchk02){
				if(rateChk != '100'){
					if(isFrmEmptyModal(form.billNum,"카드승인번호를 입력해 주십시오."))	return;
					if(isFrmEmptyModal(form.cardName,"카드사를 입력해 주십시오."))	return;
				}

			}else if(pchk03){
				if(rateChk != '100'){
					if(isFrmEmptyModal(form.billNum,"거래번호를 입력해 주십시오."))	return;
				}

			}else if(pchk04 || pchk05){
				if(rateChk != '100'){
					cchk01 = $('#cT1').is(":checked");
					cchk02 = $('#cT2').is(":checked");

					if(cchk01 == false && cchk02 == false){
						GblMsgBox('현금영수증 발행유무를 선택해 주십시오.','');
						return;
					}
				}
			}
		}
	}

	form.type.value = 'write';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>











<?
	}elseif($type == 'edit'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.name,"회원자명을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.period,"기간을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"프로그램명을 선택해 주십시오."))	return;

	programAmt = $('#programAmt').val();

	//감면비율
	rateChk = $('#rateChk').val();

	if(programAmt > 0){
		pchk01 = $('#pT0').is(":checked");
		pchk02 = $('#pT1').is(":checked");
		pchk03 = $('#pT2').is(":checked");
		pchk04 = $('#pT3').is(":checked");
		pchk05 = $('#pT4').is(":checked");

		if(pchk01 == false && pchk02 == false && pchk03 == false && pchk04 == false && pchk05 == false){
			GblMsgBox('결제수단을 선택해 주십시오.','');
			return;

		}else{
			if(isFrmEmptyModal(form.payAmt,"결제금액을 입력해 주십시오."))	return;
			if(form.payDate.value == ''){
				GblMsgBox('결제일을 입력해 주십시오.','');
				return;
			}

			if(pchk01 || pchk02){
				if(rateChk != '100'){
					if(isFrmEmptyModal(form.billNum,"카드승인번호를 입력해 주십시오."))	return;
					if(isFrmEmptyModal(form.cardName,"카드사를 입력해 주십시오."))	return;
				}

			}else if(pchk03){
				if(rateChk != '100'){
					if(isFrmEmptyModal(form.billNum,"거래번호를 입력해 주십시오."))	return;
				}

			}else if(pchk04 || pchk05){
				if(rateChk != '100'){
					cchk01 = $('#cT1').is(":checked");
					cchk02 = $('#cT2').is(":checked");

					if(cchk01 == false && cchk02 == false){
						GblMsgBox('현금영수증 발행유무를 선택해 주십시오.','');
						return;
					}
				}
			}
		}
	}

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
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





<?
	}
?>
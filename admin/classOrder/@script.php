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

	//결제금액 초기화
	$('#payAmt').val('');

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
	
	//결제금액 초기화
	$('#payAmt').val('');

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

function programChk(){
	reduction =$('#reduction').val();
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();
	period = $('#period').find('option:selected').val();
	title = $('#title').find('option:selected').val();
	getDate = $('#fpicker1').val();
	fitnessDate = $('#fpicker3').val();	//휘트니스 프로그램 이용시작일

	//대상 초기화
	$('#mTarget').val('');
	$('#mTargetTxt').text('');

	//프로그램 금액 초기화
	$('#programAmt').val('');
	$('#programAmtTxt').text('');

	//결제금액 초기화
	$('#payAmt').val('');

	//휘트니스 종료일 초기화
	$('#fpicker4').val('');

	//감면비율
	if(reduction == '국민기초생활보장수급(생계/의료)')		rate = '100';
	else if(reduction == '국민기초생활보장수급(주거/교육)')	rate = '50';
	else if(reduction == '장애인(1~3급)')							rate = '50';
	else if(reduction == '장애인(4~6급)')							rate = '20';
	else if(reduction == '국가보훈대상(본인 및 직계가족)')	rate = '50';
	else if(reduction == '차상위계층')								rate = '50';
	else if(reduction == '다자녀가족')								rate = '50';
	else if(reduction == '경로')											rate = '50';
	else if(reduction == '직원')											rate = '40';
	else																		rate = '';

	//프로그램정보
	if(title){
		$.post('json_period03.php',{'rate':rate,'year':year,'season':season,'c1':c1,'period':period,'title':title,'getDate':getDate,'fitnessDate':fitnessDate}, function(req){
			req = urldecode(req);
			parData = JSON.parse(req);		

			mTarget = parData[0];
			amt = parData[1];
			fitnessDate02 = parData[2];

			if(amt >= 0)	amtTxt = format_number(amt)+' 원';
			else			amtTxt = '';

			$('#mTarget').val(mTarget);
			$('#mTargetTxt').text(mTarget);

			$('#programAmt').val(amt);
			$('#programAmtTxt').text(amtTxt);

			$('#payAmt').val(amt);

			$('#fpicker4').val(fitnessDate02);
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

			programChk();
		});
	}else{
		programChk();
	}
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}

		programAmt = $('#programAmt').val();
		$('#payAmt').val(programAmt);
		$('#fpicker2').val("<?=date('Y-m-d')?>");

		if(chk == 0 || chk == 1){
			$('#payColumn').html("<span class='eq'></span> 거래번호");
			$('#cardDiv').show();
			$('#cashDiv').hide();
			$('input[name^=cashBill]').prop('checked', false);
		}else if(chk == 2){
			$('#payColumn').html("<span class='eq'></span> 현금영수증");
			$('#cardDiv').hide();
			$('#cashDiv').show();
			$('#billNum').val('');
		}

	}else{
		$('#payAmt').val('');
		$('#fpicker2').val('');
		$('#payColumn').text('');
		$('#cardDiv').hide();
		$('#cashDiv').hide();
		$('#billNum').val('');
		$('input[name^=cashBill]').prop('checked', false);
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

	if(programAmt > 0){
		pchk01 = $('#pT1').is(":checked");
		pchk02 = $('#pT2').is(":checked");
		pchk03 = $('#pT3').is(":checked");

		if(pchk01 == false && pchk02 == false && pchk03 == false){
			GblMsgBox('결제수단을 선택해 주십시오.','');
			return;

		}else{
			if(isFrmEmptyModal(form.payAmt,"결제금액을 입력해 주십시오."))	return;
			if(form.payDate.value == ''){
				GblMsgBox('결제일을 입력해 주십시오.','');
				return;
			}

			if(pchk01 || pchk02){
				if(isFrmEmptyModal(form.billNum,"거래번호를 입력해 주십시오."))	return;
			}else if(pchk03){
				cchk01 = $('#cT1').is(":checked");
				cchk02 = $('#cT2').is(":checked");

				if(cchk01 == false && cchk02 == false){
					GblMsgBox('현금영수증 발행유무를 선택해 주십시오.','');
					return;
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

	if(programAmt > 0){
		pchk01 = $('#pT1').is(":checked");
		pchk02 = $('#pT2').is(":checked");
		pchk03 = $('#pT3').is(":checked");

		if(pchk01 == false && pchk02 == false && pchk03 == false){
			GblMsgBox('결제수단을 선택해 주십시오.','');
			return;

		}else{
			if(isFrmEmptyModal(form.payAmt,"결제금액을 입력해 주십시오."))	return;
			if(form.payDate.value == ''){
				GblMsgBox('결제일을 입력해 주십시오.','');
				return;
			}

			if(pchk01 || pchk02){
				if(isFrmEmptyModal(form.billNum,"거래번호를 입력해 주십시오."))	return;

			}else if(pchk03){
				cchk01 = $('#cT1').is(":checked");
				cchk02 = $('#cT2').is(":checked");

				if(cchk01 == false && cchk02 == false){
					GblMsgBox('현금영수증 발행유무를 선택해 주십시오.','');
					return;
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
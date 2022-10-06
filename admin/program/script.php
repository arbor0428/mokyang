<script language='javascript'>
function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	for(var i=0;i<eChk.length;i++){
		if(i == chk){
			eChk[i].checked = true;
		}else{
			eChk[i].checked = false;
		}
	}
}

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
		$('.defaultTime').hide();
		$('.fitnessTime').fadeIn();
		$('.periodTime01').hide();
	}else{
		$('.defaultTime').fadeIn();
		$('.fitnessTime').hide();
		$('.periodTime01').fadeIn();
	}

	//기간 selectbox 초기화
	$('#period').empty();
	$('#period').append("<option value=''>:: 선택 ::</option>");

	$('#aDateTxt').text('');
	$('#oDateTxt').text('');
	$('#eDateTxt').text('');
	$('#cDateTxt').text('');

	//기간
	$.post('json_period01.php',{'year':year,'season':season,'c1':c1}, function(req){
		//기간 selectbox 초기화
		$('#period').empty();
		$('#period').append("<option value=''>:: 선택 ::</option>");

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
	cade01 = $('#cade01').find('option:selected').val();
	period = $('#period').find('option:selected').val();

	$('#aDateTxt').text('');
	$('#oDateTxt').text('');
	$('#eDateTxt').text('');
	$('#cDateTxt').text('');

	//기간정보
	$.post('json_period02.php',{'year':year,'season':season,'cade01':cade01,'title':period}, function(c1){
		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		$('#aDateTxt').text(parData[0]);
		$('#oDateTxt').text(parData[1]);
		$('#eDateTxt').text(parData[2]);
		$('#cDateTxt').text(parData[3]);
	});

	yoilChk();
}

//교육횟수계산
function yoilChk(){
/*
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();
	period = $('#period').find('option:selected').val();

	eChk = document.getElementsByName('yoil[]');
	yoilList = '';

	for(var i=0;i<eChk.length;i++){
		if(eChk[i].checked){
			if(yoilList)	yoilList += ',';
			yoilList += eChk[i].value;
		}
	}

	$.post('json_eduNum.php',{'year':year,'season':season,'c1':c1,'title':period,'yoilList':yoilList}, function(cnt){
		$('#eduNum').val(cnt);
	});
*/
	//무조건 교육횟수는 12일 고정
	$('#eduNum').val('12');
}

function tutorSearch(){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_mlist' name='ifra_mlist' width='700' height='700' frameborder='0' scrolling='no'></iframe>";

	form = document.FRM;
	
	form.chkTutorName.value = form.tutor.value;
	form.chkTutorID.value = form.tutorID.value;

	form.target = 'ifra_mlist';
	form.action = '../tutor_list.php';
	form.submit();

	$(".multiBox_open").click();
}

function tutorInfo(uid){

	$('#tutorID').val('');
	$('#tutor').val('');

	if(uid){
		$('#tutorID').val(uid);

		$.post('tutorInfo.php',{'uid':uid}, function(req){
			req = urldecode(req);
			parData = JSON.parse(req);

			tutor = parData[0];
			tutorID = parData[1];

			$('#tutor').val(tutor);
			$('#tutorID').val(tutorID);
		});
	}
}

function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['pdf','hwp','doc']) == -1) {
			GblMsgBox('pdf, hwp, doc\n파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.FRM['upfile'+no];
			
			// 익스플로러일 경우
			if(browser=="Microsoft Internet Explorer"){
				var oas = new ActiveXObject("Scripting.FileSystemObject");
				fileSize = oas.getFile(file.value).size;

			// 익스플로러가 아닐경우			
			}else{
				fileSize = file.files[0].size;
			}

			fS = Math.round(fileSize / 1024);

			if(fS > 5120){
				GblMsgBox('5M이상의 파일은 등록할 수 없습니다.','');
				$("#upfile"+no).val('');
				$("#file_route"+no).val('');
				return;
			}
		}
	}

	$("#file_route"+no).val(upFile);
}

function programSearch(){
	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_plist' name='ifra_plist' width='900' height='700' frameborder='0' scrolling='no'></iframe>";

	form = document.FRM;
	
	form.target = 'ifra_plist';
	form.action = '../program_list.php';
	form.submit();

	$(".multiBox_open").click();
}

function programInfo(uid,title){
	form = document.FRM;
	form.pid.value = uid;
	form.pTitle.value = title;
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>



<?
	if($type == 'write'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.period,"기간을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.mTarget,"대상을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.mTargetEtc,"표기되는 대상문구를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"프로그램명을 입력해 주십시오."))	return;

	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();

	if(season != '상시'){
		if(isFrmEmptyModal(form.sEduHour,"교육시작 시간을 선택해 주십시오."))	return;
		if(isFrmEmptyModal(form.eEduHour,"교육종료 시간을 선택해 주십시오."))	return;

		eChk = document.getElementsByName('yoil[]');
		yoilChk = false;

		for(var i=0;i<eChk.length;i++){
			if(eChk[i].checked)	yoilChk = true;
		}

		if(yoilChk == false){
			GblMsgBox('요일을 선택해 주시기 바랍니다.','');
			return;
		}
	}

	if(season == '상시' && c1 == '휘트니스센터'){
	}else{
		if(isFrmEmptyModal(form.eduNum,"교육횟수를 입력해 주십시오."))	return;
	}

	if(isFrmEmptyModal(form.amt,"금액을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.room,"강의실을 선택해 주십시오."))	return;

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

	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.period,"기간을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.mTarget,"대상을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.mTargetEtc,"표기되는 대상문구를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"프로그램명을 입력해 주십시오."))	return;

	season = $('#season').find('option:selected').val();
	c1 = $('#cade01').find('option:selected').val();

	if(season != '상시'){
		if(isFrmEmptyModal(form.sEduHour,"교육시작 시간을 선택해 주십시오."))	return;
		if(isFrmEmptyModal(form.eEduHour,"교육종료 시간을 선택해 주십시오."))	return;

		eChk = document.getElementsByName('yoil[]');
		yoilChk = false;

		for(var i=0;i<eChk.length;i++){
			if(eChk[i].checked)	yoilChk = true;
		}

		if(yoilChk == false){
			GblMsgBox('요일을 선택해 주시기 바랍니다.','');
			return;
		}
	}


	if(season == '상시' && c1 == '휘트니스센터'){
	}else{
		if(isFrmEmptyModal(form.eduNum,"교육횟수를 입력해 주십시오."))	return;
	}

	if(isFrmEmptyModal(form.amt,"금액을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.room,"강의실을 선택해 주십시오."))	return;

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

function filedownload(){
	form = document.frm_filedown;
	form.target = 'ifra_gbl';
	form.action = '/module/download.php';
	form.submit();
}
</script>





<?
	}
?>
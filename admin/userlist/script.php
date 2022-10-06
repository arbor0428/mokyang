<!--
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
-->
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script language='javascript'>
function openDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.			
/*
			document.getElementById('zip01').value = data.postcode1;
			document.getElementById('zip02').value = data.postcode2;
*/
			document.getElementById('zipcode').value = data.zonecode;
			document.getElementById('addr01').value = fullAddr;
			document.getElementById('addr01').focus();
		}
	}).open();
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	for(var i=0;i<eChk.length;i++){
		if(i == chk){
			eChk[i].checked = true;
			$('.'+obj+i).css('color','#ff0000');
		}else{
			eChk[i].checked = false;
			$('.'+obj+i).css('color','#666666');
		}
	}

	if(obj == 'car'){
		if(eChk[1].checked == true)	$('#'+obj+'Box').fadeIn();
		else									$('#'+obj+'Box').hide();

	}else if(obj == 'userType'){
		if(eChk[1].checked == true){
			$('#saleBox01').fadeIn();
			$('#saleBox02').fadeIn();
		}else{
			$('#saleBox01').hide();
			$('#saleBox02').hide();
		}
	}
}

function setClickBox(obj){
	eChk = document.getElementsByName(obj);

	if(eChk[0].checked)	$('.'+obj).css('color','#ff0000');
	else						$('.'+obj).css('color','#666666');
}

function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg','gif','png']) == -1) {
			GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.','');
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
function checkID(c){
	form = document.FRM;

	if(isFrmEmptyModal(form.userid,"아이디를 입력해 주십시오."))	return true;

	ID = form.userid.value;

	for( var i=0 ; i < ID.length ; i++ ){
		if( i == 0 ){
			if( (ID.charAt(i) >= '0' && ID.charAt(i) <= '9') ){
				GblMsgBox("아이디 첫글자는 영문이어야 합니다.");
				form.userid.focus();
				return true;
			}
		}
	}

	if(!isAlphaModal(form.userid, "아이디는 영문자와 숫자만 입력해 주세요."))	return true;

	if(ID.length < 4 || ID.length > 12){
		GblMsgBox("아이디는 4~12자 이내입니다.");
		form.userid.focus();
		return true;
	}

	if(c){
		userid = $('#userid').val();

		$.post('../../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
			if(cnt != 0){
				GblMsgBox('사용할 수 없는 아이디입니다.','');
				form.userid.focus();

			}else{
				GblMsgBox('사용 가능한 아이디입니다.','');
				form.pwd.focus();
			}
		});
	}
}

function check_form(){
	form = document.FRM;

	//아이디 유효성검사
	if(checkID())	return;

	userid = $('#userid').val();

	$.post('../../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
		if(cnt != 0){
			GblMsgBox('사용할 수 없는 아이디입니다.','');
			form.userid.focus();

		}else{
			if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.re_pwd,"비밀번호를 한번더 입력해 주십시오."))	return;

			PWD = form.pwd.value;

			if(form.pwd.value != form.re_pwd.value){
				GblMsgBox("비밀번호를 확인해 주십시오.");
				form.re_pwd.focus();
				return;
			}

			if(PWD.length < 4 || PWD.length > 12){
				GblMsgBox("비밀번호는 4~12자 이내입니다.");
				form.pwd.focus();
				return;
			}

			if(isFrmEmptyModal(form.name,"성명을 입력해 주십시오."))	return;
			if(!isCheckModal(form.sex,"성별을 선택해 주십시오.")){
				$("#sexBox").attr("tabindex", -1).focus();
				return;
			}
			if(form.bDate.value == ''){
				GblMsgBox('생년월일을 입력해 주십시오.','');
				return;
			}
			if(!isCheckModal(form.userType,"감면대상자 구분을 선택해 주십시오.")){
				$("#userTypeBox").attr("tabindex", -1).focus();
				return;
			}
/*
			if($('#cT2').is(":checked")){
				if(isFrmEmptyModal(form.carNum,"차량번호를 입력해 주십시오."))	return;
			}
*/
//			if(isFrmEmptyModal(form.zipcode,"우편번호를 입력해 주십시오."))	return;
//			if(isFrmEmptyModal(form.addr01,"주소를 입력해 주십시오."))	return;
//			if(isFrmEmptyModal(form.addr02,"상세주소를 입력해 주십시오."))	return;
//			if(isFrmEmptyModal(form.email01,"이메일을 입력해 주십시오."))	return;
//			if(isFrmEmptyModal(form.email02,"이메일을 입력해 주십시오."))	return;

			if($('#email01').val() && $('#email02').val()){
				email = $('#email01').val()+'@'+$('#email02').val();
				okEmail = isEmailChk(email);
				if(!okEmail){
					GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
					$('#email01').focus();
					return;
				}
			}

			if(isFrmEmptyModal(form.phone01,"연락처를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.phone01Txt,"연락처의 관계를 입력해 주십시오."))	return;

/*
			c2 = $('#cC2').is(":checked");
			c3 = $('#cC3').is(":checked");
			c4 = $('#cC4').is(":checked");
			if(!c2 && !c3 && !c4){
				GblMsgBox('선호채널을 1개이상 선택해 주십시오.','');
				return;
			}
*/

/*
			chk04 = $('#sT4').is(":checked");
			if(chk04)	if(isFrmEmptyModal(form.healthBaby,"임신 주차수를 입력해 주십시오."))	return;
			chk05 = $('#sT5').is(":checked");
			if(chk05)	if(isFrmEmptyModal(form.healthEtc,"기타 내용을 입력해 주십시오."))	return;
*/

//			if(isFrmEmptyModal(form.joinType,"가입경로를 입력해 주십시오."))	return;	

			//감면대상자 > 일반
			if($('#squaredThree3').is(":checked")){
				$("#reduction option:eq(0)").attr("selected", "selected");
				$("#file_route01").val('');
				$("#upfile01").val('');
			}

			form.type.value = 'write';
			form.target = 'ifra_gbl';
			form.action = 'proc.php';
			form.submit();
		}
	});
}

function pwdChk(){
	pwd01 = $('#pwd').val();
	pwd02 = $('#re_pwd').val();

	pwdTxt = '';
	pwdColor = '#fff';

	if(pwd01 && pwd02){
		if(pwd01 == pwd02){
			pwdTxt = '비밀번호 일치';
			pwdColor = '#0000ff';
		}else{
			pwdTxt = '비밀번호 불일치';
			pwdColor = '#ff0000';
		}
	}

	$('#pwdTxt').css('color',pwdColor);
	$('#pwdTxt').text(pwdTxt);
}
</script>











<?
	}elseif($type == 'edit'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if($('#userid').val()){
		if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;
	}

	if(isFrmEmptyModal(form.name,"성명을 입력해 주십시오."))	return;
	if(!isCheckModal(form.sex,"성별을 선택해 주십시오.")){
		$("#sexBox").attr("tabindex", -1).focus();
		return;
	}
	if(form.bDate.value == ''){
		GblMsgBox('생년월일을 입력해 주십시오.','');
		return;
	}
	if(!isCheckModal(form.userType,"감면대상자 구분을 선택해 주십시오.")){
		$("#userTypeBox").attr("tabindex", -1).focus();
		return;
	}
/*
	if($('#cT2').is(":checked")){
		if(isFrmEmptyModal(form.carNum,"차량번호를 입력해 주십시오."))	return;
	}
*/
//	if(isFrmEmptyModal(form.zipcode,"우편번호를 입력해 주십시오."))	return;
//	if(isFrmEmptyModal(form.addr01,"주소를 입력해 주십시오."))	return;
//	if(isFrmEmptyModal(form.addr02,"상세주소를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.email01,"이메일을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.email02,"이메일을 입력해 주십시오."))	return;

	if($('#email01').val() && $('#email02').val()){
		email = $('#email01').val()+'@'+$('#email02').val();
		okEmail = isEmailChk(email);
		if(!okEmail){
			GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
			$('#email01').focus();
			return;
		}
	}

	if(isFrmEmptyModal(form.phone01,"연락처를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.phone01Txt,"연락처1의 관계를 입력해 주십시오."))	return;

/*
	c2 = $('#cC2').is(":checked");
	c3 = $('#cC3').is(":checked");
	c4 = $('#cC4').is(":checked");
	if(!c2 && !c3 && !c4){
		GblMsgBox('선호채널을 1개이상 선택해 주십시오.','');
		return;
	}
*/

/*
	chk04 = $('#sT4').is(":checked");
	if(chk04)	if(isFrmEmptyModal(form.healthBaby,"임신 주차수를 입력해 주십시오."))	return;
	chk05 = $('#sT5').is(":checked");
	if(chk05)	if(isFrmEmptyModal(form.healthEtc,"기타 내용을 입력해 주십시오."))	return;
*/

//	if(isFrmEmptyModal(form.joinType,"가입경로를 입력해 주십시오."))	return;	

	//감면대상자 > 일반
	if($('#squaredThree3').is(":checked")){
		$("#reduction option:eq(0)").attr("selected", "selected");
		$("#file_route01").val('');
		$("#upfile01").val('');

		if($("#dbfile01").val()){
			$('#fDel').prop('checked', true);
		}
	}

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 이용자 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
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

function smsPhone(){
	form = document.FRM;
	if(isFrmEmptyModal(form.phone01,"연락처를 입력해 주십시오."))	return;

	document.getElementById("multiFrame").innerHTML = "<iframe src='about:blank' id='ifra_slist' class='bgtp' name='ifra_slist' width='260' height='530' frameborder='0' scrolling='auto'></iframe>";

	form.target = 'ifra_slist';
	form.action = '/module/smsPhone.php';
	form.submit();

	$(".multiBox_open").click();

	$('.bgtp').parents('.popup_background').css({'background':'transparent'})
}
</script>





<?
	}
?>
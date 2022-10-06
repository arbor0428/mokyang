<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<script>
function secede(uid){
	form = document.FRM;
	form.uid.value = uid;
	document.getElementById("multiFrame").innerHTML = "<iframe src='/member/secede.php?uid="+uid+"' width='600' height='240' frameborder='0' scrolling='no'></iframe>";
	$(".multiBox_open").click();
}
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

		$.post('../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
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

}
function join_form(){
	form = document.FRM;

	if($('#ot1').is(":checked") == false){
		GblMsgBox('이용약관에 동의해 주십시오.','');
		return;
	}

	if($('#ot2').is(":checked") == false){
		GblMsgBox('개인정보처리방침에 동의해 주십시오.','');
		return;
	}
	form.action = 'join2.php';
	form.submit();
}

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
			document.getElementById('addr02').focus();
		}
	}).open();
}
</script>

<?
	if($type=='write'){
?>
<script>
function check_form(){
	form = document.FRM;

	//아이디 유효성검사
	if(checkID())	return;

	userid = $('#userid').val();

	$.post('../module/common/UserIdCheck.php',{'userid':userid}, function(cnt){
		if(cnt != 0){
			GblMsgBox('사용할 수 없는 아이디입니다.','');
			form.userid.focus();

		}else{
			if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;
			PWD = form.pwd.value;
			if(PWD.length < 6 || PWD.length > 10){
				GblMsgBox("비밀번호는 6~10자 이내입니다.");
				form.pwd.focus();
				return;
			}

			if(isFrmEmptyModal(form.re_pwd,"비밀번호를 한번더 입력해 주십시오."))	return;			

			if(form.pwd.value != form.re_pwd.value){
				GblMsgBox("비밀번호를 확인해 주십시오.");
				form.re_pwd.focus();
				return;
			}

			if(isFrmEmptyModal(form.name,"회원명을 입력해 주십시오."))	return;
			if(!isCheckModal(form.gender,"성별을 선택해 주십시오.")){
				$("#genderBox").attr("tabindex", -1).focus();
				return;
			}
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
			if(form.bDate.value == ''){
				GblMsgBox('생년월일을 입력해 주십시오.','');
				return;
			}

			if(isFrmEmptyModal(form.phone,"연락처를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.company,"소속명을 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.zipcode,"우편번호를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.addr01,"기본주소를 입력해 주십시오."))	return;
			if(isFrmEmptyModal(form.addr02,"상세주소를 입력해 주십시오."))	return;





			form.type.value = 'write';
			form.target = 'ifra_gbl';
			form.action = 'joinProc.php';
			form.submit();
		}
	});
}
</script>

<?
	}else{
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오."))	return;


	PWD = form.new_pwd.value;

	if(PWD){
		if(isFrmEmptyModal(form.new_pwd,"비밀번호를 입력해 주십시오."))	return;
		if(isFrmEmptyModal(form.re_new_pwd,"비밀번호를 한번더 입력해 주십시오."))	return;

		if(PWD.length < 6 || PWD.length > 10){
			GblMsgBox("비밀번호는 6~10자 이내입니다.");
			form.new_pwd.focus();
			return;
		}

		if(form.new_pwd.value != form.re_new_pwd.value){
			GblMsgBox("비밀번호를 확인해 주십시오.");
			form.re_new_pwd.focus();
			return;
		}
	}


	if(isFrmEmptyModal(form.name,"회원명을 입력해 주십시오."))	return;
	if(!isCheckModal(form.gender,"성별을 선택해 주십시오.")){
		$("#genderBox").attr("tabindex", -1).focus();
		return;
	}
	if(form.bDate.value == ''){
		GblMsgBox('생년월일을 입력해 주십시오.','');
		return;
	}


	if(isFrmEmptyModal(form.zipcode,"우편번호를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.addr01,"기본주소를 입력해 주십시오."))	return;

	if($('#email01').val() && $('#email02').val()){
		email = $('#email01').val()+'@'+$('#email02').val();
		okEmail = isEmailChk(email);
		if(!okEmail){
			GblMsgBox('이메일을 정확히 기재해 주시기 바랍니다.');
			$('#email01').focus();
			return;
		}
	}

	if(isFrmEmptyModal(form.phone,"연락처1을 입력해 주십시오."))	return;

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'joinProc.php';
	form.submit();
}
</script>
<?
	}
?>
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
			document.getElementById('addr02').focus();
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
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.name,"회원명을 입력해 주십시오."))	return;
	if(!isCheckModal(form.gender,"성별을 선택해 주십시오.")){
		$("#sexBox").attr("tabindex", -1).focus();
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

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 회원 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.FRM;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>
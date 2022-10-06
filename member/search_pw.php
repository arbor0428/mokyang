<?

	include'../header.php';


	if($GBL_USERID){
		Msg::goMsg("로그아웃 후 이용해주시기 바랍니다.", "/");
	}
?>
<script language="javascript">
function searchPWD(){
	frm = document.frm01;
	if(isFrmEmptyModal(frm.f_userid, "아이디를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(frm.f_name, "이름을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(frm.f_phone, "연락처를 입력해 주십시오."))	return;

	id = setTimeout(function(){
		var params = jQuery("#frm01").serialize();
		jQuery.ajax({
			url: '../module/searchPWD.php',
			type: 'POST',
			data:params,
			dataType: 'html',
			success: function(result){
				if(result){
					GblMsgBox('고객님의 이메일로 신규 비밀번호가 발급되었습니다.\n\n비밀번호 찾기의 이메일을 받지 못한 경우 문의 바랍니다.',"location.href='/';");
					return;

				}else{
					GblMsgBox('입력하신 정보와 일치하는 회원 정보가 없습니다.','');
					return;
				}
			},
			error: function(error){
				GblMsgBox('전송오류');
				return;
			}
		});
	}, 100);
}
</script>


			

<div class="center sub">
	<form name='frm01' id='frm01' method='post' action=''>
	<input type='text' style='display:none;'>


		<div class="logins member-cont">
			<div class="input-area clearfix" >
				<p class="member-title m_66">비밀번호 찾기</p>

				<div class='login-wraps clearfix'>
					<div class="box">
						<input class="" style='' name="f_userid" type="text" value="" placeholder='아이디' onkeypress="if(event.keyCode==13){login_check();}">
						<input class="" style='' name="f_name" type="text" value="" placeholder='이름' onkeypress="if(event.keyCode==13){login_check();}">
						<input class="pw_ip" style='' name="f_phone" type="text" value="" placeholder='연락처' onkeypress="if(event.keyCode==13){login_check();}">
					</div>
					<a href="javascript:searchPWD();" class="member-login-btn">확인</a>
					
					<div class="box txt_c">
						<a href='./search_id.php' class="member-btn">아이디를 잊으셨습니까?</a>
						<a href='./join1.php' class="member-btn">회원가입 하시겠습니까?</a>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
			


<?
	include'../footer.php';
?>
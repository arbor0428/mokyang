<script language='javascript'>
function Change_password(){
	form = document.FRM;
	PWD = form.new_pwd.value;

	if(isFrmEmptyModal(form.old_pwd,"현재 비밀번호를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.new_pwd,"새 비밀번호를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.re_pwd,"새 비밀번호 확인을 입력해 주십시오"))	return;

	if(PWD.length < 4 || PWD.length > 12){
		GblMsgBox('비밀번호는 4~12자 이내입니다','');
		form.new_pwd.focus();
		return;
	}

	if(form.new_pwd.value != form.re_pwd.value){
		GblMsgBox('변경하실 비밀번호를 확인해 주십시오','');
		form.re_pwd.focus();
		return;
	}	

	form.submit();
}
</script>

<form name='FRM' method='post' action='form_proc.php'>
<input type='text' style='display:none;'>

<table cellpadding='0' cellspacing='0' border='0' class='gTable' style='width:600px !important;'>
	<tr>
		<th width='20%'><span class="smooth dp_ir">관리자 ID</span></th>
		<td width='80%'><?=$GBL_USERID?></td>
	</tr>

	<tr>
		<th><span class="smooth dp_ir">현재 비밀번호</span></th>
		<td><input type='password' name='old_pwd' style='width:150px;'></td>
	</tr>

	<tr>
		<th><span class="smooth dp_ir">신규 비밀번호</span></th>
		<td><input type='password' name='new_pwd' style='width:150px;'></td>
	</tr>

	<tr>
		<th><span class="smooth dp_ir">비밀번호 확인</span></th>
		<td><input type='password' name='re_pwd' style='width:150px;'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='600'>
	<tr>
		<td align='center' style='padding:30px 0;'><a href="javascript:Change_password();" class='big cbtn black'>수정하기</a></td>
	</tr>
</table>

</form>
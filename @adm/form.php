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

	form.target = 'ifra_gbl';
	form.action = 'form_proc.php';
	form.submit();
}
</script>

<form name='FRM' method='post'>
<input type='text' style='display:none;'>

<table cellpadding='0' cellspacing='0' border='0' class='gTable' style='width:1200px !important;'>
	<tr>
		<th width='20%'>관리자 ID</th>
		<td width='80%'><?=$GBL_USERID?></td>
	</tr>

	<tr>
		<th>현재 비밀번호</th>
		<td><input type='password' name='old_pwd' class='form-control' style='width:150px;'></td>
	</tr>

	<tr>
		<th>신규 비밀번호</th>
		<td><input type='password' name='new_pwd' class='form-control'style='width:150px;'></td>
	</tr>

	<tr>
		<th>비밀번호 확인</th>
		<td><input type='password' name='re_pwd' class='form-control' style='width:150px;'></td>
	</tr>
</table>

<table cellpadding='0' cellspacing='0' border='0' width='1200px'>
	<tr>
		<td align='right' style='padding:20px 0;'><a href="javascript:Change_password();" class='btn blk'>수정하기</a></td>
	</tr>
</table>

</form>
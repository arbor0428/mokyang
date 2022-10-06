<?
	$loginTitle = '리라이브치과';
?>

<script language='javascript'>
function Admin_Login(){
	form = document.LOG;

	if(isFrmEmptyModal(form.userid,"아이디를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.pwd,"비밀번호를 입력해 주십시오"))	return;

	form.target = 'ifra_gbl';
	form.submit();
}

function is_Key(){
	if(event.keyCode==13)	Admin_Login();
}
</script>
<style>
html,body{width:100%;height:100%;background:#eff4f1;}

.ad-login-bt {width:120px;height:78px;background:#6e9e86;line-height:80px;color:#ffffff;border-radius:4px; text-align:center; cursor:pointer;}
.form-group-2 {width:100%;height:35px;border:1px solid #e1e1e1; border-radius:4px; padding-left:5px; box-sizing:border-box;}

.form-group-2:focus {
  background-color: #fff;
  outline: 0;
  box-shadow: 0 0 0 0.2rem rgba(196, 216, 206, .5);
}

</style>

<body onload="document.LOG.userid.focus();">

<form name='LOG' method='post' action='/module/login/login_proc.php'>
<input type='text' style='display:none;'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" style='margin-top:150px;'>
			<tr>
				<td align="center" valign="middle">
					<!--
					<div style="font-size:35px;color:#333333;line-height:1.3;"><span style='font-weight:bold;'><?=$loginTitle?></span><br>관리자 페이지입니다.</div>
					-->
					<div class="txt-c">
						<img src="/images/adm-logo.png" alt="리라이브치과">
					</div>
					<div style="font-size:1rem;color:#888888;margin:20px 0 50px;line-height:1.5;">
						관리자 아이디와 비밀번호를 입력하세요.
					</div>

					<table width="100%" height="221" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center">
								<table style='width:650px;height:250px;background:#fff; border-radius:12px;' border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td height="86" align="center">
											<table width="400" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="209">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<!--<td>ID</td>-->
																<td width="8"></td>
																<td><input type='text' name='userid' id='userid' class="form-group-2" onkeypress="if(event.keyCode==13){Admin_Login();}" placeholder="ID"></td>
															</tr>
															<tr>
																<td height="10"></td>
																<td height="10"></td>
															</tr>
															<tr>
																<!--<td>PASSWORD</td>-->
																<td width="8"></td>
																<td><input type='password' name='pwd' id='pwd' class="form-group-2" onkeypress="if(event.keyCode==13){Admin_Login();}" placeholder="PASSWORD"></td>
															</tr>
														</table>
													</td>

													<td width="60" align="right"><div class="ad-login-bt" onclick='Admin_Login();'>로그인</div></td>
												</tr>
											</table>
										</td>
									</tr>

								</table>
							</tr>
						</td>
					</table>


				</td>
			</tr>
		</table>

</form>

<?
	include 'footer.php';
?>
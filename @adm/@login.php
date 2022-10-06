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
html,body{width:100%;height:100%;}
</style>

<body onload="document.LOG.userid.focus();">

<form name='LOG' method='post' action='/module/login/login_proc.php'>
<input type='text' style='display:none;'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" style='margin-top:150px;'>
			<tr>
				<td align="center" valign="middle">
					<div style="font-size:35px;color:#333333;line-height:1.3;"><span style='font-weight:bold;'><?=$loginTitle?></span><br>관리자 페이지입니다.</div>
					<div style="font-size:16px;color:#888888;margin:20px 0 50px;line-height:1.5;">
						관리자 아이디와 비밀번호를 입력하세요.
					</div>

					<table width="100%" height="221" border="0" cellpadding="0" cellspacing="0">
						<tr>
							<td align="center">
								<table style='width:650px;height:250px;background:#efefef;border-bottom:2px solid #dddddd;' border="0" cellspacing="0" cellpadding="0">
									<tr>
										<td height="86" align="center">
											<table width="400" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td width="209">
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td>아이디</td>
																<td width="8"></td>
																<td><input type='text' name='userid' id='userid' style='width:200px;height:35px;border:none;border-top:2px solid #dddddd;padding-left:5px;'onkeypress="if(event.keyCode==13){Admin_Login();}"></td>
															</tr>
															<tr>
																<td height="10"></td>
																<td height="10"></td>
															</tr>
															<tr>
																<td>비밀번호</td>
																<td width="8"></td>
																<td><input type='password' name='pwd' id='pwd' style='width:200px;height:35px;border:none;border-top:2px solid #dddddd;' onkeypress="if(event.keyCode==13){Admin_Login();}"></td>
															</tr>
														</table>
													</td>

													<td width="60" align="right"><div style='width:100px;height:78px;background:#46748c;line-height:80px;color:#ffffff;text-align:center;border-bottom:2px solid #314e5c;cursor:pointer;' onclick='Admin_Login();'>로그인</div></td>
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
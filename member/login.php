<?
	include'../header.php';
	include './script.php';

	if($GBL_USERID){
		Msg::goNext("/");
	}
?>



<script>
function login_check(){
	form = document.LOG;
	if(isFrmEmptyModal(form.userid, "아이디를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.pwd, "비밀번호를 입력해 주십시오"))	return;

	if(isObject(form.isSave)){
		if(form.isSave.checked==true){
			setCookie("save_userid", "Y", 1);
			setCookie("ck_userid", form.userid.value, 1);
		}else{
			setCookie("save_userid", "", 1);
		}
	}

	form.target = 'ifra_gbl';
	form.action = '/module/login/login_proc.php';
	form.submit();
}
</script>

<div class="center sub">
	<form name='LOG' method='post' action=''>				
		<div class="logins member-cont">
			<div class="input-area clearfix" >
				<p class="member-title">로그인</p>

				<div class='login-wraps clearfix'>
					<div class='login-btn-wrap clearfix'>
						<div class="login-btn">
							<div class="squared">
								<input type="checkbox" name='ssl' value='1' id="squared2" checked onclick="return false" class="cb20">
							</div>
							<label for="squared2"><p style="margin-left:5px;">보안로그인</p></label>
						</div>

						<div class="login-btn">
							<div class="squared">
								<input type="checkbox" value="None" id="squared" name="isSave"  class="cb20">
							</div>
							<label for="squared"><p style="margin-left:5px;">아이디 저장</p></label>
						</div>
					</div>
				
					


					<div class="box">
						<input class="" style="ime-mode:disabled;" name="userid" id="userid" type="text" value="" placeholder='아이디' onkeypress="if(event.keyCode==13){login_check();}">
						<input class="" style="margin-top:10px;" name="pwd" id="pwd" type="password" value="" placeholder='비밀번호' onkeypress="if(event.keyCode==13){login_check();}">
					</div>

					<div class="box txt_c">
						<a href="search_id.php" class="member-btn">아이디를 잊으셨습니까?</a>
						<a href="search_pw.php" class="member-btn">비밀번호를 잊으셨습니까?</a>
					</div>

					<a href="javascript:login_check();" class="member-login-btn">로그인</a>
		

					

				</div>
			</div>
		</div>
	</form>
</div>

<script>
if('<?=$GBL_USERID?>' == ''){
	set_auto('0');
}
</script>

<?
	include'../footer.php';
?>
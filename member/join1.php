<?
	include'../header.php';
	include './script.php';
?>

<script>
function frmCheck(){
	if($('#ot1').is(":checked") == false){
		GblMsgBox('이용약관에 동의해 주시기 바랍니다.');
		$('#ot1').focus();
		return;
	}

	if($('#ot2').is(":checked") == false){
		GblMsgBox('개인정보처리방침에 동의해 주시기 바랍니다.');
		$('#ot2').focus();
		return;
	}

	location.href = 'join2.php';
}
</script>

<div class="center sub member-area">
	<div class="joins member-cont">
		<div class="member-title m_66">회원가입</div>
		<form name='frm01' id='frm01' method='post' action=''>
		<input type='text' style='display:none;'>

		<div class="list member-titles">
			이용약관
		</div>

		<div class="member-area wrap_">		
		<?
			//이용약관내용
			include 'useHtml.php';
		?>
		</div>

		<div class="agree_wrap clearfix" style='margin-top:10px;'>
			<div class="fr">
				<div class="squared"><input type="checkbox" value="1" id="ot1" name="ok01" class="cb20"></div>
				<div class="agreeex"><label for="ot1">위 이용약관에 동의합니다.</label></div>
			</div>
		</div>

		<div class="list member-titles">
			개인정보처리방침
		</div>

		<div class="member-area wrap_">		
		<?
			//이용약관내용
			include 'policyHtml.php';
		?>
		</div>

		<div class="agree_wrap clearfix" style='margin-top:10px;'>
			<div class="fr">
				<div class="squared"><input type="checkbox" value="1" id="ot2" name="ok02" class="cb20"></div>
				<div class="agreeex"><label for="ot2">위 개인정보 수집 및 활용에 동의합니다.</label></div>
			</div>
		</div>
		</form>
		<div style='margin:0 auto;text-align:center;'>
			<!--<a href='javascript:join_form();' class="go-btn">-->
			<a href='javascript:frmCheck();' class="go-btn">
				회원가입
			</a>
		</div>
	</div>
	
	</form>
</div>


<?
	include'../footer.php';
?>
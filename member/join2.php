<?
	include'../header.php';
	
	//제이쿼리 달력
	$sRange = '90';
	$eRange = '0';
	include '../module/Calendar.php';

	if($GBL_USERID)		$type = 'edit';
	else						$type = 'write';
?>


<div class="center sub member-area">
	<div class="bg joinForm member-cont">
		<form name='FRM' id='FRM' method='post' action=''>
			<input type='hidden' name='mtype' id='mtype' value='M'>
			<input type='hidden' name='type' id='type' value='<?=$type?>'>
		

			<?
				include './script.php';
				include'joinForm.php';
			?>


			<div style='margin:0 auto;text-align:center;'>
			<?if($type == 'write'){?>
				<a href='javascript:check_form()' class="go-btn">회원가입</a>
			<?}elseif($type == 'edit'){?>
				<a href='javascript:check_form()' class="go-btn">정보수정</a>
			<?}?>
				<a href='javascript:history.back();' class="gry go-btn" style="margin-left:10px;">취소</a>
			</div>
		</form>
	</div>
</div>


<?
	include'../footer.php';
?>
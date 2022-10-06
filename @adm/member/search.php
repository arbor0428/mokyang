<?
	//제이쿼리 달력
	$sRange = date('Y') - 2018;
	$eRange = '1';
	include '../../module/Calendar.php';
?>

<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	$('#sChk0').prop('checked', true);
	$('#mChk0').prop('checked', true);

	form.f_manager.selectedIndex = 0;
	form.f_userid.value = '';
	form.f_name.value = '';
	form.f_email.value = '';
	form.f_mobile01.selectedIndex = 0;
	form.f_mobile02.value = '';
	form.f_mobile03.value = '';

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>상 태</th>
					<td colspan='3'>
						<label for="sChk0"><input type="radio" name="f_status" id="sChk0" value="" <?if($f_status == ''){echo 'checked';}?>> <span class='ico10' style='cursor:pointer;'>전체</span></label>&nbsp;&nbsp;&nbsp;
						<label for="sChk1"><input type="radio" name="f_status" id="sChk1" value="1" <?if($f_status == '1'){echo 'checked';}?>> <span class='ico06' style='cursor:pointer;'>승인</span></label>&nbsp;&nbsp;&nbsp;
						<label for="sChk2"><input type="radio" name="f_status" id="sChk2" value="2" <?if($f_status == '2'){echo 'checked';}?>> <span class='ico09' style='cursor:pointer;'>미승인</span></label>
					</td>
				</tr>
				<tr>
					<th>아이디</th>
					<td><input name="f_userid" type="text" style='width:200px;' value='<?=$f_userid?>' class='textBox01' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th>성 명</th>
					<td><input name="f_name" type="text" style='width:200px;' value='<?=$f_name?>' class='textBox01' onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>
				<tr>
					<th>이메일</th>
					<td><input name="f_email" type="text" style='width:200px;' value='<?=$f_email?>' class='textBox01' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th>연락처</th>
					<td>
						<select name='f_mobile01' id='f_mobile01' style='width:80px;padding-left:10px;font-size:16px;color:#777;' class='selectBox'>
							<option value=''>==</option>
							<option value='010' <?if($f_mobile01 == '010'){echo 'selected';}?>>010</option>
							<option value='011' <?if($f_mobile01 == '011'){echo 'selected';}?>>011</option>
							<option value='016' <?if($f_mobile01 == '016'){echo 'selected';}?>>016</option>
							<option value='017' <?if($f_mobile01 == '017'){echo 'selected';}?>>017</option>
							<option value='018' <?if($f_mobile01 == '018'){echo 'selected';}?>>018</option>
							<option value='019' <?if($f_mobile01 == '019'){echo 'selected';}?>>019</option>
						</select> - 
						<input type="text" name="f_mobile02" id="f_mobile02" style="width:70px;" value="<?=$f_mobile02?>" maxlength='4' class="textBox01 numberOnly"> - 
						<input type="text" name="f_mobile03" id="f_mobile03" style="width:70px;" value="<?=$f_mobile03?>" maxlength='4' class="textBox01 numberOnly">
					</td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td align='center' style="padding:10px 0 50px 0;">
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>
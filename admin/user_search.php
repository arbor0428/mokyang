<script language='javascript'>
function go_search(){
	form = document.form1;
	form.type.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.form1;

	form.f_name.value = '';
	form.f_userNum.value = '';

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
					<th width='17%'>회원명</th>
					<td width='33%'><input name="f_name" type="text" style='width:100%;' value='<?=$f_name?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>회원번호</th>
					<td width='33%'><input name="f_userNum" type="text" style='width:100%;' value='<?=$f_userNum?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'>
			<a href='javascript:go_search();' class='small cbtn black'>검색</a>
		</td>
	</tr>						
</table>

<br><br>
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

	form.f_cade01.selectedIndex = 0;
	form.f_title.value = '';
	form.f_tutor.value = '';

	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>종목명</th>
					<td colspan='3'>
						<select name='f_cade01'>
							<option value=''>:: 전체 ::</option>
							<option value='어학' <?if($f_cade01 == '어학'){echo 'selected';}?>>어학</option>
							<option value='음악' <?if($f_cade01 == '음악'){echo 'selected';}?>>음악</option>
							<option value='국악' <?if($f_cade01 == '국악'){echo 'selected';}?>>국악</option>
							<option value='무용' <?if($f_cade01 == '무용'){echo 'selected';}?>>무용</option>
							<option value='역학' <?if($f_cade01 == '역학'){echo 'selected';}?>>역학</option>
							<option value='미술' <?if($f_cade01 == '미술'){echo 'selected';}?>>미술</option>
						</select>
					</td>
				</tr>
				<tr>
					<th width='17%'>강습반명</th>
					<td width='33%'><input name="f_title" type="text" style='width:150px;' value="<?=$f_title?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>강사명</th>
					<td width='33%'><input name="f_tutor" type="text" style='width:150px;' value="<?=$f_tutor?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'>
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>
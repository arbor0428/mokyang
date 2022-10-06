<script language="JavaScript">
function go_search(){
	form = document.frm_list;

	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function is_Key(){
	if(event.keyCode==13)	go_search();
}
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr>
					<th>전송연월</th>
					<td colspan='3'>
						<select name='f_year'>
					<?
						for($i=2011; $i<=date('Y'); $i++){
							if($i == $f_year)	$chk = 'selected';
							else	$chk = '';

							echo ("<option value='$i' $chk>$i</option>");
						}
					?>
						</select>년
						<select name='f_month'>
					<?
						for($i=1; $i<=12; $i++){
							if($i == $f_month)	$chk = 'selected';
							else	$chk = '';

							$no = sprintf('%02d',$i);

							echo ("<option value='$no' $chk>$i</option>");
						}
					?>
						</select>월
					</td>
				</tr>

				<tr>
					<th width='15%'>메세지</th>
					<td width='35%'><input name='f_msg' type='text' style='width:180px;' value='<?=$f_msg?>' onfocus='inputFocus(this)' onblur='inputBlur(this)' onkeypress='is_Key();'></td>
					<th width='15%'>수신번호</th>
					<td width='35%'><input name='f_phone' type='text' style='width:180px;' value='<?=$f_phone?>' onfocus='inputFocus(this)' onblur='inputBlur(this)' onkeypress='is_Key();'></td>
				</tr>


			</table>
		<!-- /검색부분 -->
		</td>
	</tr>						
	<tr>
		<td align='center' style='padding-top:10px;'><a href='javascript:go_search();' class='small cbtn black'>검색</a></td>
	</tr>						
</table>
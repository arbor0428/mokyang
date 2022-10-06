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
					<th>검색기간</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='f_payDate01' id='fpicker1' value='<?=$f_payDate01?>' readonly> ~ 
									<input type='text' name='f_payDate02' id='fpicker2' value='<?=$f_payDate02?>' readonly>
								</td>
								<td style='padding:0 0 0 20px;'>
									<a href="javascript:SetYesterday();" class="small cbtn black">어제</a>
									<a href="javascript:SetToday();" class="small cbtn black">금일</a>
									<a href="javascript:SetWeek();" class="small cbtn black">이번주</a>
									<a href="javascript:SetPrevMonthDays();" class="small cbtn black">지난달</a>
									<a href="javascript:SetCurrentMonthDays();" class="small cbtn black">이번달</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th width='17%'>카드번호</th>
					<td width='33%'><input name="f_cdno" type="text" style='width:100%;' value='<?=$f_cdno?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>승인번호</th>
					<td width='33%'><input name="f_authno" type="text" style='width:100%;' value='<?=$f_authno?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
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
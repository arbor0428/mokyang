<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_status[0].checked = true;
	form.f_rType[0].checked = true;
	form.f_team.value = '';
	form.f_name.value = '';
	form.f_title.value = '';
	form.f_staff.value = '';

	form.record_start.value = '';
	form.taget = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}


</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>상태</th>
					<td colspan='3'>
						<input type='radio' name='f_status' value='' <?if($f_status == ''){echo 'checked';}?>> <span class='ico10' style='display:inline !important;'>전체</span>&nbsp;&nbsp;
						<input type='radio' name='f_status' value='접수' <?if($f_status == '접수'){echo 'checked';}?>> <span class='ico01' style='display:inline !important;'>접수</span>&nbsp;&nbsp;
						<input type='radio' name='f_status' value='심사중' <?if($f_status == '심사중'){echo 'checked';}?>> <span class='ico03' style='display:inline !important;'>심사중</span>&nbsp;&nbsp;
						<input type='radio' name='f_status' value='승인' <?if($f_status == '승인'){echo 'checked';}?>> <span class='ico04' style='display:inline !important;'>승인</span>&nbsp;&nbsp;
						<input type='radio' name='f_status' value='미승인' <?if($f_status == '미승인'){echo 'checked';}?>> <span class='ico09' style='display:inline !important;'>미승인</span>&nbsp;&nbsp;
						<input type='radio' name='f_status' value='취소' <?if($f_status == '취소'){echo 'checked';}?>> <span class='ico07' style='display:inline !important;'>취소</span>
					</td>
				</tr>

				<!--tr>
					<th>구분</th>
					<td colspan='3'>
						<input type='radio' name='f_rType' value='' <?if($f_rType == ''){echo 'checked';}?>> <span class='ico10' style='display:inline !important;'>전체</span>&nbsp;&nbsp;
						<input type='radio' name='f_rType' value='art' <?if($f_rType == 'art'){echo 'checked';}?>> <span class='ico05' style='display:inline !important;'>예술회관</span>&nbsp;&nbsp;
						<input type='radio' name='f_rType' value='forest' <?if($f_rType == 'forest'){echo 'checked';}?>> <span class='ico02' style='display:inline !important;'>숲속극장</span>
					</td>
				</tr-->

				<tr>
					<th>단체명</th>
					<td colspan='3'><input type='text' name='f_team' style='width:190px;' value='<?=$f_team?>'></td>
				</tr>

				<tr>
					<th width='17%'>대표자</th>
					<td width='33%'><input type='text' name='f_name' style='width:190px;' value='<?=$f_name?>'></td>
					<th width='17%'>신청인</th>
					<td width='33%'><input type='text' name='f_staff' style='width:190px;' value='<?=$f_staff?>'></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'><a href='javascript:go_search();'><img src="/images/common/search.gif" alt="검색"></a> <a href='javascript:reset_search();'><img src="/images/common/reset.gif" alt="초기화"></a></td>
	</tr>						
</table>

<br><br>
<script language='javascript'>
function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.taget = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_userid.value = '';
	form.f_name.value = '';

	form.record_start.value = '';
	form.taget = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}


</script>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr>
					<th width='17%'>아이디</th>
					<td width='33%'><input type='text' name='f_userid' style='width:190px;' value='<?=$f_userid?>'></td>
					<th width='17%'>회원명</th>
					<td width='33%'><input type='text' name='f_name' style='width:190px;' value='<?=$f_name?>'></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'><a href='javascript:go_search();'><img src="/images/common/search.gif" alt="검색"></a> <a href='javascript:reset_search();'><img src="/images/common/reset.gif" alt="초기화"></a></td>
	</tr>						
</table>

<br><br>
<script language='javascript'>
function setCalendar(y,m){
	form = document.frm01;
	form.year.value = y;
	form.month.value = m;
	form.day.value = '1';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_view(uid,cno){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.cno.value = cno;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function show_view(uid){
	location.href = '/sub01/sub01.php?type=view&uid='+uid;
}


function error_msg(mod){
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}

</script>

<?
	if(!$c_path) $c_path=$calendarRoot;	//달력폴더경로
	if(!$calendarFile)	$calendarFile = 'calendar01.php';
	if(!$cellh)	$cellh = '70';	// date cell height
	if(!$tablew)	$tablew = '100%';	// table width

	//글쓰기 권한확인
	include $boardRoot.'chk_write.php';

	$write_chk = $chk_type;


	echo ("<script lnaguage='javascript'>");

	if($write_chk == 'ok'){
		echo ("
			function reg_register(y,m,d){
				form = document.frm01;
				form.type.value = 'write';
				form.year.value = y;
				form.month.value = m;
				form.day.value = d;
				form.action = '$PHP_SELF';
				form.submit();
			}");

	}else{
		echo ("
			function reg_register(){
				return;
			}");
	}

	echo ("</script>");
?>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->

<input type='hidden' name='cno' value=''><!-- 상세페이지에서 게시물번호용 -->


<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'> 

	<tr>
		<td>
		<?
			include $calendarRoot.'calendar01.php';
		?>
		</td>
	</tr>

</table>


<input type='hidden' name='year' value='<?=$year?>'>
<input type='hidden' name='month' value='<?=$month?>'>
<input type='hidden' name='day' value=''>

</form>
<script language='javascript'>

function click_del(txt,uid){

	if(confirm(txt+' 글을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

	

}


function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 글을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 글을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();

	}

}


function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
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

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
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


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>



<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0"> 

	<tr>
		<td>

<?
if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
?>
		<a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='전체선택'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='선택삭제'></a>
<?
}
?>
		</td>
		<td width='50%' height='30' align='right'>
			<select name="field">
				<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
				<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>
				<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
			</select>
			<input name="word" type="text" size="20" value='<?=$word?>'> <a href='javascript:document.frm01.submit();'><img src='<?=$BTN_search?>' align='absmiddle' alt='검색'></a>
		</td>
	</tr>
	<tr> 
		<td bgcolor="cccccc"  height="2" colspan="2"></td>
	</tr>
	<tr>
		<td colspan='2'>
			<table width="100%" border="0" cellspacing="0" cellpadding="3" class='s2' style="position:relative;" id='list_table'>

<?
if($GBL_MTYPE == 'A'){
	$cols = '7';
?>

				<tr bgcolor="676767"> 
					<td width="5%" align='center'><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<td width="5%" align='center' class='w'>번호</td>
					<td width="42%" align='center' class='w'>제목</td>
					<td width="10%" align='center' class='w'>글쓴이</td>
					<td width="8%" align='center' class='w'>조회수</td>
					<td width="13%" align='center' class='w'>등록일</td>
					<td width="17%" align='center' class='w'>편집</td>
				</tr>
<?
}else{
	$cols = '5';
?>

				<tr bgcolor="676767"> 
					<td width="8%" align='center' class='w' height='26'>번호</td>
					<td width="56%" align='center' class='w'>제목</td>
					<td width="15%" align='center' class='w'>글쓴이</td>
					<td width="8%" align='center' class='w'>조회수</td>
					<td width="13%" align='center' class='w'>등록일</td>
				</tr>

<?
}
?>

				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>

<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$name = $row["name"];
		$hit = $row["hit"];
		$hit = number_format($hit);
		$pwd_chk = $row["pwd_chk"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);


		//공지글 배경색상지정
		if($notice_chk)	 $bgcolor=" bgcolor='#efefef'";
		else	$bgcolor='';

		//비밀글설정
		if($pwd_chk){
			$lock_icon=" <img src='".$BTN_lock."'>";

			if($GBL_MTYPE == 'A')	 $str_len = '42';
			else	 $str_len = '52';

		}else{
			$lock_icon='';

			if($GBL_MTYPE == 'A')	 $str_len = '46';
			else	 $str_len = '56';

		}

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,$str_len,'..');



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';



		//등록된 한줄의견수
		$query01 = "select * from tb_board_coment where pid='$uid'";
		$query02 = mysql_query($query01);
		$c_tot_num = mysql_num_rows($query02);

		if($c_tot_num)	 $c_tot_num = "<font color='#086692'>[".$c_tot_num."]</font>";
		else	$c_tot_num = '';

		

		

		if($GBL_MTYPE == 'A'){

?>
				<tr <?=$bgcolor?>> 
					<td align='center'><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td align='center'><?=$i?></td>
					<td style='padding-left:5px;'><?=$lock_icon?>	<?=$btn_tit_view?> <?=$c_tot_num?></td>
					<td align='center'><?=$name?></td>
					<td align='center'><?=$hit?></td>
					<td align='center'><?=$reg_date?></td>
					<td align='center'><a href="javascript:reg_modify('<?=$uid?>');"><img src="<?=$BTN_modify02?>" alt="수정"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="<?=$BTN_del02?>" alt="삭제" width="50" height="21"></a></td>
				</tr>

<?
		}else{
?>

				<tr <?=$bgcolor?>> 
					<td align='center' height='31'><?=$i?></td>
					<td style='padding-left:5px;'><?=$lock_icon?>	<?=$btn_tit_view?> <?=$c_tot_num?></td>
					<td align='center'><?=$name?></td>
					<td align='center'><?=$hit?></td>
					<td align='center'><?=$reg_date?></td>
				</tr>

<?
		}
?>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>



<?
//답글리스트
include $boardRoot.'reply_list01.php';
?>





<?
		$i--;
		$line_num++;
	}
}else{
?>

				<tr> 
					<td colspan="<?=$cols?>" align='center' height='50'>등록된 게시물이 없습니다</td>
				</tr>

<?
}
?>

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

				<tr> 
					<td height="25" colspan="<?=$cols?>" align='right'><?=$btn_write?></td>
				</tr>
			</table>									
		</td>
	</tr>
</table>




</form>
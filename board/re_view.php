<?

	if($uid){

		//조회수증가
		$sql = "update tb_board_reply set hit = hit + 1 where uid='$uid'";
		$result = mysql_query($sql);


		$sql = "select * from tb_board_reply where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$ment = $row["ment"];
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);


	}




?>



<script language='javascript'>
function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 're_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 're_edit';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function error_msg(mod){
	if(mod == 'r'){
		alert('답글작성 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="0" cellspacing="0" cellpadding="0" class='gTable2'>

				<tr align=""> 
					<th width="20%" class='bbs'>작성자</th>
					<th width="57%" class='bbs'>제목</th>
					<th width="23%" class='bbs'>등록일</th>
				</tr>

				<tr align=""> 
					<td class='bbs01'><?=$name?></td>
					<td class='bbs01'><?=$title?></td>
					<td class='bbs01'><?=$reg_date?></td>
				</tr>

				<tr height="300" valign="top"> 
					<td class='bbs01' colspan='3' style="padding:20 20 10 20"><?=$ment?></td>
				</tr>


			</table>

		</td>
	</tr>







	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='40%'>

					<!-- 수정 or 삭제시 비밀번호 입력 테이블 -->

<script language='javascript'>


function isEnter4(){
	if(event.keyCode==13){
		mod_pwd();
		return;
	}
}

function mod_pwd(){
	form = document.FRM;

	if(isFrmEmpty(form.mod_pwd,"비밀번호를 입력해 주십시오"))	return;	
	form.action = '<?=$boardRoot?>pwd_proc.php';
	form.submit();

}

function tblDataPwd(mod){

	form = document.FRM;
 
	var tr = document.getElementById("tbl_mod");


	if(mod == 're_del'){
		if(!confirm('삭제하시겠습니까?')){
			return;
		}
	}

	tr.style.display='';		
	form.type.value = mod;
	form.mod_pwd.focus();


}

</script>

						<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none;">
							<tr>
								<td><b>비밀번호</b></td>
								<td width='5'></td>
								<td><input type='password' name='mod_pwd' style='width:130px;' onKeyPress="javascript:isEnter4()"></td>
								<td width='5'></td>
								<td><a href="javascript:mod_pwd();"><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a></td>
							</tr>
						</table>

					<!-- /수정 or 삭제시 비밀번호 입력 테이블 -->

					</td>



<?
//수정 & 삭제버튼 설정
if($GBL_MTYPE){
	if($GBL_MTYPE == 'A' || $GBL_USERID == $userid){
		$btn_tbl_type = 'ok';

	}else{
		$btn_tbl_type = 'pwd';

	}

}else{
	$btn_tbl_type = 'pwd';
}
?>


				<?
					if($btn_tbl_type == 'ok'){
				?>

					<td width='60%' align='right'>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:reg_del();"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
						<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/list01.gif" border=0></a>
					</td>

				<?
					}else{
				?>
					<td width='60%' align='right'>
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('re_edit');"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:tblDataPwd('re_del');"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
						<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/list01.gif" border=0></a>
					</td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
</table>




</form>


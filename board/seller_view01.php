<?

	if($uid){

		//조회수증가
		$sql = "update tb_board_list set hit = hit + 1 where uid='$uid'";
		$result = mysql_query($sql);


		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);

		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];
	}




?>



<script language='javascript'>
function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
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
	form.type.value = 'edit';
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
<input type='hidden' name='seller' value='<?=$seller?>'>
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



<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td bgcolor="8c8c8c"  height="1" colspan="3"></td>
				</tr>
				<tr align="center" height='30'> 
					<td width="23%" class='bbs'>등록일</td>
					<td width="57%" class='bbs'>제목</td>
					<td width="20%" class='bbs'>작성자</td>
				</tr>
				<tr height="2">
					<td bgcolor="8d8d8d"></td>
					<td bgcolor="e86261"></td>
					<td bgcolor="8d8d8d"></td>
				</tr>
				<tr align="center" height='30'> 
					<td class='bbs01'><?=$reg_date?></td>
					<td class='bbs01'><?=$title?></td>
					<td class='bbs01'><?=$name?></td>
				</tr>
				<tr> 
					<td bgcolor="8c8c8c"  height="1" colspan="3"></td>
				</tr>

				<tr height="300" valign="top"> 
					<td class='bbs01' colspan='3' style="padding:20 20 10 20"><?=$ment?></td>
				</tr>



<?

$fno = 0;
$upload_chk = 0;

for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
	$file_name = ${'realfile'.$file_num};
	$down_icon = '';


	if($download_chk && $file_name){		
		$rfile = ${'userfile'.$file_num};
		$down_icon = "<a href='#' onclick=javascript:location.href='".$boardRoot."file_down.php?rfile=$rfile&sname=$file_name' target='ifra_down'><img src='".$boardRoot."img/down.gif'></a>";

	}

	if($file_name){
		$fno++;
?>


				
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="3"></td>
				</tr>
				<tr> 
					<td class='bbs'>첨부파일#<?=$fno?></td>
					<td class='bbs01' colspan='2'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td><?=$file_name?></td>
								<td width='80' align='right'><?=$down_icon?></td>
							</tr>
						</table>
					</td>
				</tr>

<?
	}
}
?>
				<tr>
					<td colspan="3" height="1" bgcolor="8c8c8c" ></td>
				</tr>
				<tr>
					<td colspan="3" height="3" bgcolor="f5f5f5"></td>
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


	if(mod == 'del'){
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
//답글쓰기 권한설정
include $boardRoot.'chk_reply.php';
?>



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
					<!--
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:tblDataPwd('del');"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
					-->
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





<!-- 한줄의견-->
<?
include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>

<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>
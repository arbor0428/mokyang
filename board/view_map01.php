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
		$reg_date = date("Y-m-d",$reg_date);
		$hit = $row["hit"];
		$hit = number_format($hit);
		$notice_chk = $row['notice_chk'];

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

		//상품구매후기관련
		$order_review_uid = $row['order_review_uid'];
		$order_review_grade = $row['order_review_grade'];





	}





?>


<style type='text/css'>
.gfTxt01{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 15px;
}

.gfTxt02{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 35px;
}
</style>
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
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function error_msg(mod){
	if(mod == 'r'){
		alert('답글작성 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}else if(mod == 'p'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'v'){
		alert('비밀글입니다.');
		return;

	}
}

function reg_view(uid){
	form = document.FRM;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function toclip(id){
	var idxs = document.getElementsByName("clip[]");
	if(idxs[id].value==''){ document.body.focus(); return; }
	idxs[id].select();
	var clip=idxs[id].createTextRange();
	clip.execCommand('copy');
}

</script>








<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->

<input type='hidden' name='order_review_uid' value='<?=$order_review_uid?>'><!-- 구매후기 작성시 상품번호 -->

<?
//상품번호가 있는 경우 구매후기 작성이기 때문에 상품정보를 표시한다
if($order_review_uid){
	include '../../board/product_view01.php';
}
?>


<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td height="3" bgcolor="#317034"></td>
				</tr>
				<tr>
					<td height="30" style='padding:0 0 0 16;'><span class="style1"><strong><?=$title?></strong></span></td>
				</tr>
				<tr>
					<td height="1" bgcolor="317034"></td>
				</tr>
				<tr>
					<td height="30" style='padding:0 0 0 16;'>
						<table border="0" cellspacing="0" cellpadding="0" width='100%'>
							<tr height='35'>
								<td width="12%" class='gfTxt01'>지역</td>
								<td width="38%"><?=$name?></td>
								<td width="12%" class='gfTxt01'>주소</td>
								<td width="38%"><?=$data02?></td>
							</tr>

							<tr>
								<td height="1" colspan="4" bgcolor="e2e2e2"></td>
							</tr>	

							<tr height='35'>
								<td width="12%" class='gfTxt01'>연락처</td>
								<td width="38%"><?=$data01?></td>
								<td width="12%" class='gfTxt01'>홈페이지</td>
								<td width="38%"><?=$data03?></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td height="1" bgcolor="e5e5e4"></td>					
				</tr>




			</table>


		</td>
	</tr>
</table>



<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style="padding:20px 0px;"><div style='width:100%'><?=$ment?></div></td>
	</tr>


	<tr>
		<td height="2" bgcolor="e5e5e4"></td>
	</tr>
</table>




<table cellpadding='0' cellspacing='0' border='0' width='100%'>
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
		if(!confirm('글을 삭제하시겠습니까?')){
			return;
		}
	}

	tr.style.display='';		
	form.type.value = mod;
	form.mod_pwd.focus();


}

</script>

						<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none">
							<tr>
								<td><b>Password</b></td>
								<td width='5'></td>
								<td><input type='password' name='mod_pwd' style='width:130px;' onKeyPress="javascript:isEnter4()" class='3inputs'></td>
								<td width='5'></td>
								<td><a href="javascript:mod_pwd();"><img src="<?=$BTN_pwdok?>" alt="Confirm"></a></td>
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
	if($GBL_MTYPE == 'A' || $GBL_MTYPE == '1' || $GBL_USERID == $userid){
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
					<?
						//글 수정/삭제권한이 관리자에게만 있는경우
						if($set_edit_btn == ''){
					?>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();"><img src="<?=$BTN_modify01?>"></a>&nbsp;
						<a href="javascript:reg_del();"><img src="<?=$BTN_del01?>"></a>&nbsp;
					<?
						}
					?>
						<a href="javascript:reg_list();"><img src="<?=$BTN_list?>"></a>
					</td>

				<?
					}else{
				?>
					<td width='60%' align='right'>
					<?
						//글 수정/삭제권한이 관리자에게만 있는경우
						if($set_edit_btn == ''){
					?>
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');"><img src="<?=$BTN_modify01?>"></a>&nbsp;
						<a href="javascript:tblDataPwd('del');"><img src="<?=$BTN_del01?>"></a>&nbsp;
					<?
						}
					?>
						<a href="javascript:reg_list();"><img src="<?=$BTN_list?>"></a>
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
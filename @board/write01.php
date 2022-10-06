<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];


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

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script language='javascript' src='/html_editor/languages/euc-kr/java.lang.js'></script>

<script language='javascript'>
var _editor_url = "/html_editor";
var _contentValue = "ment";
var _contentName = "FRM";
var _i_uploaded = "";
var _m_uploaded = "";


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	form.ment.value = SubmitHTML();

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

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
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>

<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$userfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$userfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$userfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$userfile05?>'>

<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>



<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc" frame="hsides" class='s'>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="4"></td>
				</tr>
<?
if($GBL_MTYPE == 'A'){
?>
				<tr> 
					<td class='tab_tit'>공지</td>
					<td colspan='3'><input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</td>
				</tr>
<?
}
?>

				<tr> 
					<td class='tab_tit'>제목</td>
					<td class='tab' colspan='3'><input name="title" type="text" style='width:100%;' value='<?=$title?>'></td>
				</tr>

				<tr> 
					<td width="17%" class='tab_tit'>작성자</td>
					<td width="33%" class='tab'><input name="name" type="text" style='width:213px;' value='<?=$name?>'></td>
					<td width="17%" class='tab_tit'>비밀번호</td>
					<td width="33%" class='tab'>
						<input name="passwd" type="password" style='width:113px;' value='<?=$passwd?>'>
						<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개
						<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
					</td>
				</tr>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
?>


				<tr> 
					<td class='tab_tit'>첨부파일#<?=$i?></td>
					<td class='tab' colspan='3'>
						<input type='file' name='upfile<?=$file_num?>' class='file01'>
					<?
						if(${'userfile'.$file_num}){
					?>
						<input type='checkbox' name='del_upfile<?=$file_num?>' value='Y'>삭제 (<?=${'realfile'.$file_num}?>)
					<?
						}
					?>

					</td>
				</tr>

<?
}
?>


				<tr> 
					<td class='tab_tit'>내용</td>
					<td class='tab' colspan='3'>
						<!-- html_editor -->
						<table border='0' cellpadding='1' cellspacing='1' width='100%'>

							<tr>
								<td>
								<?
									include '../html_editor/btn_tool.php';
								?>			
								</td>
							</tr>

							<tr>
								<td>
									<table border='1' width='100%' cellspacing='0' bordercolor='#EFEFEF' bordercolordark='white' bordercolorlight='#DBDBDB'>
										<tr>
											<td>
											<iframe id='gmEditor' width='100%' height='300' scrolling='auto' border='0' frameborder='0' framespacing='0' hspace='0' marginheight='0' marginwidth='0' vspace='0'></iframe>
											<textarea cols=0 rows=0 style='display:none;' wrap='physical' name='ment'><?=$ment?></textarea>
											<input type='hidden' name='editor_url' id='editor_url' value='/html_editor'>
											<input type='hidden' name='editor_stom' id='editor_stom' value='euc-kr'>
											<script language='javascript' src='/html_editor/gmEditor.js'></script>
											</td>
										</td>
									</table>
								</td>
							</tr>
						</table>
						<!-- html_editor -->
					</td>
				</tr>


			</table>


		</td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/register.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/cancel.gif" border=0></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
			<a href="javascript:reg_del();"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/list01.gif" border=0></a>
		</td>
	</tr>
<?
}
?>
			
</table>


</form>


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
		$data01 = $row["data01"];		//저작권보호신청 악보uid


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

	}else{
		//비밀글설정
		$pwd_chk = 1;
		$data01 = '';

		//악보페이지에서 [저작권보호신청]을 신청한 경우
		$plen = count($chk);
		if($direct_order && $plen > 0){
			for($i=0; $i<$plen; $i++){
				if($data01)	$data01 .= ',';
				$data01 .= $chk[$i];
			}
		}
	}



	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

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
<input type='hidden' name='type' value="<?=$type?>">
<input type='hidden' name='uid' value="<?=$uid?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">

<input type='hidden' name='table_id' value="<?=$table_id?>">
<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">

<input type='hidden' name='data01' value="<?=$data01?>"><!-- 저작권보호신청 악보uid -->


<?
	if($data01){
		//악보내역
		include 'plist01.php';
	}
?>



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr> 
					<td width='17%' bgcolor="8c8c8c" height="2"></td>
					<td width='83%' bgcolor="e86261" height="2"></td>
				</tr>
			</table>

			<table width='100%' border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;border-top:1px solid #ffffff;" frame="hsides" bordercolor="cccccc">
			<?
				if($GBL_MTYPE == 'A'){
			?>
				<tr> 
					<td class='tab_bbs'>공지</td>
					<td class='tab' colspan='3'> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</td>
				</tr>
			<?
				}
			?>

				<tr> 
					<td class='tab_bbs'>제목</td>
					<td class='tab' colspan='3'><input name="title" type="text" style='width:98%;' value="<?=$title?>" class='3tt5'></td>
				</tr>
				<tr> 
					<td width="17%" class='tab_bbs'>작성자</td>
					<td width="33%" class='tab'><input name="name" type="text" style='width:205px;' value="<?=$name?>" class='3tt5'></td>
					<td width="17%" class='tab_bbs'>비밀번호</td>
					<td width="33%" class='tab'>
						<input name="passwd" type="password" style='width:100px;' value="<?=$passwd?>" class='3tt5'>
						<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개
						<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
					</td>
				</tr>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
?>


				<tr> 
					<td class='tab_bbs'>첨부파일#<?=$i?></td>
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

			</table>


		</td>
	</tr>

	<tr>
		<td style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<img src="<?=$boardRoot?>img/register.gif" border=0 onClick='check_form();return false;'>&nbsp;
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

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
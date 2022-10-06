<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

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

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$sData04 = $row["sData04"];
		$sData05 = $row["sData05"];
		$sData06 = $row["sData06"];
		$sData07 = $row["sData07"];
		$sData08 = $row["sData08"];
		$sDataTxt = $row["sDataTxt"];


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


		if($sDataTxt)	$sDataTxt = Util::textareaDecodeing($sDataTxt);
	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;

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
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
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

<input type='hidden' name='name' value="<?=$GBL_NAME?>">
<input type='hidden' name='password' value="1234">




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr> 
					<th><?=$ico01?> 제 목</th>
					<td colspan='3'><input name="title" type="text" style='width:98%;' value="<?=$title?>"></td>
				</tr>

				<tr> 
					<th width='17%'><?=$ico02?> 장 르</th>
					<td width='33%'><input type="text" name="sData01" value="<?=$sData01?>" style='width:70%;'></td>
					<th width='17%'><?=$ico02?> 장 소</th>
					<td width='33%'><input type="text" name="sData02" value="<?=$sData02?>" style='width:70%;'></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 일 자</th>
					<td><input type="text" name="sData03" value="<?=$sData03?>" style='width:70%;'></td>
					<th><?=$ico02?> 연 령</th>
					<td><input type="text" name="sData04" value="<?=$sData04?>" style='width:70%;'></td>
				</tr>

				<tr> 
					<th>간단설명</th>
					<td colspan='3'><textarea name='sDataTxt' style='width:100%;height:120px;resize:none;'><?=$sDataTxt?></textarea></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 주 최</th>
					<td><input type="text" name="sData05" value="<?=$sData05?>" style='width:70%;'></td>
					<th><?=$ico02?> 문 의</th>
					<td><input type="text" name="sData06" value="<?=$sData06?>" style='width:70%;'></td>
				</tr>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
?>


				<tr> 
					<th>첨부파일#<?=$i?></th>
					<td colspan='3'>
						<input type='file' name='upfile<?=$file_num?>' class='file01' style="width:305px;">
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
			<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();" class='big cbtn blue'>수정</a>&nbsp;
			<a href="javascript:reg_del();" class='big cbtn blood'>삭제</a>&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
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
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
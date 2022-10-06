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
		$sDataUrl = $row["sDataUrl"];
		$startDate = $row["startDate"];
		$endDate = $row["endDate"];


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




	$sRange = '1';
	$eRange = '1';
	include '../module/Calendar.php';
?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.sData03,"구분을 선택해 주십시오"))	return;
	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.sDate,"시작일자를 선택해 주십시오"))	return;
	if(isFrmEmptyModal(form.eDate,"종료일자를 선택해 주십시오"))	return;

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
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_month' value='<?=$f_month?>'>
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
					<th><?=$ico01?> 구 분</th>
					<td colspan='3'>
						<label for="sData03">
							<select name='sData03'>
								<option value=''>----</option>
								<option value='공연' <?if($sData03=='공연') echo'selected';?>>공연</option>
								<option value='전시' <?if($sData03=='전시') echo'selected';?>>전시</option>
							</select>
						</label>
					</td>
				</tr>

				<tr> 
					<th><?=$ico01?> 제 목</th>
					<td colspan='3'><label for="title"><input name="title" type="text" style='width:100%;' value="<?=$title?>"></label></td>
				</tr>

				<tr> 
					<th width='17%'><?=$ico02?> 장 르</th>
					<td width='33%'><label for="sData01"><input type="text" name="sData01" value="<?=$sData01?>" style='width:70%;'></label></td>
					<th width='17%'><?=$ico02?> 장 소</th>
					<td width='33%'><label for="sData02"><input type="text" name="sData02" value="<?=$sData02?>" style='width:70%;'></label></td>
				</tr>

				<tr>
					<th><?=$ico01?> 일 자</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><label for="sData"><input type='text' name='sDate' id='fpicker1' value="<?=$startDate?>"></label></td>
								<td style='padding:0 10px;'>~</td>
								<td><label for="eData"><input type='text' name='eDate' id='fpicker2' value="<?=$endDate?>"></label></td>
							</tr>
						</table>
					</td>
					<th><?=$ico02?> 연 령</th>
					<td><label for="sData04"><input type="text" name="sData04" value="<?=$sData04?>" style='width:70%;'></label></td>
				</tr>

			<!--
				<tr> 
					<th><?=$ico02?> 일 자</th>
					<td><label for="sData03"><input type="text" name="sData03" value="<?=$sData03?>" style='width:70%;'></label></td>
					<th><?=$ico02?> 연 령</th>
					<td><label for="sData04"><input type="text" name="sData04" value="<?=$sData04?>" style='width:70%;'></label></td>
				</tr>
			-->

				<tr> 
					<th>간단설명</th>
					<td colspan='3'><textarea name='sDataTxt' style='width:100%;height:120px;resize:none;'><?=$sDataTxt?></textarea></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 주 최</th>
					<td><label for="sData05"><input type="text" name="sData05" value="<?=$sData05?>" style='width:70%;'></label></td>
					<th><?=$ico02?> 주 관</th>
					<td><label for="sData07"><input type="text" name="sData07" value="<?=$sData07?>" style='width:70%;'></label></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 문 의</th>
					<td colspan='3'><label for="sData06"><input type="text" name="sData06" value="<?=$sData06?>" style='width:30%;'></label></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 예매하기 URL</th>
					<td colspan='3'><label for="sDataUrl"><input name="sDataUrl" type="text" style='width:100%;' value="<?=$sDataUrl?>"></label></td>
				</tr>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	$upfile = ${'userfile'.$file_num};
	$realfile = ${'realfile'.$file_num};
?>


				<tr> 
					<th>첨부파일#<?=$i?></th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="file_input">
										<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:235px;padding:0 0 0 10px;">
										<label>찾아보기<input type="file" name="upfile<?=$file_num?>" onchange="javascript:document.getElementById('file_route<?=$file_num?>').value=this.value"></label>
									</div>
								</td>
							<?
								if($upfile){
							?>
								<td style='padding:0 0 0 10px;'>
									<div class="enable_btn">
										<div class="squaredThree">
											<input type="checkbox"  id="squaredDel<?=$file_num?>" type="checkbox" name="del_upfile<?=$file_num?>" value="Y" />
											<label for="squaredDel<?=$file_num?>"></label>										
										</div>
										<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
									</div>
								</td>
							<?
								}
							?>
							</tr>
						</table>
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
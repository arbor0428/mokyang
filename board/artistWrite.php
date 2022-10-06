<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$sDataTxt = $row["sDataTxt"];


		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];

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

function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if(no == 1 && $.inArray(ext, ['jpg','gif','png']) == -1) {
			GblMsgBox('jpg, gif, png 파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else if(no == 2 && $.inArray(ext, ['hwp','pdf','doc']) == -1) {
			GblMsgBox('hwp, pdf, doc 파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.FRM['upfile'+no];

			// 익스플로러일 경우
			if(browser=="Microsoft Internet Explorer"){
				var oas = new ActiveXObject("Scripting.FileSystemObject");
				fileSize = oas.getFile(file.value).size;

			// 익스플로러가 아닐경우
			}else{
				fileSize = file.files[0].size;
			}

			fS = Math.round(fileSize / 1024 / 1024);

			if(fS > 50){
				GblMsgBox('50MB이상의 파일은 등록할 수 없습니다.','');
				$("#upfile"+no).val('');
				$("#file_route"+no).val('');
				return;
			}
		}
	}

	$("#file_route"+no).val(upFile);
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
					<th>구분</th>
					<td colspan='3'>
						<select name='data01'>
							<option value=''>:: 선택 ::</option>
							<option value='안무자' <?if($data01 == '안무자'){echo 'selected';}?>>안무자</option>
							<option value='무용단원' <?if($data01 == '무용단원'){echo 'selected';}?>>무용단원</option>
							<option value='연주단원-풍물' <?if($data01 == '연주단원-풍물'){echo 'selected';}?>>연주단원-풍물</option>
							<option value='연주단원-기악' <?if($data01 == '연주단원-기악'){echo 'selected';}?>>연주단원-기악</option>
							<option value='사무실' <?if($data01 == '사무실'){echo 'selected';}?>>사무실</option>
						</select>
					</td>
				</tr>
				<tr> 
					<th width='17%'><?=$ico01?> 이름</th>
					<td width='83%'><input name="title" type="text" style='width:98%;' value="<?=$title?>"></td>
				</tr>
				<tr> 
					<th>간단설명</th>
					<td><textarea name='sDataTxt' style='width:100%;height:120px;resize:none;'><?=$sDataTxt?></textarea></td>
				</tr>


<?

for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	$upfile = ${'userfile'.$file_num};
	$realfile = ${'realfile'.$file_num};

	if($i == 1)	$fTxt = "이미지";
	else			$fTxt = "첨부파일";

	if($i == 1)	$placeholder = "180 * 250 크기로 올려주시기 바랍니다.";
	else			$placeholder = "";
?>


				<tr> 
					<th><?=$fTxt?></th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="file_input">
										<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:235px;padding:0 0 0 10px;" placeholder='<?=$placeholder?>'>
										<label>찾아보기<input type="file" name="upfile<?=$file_num?>" id="upfile<?=$file_num?>" onchange="fileChk('<?=$file_num?>');"></label>
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
										<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile?>)</p>
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
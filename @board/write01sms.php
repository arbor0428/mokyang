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

		$reg_date = $row["reg_date"];

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

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);
	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	//휴대폰 인증
	smsOk = $('#smsOk').val();
	if(smsOk != '1'){
		GblMsgBox('본인인증을 진행해 주시기 바랍니다.','');
		return;
	}

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.passwd,"비밀번호를 입력해 주십시오"))	return;

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

function isCellPhone(p){
	p = p.split('-').join('');
	var regPhone = /^((01[1|6|7|8|9])[1-9]+[0-9]{6,7})|(010[1-9][0-9]{7})$/;
	return regPhone.test(p);
}

function smsSend(){
	form = document.FRM;

	if(isFrmEmpty(form.data04,"휴대폰 가입자명을 입력해 주십시오."))	return;
	if(isFrmEmpty(form.data02,"휴대전화번호를 입력해 주십시오."))	return;
	if(isFrmEmpty(form.data03,"휴대전화번호를 입력해 주십시오."))	return;

	//휴대폰번호 유효성검사
	mobile = $("#data01 option:selected").val()+$("#data02").val()+$("#data03").val();
	okMobile = isCellPhone(mobile);

	if(!okMobile){
		GblMsgBox('휴대폰번호를 정확히 기재해 주시기 바랍니다.');
		return;
	}

	id = setTimeout(function(){
		var params = jQuery("#FRM").serialize();
		jQuery.ajax({
			url: '../module/SmsSend.php',
			type: 'POST',
			data:params,
			dataType: 'html',
			success: function(result){
				if(result == 'ok'){
					$('#data04').prop('readonly',true);
					$("#data01 option").not(":selected").attr("disabled", "disabled")
					$('#data02').prop('readonly',true);
					$('#data03').prop('readonly',true);
					$('#smsSendBtn').html("<a href='#' class='small cbtn black'>전송완료</a>");
					$('#okNumChk').fadeIn();

				}else{
					GblMsgBox(result);
					return;
				}
			},
			error: function(error){
				GblMsgBox('문자전송오류');
				return;
			}
		});
	}, 100);
}


function smsChk(){
	form = document.FRM;

	if(isFrmEmptyModal(form.okNum,"인증번호를 입력해 주십시오."))	return;

	id = setTimeout(function(){
		var params = jQuery("#FRM").serialize();
		jQuery.ajax({
			url: '../module/SmsCheck.php',
			type: 'POST',
			data:params,
			dataType: 'html',
			success: function(result){
				if(result){
					okNum = $('#okNum').val();
					if(okNum != result){
						GblMsgBox('인증번호를 다시 확인해 주시기 바랍니다.');
						return;

					}else{
						$('#smsOk').val('1');
						$('#smsSendBtn').html("<a href='#' class='small cbtn black'>인증성공</a>");
						$('#okNumChk').hide();
						return;
					}
				}
			},
			error: function(error){
				GblMsgBox('검증오류');
				return;
			}
		});
	}, 100);
}
</script>



<form name='FRM' id='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
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

<input type='hidden' name='rtyTime' value="<?=mktime()?>">
<input type='hidden' name='smsOk' id='smsOk' value="">


<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th>본인인증</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input name="data04" id="data04" type="text" style='width:193px;' value="" placeholder='가입자명'></td>
							</tr>
							<tr>
								<td style='padding-top:5px;'>
									<select name='data01' id='data01'>
										<option value='010'>010</option>
										<option value='011'>011</option>
										<option value='016'>016</option>
										<option value='017'>017</option>
										<option value='018'>018</option>
										<option value='019'>019</option>
									</select> - 
									<input type='text' name='data02' id='data02' value='' maxlength="4" style='width:60px;' class='numberOnly'> - 
									<input type='text' name='data03' id='data03' value='' maxlength="4" style='width:60px;' class='numberOnly'>

									<span id="smsSendBtn">
										<a href="javascript:smsSend();" class="small cbtn black">인증번호 전송</a>
									</span>
								</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr id='okNumChk' style='display:none;'>
					<th>인증번호</th>
					<td>
						<input type="text" name='okNum' id='okNum' placeholder="인증번호 입력" maxlength="6" style="width:150px;" class='numberOnly'>
						<a href="javascript:smsChk();" class='small cbtn black'>확인</a>
					</td>
				</tr>

<?
if($GBL_MTYPE == 'A'){
?>
				<tr> 
					<th>공지</th>
					<td colspan='3'> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</td>
				</tr>
<?
}else{
?>
<input type='hidden' name='notice_chk' value='<?=$notice_chk?>'>
<?
}
?>

				<tr> 
					<th>제목</th>
					<td colspan='3'><input name="title" type="text" style='width:98%;' value="<?=$title?>"></td>
				</tr>
				<tr> 
					<th width="17%">작성자</th>
					<td width="33%"><input name="name" type="text" style='width:205px;' value="<?=$name?>"></td>
					<th width="17%">비밀번호</th>	
					<td width="33%">
						<input name="passwd" type="password" style='width:100px;' value="<?=$passwd?>">
					<?
						//열린공간 > 재단에게 바란다
						if($table_id == 'table_1512539600'){
							echo ("<input type='hidden' name='pwd_chk' value='1'>");
						}else{
					?>					
						<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개
						<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
					<?
						}
					?>
					</td>
				</tr>

<?
	if($GBL_MTYPE == 'A'){
?>
				<tr>
					<th>등록일시</th>
					<td colspan='3'>
						<select name='set_ry' style='height:30px;'>
						<?
							for($i=date('Y')+1; $i>=2016; $i--){
								if($i == $set_ry)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>년
						<select name='set_rm' style='height:30px;'>
						<?
							for($i=1; $i<=12; $i++){
								$set_rm_no = sprintf('%02d',$i);
								if($i == $set_rm)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>월
						<select name='set_rd' style='height:30px;'>
						<?
							for($i=1; $i<=31; $i++){
								$set_rd_no = sprintf('%02d',$i);
								if($i == $set_rd)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>일&nbsp;&nbsp;

						<select name='set_rh' style='height:30px;'>
						<?
							for($i=0; $i<=23; $i++){
								$set_rh_no = sprintf('%02d',$i);
								if($i == $set_rh)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
						<select name='set_ri' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_ri_no = sprintf('%02d',$i);
								if($i == $set_ri)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>분
						<select name='set_rs' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_rs_no = sprintf('%02d',$i);
								if($i == $set_rs)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>초&nbsp;&nbsp;
						<input type='button' name='btn_set' value='현재시간' onclick='setToDate(this.form);' style='height:30px;cursor:pointer;'>
					</td>
				</tr>
<?
	}
?>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	$upfile = ${'userfile'.$file_num};
	$realfile = ${'realfile'.$file_num};

	if($list_mod == '갤러리형' || $list_mod == '블로그형'){
		if($i == 1)	$fileTitle = "썸네일";
		else			$fileTitle = "첨부파일 #".($i-1);

	}else{
		$fileTitle = "첨부파일 #".$i;
	}
?>


				<tr> 
					<th><?=$fileTitle?></th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="file_input">
										<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:290px;padding:0 0 0 10px;">
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
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/register.gif" border=0 ></a>&nbsp;
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
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
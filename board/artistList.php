<style type='text/css'>
.blog_wrap{
	margin:10px auto;
	width:100%;/*총 넓이*/
}

.blog_wrap li{
	width:23.5%;
	height:340px;
	float:left;
	overflow:hidden;
	margin-bottom:4%;
	margin-right:2%;
	border:1px solid #ddd;
	box-sizing:border-box;
}

.blog_wrap li:nth-child(4n) { margin-right:0;}

.blog_wrap a{
	display:block;
	height:100%;
}

.blog_wrap .photo_cell{
	overflow:hidden;
	width:90%;
	height:250px;
	margin:3% auto 0;
	text-align:center;
}

.blog_wrap .grow {
	transition: all .35s ease-in-out;
	width:100%;
}

.blog_wrap .text_cell{
	overflow:hidden;
	width:80%;
	margin:0 auto;
	line-height:1.5;
	text-align:center;
}
.text_cell .culture_title{
	border-bottom:1px solid #ddd;
	padding:10px 0;
	box-sizing:border-box;
	font-size:18px;
	letter-spacing:-0.5px;
	color:#333;
	font-weight:800;
	width:100%;
	max-height:60px;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	cursor:pointer;
}
.culture_text{
	font-size:16px;
	line-height:20px;
	width:100%;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	padding:5px 0;
}

/* 태블릿 */
@media screen and (min-width:769px) and (max-width:1199px) {
	.blog_wrap li{height:295px;}
	.blog_wrap .photo_cell{height:200px; margin:5% auto 0;}
}

/* 모바일 */
@media screen and (max-width:768px) {
	.blog_wrap li{
		width:47%;
		height:auto;
		margin-right:5%;
	}
	.blog_wrap li:nth-child(2n) {margin-right:0;}

	.blog_wrap .photo_cell{height:auto; margin:5% auto 0;}

	.text_cell .culture_title{padding:5px 0; font-size:16px;}
	.culture_text{font-size:13px; padding:3px 0;}
}
</style>




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

	function goSearch(){
		form = document.frm01;

		form.type.value = '';
		form.uid.value = '';
		form.record_start.value = '';
		form.action = '<?=$PHP_SELF?>';
		form.target = '';
		form.submit();
	}

	function pdfDown(fName,uid){
		form01 = document[fName];

		file_name = form01['pdfFile'+uid].value;
		file_rename = form01['pdfName'+uid].value;

		form02 = document.frm_down;
		form02.file_rename.value = file_rename;
		form02.file_name.value = file_name;
		form02.submit();
	}
</script>




<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
	<label><input type="text" style="display: none;"></label>  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
	<input type='hidden' name='type' value=''>
	<input type='hidden' name='uid' value=''>
	<input type='hidden' name='record_start' value='<?=$record_start?>'>
	<input type='hidden' name='table_id' value='<?=$table_id?>'>
	<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
	<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
	<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
	<input type='hidden' name='f_data01' value='<?=$f_data01?>'>

	<!-- 비밀번호 테이블 -->
	<? include $boardRoot.'pwd_pop.php'; ?>
	<!-- /비밀번호 테이블 -->

	<?
		//글쓰기 권한 설정
		include $boardRoot.'chk_write.php';
	?>

	<div style='float:left;'><?=$btn_write?></div>

	<div style='float:right;'>
		<label for="field">
			<select name='field'>
				<option value='title' <?if($field == 'titile'){echo 'selected';}?>>제목</option>
			</select>
		</label>
		<label for="text"><input type='text' name='word' value="<?=$word?>" onkeypress="if(event.keyCode==13){goSearch();}"></label><a href="javascript:goSearch();" class="scbtn"><img src="/images/scbtn.png" alt="" style="max-width:20px;"></a>
	</div>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				<table cellpadding='0' cellspacing='0' border='0' width='100%' id='list_table'>
					<ul class="blog_wrap clearfix ">
						<?
							$file_path = $boardRoot.'upfile/';

							if($total_record != '0'){
								$i = $total_record - ($current_page - 1) * $record_count;

								$line_num = 1;

								while($row = mysql_fetch_array($result)){

									$uid = $row["uid"];
									$userid = $row["userid"];
									$title = $row["title"];
									$userfile01 = $row["userfile01"];
									$userfile02 = $row["userfile02"];
									$realfile02 = $row["realfile02"];
									$sDataTxt = $row["sDataTxt"];


									$geturl = $boardRoot."img/no_txt.gif";

									if($userfile01){
										$file_s = $userfile01;
										$file_tmp = explode(".", $file_s);
										$file_tmp_len = count($file_tmp);
										$file_name = $file_tmp[$file_tmp_len-1];

										$file_exe = strtolower($file_name);

										if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){
											$geturl = $file_path.$userfile01;
										}
									}

									$userfile = "<img src='".$geturl."' class='grow' alt='".$title."'>";



									$downBtn = '';

									if($userfile02){
										$file_s = $userfile02;
										$file_tmp = explode(".", $file_s);
										$file_tmp_len = count($file_tmp);
										$file_name = $file_tmp[$file_tmp_len-1];

										$downBtn = strtolower($file_name);
									}



									//글읽기 권한 설정
									include $boardRoot.'chk_view.php';
								?>

								<li>
									<div class="photo_cell"><?=$btn_view?></div>
									<div class="text_cell" <?=$btn_link?>>
										<span class='culture_title'><?=$title?></span>
										<span class='culture_text'><?=$sDataTxt?></span>
									</div>
								</li>



								<?
									$i--;
								}
							}else{
							?>

							<div style='width:100%;margin-top:100px;font-size:15px;text-align:center;'>등록된 게시물이 없습니다.</div>

							<?
							}
						?>
					</ul>
				</table>
			</td>
		</tr>
	</table>
</form>





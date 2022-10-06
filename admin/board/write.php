<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_set where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$table_id = $row["table_id"];
		$title = $row["title"];
		$list_mod = $row["list_mod"];
		$write_chk = $row["write_chk"];
		$read_chk = $row["read_chk"];
		$reply_chk = $row["reply_chk"];
		$coment_chk = $row["coment_chk"];
		$upload_chk = $row["upload_chk"];
		$download_chk = $row["download_chk"];
		$list_mod = $row["list_mod"];
		$list_new = $row["list_new"];

		if($list_mod == '리스트형'){	//리스트형
			$dis01 = '';
			$dis02 = '';
			$dis03 = '';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '갤러리형'){	//갤러리형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '미리보기형'){	//미리보기형
			$dis01 = '';
			$dis02 = 'disabled';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = '';

		}elseif($list_mod == '블로그형'){	//블로그형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = '';
			$dis05 = '';
			$dis06 = '';

		}elseif($list_mod == '질문과답변형'){	//질문과답변형
			$dis01 = 'disabled';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = 'disabled';

		}elseif($list_mod == '스케쥴러형'){	//스케쥴러형
			$dis01 = '';
			$dis02 = '';
			$dis03 = 'disabled';
			$dis04 = 'disabled';
			$dis05 = 'disabled';
			$dis06 = 'disabled';

		}
	}


	$sel_chk01 = Array('전체','관리자','실무담당자','실무자','일반');

?>

<script language='javascript'>

function CheckSet(mod){

	form = document.FRM;

	if(mod == '리스트형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = false;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;

		form.db_write_chk.value = '';


	}else	if(mod == '갤러리형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;

		form.db_write_chk.value = '';


	}else	if(mod == '미리보기형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;

		form.db_write_chk.value = '';


	}else	if(mod == '블로그형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = false;

		//첨부파일
		form.upload_chk.disabled = false;
		if(form.upload_chk[0].selected)	form.upload_chk[1].selected = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = false;


		form.db_write_chk.value = '';



	}else	if(mod == '질문과답변형'){
		//쓰기권한
		form.write_chk.value = '관리자';
		form.write_chk.disabled = true;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '전체';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk[0].selected = true;
		form.upload_chk.disabled = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;


		form.db_write_chk.value = '관리자';


	}else	if(mod == '스케쥴러형'){
		//쓰기권한
		form.write_chk.value = '전체';
		form.write_chk.disabled = false;

		//읽기권한
		form.read_chk.value = '전체';
		form.read_chk.disabled = false;

		//답글기능
		form.reply_chk.value = '전체';
		form.reply_chk.disabled = true;

		//한줄의견
		form.coment_chk.value = '';
		form.coment_chk.disabled = true;

		//첨부파일
		form.upload_chk[0].selected = true;
		form.upload_chk.disabled = true;

		//다운로드
		form.download_chk.checked = false;
		form.download_chk.disabled = true;


		form.db_write_chk.value = '관리자';


	}

}

function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"게시판명을 입력해 주십시오"))	return;

	form.action = 'proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = 'up_index.php';
	form.submit();

}
</script>

<body onload='document.FRM.title.focus();'>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>

<input type='hidden' name='db_write_chk' value='<?=$write_chk?>'>



<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>

				<tr> 
					<th>게시판명</th>
				<?
					if($type == 'write'){
				?>
					<td colspan='3'><input name="title" type="text" style='width:213px;' value='<?=$title?>'></td>
				<?
					}else{
				?>
					<td><input name="title" type="text" style='width:213px;' value='<?=$title?>'></td>
					<th>게시판아이디</th>
					<td><?=$table_id?></td>
				<?
					}
				?>
				</tr>


				<tr> 
					<th width="17%">쓰기권한</th>
					<td width="33%">
						<select name='write_chk' <?=$dis01?>>

						<?

							if(!$write_chk)	$write_chk = '전체';

							for($i=0; $i<count($sel_chk01); $i++){

								if($write_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
					<th width="17%">읽기권한</th>
					<td width="33%">
						<select name='read_chk' <?=$dis02?>>

						<?

							if(!$read_chk)	$read_chk = '전체';

							for($i=0; $i<count($sel_chk01); $i++){

								if($read_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>				
				</tr>
				<tr> 
					<th>답글기능</th>
					<td>
						<select name='reply_chk' <?=$dis03?>>
							<option value=''>사용안함</option>

						<?

							for($i=0; $i<count($sel_chk01); $i++){

								if($reply_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
					<th>한줄의견</th>
					<td>
						<select name='coment_chk' <?=$dis04?>>
							<option value=''>사용안함</option>

						<?

							for($i=0; $i<count($sel_chk01); $i++){

								if($coment_chk == $sel_chk01[$i])	$chk = 'selected';
								else	$chk = '';

								echo ("<option value='$sel_chk01[$i]' $chk>$sel_chk01[$i]</option>");
							}																		
						?>

						</select>
					</td>
				</tr>


				<tr> 
					<th>첨부파일</th>
					<td colspan='3'>
						<select name='upload_chk' <?=$dis06?>>
							<option value=''>사용안함</option>

						<?
							for($i=0; $i<10; $i++){
								$k = $i + 1;

								if($k == $upload_chk)	$chk = 'selected';
								else	$chk = '';

								$ment = $k.'개';

								echo ("<option value='$k' $chk>$ment</option>");
							}																		
						?>

						</select>&nbsp;(글 등록시 파일첨부 기능을 사용합니다.)
					</td>
				</tr>

				<tr> 
					<th>다운로드</th>
					<td colspan='3'>
						<input type='checkbox' name='download_chk' value='1' <?if($download_chk) echo 'checked';?> <?=$dis05?>>&nbsp;(첨부파일 다운로드 기능을 사용합니다.)
					</td>
				</tr>

				<tr> 
					<th>리스트방식</th>
					<td colspan='3'>
						<table width='95%' border="0" cellspacing="0" cellpadding="0" align='center'>
							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'>
												<input type='radio' name='list_mod' value='리스트형' <?if($list_mod=='' || $list_mod=='리스트형') echo 'checked';?> onclick="CheckSet('리스트형')"> 리스트형&nbsp;&nbsp;
												<input type='checkbox' name='list_new' value='1' <?if($list_new){echo 'checked';}?>>New
											</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view01.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='갤러리형' <?if($list_mod=='갤러리형') echo 'checked';?> onclick="CheckSet('갤러리형')"> 갤러리형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view02.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='미리보기형' <?if($list_mod=='미리보기형') echo 'checked';?> onclick="CheckSet('미리보기형')"> 미리보기형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view03.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>
							
							<tr>
								<td colspan='3' height='30'></td>
							</tr>

							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='블로그형' <?if($list_mod=='블로그형') echo 'checked';?> onclick="CheckSet('블로그형')"> 블로그형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view04.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='질문과답변형' <?if($list_mod=='질문과답변형') echo 'checked';?> onclick="CheckSet('질문과답변형')"> 질문과답변형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view05.jpg'></td>
										</tr>
									</table>
								</td>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='스케쥴러형' <?if($list_mod=='스케쥴러형') echo 'checked';?> onclick="CheckSet('스케쥴러형')"> 스케쥴러형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view06.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>

							<tr>
								<td colspan='3' height='30'></td>
							</tr>

							<tr>
								<td align='center'>
									<table cellpadding='0' cellspacing='0' border='0' width='100%'>
										<tr>
											<td align='center'><input type='radio' name='list_mod' value='지도형' <?if($list_mod=='지도형') echo 'checked';?> onclick="CheckSet('지도형')"> 지도형</td>
										</tr>
										<tr>
											<td align='center'><img src='./img/view07.jpg'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>


			</table>


		</td>
	</tr>

	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="../../images/common/register.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list();"><img src="../../images/common/cancel.gif" border=0></a>
		</td>
	</tr>
</table>


</form>


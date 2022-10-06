<script language="JavaScript"> 
function bluring(){ 
if(event.srcElement.tagName=="A"||event.srcElement.tagName=="IMG") document.body.focus(); 
} 
document.onfocusin=bluring; 
</script>
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

</script>

<script type="text/javascript" src="<?=$boardRoot?>lightbox/js/prototype.js"></script>
<script type="text/javascript" src="<?=$boardRoot?>lightbox/js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="<?=$boardRoot?>lightbox/js/lightbox.js"></script>
<link rel="stylesheet" href="<?=$boardRoot?>lightbox/css/lightbox.css" type="text/css" media="screen" />


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');" style="display: none;">


<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0"> 

	<tr>
		<td>

<?
if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
?>
		<a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='전체선택'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='선택삭제'></a>
<?
}
?>
		
	<tr>
		<td height='40'></td>
	</tr>
	<tr>
		<td colspan='2' align='center'>
			<table border="0" cellspacing="0" cellpadding="0" style="position:relative;" id='list_table'>
				<tr>


<?php


if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$pwd_chk = $row["pwd_chk"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,26,'..');


		if($userfile01){
			$file_s = $userfile01; 
			$file_tmp = explode(".", $file_s); 
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){

				//사이즈조정
				$geturl = $boardRoot.'upfile/'.$userfile01;
				$ReSize = Util::AutoImgSize($geturl,$img_w,$img_h);

				$userfile = "<a href='".$boardRoot."upfile/$userfile01' rel='lightbox[roadtrip]' title='$title' onfocus='this.blur();'><img src='".$boardRoot."upfile/$userfile01' $ReSize style='box-shadow:10px 10px 30px #999'></a>";

			}else{
				$userfile = "<img src='".$boardRoot."img/no_txt.gif'>";
			}

		}else{
			$userfile = "<img src='".$boardRoot."img/no_txt.gif'>";

		}


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';






?>


					<td>

						<table border="0" cellspacing="0" cellpadding="0" width='<?=$img_w?>' height='<?=$img_h?>' align='center'>
							<tr>
								<td style='border:1px solid #d0cfd4;' align='center'><?=$userfile?></td>
							</tr>
						</table>
						<table border="0" cellspacing="0" cellpadding="0" width='<?=$img_w?>'align='center'>
							<tr>
						<?
							if($GBL_MTYPE=='A'){
						?>
								<td><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
						<?
							}
						?>
								<td style='padding-top:20px;width:100%;text-align:center;font-size:14px'><?=$btn_tit_view?></td>
							</tr>
						</table>

					</td>


<?
		$mod = $line_num % $one_line;
		if ($mod == 0)	echo ("</tr><tr><td height='80'></td></tr>");
		else	echo ("<td width='70'></td>");

		$i--;
		$line_num++;
	}


	//빈TD 채우기
	if($mod > 0){

		for($k=$mod; $k<$one_line; $k++){
			echo ("
						<td>
							<table border='0' cellspacing='0' cellpadding='0' width='$img_w' height='$img_h'>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</table>
						</td>");

			if($k < ($one_line-1))	echo ("<td width='10'></td>");
		}

	}

}else{
?>

				
					<td height='30' align='center'>등록된 게시물이 없습니다</td>


<?
}
?>


				</tr>

			</table>									
		</td>
	</tr>
<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';
?>

	<tr> 
		<td height="25" colspan="2" align='right'><?=$btn_write?></td>
	</tr>
</table>




</form>
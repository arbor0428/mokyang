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

function answer(i){
	
	var tot = document.frm01.tot_class.value;
	var tr01 = document.getElementById("a_ment" + i);
	var tr02 = document.getElementById("a_line" + i);

	if(tr01.style.display == ''){
		tr01.style.display = 'none';
		tr02.style.display = 'none';

	}else{
		for(k=0; k<tot; k++){
			var ttr01 = document.getElementById("a_ment" + k);
			var ttr02 = document.getElementById("a_line" + k);

			if(k==i){
				ttr01.style.display='';
				ttr02.style.display='';

			}else{
				ttr01.style.display='none';
				ttr02.style.display='none';

			}
		}

	}
 
}


</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>



<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0"> 


<?
if($GBL_MTYPE == 'A'){
	$cols = '5';
?>
	<tr>
		<td style="border:1px solid #bcbcbc; border-left:0px; border-right:0px; background-color:#f6f6f6; padding:8px 0px; text-align:center;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr align='center'>
					<td width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<td width="10%" class='b-text'>분류</td>
					<td width="57%" class='b-text'>질문</td>
					<td width="13%" class='b-text'>등록일</td>
					<td width="15%" class='b-text'>편집</td>
				</tr>
			</table>
		</td>
	</tr>

<?
}else{
	$cols = '3';
?>
	<tr>
		<td style="border:1px solid #bcbcbc; border-left:0px; border-right:0px; background-color:#f6f6f6; padding:8px 0px; text-align:center;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr align='center'>
					<td width="20%" class='b-text'>분류</td>
					<td width="80%" class='b-text'>제목</td>
					<!--<td width="15%" class='b-text'>등록일</td>-->
				</tr>
			</table>
		</td>
	</tr>

<?
}
?>


	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$name = $row["name"];
		$hit = $row["hit"];
		$hit = number_format($hit);
		$pwd_chk = $row["pwd_chk"];
		$ment = $row["ment"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);


		//공지글 배경색상지정
		if($notice_chk)	 $bgcolor=" bgcolor='#efefef'";
		else	$bgcolor='';

		//비밀글설정
		if($pwd_chk){
			$lock_icon=" <img src='".$BTN_lock."'>";

			if($GBL_MTYPE == 'A')	 $str_len = '42';
			else	 $str_len = '52';

		}else{
			$lock_icon='';

			if($GBL_MTYPE == 'A')	 $str_len = '46';
			else	 $str_len = '56';

		}

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,$str_len,'..');



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';



	

		

		if($GBL_MTYPE == 'A'){

?>
				<!-- 질문 -->
				<tr <?=$bgcolor?> height='50'> 
					<td width='5%' align='center'><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td width='10%' align='center' class='b-text-s'><?=$name?></td>
					<td width='57%' style='padding-left:5px;' class='b-text-s'><?=$btn_tit_view?></td>
					<td width='13%' align='center' class='b-text-s'><?=$reg_date?></td>
					<td width='15%' align='center' class='b-text-s'><a href="javascript:reg_modify('<?=$uid?>');"><img src="<?=$BTN_modify02?>" alt="수정"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="<?=$BTN_del02?>" alt="삭제" width="50" height="21"></a></td>
				</tr>

				<tr id='a_line<?=$line_num?>' style="display:none"> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>

				<!-- 답변 -->
				<tr id='a_ment<?=$line_num?>' style="display:none" <?=$bgcolor?>>
					<td align='center'></td>
					<td align='center'><img src="<?=$BTN_aimg?>" style='width:auto !important;'></td>
					<td style='padding:10px 5px;' colspan='3'><span class='board1'><?=$ment?></span></td>
				</tr>

<?
		}else{
?>

				<!-- 질문 -->
				<tr <?=$bgcolor?> height='50'> 
					<td width='20%' align='center'><?=$name?></td>
					<td width='80%' style='padding-left:5px;'><?=$btn_tit_view?></td>
					<!--<td width='15%' align='center'><?=$reg_date?></td>-->
				</tr>


				<tr id='a_line<?=$line_num?>' style="display:none"> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>

				<!-- 답변 -->
				<tr id='a_ment<?=$line_num?>' style="display:none" <?=$bgcolor?>> 
					<td align='center'><img src="<?=$BTN_aimg?>" style='width:auto !important;'></td>
					<td style='padding:50px 5px;' colspan='2'><span class='board1' style='line-height:20px;'><?=$ment?></span></td>
				</tr>


<?
		}
?>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>




<?
		$i--;
		$line_num++;
	}

	echo ("<input type='hidden' name='tot_class' value='$line_num'>");

}else{
?>

				<tr> 
					<td colspan="<?=$cols?>" align='center' height='50'>등록된 게시물이 없습니다</td>
				</tr>

<?
}
?>

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

				<tr> 
					<td height="25" colspan="<?=$cols?>" align='right'><?=$btn_write?></td>
				</tr>
			</table>									
		</td>
	</tr>
</table>




</form>
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


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>

<input type='hidden' name='pid' value='<?=$pid?>'><!-- 상품번호 -->



<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0"> 

	<tr>
		<td height='30' align='right'>
			<select name="field">
				<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
				<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>
				<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
			</select>
			<input name="word" type="text" size="20" value='<?=$word?>'> <a href='javascript:document.frm01.submit();'><img src='<?=$BTN_search?>' align='absmiddle' alt='검색'></a>
		</td>
	</tr>
	<tr> 
		<td bgcolor="8c8c8c"  height="1" colspan="2"></td>
	</tr>
	<tr>
		<td colspan='2'>
			
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="5" bgcolor="353535" height="1"></td>
				</tr>
				<!--  번호 제목 글쓴이 날짜 조회수 -->
				<tr height="35" bgcolor="fbfbfb" class="board_top">
					<td width="94">no</td>
					<td width="680">subject</td>
					<td width="159">name</td>
					<td width="127">date</td>
					<td width="90">hit</td>
				</tr>
				<tr>
					<td colspan="5" bgcolor="353535" height="1"></td>
				</tr>

				

<?
//새글표시기간
$newday = 3;

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysqli_fetch_array($result)){
		$noTxt = ($total_record - $i) + 1;

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$data01 = $row["data01"];
		$name = $row["name"];
		$hit = $row["hit"];
		$hit = number_format($hit);
		$pwd_chk = $row["pwd_chk"];

		$reg_date=$row["reg_date"];

		//새글표시
		$date_diff = Util::dateDiffTime($reg_date);

		if($date_diff < $newday)	$B_NewIcon = "<img src='/images/mBoardNew.gif'>";
		else	$B_NewIcon = '';

		$reg_date = date("Y-m-d",$reg_date);

		$starImg = '';
		for($s=0; $s<$data01; $s++){
			$starImg .= "<img src='/images/star.jpg'>";
		}


		//공지글 배경색상지정
		if($notice_chk){
			$bgcolor=" bgcolor='#efefef'";
			$no = '공지';
			$scls = 'bbs01b';

		}else{
			$bgcolor='';
			$no = $i;
			$scls = 'bbs01';
		}

		//비밀글설정
		if($pwd_chk){
			$lock_icon=" <img src='".$BTN_lock."'>";

			if($GBL_MTYPE == 'A')	 $str_len = '72';
			else	 $str_len = '82';

		}else{
			$lock_icon='';

			if($GBL_MTYPE == 'A')	 $str_len = '76';
			else	 $str_len = '86';

		}

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,$str_len,'..');



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';



		//등록된 한줄의견수
		$query01 = "select * from tb_board_coment where pid='$uid'";
		$query02 = mysqli_query($dbc,$query01);
		$c_tot_num = mysqli_num_rows($query02);

		if($c_tot_num)	 $c_tot_num = "<font color='#086692'>[".$c_tot_num."]</font>";
		else	$c_tot_num = '';

?>
				<tr>
					<td colspan="5" bgcolor="353535" height="1"></td>
				</tr>
				<tr height="40">
					<td width="94" align="center"><?=$i?></td>
					<td width="680"><?=$lock_icon?>	<?=$btn_tit_view?> <?=$c_tot_num?> <?=$B_NewIcon?></td>
					<td width="159" align="center"><?=$name?></td>
					<td width="127" align="center"><?=$reg_date?></td>
					<td width="90" align="center"><?=$hit?></td>
				</tr>




<?
//답글리스트
include $boardRoot.'reply_list01.php';
?>





<?
		$i--;
		$line_num++;
	}
}else{
?>

				<tr> 
					<td colspan="5" align='center' height='50'>등록된 게시물이 없습니다</td>
				</tr>

<?
}
?>

				<tr>
					<td colspan="5" height="1" bgcolor="8c8c8c"></td>
				</tr>
				<tr>
					<td colspan="5" height="3" bgcolor="f5f5f5"></td>
				</tr>

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

				<tr> 
					<td height="25" colspan="5" align='right' style="padding:7 5 0 0">
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
								<?
									if($UserOS == 'mobile'){
										echo ("<a href=\"javascript:parent.user_review('<?=$pid?>');\" class='big cbtn blue'>이용후기등록</a>");
									}else{
										echo $btn_write;
									}
								?>
								</td>
								<td style='padding:0px 0px 0px 5px;'><a href="/sub08/sub05.php" target='_parent' class='big cbtn black'>모두보기<!--img src='/images/new/board_btn02.gif'--></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>									
		</td>
	</tr>
</table>




</form>
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



<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<table width="100%" border="0" cellspacing="0" cellpadding="0"> 

	<tr>
		<td style='padding:0 0 5px 0;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>

<?
if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
?>
		<a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='전체선택'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='선택삭제'></a>
<?
}
?>
					</td>
					<td width='50%' height='30' align='right'>
						<select name="field" style='height:30px;'>
							<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
							<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>
							<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
						</select>
						<input name="word" type="text" style='width:200px;height:30px;' value='<?=$word?>'> <a href='javascript:document.frm01.submit();'><img src='<?=$BTN_search?>' align='absmiddle' alt='검색'></a>
					</td>
				</td>
			</table>
		</td>
	</tr>



<?
if($GBL_MTYPE == 'A'){
	$cols = '7';
?>
	<tr>
		<td style="border:1px solid #bcbcbc; border-left:0px; border-right:0px; background-color:#f6f6f6; padding:8px 0px; text-align:center;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr align='center'>
					<td width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></td>
					<td width="5%" class='b-text'>번호</td>
					<td width="42%" class='b-text'>제목</td>
					<td width="10%" class='b-text'>글쓴이</td>
					<td width="8%" class='b-text'>조회수</td>
					<td width="13%" class='b-text'>등록일</td>
					<td width="17%" class='b-text'>편집</td>
				</tr>
			</table>
		</td>
	</tr>

<?
}else{
	$cols = '5';
?>
	<tr>
		<td style="border:1px solid #bcbcbc; border-left:0px; border-right:0px; background-color:#f6f6f6; padding:8px 0px; text-align:center;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr align='center'>
					<td width="8%" class='b-text'>번호</td>
					<td width="56%" class='b-text'>제목</td>
					<td width="15%" class='b-text'>글쓴이</td>
					<td width="8%" class='b-text'>조회수</td>
					<td width="13%" class='b-text'>등록일</td>
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
//새글표시기간
$newday = 3;

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

		$reg_date=$row["reg_date"];

		//새글표시
		$date_diff = Util::dateDiffTime($reg_date);

		if($date_diff < $newday)	$B_NewIcon = "<img src='/images/mBoardNew.gif'>";
		else	$B_NewIcon = '';

		$reg_date = date("Y-m-d",$reg_date);


		//공지글 배경색상지정
		if($notice_chk)	 $bgcolor=" bgcolor='#efefef'";
		else	$bgcolor='';

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
		$query02 = mysql_query($query01);
		$c_tot_num = mysql_num_rows($query02);

		if($c_tot_num)	 $c_tot_num = "<font color='#086692'>[".$c_tot_num."]</font>";
		else	$c_tot_num = '';

		

		

		if($GBL_MTYPE == 'A'){

?>
				<tr <?=$bgcolor?> height='35'> 
					<td width="5%" class='b-text-s' align='center'><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td width="5%" class='b-text-s' align='center'><?=$i?></td>
					<td width="42%" class='b-text-s' style='padding-left:5px;'><?=$lock_icon?>	<?=$btn_tit_view?> <?=$c_tot_num?> <?=$B_NewIcon?></td>
					<td width="10%" class='b-text-s' align='center'><?=$name?></td>
					<td width="8%" class='b-text-s' align='center'><?=$hit?></td>
					<td width="13%" class='b-text-s' align='center'><?=$reg_date?></td>
					<td width="17%" class='b-text-s' align='center'><a href="javascript:reg_modify('<?=$uid?>');"><img src="<?=$BTN_modify02?>" alt="수정"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="<?=$BTN_del02?>" alt="삭제" width="50"></a></td>
				</tr>


<?
		}else{
?>

				<tr <?=$bgcolor?> height='35'> 
					<td width="8%" class='b-text-s' align='center'><?=$i?></td>
					<td width="56%" class='b-text-s' style='padding-left:5px;'><?=$lock_icon?>	<?=$btn_tit_view?> <?=$c_tot_num?> <?=$B_NewIcon?></td>
					<td width="15%" class='b-text-s' align='center'><?=$name?></td>
					<td width="8%" class='b-text-s' align='center'><?=$hit?></td>
					<td width="13%" class='b-text-s' align='center'><?=$reg_date?></td>
				</tr>

<?
		}
?>

				<tr>
					<td colspan="<?=$cols?>" height="1px" bgcolor="#e9e9e9"></td>
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
					<td colspan="<?=$cols?>" align='right' style="padding:20px 0;"><?=$btn_write?></td>
				</tr>
			</table>									
		</td>
	</tr>
</table>




</form>
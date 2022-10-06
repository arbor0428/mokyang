<?

	if($uid){

		//조회수증가
		$sql = "update tb_board_list set hit = hit + 1 where uid='$uid'";
		$result = mysql_query($sql);


		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
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

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);


		if($data01 && $data02 && $data03){
			$yoil = date('w',strtotime($data01.'-'.$data02.'-'.$data03));

			if($yoil == 0)	$yoiltxt = '(일요일)';
			elseif($yoil == 1)	$yoiltxt = '(월요일)';
			elseif($yoil == 2)	$yoiltxt = '(화요일)';
			elseif($yoil == 3)	$yoiltxt = '(수요일)';
			elseif($yoil == 4)	$yoiltxt = '(목요일)';
			elseif($yoil == 5)	$yoiltxt = '(금요일)';
			elseif($yoil == 6)	$yoiltxt = '(토요일)';
		}

		if($data04 == '공연')	$data04Txt = "<span class='ico01'>공연</span>";
		elseif($data04 == '전시')	$data04Txt = "<span class='ico04'>전시</span>";
		elseif($data04 == '예술교육')	$data04Txt = "<span class='ico08'>예술교육</span>";
		elseif($data04 == '축제')	$data04Txt = "<span class='ico06'>축제</span>";

	}




?>



<script language='javascript'>
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

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function error_msg(mod){
	if(mod == 'r'){
		alert('답글작성 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->



<!--등록-->

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
				<tr> 
					<th>제 목</th>
					<td colspan='3'><?=$title?></td>
				</tr>

				<tr> 
					<th width='17%'>장 르</th>
					<td width='33%'><?=$sData01?></td>
					<th width='17%'>장 소</th>
					<td width='33%'><?=$sData02?></td>
				</tr>

				<tr> 
					<th>일 자</th>
					<td><?=$sData03?></td>
					<th>연 령</th>
					<td><?=$sData04?></td>
				</tr>

				<tr> 
					<th>간단설명</th>
					<td colspan='3' height='120'><?=$sDataTxt?></td>
				</tr>

				<tr> 
					<th>주 최</th>
					<td><?=$sData05?></td>
					<th>문 의</th>
					<td><?=$sData06?></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td style='height:200px;border-bottom:1px solid #ccc;padding:10px 0;'><?=$ment?></td>
	</tr>


	<tr>
		<td height='50'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='40%'>

					<!-- 수정 or 삭제시 비밀번호 입력 테이블 -->

<script language='javascript'>


function isEnter4(){
	if(event.keyCode==13){
		mod_pwd();
		return;
	}
}

function mod_pwd(){
	form = document.FRM;

	if(isFrmEmpty(form.mod_pwd,"비밀번호를 입력해 주십시오"))	return;	
	form.action = '<?=$boardRoot?>pwd_proc.php';
	form.submit();

}

function tblDataPwd(mod){

	form = document.FRM;
 
	var tr = document.getElementById("tbl_mod");


	if(mod == 'del'){
		if(!confirm('삭제하시겠습니까?')){
			return;
		}
	}

	tr.style.display='';		
	form.type.value = mod;
	form.mod_pwd.focus();


}

</script>

						<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none">
							<tr>
								<td><b>비밀번호</b></td>
								<td width='5'></td>
								<td><input type='password' name='mod_pwd' style='width:130px;' onKeyPress="javascript:isEnter4()"></td>
								<td width='5'></td>
								<td><a href="javascript:mod_pwd();"><img src="<?=$BTN_pwdok?>" alt="확인"></a></td>
							</tr>
						</table>

					<!-- /수정 or 삭제시 비밀번호 입력 테이블 -->

					</td>


<?
//답글쓰기 권한설정
include $boardRoot.'chk_reply.php';
?>



<?
//수정 & 삭제버튼 설정
if($GBL_MTYPE){
	if($GBL_MTYPE == 'A' || $GBL_USERID == $userid){
		$btn_tbl_type = 'ok';

	}else{
		$btn_tbl_type = 'pwd';

	}

}else{
	$btn_tbl_type = 'pwd';
}
?>


				<?
					if($btn_tbl_type == 'ok'){
				?>

					<td width='60%' align='right'>
					<!--
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();" class='big cbtn blue'>수정</a>&nbsp;
						<a href="javascript:reg_del();" class='big cbtn blood'>삭제</a>&nbsp;
					-->
						<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
					</td>

				<?
					}else{
				?>
					<td width='60%' align='right'>
					<!--
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');" class='big cbtn blue'>수정</a>&nbsp;
						<a href="javascript:tblDataPwd('del');" class='big cbtn blood'>삭제</a>&nbsp;
					-->
						<a href="javascript:reg_list();" class='big cbtn black'>목록</a>

					</td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
</table>





<!-- 한줄의견-->
<?
include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>


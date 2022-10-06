<?

	if($uid){

		//조회수증가
		$sql = "update tb_board_list set hit = hit + 1 where uid='$uid'";
		$result = mysqli_query($dbc,$sql);


		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		$pid = $row["pid"];
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
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);
		$hit=$row["hit"];

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

		$starImg = '';
		for($s=0; $s<$data01; $s++){
			$starImg .= "<img src='/images/star.jpg'>";
		}
	}




?>



<script language='javascript'>

function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	form.ment.value = SubmitHTML();

	form.action = '<?=$boardRoot?>proc.php';
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

<input type='hidden' name='pid' value='<?=$pid?>'><!-- 상품번호 -->



<!--등록-->


<table width='100%' border="0" cellspacing="0" cellpadding="0" class='gTable2'>
<?
	if($pid){
?>
	<tr> 
		<th width='17%' style='border-top:2px solid #8c8c8c !important;'>상품정보</th>
		<td width='83%' style='border-top:2px solid #e86261 !important;' colspan='3'>
		<?
			$psql = "select * from ks_product where uid='$pid'";
			$presult = mysqli_query($dbc,$psql);
			$prow = mysqli_fetch_array($presult);

			$pcade01 = $prow["cade01"];		//분류
			$ptitle = $prow["title"];					//상품명
			$pupfile01 = $prow["upfile01"];		//이미지
			$pprice = $prow["price"];				//판매가격
			$ppriceTxt = number_format($pprice);

			$imgTag = '';

			if($pupfile01){
				$imgFile = $path.'thumb_'.$pupfile01;
				if(!is_file($imgFile))	$imgFile = $path.$pupfile01;
				$resize = Util::AutoImgSize($imgFile,150,187);
				$imgTag = "<img src='$imgFile' $resize>";

				if($pcade01 == '여성한복')				$act = '/sub02/sub01.php';
				elseif($pcade01 == '남성한복')			$act = '/sub03/sub01.php';
				elseif($pcade01 == '커플한복')			$act = '/sub04/sub01.php';
				elseif($pcade01 == '장신구')				$act = '/sub05/sub01.php';
				elseif($pcade01 == '여아한복')			$act = '/sub02_1/sub01.php';
				elseif($pcade01 == '남아한복')			$act = '/sub03_1/sub01.php';
				elseif($pcade01 == '여아한복(판매)')	$act = '/sub02_2/sub01.php';
				elseif($pcade01 == '남아한복(판매)')	$act = '/sub03_2/sub01.php';
				elseif($pcade01 == '장신구(판매)')		$act = '/sub05_2/sub01.php';
				elseif($pcade01 == '털배자(조끼)')		$act = '/sub11/sub01.php';
		?>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td align='center' style='padding:5px 0px 5px 0px;'><?=$imgTag?></td>
					<td style='padding:0px 0px 0px 120px;'>
						<table cellpadding='2' cellspacing='0' border='0'>
							<tr>
								<td><b><?=$ptitle?></b></td>
							</tr>
							<tr>
								<td style='color:#52809a;'><b><?=$ppriceTxt?>원</b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		<?
			}
		?>
		</td>
	</tr>
<?
	}
?>
	<tr> 
		<th width='17%' class='tab_bbs'>등록일</th>
		<td width='83%' class='tab' colspan='3'><?=$reg_date?></td>
	</tr>
	<tr> 
		<th class='tab_bbs'>제목</th>
		<td class='tab' colspan='3'><?=$title?></td>
	</tr>
	<tr> 
		<th width='17%' class='tab_bbs'>작성자</th>
		<td width='33%' class='tab'><?=$name?></td>
		<th width='17%' class='tab_bbs'>조회수</th>
		<td width='33%' class='tab'><?=$hit?></td>
	</tr>


	<tr height="300" valign="top"> 
		<td colspan='4' style="padding:20 20 10 20"><?=$ment?></td>
	</tr>



<?

$fno = 0;

for($i=1; $i<=$upload_chk; $i++){
$file_num = sprintf("%02d",$i);
$file_name = ${'realfile'.$file_num};
$down_icon = '';


if($download_chk && $file_name){		
$rfile = ${'userfile'.$file_num};
$down_icon = "<a href='#' onclick=javascript:location.href='".$boardRoot."file_down.php?rfile=$rfile&sname=$file_name' target='ifra_down'><img src='".$boardRoot."img/down.gif'></a>";

}

if($file_name){
$fno++;
?>


	
	<tr> 
		<td bgcolor="cccccc"  height="1" colspan="3"></td>
	</tr>
	<tr> 
		<td class='bbs'>첨부파일#<?=$fno?></td>
		<td class='bbs01' colspan='2'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><?=$file_name?></td>
					<td width='80' align='right'><?=$down_icon?></td>
				</tr>
			</table>
		</td>
	</tr>

<?
}
}
?>

</table>


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
			<td><a href="javascript:mod_pwd();"><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a></td>
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
			<?=$btn_re_write?>
			<a href="javascript:reg_modify();" target='_parent' class='big cbtn black'>수정</a>
			<a href="javascript:reg_del();" target='_parent' class='big cbtn black'>삭제</a>
			<a href="javascript:reg_list();" target='_parent' class='big cbtn black'>목록</a>
			<!--
			<a href=""><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
			<a href=""><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
			<a href=""><img src="<?=$boardRoot?>img/list01.gif" border=0></a>
			-->
		</td>

	<?
		}else{
	?>
		<td width='60%' align='right'>
			<?
//							echo $btn_re_write;
			?>
			<a href="javascript:tblDataPwd('edit');" target='_parent' class='big cbtn black'>수정</a>
			<a href="javascript:tblDataPwd('del');" target='_parent' class='big cbtn black'>삭제</a>
			<a href="javascript:reg_list();" target='_parent' class='big cbtn black'>목록</a>
		</td>
	<?
		}
	?>
	</tr>
</table>





<!-- 한줄의견-->
<?
include $boardRoot.'coment.php';
?>
<!-- /한줄의견 -->




</form>

<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>
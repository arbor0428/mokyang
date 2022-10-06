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
		$name = $row["name"];
		$title = $row["title"];
		$ment = $row["ment"];
		$startDate = $row["startDate"];
		$endDate = $row["endDate"];
		$sDate = $row["sDate"];
		$eDate = $row["eDate"];

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d H:i:s",$reg_date);

		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];
		$userfile06 = $row["userfile06"];
		$userfile07 = $row["userfile07"];
		$userfile08 = $row["userfile08"];
		$userfile09 = $row["userfile09"];
		$userfile10 = $row["userfile10"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];
		$realfile06 = $row["realfile06"];
		$realfile07 = $row["realfile07"];
		$realfile08 = $row["realfile08"];
		$realfile09 = $row["realfile09"];
		$realfile10 = $row["realfile10"];

		$hit = $row["hit"];
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
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function reg_modify(){
	form = document.FRM;
	form.type.value = 'edit';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function reg_reply(){
	form = document.FRM;
	form.type.value = 're_write';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
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



<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='upid' value='<?=$uid?>'><!-- 답글작성용 -->
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>


<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">
<input type='hidden' name='dbfile06' value="<?=$userfile06?>">
<input type='hidden' name='dbfile07' value="<?=$userfile07?>">
<input type='hidden' name='dbfile08' value="<?=$userfile08?>">
<input type='hidden' name='dbfile09' value="<?=$userfile09?>">
<input type='hidden' name='dbfile10' value="<?=$userfile10?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">
<input type='hidden' name='realfile06' value="<?=$realfile06?>">
<input type='hidden' name='realfile07' value="<?=$realfile07?>">
<input type='hidden' name='realfile08' value="<?=$realfile08?>">
<input type='hidden' name='realfile09' value="<?=$realfile09?>">
<input type='hidden' name='realfile10' value="<?=$realfile10?>">

<div class="tbl-st">
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">제목</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$title?></span></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">접수기간</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$startDate?>~<?=$endDate?></span></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">지원처</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$name?></span></div>
	</div>
	<!--
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">모집목표액</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=number_format($sData01)?>원</span></div>
	</div>
	-->


	<!--
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">사용기간</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$sDate?>~<?=$eDate?></span></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">모집분야</span></div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$sData02?></span></div>
	</div>
	-->

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">대상</div>
		<div class="tbl-st-col col-2"><span class="smooth dp_ir"><?=$sData03?></span></div>
	</div>
	

	<div class="tbl-st-row clearfix">
		<div class='bbs01'  style="padding:30px 0;">
			<div class="view-boxs">
				<?=$ment?>
			</div>
		</div>
	</div>



	<?

	$fno = 0;
	if($download_chk == '')	$upload_chk = 0;

	for($i=1; $i<=$upload_chk; $i++){
		$file_num = sprintf("%02d",$i+1);
		$file_name = ${'realfile'.$file_num};

		if($file_name){
			$fno++;
	?>



		<div class="tbl-st-row clearfix">
			<div class="tbl-st-col col-1">첨부파일#<?=$fno?></div>
			<div class="tbl-st-col col-2">
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td><?=$file_name?></td>
					<?
						if($download_chk){
					?>
						<td width='80' align='right'><a href="javascript:file_down('FRM','<?=$file_num?>');" class='mini cbtn black'>다운로드</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</div>
		</div>

		<?
			}
		}
		?>


</div>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' style="margin-top:20px;">
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

							<table cellpadding='0' cellspacing='0' border='0' id='tbl_mod' style="display:none;">
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
					//글쓰기 권한 설정
					include $boardRoot.'chk_write.php';

					?>


					<?
					//수정 & 삭제버튼 설정
					if($GBL_MTYPE){
						if($GBL_MTYPE == 'A' || $GBL_USERID == $userid || $chk_type == 'ok'){
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

					<td align='right'>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();" class='big cbtn blue'>수정</a>&nbsp;
						<a href="javascript:reg_del();" class='big cbtn blood'>삭제</a>&nbsp;
						<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
					</td>

				<?
					}else{
				?>
					<td align='right'>
					<!--
						<?=$btn_re_write?>
						<a href="javascript:tblDataPwd('edit');"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
						<a href="javascript:tblDataPwd('del');"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
					-->
						<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
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
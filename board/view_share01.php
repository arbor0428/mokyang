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

		$sql = "select * from ks_bongsa01 where pid='$uid'";
		$row = sqlRow($sql);

		if($row){
			foreach($row as $k => $v){
				${$k} = $v;
			}
		}
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

function reg_join(){
	form = document.FRM;
	form.type.value = 'join01';
	form.action = '<?=$boardRoot?>proc.php';
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

function joinList(u){
	$("#multiBox").css({"width":"90%","max-width":"560px"});
	document.getElementById("multiFrame").innerHTML = "<iframe src='/module/joinList01.php?uid="+u+"' style='width:100%;height:600px;' frameborder='0' scrolling='auto'></iframe>";
	$(".multiBox_open").click();
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
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>

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
		<div class="tbl-st-col col-1 f16">봉사기간</div>
		<div class="tbl-st-col col-2 f16"><?=$bsDate?>~<?=$beDate?></div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사시간</div>
		<div class="tbl-st-col col-2 f16"><?=$bsHour?>시<?=$bsMin?>분~<?=$beHour?>시<?=$beMin?>분</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">모집기간</div>
		<div class="tbl-st-col col-2 f16"><?=$gsDate?>~<?=$geDate?></div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">활동요일</div>
		<div class="tbl-st-col col-2 f16"><?=$yoil?></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">모집인원</div>
		<div class="tbl-st-col col-2 f16"><?=$people?>명</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">신청인원</div>
		<div class="tbl-st-col col-2 f16">
		<?
			$cnt = sqlRowOne("select count(*) from ks_bongsa01_join where pid='$uid'");
			echo $cnt.'명';
		?>

		<?if($GBL_MTYPE == 'A'){?>
			<a href="javascript:joinList('<?=$uid?>');" class="small cbtn black" style="margin-left:20px;">인원확인</a>
		<?}?>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">봉사분야</div>
		<div class="tbl-st-col col-2 f16"><?=$cade01?> &gt; <?=$cade02?></div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사자유형</div>
		<div class="tbl-st-col col-2 f16"><?=$bongType?></div>
	</div>

	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">모집기관</div>
		<div class="tbl-st-col col-2 f16"><?=$agent?></div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사지역</div>
		<div class="tbl-st-col col-2 f16"><?=$loc01?> &gt; <?=$loc02?></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">봉사장소</div>
		<div class="tbl-st-col col-2 f16"><?=$place?></div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사대상</div>
		<div class="tbl-st-col col-2 f16"><?=$bTarget?></div>
	</div>
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">활동구분</div>
		<div class="tbl-st-col col-2 f16"><?=$actType?></div>
	</div>

	
<?

$fno = 0;
if($download_chk == '')	$upload_chk = 0;

for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
	$file_name = ${'realfile'.$file_num};

	if($file_name){
		$fno++;
?>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1 f16">첨부파일#<?=$fno?></div>
		<div class="tbl-st-col col-2 f16">
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<?=$file_name?>
				<?
					if($download_chk){
				?>
					<a href="javascript:file_down('FRM','<?=$file_num?>');" class='mini cbtn black'> 다운로드</a>
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
<p class="f16 m20">※ 로그인 하시면 신청이 가능합니다.</p>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
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

					<td width='60%' align='right'>
						<?=$btn_re_write?>
						<a href="javascript:reg_modify();" class='big cbtn blue'>수정</a>&nbsp;
						<a href="javascript:reg_del();" class='big cbtn blood'>삭제</a>&nbsp;
						<a href="javascript:reg_list();" class='big cbtn black'>목록</a>
					</td>

				<?
					}else{
				?>

				<div class="txt_c m36">
					<?
						if($GBL_MTYPE == 'A'){
					?>
					<?
						}elseif($GBL_USERID){
							//신청여부
							$tmpChk = sqlRow("select * from ks_bongsa01_join where pid='$uid' and userid='$GBL_USERID'");
							if($tmpChk){
					?>
						<a href="javascript:GblMsgBox('이미 접수되었습니다.');" class='big cbtn blood' style='padding:20px 40px;'>신청하기</a>
					<?
							}else{
					?>
						<a href="javascript:reg_join();" class='big cbtn blood' style='padding:20px 40px;'>신청하기</a>
					<?
							}
						}else{
					?>
					<?
						}
					?>
				</div>
					<td width='60%' align='right'>
					
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

<iframe name='ifra_down' src='about:blank' width='0' height='0' frameborder='0' scrolling='0'></iframe>
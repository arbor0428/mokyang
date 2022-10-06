<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$sDataUrl = $row["sDataUrl"];

		$reg_date = $row["reg_date"];

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

		
		$endDate = $row["endDate"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);

	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;
?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
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
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value="<?=$type?>">
<input type='hidden' name='uid' value="<?=$uid?>">
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='f_data01' value="<?=$f_data01?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">

<input type='hidden' name='table_id' value="<?=$table_id?>">
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



<!--등록-->

<div class="tbl-st">
<?
	if($GBL_MTYPE == 'A'){
?>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1">공지</div>
		<div class="tbl-st-col col-2"> <input type="checkbox" name="notice_chk" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</div>
	</div>
<?
	}else{
?>
	<input type='hidden' name='notice_chk' value='<?=$notice_chk?>'>
<?
	}
?>
<?
	//뉴스(언론보도형)
	if($table_id == 'table_1639985596'){
?>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1">기사주소</div>
		<div class="tbl-st-col col-2"><input type="text" name="data01" style='width:98%;' value="<?=$data01?>"></div>
	</div>
<?
	}
?>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">제목</div>
		<div class="tbl-st-col col-2"><input type="text" name="title" style='width:98%;' value="<?=$title?>"></div>
	</div>
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">작성자</div>
		<div class="tbl-st-col col-2"><input type="text" name="name" style='width:205px;' value="<?=$name?>"></div>
	</div>
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">비밀번호</div>
		<div class="tbl-st-col col-2" style="font-size:12px;">
			<input name="passwd" type="password" style='width:140px;' value="<?=$passwd?>">
			<input type='hidden' name='pwd_chk' value=''>
		</div>
	</div>

<?
	if($GBL_MTYPE == 'A'){
?>
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">등록일시</div>
		<div class="tbl-st-col col-2">
			<select name='set_ry' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=date('Y')+1; $i>=2016; $i--){
					if($i == $set_ry)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>년
			<select name='set_rm' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=1; $i<=12; $i++){
					$set_rm_no = sprintf('%02d',$i);
					if($i == $set_rm)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>월
			<select name='set_rd' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=1; $i<=31; $i++){
					$set_rd_no = sprintf('%02d',$i);
					if($i == $set_rd)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>일&nbsp;&nbsp;

			<select name='set_rh' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=0; $i<=23; $i++){
					$set_rh_no = sprintf('%02d',$i);
					if($i == $set_rh)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>시
			<select name='set_ri' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=0; $i<=59; $i++){
					$set_ri_no = sprintf('%02d',$i);
					if($i == $set_ri)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>분
			<select name='set_rs' style='height:30px; border:1px solid #e1e1e1; border-radius:4px; margin-right:4px;'>
			<?
				for($i=0; $i<=59; $i++){
					$set_rs_no = sprintf('%02d',$i);
					if($i == $set_rs)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>초&nbsp;&nbsp;
			<input type='button' name='btn_set' value='현재시간' onclick='setToDate(this.form);' style='padding:0 10px; height:30px; border:1px solid #e1e1e1; border-radius:4px; cursor:pointer;'>
		</div>
	</div>
<?
	}
?>

<?
	if($list_mod == '갤러리형'){
?>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1">영상주소</div>
		<div class="tbl-st-col col-2"><input type="text" name="sDataUrl" style='width:98%;' value="<?=$sDataUrl?>"></div>
	</div>
<?
	}
?>

<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	$upfile = ${'userfile'.$file_num};
	$realfile = ${'realfile'.$file_num};

	if($list_mod == '갤러리형' || $list_mod == '블로그형'){
		if($i == 1)	$fileTitle = "썸네일";
		else			$fileTitle = "첨부파일 #".($i-1);

	}else{
		$fileTitle = "첨부파일 #".$i;
	}
?>


	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><?=$fileTitle?></div>
		<div class="tbl-st-col col-2">
			<input type="text" readonly title="File Route" id="file_route<?=$file_num?>" style="width:290px;padding:0 0 0 10px;">
			<label><!--찾아보기--><input type="file" name="upfile<?=$file_num?>" onchange="javascript:document.getElementById('file_route<?=$file_num?>').value=this.value"></label>
		</div>
	<?
		if($upfile){
	?>
		<div class="tbl-st-col col-2">
			<div class="enable_btn">
				<div class="squaredThree">
					<input type="checkbox"  id="squaredDel<?=$file_num?>" type="checkbox" name="del_upfile<?=$file_num?>" value="Y" />
					<label for="squaredDel<?=$file_num?>"></label>										
				</div>
				<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile?>)</p>
			</div>
		</div>
	<?
		}
	?>
	</div>
<?
}
?>

	<div style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></div>

	<div class="con clearfix">
		<table style="float:right;">
		<?
		if($type == 'write'){
		?>
			<tr>
				<td align='right' height='50'>
					<a href="javascript:check_form();" class="btn blk">등록</a>&nbsp;
					<a href="javascript:reg_list();" class="btn gry">취소</a>
				</td>
			</tr>
		<?
		}else{
		?>
			<tr>
				<td align='right' height='50'>
					<a href="javascript:check_form();" class="btn grn">수정</a>&nbsp;
					<a href="javascript:reg_del();" class="btn red">삭제</a>&nbsp;
					<a href="javascript:reg_list();" class="btn blk">목록</a>
				</td>
			</tr>
		<?
		}
		?>
					
		</table>
	</div>
</div>

</form>

<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
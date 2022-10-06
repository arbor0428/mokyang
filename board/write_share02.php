<?
	$yoilList = Array();
	$bongList = Array();

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];

		$name = $row["name"];
		$title = $row["title"];
		$reg_date = $row["reg_date"];
		$startDate = $row["startDate"];
		$endDate = $row["endDate"];
		$sDate = $row["sDate"];
		$eDate = $row["eDate"];

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);


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


		$sql = "select * from ks_bongsa01 where pid='$uid'";
		$row = sqlRow($sql);

		if($row){
			foreach($row as $k => $v){
				${$k} = $v;
			}

			if($yoil)			$yoilList = explode(',',$yoil);
		}
	}





?>

<style type='text/css'>
.gfTxt01{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 15px;
}

.gfTxt02{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 35px;
}

.checkbox_wrap li{float:left;margin-right:20px;}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script>
function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"지원처를 입력해 주십시오"))	return;
//	if(isFrmEmpty(form.sData01,"모집목표액을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.startDate,"접수기간을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.endDate,"접수기간을 입력해 주십시오"))	return;
//	if(isFrmEmpty(form.sDate,"사용기간을 입력해 주십시오"))	return;
//	if(isFrmEmpty(form.eDate,"사용 입력해 주십시오"))	return;
	if(isFrmEmpty(form.sData03,"대상을 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
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



<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='SITE_ID' id='SITE_ID' value='<?=$SITE_ID?>'>
<input type='hidden' name='board_width' id='board_width' value='<?=$board_width?>'>

<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$userfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$userfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$userfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$userfile05?>'>

<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>

<input type='hidden' name='list_mod' value='<?=$list_mod?>'><!-- 게시판형태 -->
<input type='hidden' name='img_w' value='<?=$img_w?>'><!-- 썸네일 크기 -->
<input type='hidden' name='img_h' value='<?=$img_h?>'><!-- 썸네일 크기 -->




<div class="tbl-st">
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">제 목</div>
		<div class="tbl-st-col col-2"><input type="text" name="title" style='width:98%;' value="<?=$title?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><!--기 관-->지원처</div>
		<div class="tbl-st-col col-2"><input type="text" name="name" style='width:200px;' value="<?=$name?>"></div>
	</div>
	<!--
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">모집목표액</div>
		<div class="tbl-st-col col-2"><input type="text" name="sData01" style='width:200px;' value="<?=$sData01?>">원</div>
	</div>
	-->
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><!--모집기간-->접수기간</div>
		<div class="tbl-st-col col-2">
			<input type="text" name="startDate" id="startDate" class="fpicker" style='width:140px;' value="<?=$startDate?>"> ~ 
			<input type="text" name="endDate" id="endDate" class="fpicker" style='width:140px;' value="<?=$endDate?>">
		</div>
	</div>
	<!--
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">사용기간</div>
		<div class="tbl-st-col col-2">
			<input type="text" name="sDate" id="sDate" class="fpicker" style='width:140px;' value="<?=$sDate?>"> ~ 
			<input type="text" name="eDate" id="eDate" class="fpicker" style='width:140px;' value="<?=$eDate?>">
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">모집분야</div>
		<div class="tbl-st-col col-2">
			<select name="sData02" id="sData02" class='selectBox'>
				<option value="분야1" <?if($sData02 == '분야1'){echo 'selected';}?>>분야1</option>
				<option value="분야2" <?if($sData02 == '분야2'){echo 'selected';}?>>분야2</option>
				<option value="분야3" <?if($sData02 == '분야3'){echo 'selected';}?>>분야3</option>
			</select>
		</div>
	</div>
	-->

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><!--등록청-->대상</div>
		<div class="tbl-st-col col-2"><input type="text" name="sData03" style='width:200px;' value="<?=$sData03?>"></div>
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


</table>

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
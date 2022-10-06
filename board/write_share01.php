<?
	$yoilList = Array();
	$bongList = Array();

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$reg_date = $row["reg_date"];

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

<script>
function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.bsDate,"봉사기간을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.beDate,"봉사기간을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.gsDate,"모집기간을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.geDate,"모집기간을 입력해 주십시오"))	return;

	ylist0 = $('#ylist0').is(":checked");
	ylist1 = $('#ylist1').is(":checked");
	ylist2 = $('#ylist2').is(":checked");
	ylist3 = $('#ylist3').is(":checked");
	ylist4 = $('#ylist4').is(":checked");
	ylist5 = $('#ylist5').is(":checked");
	ylist6 = $('#ylist6').is(":checked");
	if(ylist0 == false && ylist1 == false && ylist2 == false && ylist3 == false && ylist4 == false && ylist5 == false && ylist6 == false){
		GblMsgBox('활동요일을 선택해 주십시오.');
		$('#ylist0').focus();
		return;
	}

	if(isFrmEmpty(form.people,"모집인원 입력해 주십시오"))	return;
	if(isFrmEmpty(form.cade01,"봉사분야를 선택해 주십시오"))	return;
	if(isFrmEmpty(form.cade02,"봉사분야를 선택해 주십시오"))	return;

	adult = $('#adult').is(":checked");
	boy = $('#boy').is(":checked");
	if(adult == false && boy == false){
		GblMsgBox('봉사자유형을 선택해 주십시오.');
		$('#adult').focus();
		return;
	}

	if(isFrmEmpty(form.agent,"모집기관을 입력해 주십시오"))		return;
	if(isFrmEmpty(form.loc01,"봉사지역을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.loc02,"봉사지역을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.place,"봉사장소를 입력해 주십시오"))		return;

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


$(function(){
	$('#loc01').change(function(){
		c1 = $(this).val();

		//시도군 선택
		$.post('/module/jsonLoc.php',{'c1':c1}, function(c2){
			//시도군 selectbox 초기화
			$('#loc02').empty();
			$('#loc02').append("<option value=''>선택</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			//시도군 selectbox 옵션설정	
			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#loc02').append(option);
			}
		});
	});



	$('#cade01').change(function(){
		c1 = $(this).val();

		$.post('/module/jsonvCade.php',{'c1':c1}, function(c2){
			$('#cade02').empty();
			$('#cade02').append("<option value=''>선택</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#cade02').append(option);
			}
		});
	});
});
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
		<div class="tbl-st-col col-1">봉사기간</div>
		<div class="tbl-st-col col-2">
			<input type="text" name="bsDate" id="bsDate" class="fpicker" style='width:140px;' value="<?=$bsDate?>"> ~ 
			<input type="text" name="beDate" id="beDate" class="fpicker" style='width:140px;' value="<?=$beDate?>">
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사시간</div>
		<div class="tbl-st-col col-2">
			<select name="bsHour" id="bsHour" class="selectBox" style="width:80px;">
			<?
				for($i=0; $i<=23; $i++){
					$n = sprintf('%02d',$i);

					if($bsHour == $n)	$chk = "selected";
					else					$chk = "";
			?>
				<option value='<?=$i?>' <?=$chk?>><?=$n?>시</option>
			<?
				}
			?>
			</select>:
			<select name="bsMin" id="bsMin" class="selectBox" style="width:80px;">
			<?
				for($i=0; $i<=50; $i+=10){
					$n = sprintf('%02d',$i);

					if($bsMin == $n)	$chk = "selected";
					else					$chk = "";
			?>
				<option value='<?=$i?>' <?=$chk?>><?=$n?>분</option>
			<?
				}
			?>
			</select>
			~ 
			<select name="beHour" id="beHour" class="selectBox" style="width:80px;">
			<?
				for($i=0; $i<=23; $i++){
					$n = sprintf('%02d',$i);

					if($beHour == $n)	$chk = "selected";
					else					$chk = "";
			?>
				<option value='<?=$i?>' <?=$chk?>><?=$n?>시</option>
			<?
				}
			?>
			</select>:
			<select name="beMin" id="beMin" class="selectBox" style="width:80px;">
			<?
				for($i=0; $i<=50; $i+=10){
					$n = sprintf('%02d',$i);

					if($beMin == $n)	$chk = "selected";
					else					$chk = "";
			?>
				<option value='<?=$i?>' <?=$chk?>><?=$n?>분</option>
			<?
				}
			?>
			</select>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">모집기간</div>
		<div class="tbl-st-col col-2">
			<input type="text" name="gsDate" id="sDate" class="fpicker" style='width:140px;' value="<?=$gsDate?>"> ~ 
			<input type="text" name="geDate" id="eDate" class="fpicker" style='width:140px;' value="<?=$geDate?>">
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">활동요일</div>
		<div class="tbl-st-col col-2">
			<ul class="checkbox_wrap">
			<?
				$yoilArr = Array('월','화','수','목','금','토','일');
				foreach($yoilArr as $k => $v){
					if(in_array($v,$yoilList))		$chk = 'checked';
					else								$chk = '';
			?>
				<li><input type="checkbox" name="ylist[]" id="ylist<?=$k?>" value="<?=$v?>" <?=$chk?> class='cb20'><label for="ylist<?=$k?>" class='cb20Label'><?=$v?></label></li>
			<?
				}
			?>
			</ul>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">모집인원</div>
		<div class="tbl-st-col col-2"><input type="text" name="people" style='width:100px;' value="<?=$people?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사분야</div>
		<div class="tbl-st-col col-2">
			<select name="cade01" id="cade01" class="selectBox" style="width:120px;">
				<option value="">선택</option>
			<?
				$item = sqlArray("select * from ks_vCade01 order by sort");
				foreach($item as $k => $v){
					$cade01Txt = $v['cade01'];

					if($cade01 == $cade01Txt)		$chk = 'selected';
					else										$chk = '';

					echo ("<option value='$cade01Txt' $chk>$cade01Txt</option>");
				}
			?>
			</select>
			<select name="cade02" id="cade02" class="selectBox" style="width:120px;">
				<option value="">선택</option>
			<?
				if($cade01){
					$item = sqlArray("select * from ks_vCade02 where cade01='$cade01' order by cade02");
					foreach($item as $k => $v){
						$cade02Txt = $v['cade02'];

						if($cade02 == $cade02Txt)		$chk = 'selected';
						else									$chk = '';

						echo ("<option value='$cade02Txt' $chk>$cade02Txt</option>");
					}
				}
			?>
			</select>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사자유형</div>
		<div class="tbl-st-col col-2">
			<ul class="checkbox_wrap">
				<li><input type="checkbox" name="adult" id="adult" value="1" class='cb20' <?if($adult){echo 'checked';}?>><label for="adult" class='cb20Label'>성인</label></li>
				<li><input type="checkbox" name="boy" id="boy" value="1" class='cb20' <?if($boy){echo 'checked';}?>><label for="boy" class='cb20Label'>청소년</label></li>
			</ul>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">모집기관</div>
		<div class="tbl-st-col col-2"><input type="text" name="agent" style='width:205px;' value="<?=$agent?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사지역</div>
		<div class="tbl-st-col col-2">
			<select name="loc01" id="loc01" class="selectBox" style="width:120px;">
				<option value="">시&middot;도 선택</option>
			<?
				$item = sqlArray("select distinct(loc01) from locArea order by sort");
				foreach($item as $k => $v){
					$loc01Txt = $v['loc01'];

					if($loc01 == $loc01Txt)		$chk = 'selected';
					else								$chk = '';

					echo ("<option value='$loc01Txt' $chk>$loc01Txt</option>");
				}
			?>
			</select>
			<select name="loc02" id="loc02" class="selectBox" style="width:120px;">
				<option value="">시&middot;군&middot;구 선택</option>
			<?
				if($loc01){
					$item = sqlArray("select distinct(loc02) from locArea where loc01='$loc01' order by loc02");
					foreach($item as $k => $v){
						$loc02Txt = $v['loc02'];

						if($loc02 == $loc02Txt)		$chk = 'selected';
						else								$chk = '';

						echo ("<option value='$loc02Txt' $chk>$loc02Txt</option>");
					}
				}
			?>
			</select>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사장소</div>
		<div class="tbl-st-col col-2"><input type="text" name="place" style='width:205px;' value="<?=$place?>"></div>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">봉사대상</div>
		<div class="tbl-st-col col-2">
			<select name="bTarget" id="bTarget" class='selectBox'>
				<option value="아동·청소년" <?if($bTarget == '아동·청소년'){echo 'selected';}?>>아동·청소년</option>
				<option value="장애인" <?if($bTarget == '장애인'){echo 'selected';}?>>장애인</option>
				<option value="노인" <?if($bTarget == '노인'){echo 'selected';}?>>노인</option>
				<option value="쪽방촌" <?if($bTarget == '쪽방촌'){echo 'selected';}?>>쪽방촌</option>
				<option value="다문화가정" <?if($bTarget == '다문화가정'){echo 'selected';}?>>다문화가정</option>
				<option value="여성" <?if($bTarget == '여성'){echo 'selected';}?>>여성</option>
				<option value="환경" <?if($bTarget == '환경'){echo 'selected';}?>>환경</option>
				<option value="사회적기업" <?if($bTarget == '사회적기업'){echo 'selected';}?>>사회적기업</option>
				<option value="고향봉사" <?if($bTarget == '고향봉사'){echo 'selected';}?>>고향봉사</option>
				<option value="기타" <?if($bTarget == '기타'){echo 'selected';}?>>기타</option>
			</select>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1">활동구분</div>
		<div class="tbl-st-col col-2">
			<select name="actType" id="actType" class='selectBox'>
				<option value="온라인" <?if($actType == '온라인'){echo 'selected';}?>>온라인</option>
				<option value="오프라인" <?if($actType == '오프라인'){echo 'selected';}?>>오프라인</option>
				<option value="온·오프라인" <?if($actType == '온·오프라인'){echo 'selected';}?>>온·오프라인</option>
			</select>
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




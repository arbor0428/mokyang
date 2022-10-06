<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$reg_date = $row["reg_date"];

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$sData04 = $row["sData04"];
		$sData05 = $row["sData05"];
		$sData06 = $row["sData06"];
		$sData07 = $row["sData07"];
		$sData08 = $row["sData08"];
		$sDataTxt = $row["sDataTxt"];
		$sDataUrl = $row["sDataUrl"];

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

input.inputBox_ {width:205px !important;}
.centerTbl input::placeholder {font-size:0.875rem;}
</style>

<?if($_SERVER['SERVER_PORT'] == '443'){?>
<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>
<?}else{?>
<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<?}?>

<script>
function openDaumPostcode() {
	new daum.Postcode({
		oncomplete: function(data) {
			// 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

			// 각 주소의 노출 규칙에 따라 주소를 조합한다.
			// 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
			var fullAddr = ''; // 최종 주소 변수
			var extraAddr = ''; // 조합형 주소 변수

			// 사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
			if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
				fullAddr = data.roadAddress;

			} else { // 사용자가 지번 주소를 선택했을 경우(J)
				fullAddr = data.jibunAddress;
			}

			// 사용자가 선택한 주소가 도로명 타입일때 조합한다.
			if(data.userSelectedType === 'R'){
				//법정동명이 있을 경우 추가한다.
				if(data.bname !== ''){
					extraAddr += data.bname;
				}
				// 건물명이 있을 경우 추가한다.
				if(data.buildingName !== ''){
					extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
				}
				// 조합형주소의 유무에 따라 양쪽에 괄호를 추가하여 최종 주소를 만든다.
				fullAddr += (extraAddr !== '' ? ' ('+ extraAddr +')' : '');
			}

			// 우편번호와 주소 정보를 해당 필드에 넣는다.
/*
			document.getElementById('zip01').value = data.postcode1;
			document.getElementById('zip02').value = data.postcode2;
*/

//			$('#zipcode').val(data.zonecode);
			$('#sData03').val(fullAddr);
			$('#sData04').focus();
		}
	}).open();
}


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"센터명을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.sData01,"지역을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.sData02,"지역을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.sData03,"주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.sData04,"주소를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.sData05,"연락처를 입력해 주십시오"))	return;

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

//지역(시/도)
$(function(){
	$('#sData01').change(function(){
		c1 = $(this).val();

		//시도군 선택
		$.post('/module/jsonLoc.php',{'c1':c1}, function(c2){
			//시도군 selectbox 초기화
			$('#sData02').empty();
			$('#sData02').append("<option value=''>시&middot;군&middot;구 선택</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			//시도군 selectbox 옵션설정	
			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#sData02').append(option);
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




<div class="tbl-st centerTbl">
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">센터명</span><span class='eq'></span></div>
		<div class="tbl-st-col col-2"><input type="text" name="title" style='width:98%;' value="<?=$title?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">지 역</span><span class='eq'></span></div>
		<div class="tbl-st-col col-2">
			<select name="sData01" id="sData01" class="select1" style="width:120px;">
				<option value="">시&middot;도 선택</option>
			<?
				$item = sqlArray("select distinct(loc01) from locArea order by sort");
				foreach($item as $k => $v){
					$loc01Txt = $v['loc01'];

					if($sData01 == $loc01Txt)		$chk = 'selected';
					else									$chk = '';

					echo ("<option value='$loc01Txt' $chk>$loc01Txt</option>");
				}
			?>
			</select>
			<select name="sData02" id="sData02" class="select1" style="width:120px;">
				<option value="">시&middot;군&middot;구 선택</option>
			<?
				if($sData01){
					$item = sqlArray("select distinct(loc02) from locArea where loc01='$sData01' order by loc02");
					foreach($item as $k => $v){
						$loc02Txt = $v['loc02'];

						if($sData02 == $loc02Txt)		$chk = 'selected';
						else									$chk = '';

						echo ("<option value='$loc02Txt' $chk>$loc02Txt</option>");
					}
				}
			?>
			</select>
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">주 소</span><span class='eq'></span></div>
		<div class="tbl-st-col col-2">
			<input type="text" name="sData03" id="sData03" value="<?=$sData03?>" style="width:48%;" placeholder="기본주소" onclick="openDaumPostcode()" readonly>
			<input type="text" name="sData04" id="sData04" value="<?=$sData04?>" style="width:48%;" placeholder="상세주소">
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">연락처</span><span class='eq'></span></div>
		<div class="tbl-st-col col-2"><input type="text" name="sData05" class='inputBox_' value="<?=$sData05?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">운영시간</span></div>
		<div class="tbl-st-col col-2">
			<!--
			<p style="margin-top:5px;"><input type="text" name="sData06" class='inputBox_' value="<?=$sData06?>" placeholder="학기중"></p>
			<p style="margin:3px 0;"><input type="text" name="sData07" class='inputBox_' value="<?=$sData07?>" placeholder="방학중"></p>
			<p style="margin-bottom:5px;"><input type="text" name="sData08" class='inputBox_' value="<?=$sData08?>" placeholder="토요일"></p>
			-->
			<input type="text" name="sData06" class='inputBox_' value="<?=$sData06?>" placeholder="학기중 운영시간 입력">
			<input type="text" name="sData07" class='inputBox_' value="<?=$sData07?>" placeholder="방학중 운영시간 입력">
			<input type="text" name="sData08" class='inputBox_' value="<?=$sData08?>" placeholder="토요일 운영시간 입력">
		</div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">정 원</span></div>
		<div class="tbl-st-col col-2"><input type="text" name="sDataTxt" class='inputBox_' value="<?=$sDataTxt?>"></div>
	</div>

	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">홈페이지</span></div>
		<div class="tbl-st-col col-2"><input type="text" name="sDataUrl" style='width:98%;' value="<?=$sDataUrl?>"></div>
	</div>


<?
	if($GBL_MTYPE == 'A'){
?>
	<div class="tbl-st-row clearfix">
		<div class="tbl-st-col col-1"><span class="smooth dp_ir">등록일시</span></div>
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




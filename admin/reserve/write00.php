<?	
	$sRange = '0';
	$eRange = '1';
	include '../../module/Calendar.php';

	if($type=='edit00' && $uid){
		$sql = "select * from ks_reserve where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row['status'];
		$team = $row['team'];
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$title = $row['title'];
		$biznum = $row['biznum'];
		$address = $row['address'];
		$hall01 = $row['hall01'];
		$opt01 = $row['opt01'];
		$temp = $row['temp'];
		$tsHour = $row['tsHour'];
		$teHour = $row['teHour'];
		$memo = $row['memo'];
		$sDate01 = $row['sDate01'];
		$sTime01 = $row['sTime01'];
		$eDate01 = $row['eDate01'];
		$eTime01 = $row['eTime01'];
		$showType = $row['showType'];
		$amNum = $row['amNum'];
		$pmNum = $row['pmNum'];
		$ngNum = $row['ngNum'];
		$ticket = $row['ticket'];
		$ticketAmt = $row['ticketAmt'];
		$upfile01 = $row['upfile01'];
		$realfile01 = $row['realfile01'];
		$upfile02 = $row['upfile02'];
		$realfile02 = $row['realfile02'];
		$upfile03 = $row['upfile03'];
		$realfile03 = $row['realfile03'];
		$staff = $row['staff'];
		$notice = $row['notice'];

		//사용기간
		$sHour01 = date('H',$sTime01);		$eHour01 = date('H',$eTime01);

		//예술회관
		if($hall01)	$hallDataArr01 = explode('|^|',$hall01);

		//예술회관 > 부대시설
		if($opt01)	$optDataArr01 = explode('|^|',$opt01);

		//공연횟수
		$totNum = $amNum + $pmNum + $ngNum;

		if($memo)	$memo = Util::textareaDecodeing($memo);
		if($notice)	$notice = Util::textareaDecodeing($notice);

		if(is_array($hallDataArr01)){
			if(in_array('공연장',$hallDataArr01))				$chk01 = 'checked';
			if(in_array('숲속극장',$hallDataArr01))			$chk02 = 'checked';
			if(in_array('제3강좌실',$hallDataArr01))		$chk03 = 'checked';
			if(in_array('제4강좌실',$hallDataArr01))		$chk04 = 'checked';
			if(in_array('제5강좌실',$hallDataArr01))		$chk05 = 'checked';
			if(in_array('제6강좌실',$hallDataArr01))		$chk06 = 'checked';
			if(in_array('음악감상실',$hallDataArr01))		$chk07 = 'checked';
			if(in_array('문화쉼터',$hallDataArr01))			$chk08 = 'checked';
			if(in_array('소회의실',$hallDataArr01))			$chk09 = 'checked';
			if(in_array('대회의실',$hallDataArr01))			$chk10 = 'checked';
			if(in_array('기획전시실',$hallDataArr01))		$chk11 = 'checked';
			if(in_array('공연연습실',$hallDataArr01))		$chk12 = 'checked';
		}
	}
?>


<script src="https://spi.maps.daum.net/imap/map_js_init/postcode.v2.js"></script>

<script language='javascript'>
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
//			document.getElementById('zipcode').value = data.zonecode; //5자리 새우편번호 사용
/*
			document.getElementById('zip01').value = data.postcode1;
			document.getElementById('zip02').value = data.postcode2;
*/
			document.getElementById('address').value = fullAddr;
			document.getElementById('address').focus();

		}
	}).open();
}

function check_form(){
	form = document.frm_reserve;

	if(isFrmEmptyModal(form.team,"단체명을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.name,"성명(대표자)를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.phone,"연락처를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.email,"이메일을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"행사명을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.biznum,"사업자번호(생년월일)를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.address,"주소를 입력해 주십시오."))	return;

	if($('#fpicker1').val() == '' || $('#fpicker2').val() == ''){
		GblMsgBox('사용기간을 입력해 주십시오.','');
		$("#DatePicker").css("outline", "none");
		$("#DatePicker").attr("tabindex", -1).focus();
		return;
	}

	if(!isCheckModal(form.showType,"대관성격을 선택해 주십시오.")){
		form.showType[0].focus();
		return;
	}


	isChk = false;
    chk01 = document.getElementsByName('hallChk01[]');

    for(i=0; i<chk01.length; i++){
		if(chk01[i].checked)		isChk = true; 
    }
	
	if(!isChk){
		GblMsgBox('대관장소를 선택해 주십시오.','');
		$("#hall").attr("tabindex", -1).focus();
		return;
	}


	if(!isCheckModal(form.ticket,"입장료 유/무를 선택해 주십시오.")){
		form.ticket[0].focus();
		return;

	}else if(form.ticket[1].checked == true){
		if(isFrmEmptyModal(form.ticketAmt,"입장료를 입력해 주십시오."))	return;		
	}

	if(isFrmEmptyModal(form.staff,"신청인을 입력해 주십시오."))	return;
	
	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc00.php';
	form.submit();
}

function Quantity(type,id){
	Num = $('#'+id);
	eaTxt = parseFloat(Num.val());

	if(type == 'up'){
		eaTxt += 1;

	}else{
		if(eaTxt > 0){
			eaTxt -= 1;
		}else{
			return;
		}
	}

	Num.val(eaTxt);
	setNum();
}

function setNum(){
	amNum = parseFloat($('#amNum').val());
	pmNum = parseFloat($('#pmNum').val());
	ngNum = parseFloat($('#ngNum').val());

	totNum = amNum + pmNum + ngNum;

	$('#totNum').text(totNum);
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(i=0; i<eChk.length; i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}
	}

	if(eChk[1].checked)		$('#ticketAmt').fadeIn('fast');
	else							$('#ticketAmt').hide();
}

function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg','gif','png','doc','hwp','pdf','zip']) == -1) {
			GblMsgBox('jpg, gif, png, doc, hwp, pdf, zip\n파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.frm_reserve['upfile'+no];
			
			// 익스플로러일 경우
			if(browser=="Microsoft Internet Explorer"){
				var oas = new ActiveXObject("Scripting.FileSystemObject");
				fileSize = oas.getFile(file.value).size;

			// 익스플로러가 아닐경우			
			}else{
				fileSize = file.files[0].size;
			}

			fS = Math.round(fileSize / 1024 / 1024);

			if(fS > 5){
				GblMsgBox('5MB이상의 파일은 등록할 수 없습니다.','');
				$("#upfile"+no).val('');
				$("#file_route"+no).val('');
				return;
			}
		}
	}

	$("#file_route"+no).val(upFile);
}

function reg_list(){
	form = document.frm_reserve;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>


<form name='frm_reserve' action="proc.php" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$upfile02?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$upfile03?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_rType' value='<?=$f_rType?>'>
<input type='hidden' name='f_team' value='<?=$f_team?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_staff' value='<?=$f_staff?>'>
<!-- /검색관련 -->



<div style='width:100%;text-align:right;font-size:12px;'><?=$ico01?> 필수입력</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th><?=$ico01?> 상태</th>
		<td colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='radio' name='status' value='접수' <?if($status == '접수'){echo 'checked';}?>> <span class='ico01'>접수</span></td>
					<td style='padding-left:25px;'><input type='radio' name='status' value='심사중' <?if($status == '심사중'){echo 'checked';}?>> <span class='ico03'>심사중</span></td>
					<td style='padding-left:25px;'><input type='radio' name='status' value='승인' <?if($status == '승인'){echo 'checked';}?>> <span class='ico04'>승인</span></td>
					<td style='padding-left:25px;'><input type='radio' name='status' value='미승인' <?if($status == '미승인'){echo 'checked';}?>> <span class='ico09'>미승인</span></td>
					<td style='padding-left:25px;'><input type='radio' name='status' value='취소' <?if($status == '취소'){echo 'checked';}?>> <span class='ico11'>취소</span></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th width='15%'><?=$ico01?> 단체명</th>
		<td width='35%'><input type='text' name='team' value="<?=$team?>" style='width:70%;'></td>
		<th width='15%'><?=$ico01?> 성명 (대표자)</th>
		<td width='35%'><input type='text' name='name' value="<?=$name?>" style='width:70%;'></td>
	</tr>

	<tr>
		<th><?=$ico01?> 연락처</th>
		<td><input type='text' name='phone' value="<?=$phone?>" style='width:70%;'></td>
		<th><?=$ico01?> 이메일</th>
		<td><input type='text' name='email' value="<?=$email?>" style='width:70%;' placeholder='* 세금계산서 수신용'></td>
	</tr>

	<tr>
		<th><?=$ico01?> 행사명</th>
		<td><input type='text' name='title' value="<?=$title?>" style='width:70%;'></td>
		<th><?=$ico01?> 사업자번호<br>(생년월일)</th>
		<td><input type='text' name='biznum' value="<?=$biznum?>" style='width:70%;' placeholder='* 세금계산서 수신용'></td>
	</tr>

	<tr>
		<th><?=$ico01?> 주소</th>
		<td colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='address' id='address' value="<?=$address?>" style='width:483px;'></td>
					<td style='padding-left:5px;'><a href="javascript:openDaumPostcode();" class='small cbtn black'>주소검색</a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<div style='width:100%;text-align:right;font-size:12px;margin-top:50px;'>(오전:09시~13시), (오후:13시~17시), (야간:17시~21시)</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr id='DatePicker' style="outline:none;">
		<th width='15%'><?=$ico01?> 사용기간</th>
		<td width='85%'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='sDate01' id='fpicker1' value="<?=$sDate01?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='sHour01'>
						<?
							for($i=0; $i<24; $i++){
								if($sHour01 == $i)	$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
					</td>
					<td style='padding:0 10px;'>~</td>
					<td><input type='text' name='eDate01' id='fpicker2' value="<?=$eDate01?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='eHour01'>
						<?
							for($i=0; $i<24; $i++){
								if($eHour01 == $i)	$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th style='border-bottom:2px solid #8d8d8d;'><?=$ico01?> 대관성격</th>
		<td style='border-bottom:2px solid #8d8d8d;'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree">
							<input type="checkbox" value="공연·전시" id="showChk01" name="showType" onclick='setChkBox(this.name,0);' <?if($showType == '공연·전시'){echo 'checked';}?>>
							<label for="showChk01"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>공연·전시 (음악, 무용, 연극 등)</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="행사" id="showChk02" name="showType" onclick='setChkBox(this.name,1);' <?if($showType == '행사'){echo 'checked';}?>>
							<label for="showChk02"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>행사(교육, 세미나 등)</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>

<div id='hall'>
	<tr>
		<th>공연장</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="공연장" id="hallChkID01" name="hallChk01[]" <?=$chk01?>>
					<label for="hallChkID01"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>공연장</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="숲속극장" id="hallChkID02" name="hallChk01[]" <?=$chk02?>>
					<label for="hallChkID02"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>숲속극장</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>강좌실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제3강좌실" id="hallChkID03" name="hallChk01[]" <?=$chk03?>>
					<label for="hallChkID03"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제3강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제4강좌실" id="hallChkID04" name="hallChk01[]" <?=$chk04?>>
					<label for="hallChkID04"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제4강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제5강좌실" id="hallChkID05" name="hallChk01[]" <?=$chk05?>>
					<label for="hallChkID05"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제5강좌실</p>
			</div>

			<div style='width:40%;float:left;height:40px;'></div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제6강좌실" id="hallChkID06" name="hallChk01[]" <?=$chk06?>>
					<label for="hallChkID06"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제6강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="음악감상실" id="hallChkID07" name="hallChk01[]" <?=$chk07?>>
					<label for="hallChkID07"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>음악감상실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="문화쉼터" id="hallChkID08" name="hallChk01[]" <?=$chk08?>>
					<label for="hallChkID08"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>문화쉼터</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>회의실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="소회의실" id="hallChkID09" name="hallChk01[]" <?=$chk09?>>
					<label for="hallChkID09"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>소회의실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="대회의실" id="hallChkID10" name="hallChk01[]" <?=$chk10?>>
					<label for="hallChkID10"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>대회의실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>전시실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="기획전시실" id="hallChkID11" name="hallChk01[]" <?=$chk11?>>
					<label for="hallChkID11"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>기획전시실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th style='border-bottom:2px solid #8d8d8d;'>기타</th>
		<td style='padding-top:15px;border-bottom:2px solid #8d8d8d;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="공연연습실" id="hallChkID12" name="hallChk01[]" <?=$chk12?>>
					<label for="hallChkID12"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>공연연습실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>부대시설</th>
		<td style='padding-top:15px;'>
		<?
			for($c=0; $c<count($OptArr01); $c++){
				$sVar = $OptArr01[$c];

				$chk = '';

				if(is_array($optDataArr01)){
					if(in_array($sVar,$optDataArr01))		$chk = 'checked';
				}
		?>
		<div style='width:25%;float:left;height:40px;'>
			<div class="squaredThree">
				<input type="checkbox" value="<?=$sVar?>" id="optChk01<?=$c?>" name="optChk01[]" <?=$chk?>>
				<label for="optChk01<?=$c?>"></label>
			</div>
			<p style='margin:3px 0 0 30px;'><?=$sVar?></p>
		</div>
		<?
				//줄바꿈용....
				if($c == 0)	echo ("<div style='width:75%;float:left;height:40px;'></div>");
			}
		?>
		</td>
	</tr>

</div>

	<tr>
		<th>냉/난방</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<select name='temp'>
							<option value=''>==</option>
							<option value='냉방' <?if($temp == '냉방'){echo 'selected';}?>>냉방</option>
							<option value='난방' <?if($temp == '난방'){echo 'selected';}?>>난방</option>
						</select>
					</td>
					<td style='padding:0 0 0 10px;'>
						<select name='tsHour'>
						<?
							for($i=0; $i<24; $i++){
								if($tsHour == $i)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시 ~ 
						<select name='teHour'>
						<?
							for($i=0; $i<24; $i++){
								if($teHour == $i)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th>기타사항</th>
		<td><textarea name='memo' style='width:100%;height:120px;resize:none;'><?=$memo?></textarea></td>
	</tr>

	<tr>
		<th>공연횟수</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>오전</td>
					<td style='padding-left:5px;'>
						<div class='quantity_wrap'>
							<div class='quantity_wdt'>
								<a href="javascript:Quantity('down','amNum');"><p>-</p></a>
								<p class='center_quant'><input type='text' name='amNum' id='amNum' value='<?=$amNum?>' maxlength='2' class='input_center_quant numberOnly' onblur='setNum();'></p>
								<a href="javascript:Quantity('up','amNum');"><p>+</p></a>
							</div>
						</div>
					</td>

					<td style='padding-left:35px;'>오후</td>
					<td style='padding-left:5px;'>
						<div class='quantity_wrap'>
							<div class='quantity_wdt'>
								<a href="javascript:Quantity('down','pmNum');"><p>-</p></a>
								<p class='center_quant'><input type='text' name='pmNum' id='pmNum' value='<?=$pmNum?>' maxlength='2' class='input_center_quant numberOnly' onblur='setNum();'></p>
								<a href="javascript:Quantity('up','pmNum');"><p>+</p></a>
							</div>
						</div>
					</td>

					<td style='padding-left:35px;'>야간</td>
					<td style='padding-left:5px;'>
						<div class='quantity_wrap'>
							<div class='quantity_wdt'>
								<a href="javascript:Quantity('down','ngNum');"><p>-</p></a>
								<p class='center_quant'><input type='text' name='ngNum' id='ngNum' value='<?=$ngNum?>' maxlength='2' class='input_center_quant numberOnly' onblur='setNum();'></p>
								<a href="javascript:Quantity('up','ngNum');"><p>+</p></a>
							</div>
						</div>
					</td>

					<td style='padding-left:50px;'>총 <span class="quantity_tot" id="totNum"><?=$totNum?></span> 회</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 입장료</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree">
							<input type="checkbox" value="무" id="ticketChk01" name="ticket" <?if($ticket == '무'){echo 'checked';}?> onclick='setChkBox(this.name,0);'>
							<label for="ticketChk01"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>무</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="유" id="ticketChk02" name="ticket" <?if($ticket == '유'){echo 'checked';}?> onclick='setChkBox(this.name,1);'>
							<label for="ticketChk02"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>유</p>
					</td>
					<td style='padding-left:20px;height:40px;'><div id='ticketAmt' <?if($ticket == '무'){echo ("style='display:none;'");}?>><input type='text' name='ticketAmt' value="<?=$ticketAmt?>" style='width:100px;' class='numberOnly' placeholder='입장료'>원</div></td>
				</tr>
			</table>
		</td>
	</tr>

<?
	for($i=1; $i<=3; $i++){
		$no = sprintf('%02d',$i);

		$upfile = ${'upfile'.$no};
		$realfile = ${'realfile'.$no};

		if($i == 1)		$fname = '행사계획서';
		elseif($i == 2)	$fname = '사업자등록증사본';
		elseif($i == 3)	$fname = '기타서류 (요청시)';
?>
	<tr>
		<th><?=$fname?></td>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="file_input">
							<input type="text" readonly title="File Route" id="file_route<?=$no?>" style="width:225px;padding:0 0 0 10px;">
							<label>찾아보기<input type="file" name="upfile<?=$no?>" id="upfile<?=$no?>" onchange="fileChk('<?=$no?>');"></label>
						</div>
					</td>								
				<?
					if($upfile){
				?>
					<td style='padding:0 0 0 10px;' valign='bottom'>
						<div class="enable_btn">
							<div class="squaredThree">
								<input type="checkbox"  id="squaredDel<?=$no?>" type="checkbox" name="del_upfile<?=$no?>" value="Y" />
								<label for="squaredDel<?=$no?>"></label>										
							</div>
							<p style='margin:0 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile?>)</p>
						</div>
					</td>
				<?
					}
				?>
				</tr>
			</table>
		</td>
	</tr>
<?
	}
?>

	<tr>
		<th><?=$ico01?> 신청인</th>
		<td><input type='text' name='staff' value="<?=$staff?>" style='width:225px;'></td>
	</tr>

	<tr>
		<th><?=$ico02?> 비고</th>
		<td><textarea name='notice' style='width:100%;height:120px;resize:none;'><?=$notice?></textarea></td>
	</tr>
</table>

</form>

<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		</td>
	</tr>
</table>

<?	
	$sRange = '0';
	$eRange = '1';
	include '../../module/Calendar.php';

	if($type=='edit02' && $uid){
		$sql = "select * from ks_reserve where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row['status'];
		$team = $row['team'];
		$biznum = $row['biznum'];
		$since = $row['since'];
		$genre = $row['genre'];
		$genreEtc = $row['genreEtc'];
		$address = $row['address'];
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$wname = $row['wname'];
		$wphone = $row['wphone'];
		$wemail = $row['wemail'];
		$teamStyle = $row['teamStyle'];
		$memo = $row['memo'];

		$sDate01 = $row['sDate01'];
		$sTime01 = $row['sTime01'];
		$eDate01 = $row['eDate01'];
		$eTime01 = $row['eTime01'];

		$sDate02 = $row['sDate02'];
		$sTime02 = $row['sTime02'];
		$eDate02 = $row['eDate02'];
		$eTime02 = $row['eTime02'];

		$sDate03 = $row['sDate03'];
		$sTime03 = $row['sTime03'];
		$eDate03 = $row['eDate03'];
		$eTime03 = $row['eTime03'];

		$hall02 = $row['hall02'];
		$opt02 = $row['opt02'];
		$temp = $row['temp'];
		$tsHour = $row['tsHour'];
		$teHour = $row['teHour'];

		$upfile01 = $row['upfile01'];
		$realfile01 = $row['realfile01'];
		$upfile02 = $row['upfile02'];
		$realfile02 = $row['realfile02'];
		$upfile03 = $row['upfile03'];
		$realfile03 = $row['realfile03'];
		$staff = $row['staff'];
		$notice = $row['notice'];
		$rDate = $row['rDate'];

		//숲속극장 > 부대시설
		if($opt02)	$optDataArr02 = explode('|^|',$opt02);

		//공연준비시간
		$sHour01 = date('H',$sTime01);		$eHour01 = date('H',$eTime01);

		//공연시간
		$sHour02 = date('H',$sTime02);		$eHour02 = date('H',$eTime02);

		//공연철수시간
		$sHour03 = date('H',$sTime03);		$eHour03 = date('H',$eTime03);


		if($memo)	$memo = Util::textareaDecodeing($memo);
		if($notice)	$notice = Util::textareaDecodeing($notice);
	}
?>


<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>

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
	if(isFrmEmptyModal(form.biznum,"사업자번호를 입력해 주십시오."))	return;

	if(!isCheckModal(form.genre,"장르를 선택해 주십시오.")){
		$("#genreBox").attr("tabindex", -1).focus();
		return;
	}

	if(isFrmEmptyModal(form.address,"단체주소를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.name,"대표자 (성명)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.phone,"대표자 (연락처)를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.email,"대표자 (이메일)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.wname,"담당자 (성명)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.wphone,"담당자 (연락처)를 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.wemail,"담당자 (이메일)을 입력해 주십시오."))	return;

	if(!isCheckModal(form.teamStyle,"단체성격을 선택해 주십시오.")){
		$("#teamBox").attr("tabindex", -1).focus();
		return;
	}

	if($('#fpicker1').val() == '' || $('#fpicker2').val() == ''){
		GblMsgBox('공연준비 기간을 입력해 주십시오.','');
		$("#DatePicker").css("outline", "none");
		$("#DatePicker").attr("tabindex", -1).focus();
		return;
	}

	if($('#fpicker3').val() == '' || $('#fpicker4').val() == ''){
		GblMsgBox('공연 기간을 입력해 주십시오.','');
		$("#DatePicker").css("outline", "none");
		$("#DatePicker").attr("tabindex", -1).focus();
		return;
	}

	if($('#fpicker5').val() == '' || $('#fpicker6').val() == ''){
		GblMsgBox('공연철수 기간을 입력해 주십시오.','');
		$("#DatePicker").css("outline", "none");
		$("#DatePicker").attr("tabindex", -1).focus();
		return;
	}


	if(isFrmEmptyModal(form.staff,"신청인을 입력해 주십시오."))	return;
	
	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc02.php';
	form.submit();
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
		<th width='15%'><?=$ico01?> 사업자번호</th>
		<td width='35%'><input type='text' name='biznum' value="<?=$biznum?>" style='width:70%;'></td>
	</tr>

	<tr>
		<th><?=$ico02?> 설립연도</th>
		<td colspan='3'><input type='text' name='since' value="<?=$since?>" style='width:225px;'></td>
	</tr>
<div id='genreBox'>
	<tr>
		<th><?=$ico01?> 장르</th>
		<td colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree">
							<input type="checkbox" value="합창" id="genreChk01" name="genre" <?if($genre == '합창'){echo 'checked';}?> onclick='setChkBox(this.name,0);'>
							<label for="genreChk01"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>합창</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="연극" id="genreChk02" name="genre" <?if($genre == '연극'){echo 'checked';}?> onclick='setChkBox(this.name,1);'>
							<label for="genreChk02"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>연극</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="교향악" id="genreChk03" name="genre" <?if($genre == '교향악'){echo 'checked';}?> onclick='setChkBox(this.name,2);'>
							<label for="genreChk03"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>교향악</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="전통예술" id="genreChk04" name="genre" <?if($genre == '전통예술'){echo 'checked';}?> onclick='setChkBox(this.name,3);'>
							<label for="genreChk04"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>전통예술</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="뮤지컬" id="genreChk05" name="genre" <?if($genre == '뮤지컬'){echo 'checked';}?> onclick='setChkBox(this.name,4);'>
							<label for="genreChk05"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>뮤지컬</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="무용" id="genreChk06" name="genre" <?if($genre == '무용'){echo 'checked';}?> onclick='setChkBox(this.name,5);'>
							<label for="genreChk06"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>무용</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="기타" id="genreChk07" name="genre" <?if($genre == '기타'){echo 'checked';}?> onclick='setChkBox(this.name,6);'>
							<label for="genreChk07"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>기타</p>
					</td>
					<td style='padding-left:20px;height:40px;'><div id='genreEtc' <?if($genre != '기타'){?>style='display:none;'<?}?>><input type='text' name='genreEtc' value="<?=$genreEtc?>" style='width:150px;'></div></td>
				</tr>
			</table>
		</td>
	</tr>
</div>
	<tr>
		<th><?=$ico01?> 단체주소</th>
		<td colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='address' id='address' value="<?=$address?>" style='width:483px;'></td>
					<td style='padding-left:5px;'><a href="javascript:openDaumPostcode();" class='small cbtn black'>주소검색</a></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 대표자 (성명)</th>
		<td><input type='text' name='name' value="<?=$name?>" style='width:70%;'></td>
		<th><?=$ico01?> 대표자 (연락처)</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><input type='text' name='phone' value="<?=$phone?>" style='width:70%;' placeholder='전화번호'></td>
				</tr>
				<tr>
					<td style='padding-top:3px;'><input type='text' name='email' value="<?=$email?>" style='width:70%;' placeholder='이메일'></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 담당자 (성명)</th>
		<td><input type='text' name='wname' value="<?=$wname?>" style='width:70%;'></td>
		<th><?=$ico01?> 담당자 (연락처)</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td><input type='text' name='wphone' value="<?=$wphone?>" style='width:70%;' placeholder='전화번호'></td>
				</tr>
				<tr>
					<td style='padding-top:3px;'><input type='text' name='wemail' value="<?=$wemail?>" style='width:70%;' placeholder='이메일'></td>
				</tr>
			</table>
		</td>
	</tr>
<div id='teamBox'>
	<tr>
		<th><?=$ico01?> 단체성격</th>
		<td colspan='3'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<div class="squaredThree">
							<input type="checkbox" value="사단법인" id="teamStyleChk01" name="teamStyle" <?if($teamStyle == '사단법인'){echo 'checked';}?> onclick='setChkBox(this.name,0);'>
							<label for="teamStyleChk01"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>사단법인</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="재단법인" id="teamStyleChk02" name="teamStyle" <?if($teamStyle == '재단법인'){echo 'checked';}?> onclick='setChkBox(this.name,1);'>
							<label for="teamStyleChk02"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>재단법인</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="기타법인" id="teamStyleChk03" name="teamStyle" <?if($teamStyle == '기타법인'){echo 'checked';}?> onclick='setChkBox(this.name,2);'>
							<label for="teamStyleChk03"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>기타법인</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="사설/임의단체" id="teamStyleChk04" name="teamStyle" <?if($teamStyle == '사설/임의단체'){echo 'checked';}?> onclick='setChkBox(this.name,3);'>
							<label for="teamStyleChk04"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>사설/임의단체</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="전문예술법인" id="teamStyleChk05" name="teamStyle" <?if($teamStyle == '전문예술법인'){echo 'checked';}?> onclick='setChkBox(this.name,4);'>
							<label for="teamStyleChk05"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>전문예술법인</p>
					</td>
					<td style='padding-left:20px;'>
						<div class="squaredThree">
							<input type="checkbox" value="전문예술단체" id="teamStyleChk06" name="teamStyle" <?if($teamStyle == '전문예술단체'){echo 'checked';}?> onclick='setChkBox(this.name,5);'>
							<label for="teamStyleChk06"></label>
						</div>
						<p style='margin:3px 0 0 30px;'>전문예술단체</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</div>
	<tr>
		<th><?=$ico02?> 단체소개 (주요연혁)</th>
		<td colspan='3'><textarea name='memo' style='width:100%;height:120px;resize:none;'><?=$memo?></textarea></td>
	</tr>
</table>

<div style='width:100%;text-align:right;font-size:12px;margin-top:50px;'>(오전:09시~13시), (오후:13시~17시), (야간:17시~21시)</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr id='DatePicker' style="outline:none;">
		<th width='15%' style='border-top:2px solid #8d8d8d;'><?=$ico01?> 공연준비</th>
		<td width='85%' style='border-top:2px solid #8d8d8d;'>
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
		<th><?=$ico01?> 공연</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='sDate02' id='fpicker3' value="<?=$sDate02?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='sHour02'>
						<?
							for($i=0; $i<24; $i++){
								if($sHour02 == $i)	$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
					</td>
					<td style='padding:0 10px;'>~</td>
					<td><input type='text' name='eDate02' id='fpicker4' value="<?=$eDate02?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='eHour02'>
						<?
							for($i=0; $i<24; $i++){
								if($eHour02 == $i)	$chk = 'selected';
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
		<th style='border-bottom:2px solid #8d8d8d;'><?=$ico01?> 철수</th>
		<td style='border-bottom:2px solid #8d8d8d;'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='sDate03' id='fpicker5' value="<?=$sDate03?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='sHour03'>
						<?
							for($i=0; $i<24; $i++){
								if($sHour03 == $i)	$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>시
					</td>
					<td style='padding:0 10px;'>~</td>
					<td><input type='text' name='eDate03' id='fpicker6' value="<?=$eDate03?>"></td>
					<td style='padding:0 0 0 10px;'>
						<select name='eHour03'>
						<?
							for($i=0; $i<24; $i++){
								if($eHour03 == $i)	$chk = 'selected';
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
		<th>부대시설</th>
		<td style="padding-top:15px;">
		<?
			for($c=0; $c<count($OptArr02); $c++){
				$sVar = $OptArr02[$c];

				$chk = '';

				if(is_array($optDataArr02)){
					if(in_array($sVar,$optDataArr02))	$chk = 'checked';
				}
		?>
		<div style='width:25%;float:left;height:40px;'>
			<div class="squaredThree">
				<input type="checkbox" value="<?=$sVar?>" id="optChk02<?=$c?>" name="optChk02[]" <?=$chk?>>
				<label for="optChk02<?=$c?>"></label>
			</div>
			<p style='margin:3px 0 0 30px;'><?=$sVar?></p>
		</div>
		<?
				//줄바꿈용....
				if($c == 2)	echo ("<div style='width:25%;float:left;height:40px;'></div>");
			}
		?>
		</td>
	</tr>

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

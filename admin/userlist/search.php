<script language='javascript'>
function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk){
				eChk[i].checked = true;
			}else{
				eChk[i].checked = false;
			}
		}
	}
}

function go_search(){
	form = document.frm01;

	f_bDate01 = form.f_bDate01.value;
	f_bDate02 = form.f_bDate02.value;

	input1 = f_bDate01.replace(/-/g,'');
	input2 = f_bDate02.replace(/-/g,'');
	date1 = new Date(input1.substr(0,4),input1.substr(4,2),input1.substr(6,2)); 
	date2 = new Date(input2.substr(0,4),input2.substr(4,2),input2.substr(6,2)); 
	interval =  date2 - date1; 
	day = 1000*60*60*24; 
	month = day*30; 
	year = month*12; 

	diffDay = parseInt(interval/day); 
	diffMonth = parseInt(interval/month); 
	diffYear = parseInt(interval/year);

	if(diffDay > 95 || diffDay < 0){
		GblMsgBox('검색기간은 최대 약 3개월입니다.\n다시 선택하여 주십시오.','');
		return;

	}else{
		form.type.value = '';
		form.record_start.value = '';
		form.action = '<?=$PHP_SELF?>';
		form.submit();
	}
}

function reset_search(){
	form = document.frm01;

	form.f_name.value = '';
	form.f_userNum.value = '';
	form.f_sex[0].checked = false;
	form.f_sex[1].checked = false;
	form.f_bDate01.value = '';
	form.f_bDate02.value = '';
	form.f_status[0].checked = false;
	form.f_status[1].checked = false;	
	form.f_reduction.selectedIndex = 0;
	form.f_carNum.value = '';
	form.f_phone.value = '';
	form.f_sort.selectedIndex = 0;
	form.f_record.selectedIndex = 0;
	
	

	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th width='17%'>회원자명</th>
					<td width='33%'><input name="f_name" type="text" style='width:150px;' value="<?=$f_name?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>회원번호</th>
					<td width='33%'><input name="f_userNum" type="text" style='width:150px;' value="<?=$f_userNum?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>

				<tr>
					<th>성별</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="squaredThree">
										<input type="checkbox" value="남" id="sT1" name="f_sex" onclick='setChkBox(this.name,0);' <?if($f_sex == '남'){echo 'checked';}?>>
										<label for="sT1"></label>
									</div>
									<p style='margin:3px 0 0 25px;'>남</p>
								</td>
								<td style='padding:0 0 0 30px;'>
									<div class="squaredThree">
										<input type="checkbox" value="여" id="sT2" name="f_sex" onclick='setChkBox(this.name,1);' <?if($f_sex == '여'){echo 'checked';}?>>
										<label for="sT2"></label>
									</div>
									<p style='margin:3px 0 0 25px;'>여</p>
								</td>
							</tr>
						</table>
					</td>
					<th>생년월일</th>
					<td>
						<input type='text' name='f_bDate01' id='fpicker1' value='<?=$f_bDate01?>' readonly style='width:120px;'> ~ 
						<input type='text' name='f_bDate02' id='fpicker2' value='<?=$f_bDate02?>' readonly style='width:120px;'>
					</td>
				</tr>

				<tr>
					<th>가입상태</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="squaredThree" id='sexBox'>
										<input type="checkbox" value="1" id="jT1" name="f_status" onclick='setChkBox(this.name,0);' <?if($f_status == '1'){echo 'checked';}?>>
										<label for="jT1"></label>
									</div>
									<p style='margin:3px 0 0 25px;' class='f_status0'>승인</p>
								</td>
								<td style='padding:0 0 0 20px;'>
									<div class="squaredThree">
										<input type="checkbox" value="2" id="jT2" name="f_status" onclick='setChkBox(this.name,1);' <?if($f_status == '2'){echo 'checked';}?>>
										<label for="jT2"></label>
									</div>
									<p style='margin:3px 0 0 25px;' class='f_status1'>미승인</p>
								</td>
							</tr>
						</table>
					</td>
					<th>감면구분</th>
					<td>
						<select name='f_reduction' id='f_reduction' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 전체 ::</option>
						<!--
							<option value=''>======================</option>
							<option value='일반' <?if($f_reduction == '일반'){echo 'selected';}?>>일반 (전체)</option>
							<option value='감면대상자' <?if($f_reduction == '감면대상자'){echo 'selected';}?>>감면대상자 (전체)</option>
							<option value=''>======================</option>
						-->
						<?
							for($i=0; $i<count($reductionArr); $i++){
								$rTxt = $reductionArr[$i];
								if($f_reduction == $rTxt)		$chk = 'selected';
								else								$chk = '';

								echo ("<option value='$rTxt' $chk>$rTxt</option>");
							}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<th>차량번호</th>
					<td><input name="f_carNum" id="f_carNum" style="width:150px;" type="text" value="<?=$f_carNum?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th>연락처</th>
					<td><input name="f_phone" id="f_phone" style="width:150px;" type="text" value="<?=$f_phone?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>

				<tr>
					<th>정렬방식</th>
					<td colspan='3'>
						<select name='f_sort' id='f_sort' style='border:1px solid #ccc;height:30px;' onchange='go_search();'>
							<option value=''>가입일자순</option>
							<option value='nameUp' <?if($f_sort == 'nameUp'){echo 'selected';}?>>회원자명 오름차순</option>
							<option value='nameDown' <?if($f_sort == 'nameDown'){echo 'selected';}?>>회원자명 내림차순</option>
							<option value='userNumUp' <?if($f_sort == 'userNumUp'){echo 'selected';}?>>회원번호 오름차순</option>
							<option value='userNumDown' <?if($f_sort == 'userNumDown'){echo 'selected';}?>>회원번호 내림차순</option>
						</select>

						<select name='f_record' id='f_record' style='border:1px solid #ccc;height:30px;' onchange='go_search();'>
							<option value='30' <?if($f_record == 30){echo 'selected';}?>>30명씩 보기</option>
							<option value='50' <?if($f_record == 50){echo 'selected';}?>>50명씩 보기</option>
							<option value='100' <?if($f_record == 100){echo 'selected';}?>>100명씩 보기</option>
							<option value='200' <?if($f_record == 200){echo 'selected';}?>>200명씩 보기</option>
						</select>
					</td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'>
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>
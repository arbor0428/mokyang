<script language='javascript'>
function go_search(){
	form = document.frm01;

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_year.selectedIndex = 0;
	form.f_join[0].checked = false;
	form.f_join[1].checked = false;	
	form.f_userNum.value = '';
	form.f_name.value = '';
	form.f_mobile.value = '';
	form.f_addr01.value = '';	

	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function setChkBox(obj,chk){
	eChk = document.getElementsByName(obj);

	if(eChk[chk].checked){
		for(var i=0;i<eChk.length;i++){
			if(i == chk)	eChk[i].checked = true;
			else			eChk[i].checked = false;
		}
	}
}
</script>




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>가입연도</th>
					<td>
						<select name='f_year' id='f_year' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 전체 ::</option>
						<?
							for($i=2019; $i>=2006; $i--){
								if($i == $f_year)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>
					</td>
					<th>아이디 발급</th>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<div class="squaredThree">
										<input type="checkbox" value="1" id="pT1" name="f_join" onclick='setChkBox(this.name,0);' <?if($f_join == '1'){echo 'checked';}?>>
										<label for="pT1"></label>
									</div>
									<p style='margin:3px 0 0 25px;'><span class='ico09'>가입</span></p>
								</td>
								<td style='padding:0 0 0 20px;'>
									<div class="squaredThree">
										<input type="checkbox" value="2" id="pT2" name="f_join" onclick='setChkBox(this.name,1);' <?if($f_join == '2'){echo 'checked';}?>>
										<label for="pT2"></label>
									</div>
									<p style='margin:3px 0 0 25px;'><span class='ico03'>미가입</span></p>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th width='17%'>회원번호</th>
					<td width='33%'><input name="f_userNum" type="text" style='width:150px;' value="<?=$f_userNum?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>회원자명</th>
					<td width='33%'><input name="f_name" type="text" style='width:150px;' value="<?=$f_name?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>

				<tr>
					<th>연락처</th>
					<td><input name="f_mobile" id="f_mobile" style="width:150px;" type="text" value="<?=$f_mobile?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th>주소</th>
					<td><input name="f_addr01" id="f_addr01" style="width:150px;" type="text" value="<?=$f_addr01?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
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
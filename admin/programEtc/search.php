<script language='javascript'>
function selChk(){
	season = $('#f_season').find('option:selected').val();

	//분류
	$.post('json.php',{'season':season}, function(c1){
		//분류 selectbox 초기화
		$('#f_cade01').empty();
		$('#f_cade01').append("<option value=''>:: 선택 ::</option>");

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#f_cade01').append(option);
		}
	});

	//기간 selectbox 설정
	periodChk();
}

function periodChk(){
	year = $('#f_year').find('option:selected').val();
	season = $('#f_season').find('option:selected').val();
	c1 = $('#f_cade01').find('option:selected').val();

	//기간 selectbox 초기화
	$('#f_period').empty();
	$('#f_period').append("<option value=''>:: 선택 ::</option>");

	//프로그램 초기화
	$('#proList').html("<input name='f_title' type='text' style='width:100%;' value='<?=$f_title?>' onkeypress='if(event.keyCode==13){go_search();}' placeholder='프로그램명 직접입력'>");

	//기간
	$.post('json_period01.php',{'year':year,'season':season,'c1':c1}, function(req){
		req = urldecode(req);
		parData = JSON.parse(req);

		//기간 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#f_period').append(option);
		}
	});
}

function periodSet(){
	year = $('#f_year').find('option:selected').val();
	season = $('#f_season').find('option:selected').val();
	c1 = $('#f_cade01').find('option:selected').val();
	period = $('#f_period').find('option:selected').val();

	//프로그램 초기화
	$('#proList').html("<input name='f_title' type='text' style='width:100%;' value='<?=$f_title?>' onkeypress='if(event.keyCode==13){go_search();}' placeholder='프로그램명 직접입력'>");

	//프로그램정보
	$.post('json_prolist.php',{'year':year,'season':season,'c1':c1,'period':period}, function(c1){
		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//프로그램 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];

			if(i == 0 && txt){
				//프로그램 초기화
				$('#proList').text('');
			}

			chkID = 'fT'+i;
			sArr = txt.split('_^_');
			sTxt01 = sArr[0];
			sTxt02 = sArr[1];

			str = "<li style='width:20%;float:left;margin-bottom:8px;'>";
			str += "<div class='squaredThree'>";
			str += "<input type='checkbox' value='"+sTxt01+"' id='"+chkID+"' name='f_prolist[]'>";
			str += "<label for='"+chkID+"'></label>";
			str += "</div>";
			str += "<p style='margin:3px 0 0 25px;font-size:13px;'>"+sTxt02+"</p>";
			str += "</li>";

			$('#proList').append(str);
		}
	});
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

function go_search(){
	form = document.frm01;

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_name.value = '';
	form.f_userNum.value = '';
	form.f_year.selectedIndex = 0;
	form.f_season.selectedIndex = 0;
	form.f_cade01.selectedIndex = 0;
	form.f_period.selectedIndex = 0;
	$('#proList').text('');

	form.type.value = '';
	form.record_start.value = '';
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
					<td width='33%'><input name="f_name" type="text" style='width:100%;' value='<?=$f_name?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>회원번호</th>
					<td width='33%'><input name="f_userNum" type="text" style='width:100%;' value='<?=$f_userNum?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>
				<tr>
					<th>연도</th>
					<td>
						<select name='f_year' id='f_year' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
						<?
							for($i=date('Y')+1; $i>=2017; $i--){
								if($i == $f_year)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>
					</td>
					<th>학기</th>
					<td>
						<select name='f_season' id='f_season' onchange='selChk();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
							<option value='봄' <?if($f_season == '봄'){echo 'selected';}?>>봄(3~5월)</option>
							<option value='여름' <?if($f_season == '여름'){echo 'selected';}?>>여름(6~8월)</option>
							<option value='가을' <?if($f_season == '가을'){echo 'selected';}?>>가을(9~11월)</option>
							<option value='겨울' <?if($f_season == '겨울'){echo 'selected';}?>>겨울(12~2월)</option>
							<option value='상시' <?if($f_season == '상시'){echo 'selected';}?>>그외(상시)</option>
						</select>
					</td>
				</tr>

				<tr>
					<th>분류</th>
					<td>
						<select name='f_cade01' id='f_cade01' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
						<?
							$fsql = "select * from ks_programCode where season='$f_season' order by sort";
							$fresult = mysql_query($fsql);
							$fnum = mysql_num_rows($fresult);

							for($i=0; $i<$fnum; $i++){
								$frow = mysql_fetch_array($fresult);
								$txt = $frow['cade01'];

								if($txt == $f_cade01)	$chk = 'selected';
								else							$chk = '';

								echo ("<option value='$txt' $chk>$txt</option>");
							}
						?>
						</select>
					</td>
					<th>기간</th>
					<td>
						<select name='f_period' id='f_period' onchange='periodSet();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
						<?
							$fsql = "select * from ks_programPeriod where year='$f_year' and cade01='$f_cade01' order by title";
							$fresult = mysql_query($fsql);
							$fnum = mysql_num_rows($fresult);

							for($i=0; $i<$fnum; $i++){
								$frow = mysql_fetch_array($fresult);
								$ptxt = $frow['title'];

								if($f_period == $ptxt)	$chk = 'selected';
								else						$chk = '';

								echo ("<option value='$ptxt' $chk>$ptxt</option>");
							}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<th>프로그램</th>
					<td colspan='3' id='proList'>
					<?
						if($f_year && $f_season && $f_cade01 && $f_period){
							$fsql = "select * from ks_program where year='$f_year' and season='$f_season' and cade01='$f_cade01' and period='$f_period' order by uid desc";
							$fresult = mysql_query($fsql);
							$fnum = mysql_num_rows($fresult);

							for($i=0; $i<$fnum; $i++){
								$frow = mysql_fetch_array($fresult);
								$puid = $frow['uid'];
								$ptxt = $frow['title'];

								$chk = '';

								if(is_array($f_prolist)){
									if(in_array($puid,$f_prolist))	$chk = 'checked';
								}

								$chkID = 'fT'.$i;
					?>

						<li style='width:20%;float:left;margin-bottom:8px;'>
							<div class='squaredThree'>
								<input type='checkbox' value='<?=$puid?>' id='<?=$chkID?>' name='f_prolist[]' <?=$chk?>>
								<label for='<?=$chkID?>'></label>
							</div>
							<p style='margin:3px 0 0 25px;font-size:13px;'><?=$ptxt?></p>
						</li>

					<?
							}
						}else{
					?>
						<input name="f_title" type="text" style='width:100%;' value='<?=$f_title?>' onkeypress="if(event.keyCode==13){go_search();}" placeholder="프로그램명 직접입력">
					<?
						}
					?>
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
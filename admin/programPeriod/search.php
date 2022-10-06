<script language='javascript'>
function selChk01(){
	season = $('#f_season').find('option:selected').val();

	//분류
	$.post('json.php',{'season':season}, function(c1){
		//분류 selectbox 초기화
		$('#f_cade01').empty();
		$('#f_cade01').append("<option value=''>:: 선택 ::</option>");

		//이름 selectbox 초기화
		$('#f_title').empty();
		$('#f_title').append("<option value=''>:: 선택 ::</option>");

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#f_cade01').append(option);
		}

		//이름 selectbox 옵션설정
		if(season){
			if(season == '상시')	txt = '상시프로그램';
			else						txt = season+'학기프로그램';

			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#f_title').append(option);

			for(i=1; i<=12; i++){	
				txt = i+'월프로그램';
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#f_title').append(option);
			}
		}
	});
}

function go_search(){
	form = document.frm01;

	f_aDate01 = form.f_aDate01.value;
	f_aDate02 = form.f_aDate02.value;

	input1 = f_aDate01.replace(/-/g,'');
	input2 = f_aDate02.replace(/-/g,'');
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

		f_oDate01 = form.f_oDate01.value;
		f_oDate02 = form.f_oDate02.value;

		input1 = f_oDate01.replace(/-/g,'');
		input2 = f_oDate02.replace(/-/g,'');
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

			f_eDate01 = form.f_eDate01.value;
			f_eDate02 = form.f_eDate02.value;

			input1 = f_eDate01.replace(/-/g,'');
			input2 = f_eDate02.replace(/-/g,'');
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
	}
}

function reset_search(){
	form = document.frm01;

	form.f_year.selectedIndex = 0;
	form.f_season.selectedIndex = 0;
	form.f_cade01.selectedIndex = 0;
	form.f_title.selectedIndex = 0;
	form.f_aDate01.value = '';
	form.f_aDate02.value = '';
	form.f_oDate01.value = '';
	form.f_oDate02.value = '';
	form.f_eDate01.value = '';
	form.f_eDate02.value = '';

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
					<th>연도</th>
					<td colspan='3'>
						<select name='f_year' id='f_year' style='border:1px solid #ccc;height:30px;'>
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
				</tr>

				<tr>
					<th width='17%'>학기</th>
					<td width='33%'>
						<select name='f_season' id='f_season' onchange='selChk01();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
							<option value='봄' <?if($f_season == '봄'){echo 'selected';}?>>1학기</option>
							<option value='여름' <?if($f_season == '여름'){echo 'selected';}?>>2학기</option>
							<option value='가을' <?if($f_season == '가을'){echo 'selected';}?>>3학기</option>
							<option value='겨울' <?if($f_season == '겨울'){echo 'selected';}?>>4학기</option>
							<option value='상시' <?if($f_season == '상시'){echo 'selected';}?>>그외(상시)</option>
						</select>
					</td>
					<th width='17%'>분류</th>
					<td width='33%'>
						<select name='f_cade01' id='f_cade01' style='border:1px solid #ccc;height:30px;'>
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
				</tr>

				<tr>
					<th>이름</th>
					<td colspan='3'>
						<select name='f_title' id='f_title' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
					<?
						$chk = '';

						if($f_season == '상시'){
							if($f_title == '상시프로그램')	$chk = 'selected';
							echo ("<option value='상시프로그램' $chk>상시프로그램</option>");
						}elseif($f_season){
							$str = $f_season.'학기프로그램';
							if($f_title == $str)	$chk = 'selected';
							echo ("<option value='$str' $chk>$str</option>");
						}

						if($f_season){
							for($i=1; $i<=12; $i++){
								$str = $i.'월프로그램';
								if($f_title == $str)	$chk = 'selected';
								else					$chk = '';
								echo ("<option value='$str' $chk>$str</option>");
							}
						}
					?>
						</select>
					</td>
				</tr>

				<tr>
					<th>접수기간(신규회원)</th>
					<td>
						<input type='text' name='f_aDate01' id='fpicker1' value='<?=$f_aDate01?>' readonly style='width:120px;'> ~ 
						<input type='text' name='f_aDate02' id='fpicker2' value='<?=$f_aDate02?>' readonly style='width:120px;'>
					</td>
					<th>접수기간(기존회원)</th>
					<td>
						<input type='text' name='f_oDate01' id='fpicker3' value='<?=$f_oDate01?>' readonly style='width:120px;'> ~ 
						<input type='text' name='f_oDate02' id='fpicker4' value='<?=$f_oDate02?>' readonly style='width:120px;'>
					</td>
				</tr>

				<tr>
					<th>교육기간</th>
					<td colspan='3'>
						<input type='text' name='f_eDate01' id='fpicker5' value='<?=$f_eDate01?>' readonly style='width:120px;'> ~ 
						<input type='text' name='f_eDate02' id='fpicker6' value='<?=$f_eDate02?>' readonly style='width:120px;'>
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











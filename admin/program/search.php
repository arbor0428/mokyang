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

	//기간
	$.post('json_period01.php',{'year':year,'season':season,'c1':c1}, function(req){
		//기간 selectbox 초기화
		$('#f_period').empty();
		$('#f_period').append("<option value=''>:: 선택 ::</option>");

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

function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	$("#f_year").val("<?=date('Y')?>").attr("selected", "selected");
	form.f_season.selectedIndex = 0;	
	form.f_cade01.selectedIndex = 0;
	form.f_period.selectedIndex = 0;
	form.f_title.value = '';

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
						<select name='f_year' id='f_year' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
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
						<select name='f_season' id='f_season' onchange='selChk();' style='border:1px solid #ccc;height:30px;'>
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
				</tr>

				<tr>
					<th>기간</th>
					<td>
						<select name='f_period' id='f_period' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 선택 ::</option>
						<?
							$fsql = "select * from ks_programPeriod where year='$f_year' and season='$f_season' and cade01='$f_cade01' order by title";
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
					<th>프로그램명</th>
					<td><input name="f_title" id="f_title" style="width:100%;" type="text" value="<?=$f_title?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
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











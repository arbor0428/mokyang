<?
	$oyear = '2019';
	$oseason = '겨울';
	$year = '2020';
	$season = '봄';
?>
<script language='javascript'>
function copyBtnOn(){
	//등록버튼 활성화
	$("#copyBtn").css({'pointer-events':'auto'});
	$(".GblNotice_close").click();
}

function copyChk(){
	form = document.FRM;
	if(isFrmEmptyModal(form.oyear,"[기존프로그램] 연도를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.oseason,"[기존프로그램] 학기를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.year,"[신규프로그램] 연도를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.season,"[신규프로그램] 학기를 선택해 주십시오."))	return;

	oyear = $('#oyear').find('option:selected').val();
	oseason = $('#oseason').find('option:selected').val();
	year = $('#year').find('option:selected').val();
	season = $('#season').find('option:selected').val();

	//등록버튼 비활성화
	$("#copyBtn").css({'pointer-events':'none'});

	$.post('json_copy.php',{'oyear':oyear,'oseason':oseason,'year':year,'season':season}, function(res){
		res = urldecode(res);
		parData = JSON.parse(res);

		if(parData[0] == 'empty1'){
			GblMsgBox(oyear+'년도 '+oseason+'학기에 등록된 프로그램이 없습니다.','copyBtnOn();');
			return;

		}else 	if(parData[0] == 'code'){
			GblMsgBox(year+'년도 '+season+'학기에 ['+parData[1]+'] 코드 정보가 없습니다.\n[프로그램 > 코드관리] 메뉴에서 확인해 주시기 바랍니다.','copyBtnOn();');
			return;

		}else if(parData[0] == 'empty2'){
			GblMsgBox(oyear+'년도 '+oseason+'학기에 등록된 프로그램의 기간정보가 없습니다.','copyBtnOn();');
			return;

		}else 	if(parData[0] == 'period'){
			GblMsgBox(year+'년도 '+season+'학기에 ['+parData[1]+'] 기간 정보가 없습니다.\n[프로그램 > 기간관리] 메뉴에서 확인해 주시기 바랍니다.','copyBtnOn();');
			return;

		}else 	if(parData[0] == 'suc'){
			GblMsgBox(year+'년도 '+season+'학기에 ['+parData[1]+']개의 프로그램이 신규등록되었습니다.','listpage();');
			return;
		}
	});
}

function listpage(){
	form = document.FRM;
	form.type.value = 'list';
	form.f_year.value = year;
	form.f_season.value = season;
	form.f_cade01.value = '';
	form.f_period.value = '';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>기존 프로그램</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'><span class='eq'></span> 연도</th>
			<td width='33%'>
				<select name='oyear' id='oyear' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					for($i=date('Y')+1; $i>=2017; $i--){
						if($i == $oyear)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$i' $chk>$i</option>");
					}
				?>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> 학기</th>
			<td width='33%'>
				<select name='oseason' id='oseason' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
					<option value='봄' <?if($oseason == '봄'){echo 'selected';}?>>1학기</option>
					<option value='여름' <?if($oseason == '여름'){echo 'selected';}?>>2학기</option>
					<option value='가을' <?if($oseason == '가을'){echo 'selected';}?>>3학기</option>
					<option value='겨울' <?if($oseason == '겨울'){echo 'selected';}?>>4학기</option>
					<option value='상시' <?if($oseason == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
		</tr>
	</table>

	<div class='mCadeTit02' style='margin:60px 0 3px 0;'>신규 프로그램</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'><span class='eq'></span> 연도</th>
			<td width='33%'>
				<select name='year' id='year' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					for($i=date('Y')+1; $i>=2017; $i--){
						if($i == $year)	$chk = 'selected';
						else				$chk = '';

						echo ("<option value='$i' $chk>$i</option>");
					}
				?>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> 학기</th>
			<td width='33%'>
				<select name='season' id='season' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
					<option value='봄' <?if($season == '봄'){echo 'selected';}?>>1학기</option>
					<option value='여름' <?if($season == '여름'){echo 'selected';}?>>2학기</option>
					<option value='가을' <?if($season == '가을'){echo 'selected';}?>>3학기</option>
					<option value='겨울' <?if($season == '겨울'){echo 'selected';}?>>4학기</option>
					<option value='상시' <?if($season == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
		</tr>
	</table>

	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:copyChk();" class='big cbtn blue' id='copyBtn'>등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>취소</a>
			</td>
		</tr>
	</table>
</div>

</form>
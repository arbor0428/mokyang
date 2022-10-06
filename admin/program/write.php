<?
	//휘트니스 프로그램용 필드
	$fitnessChk = false;



	if(($type=='edit' && $uid) || $pid){
		if($type == 'write' && $pid)	$uid = $pid;

		$sql = "select * from ks_program where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$online = $row["online"];
		$package = $row["package"];

		if($pid == ''){
			$pid = $row["pid"];
			$pTitle = $row["pTitle"];
		}

		if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
			echo 'pid => '.$pid.'<br>uid => '.$uid.'<br>';
		}

		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$mTarget = $row["mTarget"];
		$mTargetEtc = $row["mTargetEtc"];
		$title = $row["title"];
		$fitnessType = $row["fitnessType"];
		$tutorID = $row["tutorID"];
		$tutor = $row["tutor"];
		$maxNum = $row["maxNum"];
		$amt = $row["amt"];
		$room = $row["room"];
		$sEduHour = $row["sEduHour"];
		$sEduMin = $row["sEduMin"];
		$eEduHour = $row["eEduHour"];
		$eEduMin = $row["eEduMin"];
		$yoilList = $row["yoilList"];
		$eduNum = $row["eduNum"];
		$aDate01 = $row["aDate01"];
		$aDate02 = $row["aDate02"];
		$oDate01 = $row["oDate01"];
		$oDate02 = $row["oDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$cDate01 = $row["cDate01"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$ment01 = $row["ment01"];
		$ment02 = $row["ment02"];

		$aDateTxt = $aDate01.' ~ '.$aDate02;
		$oDateTxt = $oDate01.' ~ '.$oDate02;
		$eDateTxt = $eDate01.' ~ '.$eDate02;

		$yoilArr = explode(',',$yoilList);

		if($ment01)		$ment01 = Util::textareaDecodeing($ment01);
		if($ment02)		$ment02 = Util::textareaDecodeing($ment02);

		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;

	}else{
		$online = '';
		$package = '';
		$year = date('Y');
		$month = date('n');

		if(!$season){
			if($month == 3 || $month == 4 || $month == 5)				$season = '봄';
			elseif($month == 6 || $month == 7 || $month == 8)		$season = '여름';
			elseif($month == 9 || $month == 10 || $month == 11)	$season = '가을';
			elseif($month == 12 || $month == 1 || $month == 2)		$season = '겨울';
		}

		$yoilArr = Array();


		//기존 프로그램 정보에서 등록으로 넘어온 경우
		if($oldProgram){
			$sql = "select * from zz_program where uid='$oldProgram'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$year = '2020';
			$month = '3';
			$season = '봄';
			$period = '봄학기프로그램';

			$cade01 = $row["cade01"];
			$mTarget = $row["target"];
			$mTargetEtc = $row["target"];
			$title = $row["title"];
			$sEduHour = $row["sHour"];
			$sEduMin = $row["sMin"];
			$eEduHour = $row["eHour"];
			$eEduMin = $row["eMin"];
			$yoilList = $row["yoil"];

			$yoilList = str_replace('월',1,$yoilList);
			$yoilList = str_replace('화',2,$yoilList);
			$yoilList = str_replace('수',3,$yoilList);
			$yoilList = str_replace('목',4,$yoilList);
			$yoilList = str_replace('금',5,$yoilList);
			$yoilList = str_replace('토',6,$yoilList);
			$yoilArr = explode(',',$yoilList);

			$room = '공연장';
			$tutor = $row["tutor"];
			$maxNum = $row["maxNum"];
			$amt = $row["amt"];


		}
	}

	include 'script.php';
?>

<?
	if($type == 'edit'){
?>
<form name='frm_filedown' method='post'>
<input type='hidden' name='file_dir' value='../upfile/program/'>
<input type='hidden' name='ufile' value="<?=$upfile01?>">
<input type='hidden' name='rfile' value="<?=$realfile01?>">
</form>
<?
	}
?>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='pid' value='<?=$pid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<input type='hidden' name='tutorID' id='tutorID' value='<?=$tutorID?>'>
<input type='hidden' name='chkTutorName' value=''>
<input type='hidden' name='chkTutorID' value=''>

<!-- 검색관련 -->
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<!-- /검색관련 -->

<input type='hidden' name='oldProgram' value='<?=$oldProgram?>'>

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>프로그램 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th>이전 프로그램</th>
			<td colspan='3'><input name="pTitle" id="pTitle" style="width:215px;" type="text" value="<?=$pTitle?>" readonly onclick="programSearch();"> <a href="javascript:programSearch();" class="super cbtn black">검색</a></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 접수형태</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="1" id="jT1" name="online" onclick='setChkBox(this.name,0);' <?if($online == '1'){echo 'checked';}?>>
								<label for="jT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status0'>온라인접수</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="" id="jT2" name="online" onclick='setChkBox(this.name,1);' <?if($online == ''){echo 'checked';}?>>
								<label for="jT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status1'>오프라인접수</p>
						</td>
					</tr>
				</table>
			</td>
		<!--
			<th>헬스 패키지</th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="1" id="pT1" name="package" onclick='setChkBox(this.name,0);' <?if($package == '1'){echo 'checked';}?>>
								<label for="pT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status0'>대상</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="" id="pT2" name="package" onclick='setChkBox(this.name,1);' <?if($package == ''){echo 'checked';}?>>
								<label for="pT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status1'>대상아님</p>
						</td>
					</tr>
				</table>
			</td>
		-->
		</tr>

		<tr>
			<th><span class='eq'></span> 연도</th>
			<td colspan='3'>
				<select name='year' id='year' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
				<?
					for($i=date('Y')+1; $i>=2017; $i--){
						if($i == $year)	$chk = 'selected';
						else				$chk = '';

						echo ("<option value='$i' $chk>$i</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th width='17%'><span class='eq'></span> 학기</th>
			<td width='33%'>
				<select name='season' id='season' onchange='selChk();' style='border:1px solid #ccc;height:30px;'>
					<option value='봄' <?if($season == '봄'){echo 'selected';}?>>1학기</option>
					<option value='여름' <?if($season == '여름'){echo 'selected';}?>>2학기</option>
					<option value='가을' <?if($season == '가을'){echo 'selected';}?>>3학기</option>
					<option value='겨울' <?if($season == '겨울'){echo 'selected';}?>>4학기</option>
					<option value='상시' <?if($season == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> 분류</th>
			<td width='33%'>
				<select name='cade01' id='cade01' onchange='periodChk();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					$sql = "select * from ks_programCode where season='$season' order by sort";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);

					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$txt = $row['cade01'];

						if($txt == $cade01)	$chk = 'selected';
						else						$chk = '';

						echo ("<option value='$txt' $chk>$txt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 기간</th>
			<td>
				<select name='period' id='period' onchange='periodSet();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' order by title";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);

					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$ptxt = $row['title'];

						if($period == $ptxt){
							$chk = 'selected';
							$oDateTxt = $row['oDate01'].' ~ '.$row['oDate02'];
							$eDateTxt = $row['eDate01'].' ~ '.$row['eDate02'];
						}else{
							$chk = '';
						}

						echo ("<option value='$ptxt' $chk>$ptxt</option>");
					}
				?>
				</select>
			</td>
			<th><span class='eq'></span> 대상</th>
			<td>
				<select name='mTarget' id='mTarget' style='border:1px solid #ccc;height:30px;' onchange="$('#mTargetEtc').val(this.options[this.selectedIndex].value);">
					<option value=''>:: 선택 ::</option>
					<option value='어린이' <?if($mTarget == '어린이'){echo 'selected';}?>>어린이</option>
					<option value='6세~초등고학년' <?if($mTarget == '6세~초등고학년'){echo 'selected';}?>>6세~초등고학년</option>
					<option value='중학생이상' <?if($mTarget == '중학생이상'){echo 'selected';}?>>중학생이상</option>
					<option value='성인' <?if($mTarget == '성인'){echo 'selected';}?>>성인</option>
					<option value='전체' <?if($mTarget == '전체'){echo 'selected';}?>>전체</option>
				</select>
				<input name="mTargetEtc" id="mTargetEtc" style="width:140px;" type="text" value="<?=$mTargetEtc?>" placeholder="보여지는 대상문구">
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 프로그램명</th>
			<td colspan='3'><input name="title" id="title" style="width:310px;" type="text" value="<?=$title?>"></td>
		</tr>

		<tr class='defaultTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> 교육시간</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr height='40'>
						<td>
							<select name='sEduHour' id='sEduHour' style='border:1px solid #ccc;height:30px;'>
								<option value=''>==</option>
							<?
								for($i=8; $i<22; $i++){
									$txt = sprintf('%02d',$i);

									if($sEduHour == $txt)	$chk = 'selected';
									else							$chk = '';

									echo ("<option value='$txt' $chk>$txt</option>");
								}
							?>
							</select> : 
							<select name='sEduMin' id='sEduMin' style='border:1px solid #ccc;height:30px;'>
							<?
								for($i=0; $i<60; $i+=5){
									$txt = sprintf('%02d',$i);

									if($sEduMin == $txt)	$chk = 'selected';
									else							$chk = '';

									echo ("<option value='$txt' $chk>$txt</option>");
								}
							?>
							</select> ~ 
							<select name='eEduHour' id='eEduHour' style='border:1px solid #ccc;height:30px;'>
								<option value=''>==</option>
							<?
								for($i=8; $i<23; $i++){
									$txt = sprintf('%02d',$i);

									if($eEduHour == $txt)	$chk = 'selected';
									else							$chk = '';

									echo ("<option value='$txt' $chk>$txt</option>");
								}
							?>
							</select> : 
							<select name='eEduMin' id='eEduMin' style='border:1px solid #ccc;height:30px;'>
							<?
								for($i=0; $i<60; $i+=5){
									$txt = sprintf('%02d',$i);

									if($eEduMin == $txt)		$chk = 'selected';
									else							$chk = '';

									echo ("<option value='$txt' $chk>$txt</option>");
								}
							?>
							</select>
						</td>
					<!--
						<td style='padding:0 0 0 110px;'>
							<div class="squaredThree">
								<input type="checkbox" value="0" id="sT1" name="yoil[]" <?if(in_array('0',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;color:#ff0000;'>일</p>
						</td>
					-->
						<td style='padding:0 0 0 110px;'>
							<div class="squaredThree">
								<input type="checkbox" value="1" id="sT2" name="yoil[]" <?if(in_array('1',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>월</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="2" id="sT3" name="yoil[]" <?if(in_array('2',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT3"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>화</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="3" id="sT4" name="yoil[]" <?if(in_array('3',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT4"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>수</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="4" id="sT5" name="yoil[]" <?if(in_array('4',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT5"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>목</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="5" id="sT6" name="yoil[]" <?if(in_array('5',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT6"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>금</p>
						</td>
						<td style='padding:0 0 0 20px;'>
							<div class="squaredThree">
								<input type="checkbox" value="6" id="sT7" name="yoil[]" <?if(in_array('6',$yoilArr)){echo 'checked';}?> onclick="yoilChk();">
								<label for="sT7"></label>
							</div>
							<p style='margin:3px 0 0 25px;color:#0000ff;'>토</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class='defaultTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> 교육횟수</th>
			<td colspan='3'><input name="eduNum" id="eduNum" style="width:50px;" type="text" value="<?=$eduNum?>" class='numberOnly'>회</td>
		</tr>

		<tr class='fitnessTime' <?if(!$fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> 이용권 종류</th>
			<td colspan='3'>
				<select name='fitnessType' id='fitnessType' style='border:1px solid #ccc;height:30px;'>
					<option value='1day' <?if($fitnessType == '1day'){echo 'selected';}?>>당일권</option>
					<option value='1month' <?if($fitnessType == '1month'){echo 'selected';}?>>1개월권</option>
					<option value='3month' <?if($fitnessType == '3month'){echo 'selected';}?>>3개월권</option>
					<option value='6month' <?if($fitnessType == '6month'){echo 'selected';}?>>6개월권</option>
				</select>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 금액</th>
			<td><input name="amt" id="amt" style="width:110px;" type="text" value="<?=$amt?>" class='numberOnly'>원</td>
			<th>정원</th>
			<td><input name="maxNum" id="maxNum" style="width:110px;" type="text" value="<?=$maxNum?>" class='numberOnly'>명</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 강의실</th>
			<td colspan='3'>
				<select name='room' id='room' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 강의실 선택 ::</option>
				<?
					for($i=0; $i<count($rArr); $i++){
						$rTxt = $rArr[$i];

						if($room == $rTxt)		$chk = 'selected';
						else								$chk = '';

						echo ("<option value='$rTxt' $chk>$rTxt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr>
			<th>강의계획서</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route01" style="width:250px;padding:0 0 0 10px;" placeholder="강의계획서 서류를 첨부해주세요.">
								<label>파일선택<input type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
							</div>
						</td>
					<?
						if($upfile01){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel" name="del_upfile01">
								<label for="fDel"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
						</td>
						<td style='padding:0 0 0 20px;'><a href="javascript:filedownload();" class='small cbtn green'>다운로드</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<th>강사명</th>
		<!--
			<td colspan='3'><input name="tutor" id="tutor" style="width:140px;" type="text" value="<?=$tutor?>" readonly onclick="tutorSearch();"> <a href="javascript:tutorSearch();" class="super cbtn black">검색</a></td>
		-->
			<td colspan='3'><input name="tutor" id="tutor" style="width:140px;" type="text" value="<?=$tutor?>"></td>
		</tr>

		<tr class='periodTime01' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th>접수기간 <span style='font-size:12px;'>(기존회원)</span></th>
			<td><span id='aDateTxt'><?=$aDateTxt?></span></td>
			<th>접수기간 <span style='font-size:12px;'>(신규회원)</span></th>
			<td><span id='oDateTxt'><?=$oDateTxt?></span></td>
		</tr>

		<tr class='periodTime01' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th>교육기간</th>
			<td colspan='3'><span id='eDateTxt'><?=$eDateTxt?></span></td>
		</tr>

		<tr class='periodTime02' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th>환불 불가일</th>
			<td colspan='3'><span id='cDateTxt'><?=$cDate01?></span></td>
		</tr>

		<tr>
			<th>내용</th>
			<td colspan='3'><textarea name='ment01' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$ment01?></textarea></td>
		</tr>

		<tr>
			<th>비고</th>
			<td colspan='3'><textarea name='ment02' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$ment02?></textarea></td>
		</tr>
	</table>

<?
	if($type == 'write'){
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>취소</a>
			</td>
		</tr>
	</table>

<?
	}else{
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>삭제</a></td>
		</tr>
	</table>

<?
	}
?>


</div>

</form>


<?
if($oldProgram){
?>
<script>
$(document).ready(function(){
	periodSet();
});
</script>
<?
}
?>
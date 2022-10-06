<?
	if($type=='edit' && $uid){
		$sql = "select * from ks_programPeriod where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$title = $row["title"];
		$aDate01 = $row["aDate01"];
		$aDate02 = $row["aDate02"];
		$oDate01 = $row["oDate01"];
		$oDate02 = $row["oDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$cDate01 = $row["cDate01"];

	}else{
		if(!$year)	$year = date('Y');
		if(!$month)	$month = date('n');

		if(!$season){
			if($month == 3 || $month == 4 || $month == 5)				$season = '봄';
			elseif($month == 6 || $month == 7 || $month == 8)		$season = '여름';
			elseif($month == 9 || $month == 10 || $month == 11)	$season = '가을';
			elseif($month == 12 || $month == 1 || $month == 2)		$season = '겨울';
		}
	}

	include 'script.php';
?>

<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_oDate01' value='<?=$f_oDate01?>'>
<input type='hidden' name='f_oDate02' value='<?=$f_oDate02?>'>
<input type='hidden' name='f_eDate01' value='<?=$f_eDate01?>'>
<input type='hidden' name='f_eDate02' value='<?=$f_eDate02?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>기간정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><span class='eq'></span> 연도</th>
			<td colspan='3'>
				<select name='year' id='year' style='border:1px solid #ccc;height:30px;'>
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
				<select name='season' id='season' onchange='selChk01();' style='border:1px solid #ccc;height:30px;'>
					<option value='봄' <?if($season == '봄'){echo 'selected';}?>>1학기</option>
					<option value='여름' <?if($season == '여름'){echo 'selected';}?>>2학기</option>
					<option value='가을' <?if($season == '가을'){echo 'selected';}?>>3학기</option>
					<option value='겨울' <?if($season == '겨울'){echo 'selected';}?>>4학기</option>
					<option value='상시' <?if($season == '상시'){echo 'selected';}?>>그외(상시)</option>
				</select>
			</td>
			<th width='17%'><span class='eq'></span> 분류</th>
			<td width='33%'>
				<select name='cade01' id='cade01' style='border:1px solid #ccc;height:30px;'>
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
			<th><span class='eq'></span> 이름</th>
			<td colspan='3'>
				<select name='title' id='title' onchange='chkTitle();' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
			<?
				$chk = '';

				if($season == '상시'){
					if($title == '상시프로그램')	$chk = 'selected';
					echo ("<option value='상시프로그램' $chk>상시프로그램</option>");
				}else{
					$str = $season.'학기프로그램';
					if($title == $str)	$chk = 'selected';
					echo ("<option value='$str' $chk>$str</option>");
				}

				for($i=1; $i<=12; $i++){
					$str = $i.'월프로그램';
					if($title == $str)	$chk = 'selected';
					else					$chk = '';
					echo ("<option value='$str' $chk>$str</option>");
				}
			?>
				</select>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 접수기간 <span style='font-size:12px;'>(기존회원)</span></th>
			<td colspan='3'>
				<input type='text' name='aDate01' id='fpicker1' value='<?=$aDate01?>' readonly> ~ 
				<input type='text' name='aDate02' id='fpicker2' value='<?=$aDate02?>' readonly>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 접수기간 <span style='font-size:12px;'>(신규회원)</span></th>
			<td colspan='3'>
				<input type='text' name='oDate01' id='fpicker3' value='<?=$oDate01?>' readonly> ~ 
				<input type='text' name='oDate02' id='fpicker4' value='<?=$oDate02?>' readonly>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 교육기간</th>
			<td colspan='3'>
				<input type='text' name='eDate01' id='fpicker5' value='<?=$eDate01?>' readonly> ~ 
				<input type='text' name='eDate02' id='fpicker6' value='<?=$eDate02?>' readonly>
			</td>
		</tr>

		<tr>
			<th>환불 불가일</th>
			<td colspan='3'><input type='text' name='cDate01' id='fpicker7' value='<?=$cDate01?>' readonly>일 부터 환불 불가</td>
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
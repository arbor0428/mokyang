<?
	//제이쿼리 달력
	$sRange = '90';
	$eRange = '0';
	include '../../module/Calendar.php';

	if($type=='edit' && $uid){
		//회원정보
		$row = sqlRow("select * from tb_member where uid='".$uid."'");

		if($row){
			foreach($row as $k => $v){
				${$k} = $v;
			}
		}
	}

	include 'script.php';
?>


<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_userid' value='<?=$f_userid?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>회원 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><?=$ico01?> 아이디</th>
			<td colspan='3'><?=$userid?><input type='hidden' name='userid' id='userid' value='<?=$userid?>'></td>
		</tr>

		<tr>
			<th><?=$ico01?> 비밀번호</th>
			<td colspan='3'><input name="pwd" id="pwd" style="width:250px;" type="password" value="" placeholder="변경시에만 입력"></td>
		</tr>

		<tr>
			<th><?=$ico01?> 등급</th>
			<td colspan='3'>
				<input type='radio' name='mtype' id='m1' value='M' <?if($mtype == 'M'){echo 'checked';}?>><label for='m1'><span class='ico04'>일반</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='radio' name='mtype' id='m2' value='C' <?if($mtype == 'C'){echo 'checked';}?>><label for='m2'><span class='ico07'>실무자</span></label>&nbsp;&nbsp;&nbsp;&nbsp;
				<input type='radio' name='mtype' id='m3' value='S' <?if($mtype == 'S'){echo 'checked';}?>><label for='m3'><span class='ico02'>실무담당자</span></label>
			</td>
		</tr>

		<tr>
			<th width='17%'><?=$ico01?> 회원명</th>
			<td width='33%'><input name="name" id="name" style="width:250px;" type="text" value="<?=$name?>"></td>
			<th width='17%'><?=$ico01?> 성별</th>
			<td width='33%'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree" id='sexBox'>
								<input type="checkbox" value="남" id="squaredThree1" name="gender" onclick='setChkBox(this.name,0);' <?if($gender == '남'){echo 'checked';}?>>
								<label for="squaredThree1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='sex0'>남</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="여" id="squaredThree2" name="gender" onclick='setChkBox(this.name,1);' <?if($gender == '여'){echo 'checked';}?>>
								<label for="squaredThree2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='sex1'>여</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<th><?=$ico01?> 이메일</th>
			<td colspan='3'>
				<input name="email01" id="email01" style="width:150px;" type="text" value="<?=$email01?>"> @
				<input name="email02" id="email02" style="width:150px;" type="text" value="<?=$email02?>" placeholder="직접입력">
				<select style='border:1px solid #ccc;height:30px;' onchange="document.FRM.email02.value=this.options[this.selectedIndex].value;">
					<option value="">:: 직접입력 ::</option>
					<option value="naver.com">naver.com</option>
					<option value="hanmail.net">hanmail.net</option>
					<option value="gmail.com">gmail.com</option>
					<option value="nate.com">nate.com</option>
					<option value="daum.net">daum.net</option>
					<option value="hotmail.com">hotmail.com</option>
				</select>
			</td>
		</tr>

		<tr>
			<th><?=$ico01?> 생년월일</th>
			<td colspan='3'><input type='text' name='bDate' id='bDate' value='<?=$bDate?>' autocomplete='off' onkeyup="auto_date_format(event, this)" onkeypress="auto_date_format(event, this)" maxlength="10" /></td>
		</tr>

		<tr>
			<th><?=$ico01?> 연락처</th>
			<td><input name="phone" id="phone" style="width:150px;" type="text" value="<?=$phone?>" placeholder="연락처"></td>
			<th><?=$ico01?> 소속명</th>
			<td><input name="company" id="company" style="width:150px;" type="text" value="<?=$company?>" placeholder="소속명"></td>
		</tr>

		<tr>
			<th>주소</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td><input name="zipcode" id="zipcode" style="width:70px;" type="text" value="<?=$zipcode?>" maxlength='5'> <a href="javascript:openDaumPostcode();" class='small cbtn black'>주소찾기</a></td>
					</tr>
					<tr>
						<td style='padding:3px 0;'>
							<input name="addr01" id="addr01" style="width:49%;" type="text" value="<?=$addr01?>"> 
							<input name="addr02" id="addr02" style="width:49%;" type="text" value="<?=$addr02?>">
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th>가입일</th>
			<td colspan='3'><?=$rDate?></td>
		</tr>
	</table>

<?
	if($type == 'write'){
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>이용자등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
		</tr>
	</table>

<?
	}else{
?>
<!--
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>본인인증정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>성명</th>
			<td width='33%'><?=$kcbName?></td>
			<th width='17%'>성별</th>
			<td width='33%'><?=$kcbSex?></td>
		</tr>
		<tr>
			<th>생년월일</th>
			<td><?=$kcbBdate?></td>
			<th>휴대폰번호</th>
			<td><?=$kcbMobile?></td>
		</tr>
	</table>
-->
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>이용자삭제</a></td>
		</tr>
	</table>

<?
	}
?>
</div>


</form>



<script>
$(document).ready(function () {
	//승인
	if('<?=$status?>' == '1'){
		$('#jT1').click();
		$('#jT1').prop('checked', true);
	}else if('<?=$status?>' == '2'){
		$('#jT2').click();
		$('#jT2').prop('checked', true);
	}

	//성별
	if('<?=$sex?>' == '남'){
		$('#squaredThree1').click();
		$('#squaredThree1').prop('checked', true);
	}else if('<?=$sex?>' == '여'){
		$('#squaredThree2').click();
		$('#squaredThree2').prop('checked', true);
	}

	//회원구분
	if('<?=$userType?>' == '일반'){
		$('#squaredThree3').click();
		$('#squaredThree3').prop('checked', true);
	}else if('<?=$userType?>' == '감면대상자'){
		$('#squaredThree4').click();
		$('#squaredThree4').prop('checked', true);
	}

	//차량보유
	if('<?=$car?>' == ''){
		$('#cT1').click();
		$('#cT1').prop('checked', true);
	}else if('<?=$car?>' == '예'){
		$('#cT2').click();
		$('#cT2').prop('checked', true);
	}

	//대상자 자료제공
	if('<?=$cok?>' == ''){
		$('#sT7').click();
		$('#sT7').prop('checked', true);
	}else{
		$('#sT8').click();
		$('#sT8').prop('checked', true);
	}

	//선호채널
	if('<?=$cokPost?>'){
		$('#cC1').click();
		$('#cC1').prop('checked', true);
	}

	if('<?=$cokSms?>'){
		$('#cC2').click();
		$('#cC2').prop('checked', true);
	}

	if('<?=$cokEmail?>'){
		$('#cC3').click();
		$('#cC3').prop('checked', true);
	}

	if('<?=$cokPhone?>'){
		$('#cC4').click();
		$('#cC4').prop('checked', true);
	}
});
</script>
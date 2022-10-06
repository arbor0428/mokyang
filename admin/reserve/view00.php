<?	
	if($uid){
		$sql = "select * from ks_reserve where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row['status'];
		$team = $row['team'];
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$title = $row['title'];
		$biznum = $row['biznum'];
		$address = $row['address'];
		$sDate01 = $row['sDate01'];
		$sTime01 = $row['sTime01'];
		$eDate01 = $row['eDate01'];
		$eTime01 = $row['eTime01'];
		$showType = $row['showType'];
		$hall01 = $row['hall01'];
		$opt01 = $row['opt01'];
		$temp = $row['temp'];
		$tsHour = $row['tsHour'];
		$teHour = $row['teHour'];
		$memo = $row['memo'];
		$amNum = $row['amNum'];
		$pmNum = $row['pmNum'];
		$ngNum = $row['ngNum'];
		$ticket = $row['ticket'];
		$ticketAmt = $row['ticketAmt'];
		$upfile01 = $row['upfile01'];
		$realfile01 = $row['realfile01'];
		$upfile02 = $row['upfile02'];
		$realfile02 = $row['realfile02'];
		$upfile03 = $row['upfile03'];
		$realfile03 = $row['realfile03'];
		$staff = $row['staff'];
		$notice = $row['notice'];
		$rDate = $row['rDate'];

		if($status == '접수')			$statusTxt = "<span class='ico01'>접수</span>";
		elseif($status == '심사중')	$statusTxt = "<span class='ico03'>심사중</span>";
		elseif($status == '승인')		$statusTxt = "<span class='ico04'>승인</span>";
		elseif($status == '미승인')	$statusTxt = "<span class='ico09'>미승인</span>";
		elseif($status == '취소')		$statusTxt = "<span class='ico11'>취소</span>";

		//사용기간
		$sDate01Txt = $sDate01.' '.date('H',$sTime01).'시 ~ '.$eDate01.' '.date('H',$eTime01).'시';

		//예술회관
		if($hall01)	$hallDataArr01 = explode('|^|',$hall01);

		//예술회관 > 부대시설
		if($opt01)	$optDataArr01 = explode('|^|',$opt01);

		//숲속극장
		if($hall02)	$hallDataArr02 = explode('|^|',$hall02);

		//숲속극장 > 부대시설
		if($opt02)	$optDataArr02 = explode('|^|',$opt02);

		//공연횟수
		$totNum = $amNum + $pmNum + $ngNum;


		if(is_array($hallDataArr01)){
			if(in_array('공연장',$hallDataArr01))				$chk01 = 'checked';
			if(in_array('숲속극장',$hallDataArr01))			$chk02 = 'checked';
			if(in_array('제3강좌실',$hallDataArr01))		$chk03 = 'checked';
			if(in_array('제4강좌실',$hallDataArr01))		$chk04 = 'checked';
			if(in_array('제5강좌실',$hallDataArr01))		$chk05 = 'checked';
			if(in_array('제6강좌실',$hallDataArr01))		$chk06 = 'checked';
			if(in_array('음악감상실',$hallDataArr01))		$chk07 = 'checked';
			if(in_array('문화쉼터',$hallDataArr01))			$chk08 = 'checked';
			if(in_array('소회의실',$hallDataArr01))			$chk09 = 'checked';
			if(in_array('대회의실',$hallDataArr01))			$chk10 = 'checked';
			if(in_array('기획전시실',$hallDataArr01))		$chk11 = 'checked';
			if(in_array('공연연습실',$hallDataArr01))		$chk12 = 'checked';
		}
	}
?>

<script language='javascript'>
function check_form(){
	form = document.frm01;
	form.type.value = 'edit00';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_list(){
	form = document.frm01;
	form.type.value = 'list';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("본 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.frm01;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc00.php';
	form.submit();
}

function file_down(m){
	form01 = document.frm01;

	if(m == 1){
		file_name = form01.dbfile01.value;
		file_rename = form01.realfile01.value;
	}else if(m == 2){
		file_name = form01.dbfile02.value;
		file_rename = form01.realfile02.value;
	}else if(m == 3){
		file_name = form01.dbfile03.value;
		file_rename = form01.realfile03.value;
	}


	form02 = document.frm_down;
	form02.file_rename.value = file_rename;
	form02.file_name.value = file_name;
	form02.target = '';
	form02.submit();
}
</script>

<form name='frm_down' method='post' action='/module/download.php'><!-- 다운로드 폼 -->
<input type='hidden' name='file_name' value="">
<input type='hidden' name='file_rename' value="">
</form>

<form name='frm01' action="proc.php" method='post'>
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
		<td colspan='3'><?=$statusTxt?></td>
	</tr>

	<tr>
		<th width='15%'><?=$ico01?> 단체명</th>
		<td width='35%'><?=$team?></td>
		<th width='15%'><?=$ico01?> 성명 (대표자)</th>
		<td width='35%'><?=$name?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 연락처</th>
		<td><?=$phone?></td>
		<th><?=$ico01?> 이메일</th>
		<td><?=$email?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 행사명</th>
		<td><?=$title?></td>
		<th><?=$ico01?> 사업자번호<br>(생년월일)</th>
		<td><?=$biznum?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 주소</th>
		<td colspan='3'><?=$address?></td>
	</tr>
</table>

<div style='width:100%;text-align:right;font-size:12px;margin-top:50px;'>(오전:09시~13시), (오후:13시~17시), (야간:17시~21시)</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th width='15%'><?=$ico01?> 사용기간</th>
		<td width='85%'><?=$sDate01Txt?></td>
	</tr>

	<tr>
		<th width='15%' style='border-bottom:2px solid #8d8d8d;'><?=$ico01?> 대관성격</th>
		<td width='85%' style='border-bottom:2px solid #8d8d8d;'><?=$showType?></td>
	</tr>

	<tr>
		<th>공연장</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="공연장" id="hallChkID01" name="hallChk01[]" <?=$chk01?> disabled>
					<label for="hallChkID01"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>공연장</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="숲속극장" id="hallChkID02" name="hallChk01[]" <?=$chk02?> disabled>
					<label for="hallChkID02"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>숲속극장</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>강좌실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제3강좌실" id="hallChkID03" name="hallChk01[]" <?=$chk03?> disabled>
					<label for="hallChkID03"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제3강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제4강좌실" id="hallChkID04" name="hallChk01[]" <?=$chk04?> disabled>
					<label for="hallChkID04"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제4강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제5강좌실" id="hallChkID05" name="hallChk01[]" <?=$chk05?> disabled>
					<label for="hallChkID05"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제5강좌실</p>
			</div>

			<div style='width:40%;float:left;height:40px;'></div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="제6강좌실" id="hallChkID06" name="hallChk01[]" <?=$chk06?> disabled>
					<label for="hallChkID06"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>제6강좌실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="음악감상실" id="hallChkID07" name="hallChk01[]" <?=$chk07?> disabled>
					<label for="hallChkID07"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>음악감상실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="문화쉼터" id="hallChkID08" name="hallChk01[]" <?=$chk08?> disabled>
					<label for="hallChkID08"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>문화쉼터</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>회의실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="소회의실" id="hallChkID09" name="hallChk01[]" <?=$chk09?> disabled>
					<label for="hallChkID09"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>소회의실</p>
			</div>

			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="대회의실" id="hallChkID10" name="hallChk01[]" <?=$chk10?> disabled>
					<label for="hallChkID10"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>대회의실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>전시실</th>
		<td style='padding-top:15px;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="기획전시실" id="hallChkID11" name="hallChk01[]" <?=$chk11?> disabled>
					<label for="hallChkID11"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>기획전시실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th style='border-bottom:2px solid #8d8d8d;'>기타</th>
		<td style='padding-top:15px;border-bottom:2px solid #8d8d8d;'>
			<div style='width:20%;float:left;height:40px;'>
				<div class="squaredThree">
					<input type="checkbox" value="공연연습실" id="hallChkID12" name="hallChk01[]" <?=$chk12?> disabled>
					<label for="hallChkID12"></label>
				</div>
				<p style='margin:3px 0 0 30px;'>공연연습실</p>
			</div>
		</td>
	</tr>

	<tr>
		<th>부대시설</th>
		<td style='padding-top:15px;'>
		<?
			for($c=0; $c<count($OptArr01); $c++){
				$sVar = $OptArr01[$c];

				$chk = '';

				if(is_array($optDataArr01)){
					if(in_array($sVar,$optDataArr01))		$chk = 'checked';
				}
		?>
		<div style='width:25%;float:left;height:40px;'>
			<div class="squaredThree">
				<input type="checkbox" value="<?=$sVar?>" id="optChk01<?=$c?>" name="optChk01[]" <?=$chk?> disabled>
				<label for="optChk01<?=$c?>"></label>
			</div>
			<p style='margin:3px 0 0 30px;'><?=$sVar?></p>
		</div>
		<?
				//줄바꿈용....
				if($c == 0)	echo ("<div style='width:75%;float:left;height:40px;'></div>");
			}
		?>
		</td>
	</tr>

	<tr>
		<th>냉/난방</th>
		<td>
		<?
			if($temp){
		?>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><?=$temp?></td>
					<td style='padding:0 0 0 10px;'><?=$tsHour?> 시 ~ <?=$teHour?>시</td>
				</tr>
			</table>
		<?
			}
		?>		
		</td>
	</tr>

	<tr>
		<th>기타사항</th>
		<td height='120'><?=$memo?></td>
	</tr>

	<tr>
		<th>공연횟수</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>오전 (<?=$amNum?>)</td>
					<td style='padding-left:35px;'>오후 (<?=$pmNum?>)</td>
					<td style='padding-left:35px;'>야간 (<?=$ngNum?>)</td>
					<td style='padding-left:50px;'>총 <span class="quantity_tot"><?=$totNum?></span> 회</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<th><?=$ico01?> 입장료</th>
		<td>
		<?
			if($ticket == '유')	echo number_format($ticketAmt).'원';
			else					echo $ticket;
		?>
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
		<?
			if($upfile){
		?>
			<a href="javascript:file_down('<?=$i?>');" class='small cbtn black'>다운로드</a> (<?=$realfile?>)
		<?
			}
		?>
		</td>
	</tr>
<?
	}
?>


	<tr>
		<th><?=$ico01?> 신청인</th>
		<td><?=$staff?></td>
	</tr>

	<tr>
		<th><?=$ico02?> 신청일시</th>
		<td><?=$rDate?></td>
	</tr>

	<tr>
		<th><?=$ico02?> 비고</th>
		<td><?=$notice?></td>
	</tr>
</table>


<table cellpadding='0' cellspacing='0' border='0' width='100%' style='margin-top:20px;'>
	<tr>
		<td width='30%'><a href="javascript:checkDel();" class='big cbtn blood'>삭제하기</a></td>
		<td width='40%' align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>수정하기</a>&nbsp;&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		</td>
		<td width='30%'></td>
	</tr>
</table>


</form>
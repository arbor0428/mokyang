<?	
	if($uid){
		$sql = "select * from ks_reserve where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row['status'];
		$team = $row['team'];
		$biznum = $row['biznum'];
		$since = $row['since'];
		$genre = $row['genre'];
		$genreEtc = $row['genreEtc'];
		$address = $row['address'];
		$name = $row['name'];
		$phone = $row['phone'];
		$email = $row['email'];
		$wname = $row['wname'];
		$wphone = $row['wphone'];
		$wemail = $row['wemail'];
		$teamStyle = $row['teamStyle'];
		$memo = $row['memo'];

		$sDate01 = $row['sDate01'];
		$sTime01 = $row['sTime01'];
		$eDate01 = $row['eDate01'];
		$eTime01 = $row['eTime01'];

		$sDate02 = $row['sDate02'];
		$sTime02 = $row['sTime02'];
		$eDate02 = $row['eDate02'];
		$eTime02 = $row['eTime02'];

		$sDate03 = $row['sDate03'];
		$sTime03 = $row['sTime03'];
		$eDate03 = $row['eDate03'];
		$eTime03 = $row['eTime03'];

		$hall02 = $row['hall02'];
		$opt02 = $row['opt02'];
		$temp = $row['temp'];
		$tsHour = $row['tsHour'];
		$teHour = $row['teHour'];

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


		//공연준비기간
		$sDate01Txt = $sDate01.' '.date('H',$sTime01).'시 ~ '.$eDate01.' '.date('H',$eTime01).'시';

		//공연기간
		$sDate02Txt = $sDate02.' '.date('H',$sTime02).'시 ~ '.$eDate02.' '.date('H',$eTime02).'시';

		//공연철수기간
		$sDate03Txt = $sDate03.' '.date('H',$sTime03).'시 ~ '.$eDate03.' '.date('H',$eTime03).'시';

		//숲속극장 > 부대시설
		if($opt02)	$optDataArr02 = explode('|^|',$opt02);
	}
?>

<script language='javascript'>
function check_form(){
	form = document.frm01;
	form.type.value = 'edit02';
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
	form.action = 'proc02.php';
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
		<th width='15%'><?=$ico01?> 사업자번호</th>
		<td width='35%'><?=$biznum?></td>
	</tr>

	<tr>
		<th><?=$ico02?> 설립연도</th>
		<td colspan='3'><?=$since?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 장르</th>
		<td colspan='3'><?=$genre?> <?if($genre == '기타'){echo '('.$genreEtc.')';}?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 단체주소</th>
		<td colspan='3'><?=$address?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 대표자 (성명)</th>
		<td><?=$name?></td>
		<th><?=$ico01?> 대표자 (연락처)</th>
		<td><?=$phone?> / <?=$email?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 담당자 (성명)</th>
		<td><?=$wname?></td>
		<th><?=$ico01?> 담당자 (연락처)</th>
		<td><?=$wphone?> / <?=$wemail?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 단체성격</th>
		<td colspan='3'><?=$teamStyle?></td>
	</tr>

	<tr>
		<th><?=$ico02?> 단체소개 (주요연혁)</th>
		<td colspan='3' height='120'><?=$memo?></td>
	</tr>
</table>

<div style='width:100%;text-align:right;font-size:12px;margin-top:50px;'>(오전:09시~13시), (오후:13시~17시), (야간:17시~21시)</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th width='15%'><?=$ico01?> 공연준비</th>
		<td width='85%'><?=$sDate01Txt?></td>
	</tr>

	<tr>
		<th><?=$ico01?> 공연</th>
		<td><?=$sDate02Txt?></td>
	</tr>

	<tr>
		<th style='border-bottom:2px solid #8d8d8d;'><?=$ico01?> 철수</th>
		<td style='border-bottom:2px solid #8d8d8d;'><?=$sDate03Txt?></td>
	</tr>

	<tr>
		<th>부대시설</th>
		<td style='padding-top:15px;'>
		<?
			for($c=0; $c<count($OptArr02); $c++){
				$sVar = $OptArr02[$c];

				$chk = '';

				if(is_array($optDataArr02)){
					if(in_array($sVar,$optDataArr02))		$chk = 'checked';
				}
		?>
		<div style='width:25%;float:left;height:40px;'>
			<div class="squaredThree">
				<input type="checkbox" value="<?=$sVar?>" id="optChk02<?=$c?>" name="optChk02[]" <?=$chk?> disabled>
				<label for="optChk02<?=$c?>"></label>
			</div>
			<p style='margin:3px 0 0 30px;'><?=$sVar?></p>
		</div>
		<?
				//줄바꿈용....
				if($c == 2)	echo ("<div style='width:25%;float:left;height:40px;'></div>");
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
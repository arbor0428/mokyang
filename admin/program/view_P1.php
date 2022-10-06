<?
	//휘트니스 프로그램용 필드
	$fitnessChk = false;

	if(($type=='view' && $uid) || $pid){
		if($pid)	$uid = $pid;

		$sql = "select * from ks_program where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$online = $row["online"];
		$package = $row["package"];

		if($pid == ''){
			$pid = $row["pid"];
			$pTitle = $row["pTitle"];
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
		$tutorNum = $row["tutorNum"];
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

		$yoilList = str_replace('0','일',$yoilList);
		$yoilList = str_replace('1','월',$yoilList);
		$yoilList = str_replace('2','화',$yoilList);
		$yoilList = str_replace('3','수',$yoilList);
		$yoilList = str_replace('4','목',$yoilList);
		$yoilList = str_replace('5','금',$yoilList);
		$yoilList = str_replace('6','토',$yoilList);

		if($sEduHour && $eEduHour)	$eduTime = $sEduHour.':'.$sEduMin.' ~ '.$eEduHour.':'.$eEduMin;
		else									$eduTime = '';

		if($online)	$onlineTxt = "<span class='ico01'>ON</span>";
		else			$onlineTxt = "<span class='ico06'>OFF</span>";

		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;
	}

	include 'script.php';
?>


<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='pid' value='<?=$pid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>

<input type='hidden' name='tutorID' id='tutorID' value='<?=$tutorID?>'>
<input type='hidden' name='tutorNum' id='tutorNum' value='<?=$tutorNum?>'>
<input type='hidden' name='chkTutorName' value=''>
<input type='hidden' name='chkTutorNum' value=''>

<!-- 검색관련 -->
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_season' value='<?=$f_season?>'>
<input type='hidden' name='f_cade01' value='<?=$f_cade01?>'>
<input type='hidden' name='f_period' value='<?=$f_period?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>프로그램 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th>이전 프로그램</th>
			<td colspan='3'><?=$pTitle?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >접수형태</th>
			<td colspan='3'><?=$onlineTxt?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >연도</th>
			<td colspan='3'><?=$year?></td>
		</tr>

		<tr>
			<th width='17%'><span class='eq'></span> >학기</th>
			<td width='33%'><?=$season?></td>
			<th width='17%'><span class='eq'></span> >분류</th>
			<td width='33%'><?=$cade01?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >기간</th>
			<td><?=$period?></td>
			<th><span class='eq'></span> >대상</th>
			<td>
			<?
				echo $mTarget;
				if($mTargetEtc && $mTarget != $mTargetEtc)	echo " ($mTargetEtc)";
			?>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> >프로그램명</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
					<?
						if($package){
					?>
						<td style='padding-right:5px;'>
							<div class="hp_q">P</div>
						</td>
					<?
						}
					?>
						<td><?=$title?></td>
					</tr>
				</table>
			</td>
		</tr>

		<tr class='defaultTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> >교육시간</th>
			<td colspan='3'><?=$eduTime?> <?=$yoilList?></td>
		</tr>

		<tr class='defaultTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> >교육횟수</th>
			<td colspan='3'><?=$eduNum?>회</td>
		</tr>

		<tr class='fitnessTime' <?if(!$fitnessChk){echo "style='display:none;'";}?>>
			<th><span class='eq'></span> >이용권 종류</th>
			<td colspan='3'><?=$fitnessType?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> >금액</th>
			<td><?=$amt?>원</td>
			<th>정원</th>
			<td><?=$maxNum?>명</td>
		</tr>

		<tr>
			<th><span class='eq'></span> >강의실</th>
			<td colspan='3'><?=$room?></td>
		</tr>

		<tr>
			<th>강의계획서</th>
			<td colspan='3'>
			<?
				if($upfile01){
			?>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel" name="del_upfile01">
								<label for="fDel"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
						</td>
						<td style='padding:0 0 0 20px;'><a href="javascript:filedownload();" class='small cbtn green'>다운로드</a></td>
					</tr>
				</table>
			<?
				}
			?>
			</td>
		</tr>

		<tr>
			<th>강사명</th>
			<td colspan='3'><?=$tutor?></td>
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
			<td colspan='3'><?=$ment01?></td>
		</tr>

		<tr>
			<th>비고</th>
			<td colspan='3'><?=$ment02?></td>
		</tr>
	</table>


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
		</tr>
	</table>


</div>

</form>
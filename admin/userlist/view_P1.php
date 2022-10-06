<?
	if($type=='view' && $uid){
		$sql = "select * from ks_userlist where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row["status"];
		$userid = $row["userid"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$car = $row["car"];
		$carNum = $row["carNum"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$bank = $row["bank"];
		$accName = $row["accName"];
		$account = $row["account"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$phone01Txt = $row["phone01Txt"];
		$phone02 = $row["phone02"];
		$phone02Txt = $row["phone02Txt"];
		$memo = $row["memo"];
		$reduction = $row["reduction"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$cok = $row["cok"];
		$cokPost = $row["cokPost"];
		$cokSms = $row["cokSms"];
		$cokEmail = $row["cokEmail"];
		$cokPhone = $row["cokPhone"];
		$health = $row["health"];
		$healthBaby = $row["healthBaby"];
		$healthEtc = $row["healthEtc"];
		$joinType = $row["joinType"];
		$getDate = $row["getDate"];

		$healthArr = explode(',',$health);

		if($status == '1')			$statusTxt = "<span class='ico04'>승인</span>";
		elseif($status == '2')		$statusTxt = "<span class='ico07'>미승인</span>";

	}else{
		$status = '2';
		$healthArr = Array();
		$getDate = date('Y-m-d');
	}

	include 'script.php';
?>


<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' id='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' id='realfile01' value='<?=$realfile01?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_sex' value='<?=$f_sex?>'>
<input type='hidden' name='f_bDate01' value='<?=$f_bDate01?>'>
<input type='hidden' name='f_bDate02' value='<?=$f_bDate02?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_userType' value='<?=$f_userType?>'>
<input type='hidden' name='f_reduction' value='<?=$f_reduction?>'>
<input type='hidden' name='f_carNum' value='<?=$f_carNum?>'>
<input type='hidden' name='f_phone' value='<?=$f_phone?>'>
<input type='hidden' name='f_sort' value='<?=$f_sort?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>회원 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><span class='eq'></span> 가입상태</th>
			<td colspan='3'><?=$statusTxt?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 아이디</th>
			<td colspan='3'><?=$userid?></td>
		</tr>


		<tr>
			<th width='17%'><span class='eq'></span> 회원자명</th>
			<td width='33%'><?=$name?></td>
			<th width='17%'><span class='eq'></span> 회원번호</th>
			<td width='33%'><?=$userNum?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 성별</th>
			<td><?=$sex?></td>
			<th><span class='eq'></span> 생년월일</th>
			<td><?=$bDate?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 감면대상자 구분</th>
			<td colspan='3'><?=$userType?></td>
		</tr>

		<tr id="saleBox01" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<th>감면구분</th>
			<td colspan='3'><?=$reduction?></td>
		</tr>


		<tr>
			<th>주차권 발급</th>
			<td colspan='3'>
			<?
				if($car == '예')		echo $carNum;
			?>
			</td>
		</tr>

		<tr>
			<th><span class='eq'></span> 주소</th>
			<td colspan='3'>[<?=$zipcode?>] <?=$addr01?> <?=$addr02?></td>
		</tr>

		<tr>
			<th>계좌정보</th>
			<td colspan='3'><?=$bank?> <?=$accName?> <?=$account?></td>
		</tr>

		<tr>
			<th>이메일</th>
			<td colspan='3'><?=$email01?>@<?=$email02?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 연락처1</th>
			<td colspan='3'><?=$phone01?> <?=$phone01Txt?></td>
		</tr>

		<tr>
			<th>연락처2</th>
			<td colspan='3'><?=$phone02?> <?=$phone02Txt?></td>
		</tr>

		<tr>
			<th>비고</th>
			<td colspan='3'><?=$memo?></td>
		</tr>

		<tr id='cokBox'>
			<th><span class='eq'></span> 선호채널</th>
			<td colspan='3'><?=$cokSms?> <?=$cokEmail?> <?=$cokPhone?></td>
		</tr>

		<tr>
			<th><span class='eq'></span> 가입경로</th>
			<td colspan='3'><?=$joinType?></td>
		</tr>

		<tr>
			<th>접수일</th>
			<td colspan='3'><?=$getDate?></td>
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
<?
	include "../../module/login/head.php";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";

	if($uid){
		$sql = "select c.*, p.package as packageProgram, p.tutor from ks_userClass as c left join ks_program as p on c.programID=p.uid where c.uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$period = $row["period"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$cDate01 = $row["cDate01"];
		$title = $row["title"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$programID = $row["programID"];
		$programAmt = $row["programAmt"];
		$mTarget = $row["mTarget"];
		$health = $row["health"];
		$getDate = $row["getDate"];
		$breakDate01 = $row["breakDate01"];
		$breakDate02 = $row["breakDate02"];
		$payOk = $row["payOk"];						//결제상태
		$paynum = $row['paynum'];					//kcp 거래번호
		$payMode = $row["payMode"];
		$payAmt = $row["payAmt"];
		$payTime = $row["payTime"];
		$billNum = $row["billNum"];
		$cashBill = $row["cashBill"];					//현금영수증 발행유무
		$cashBillNum = $row["cashBillNum"];		//현금영수증번호
		$memo = $row["memo"];
		$payMemo = $row["payMemo"];
		$billName = $row["billName"];					//영수증내 이름표시
		$cardName = $row["cardName"];				//결제한 카드사
		$saleChk = $row["saleChk"];					//감면적용
		$package = $row["package"];					//헬스1개월 패키지
		$packageProgram = $row["packageProgram"];
		$rTime = $row["rTime"];
		$kcpAmt = $row["kcpAmt"];
		$tutor = $row["tutor"];
		$saleAmt = $row["saleAmt"];	//감면금액

		$eDate = $eDate01.' ~ '.$eDate02;

		$programAmtTxt = number_format($programAmt).' 원';

		if($payTime){
			$payDate = date('Y-m-d',$payTime);
			$payHour = date('H',$payTime);
			$payMin = date('i',$payTime);
			$paySec = date('s',$payTime);
		}

		if($season == '상시' && $cade01 == '휘트니스센터')	$fitnessChk = true;

		if($memo)		$memo = Util::textareaDecodeing($memo);
		if($payMemo)	$payMemo = Util::textareaDecodeing($payMemo);

		if($payMode == '가상계좌'){

			$bankname = $row["bankname"];			//가상계좌(입금은행)
			$depositor = $row["depositor"];				//가상계좌(입금자)
			$account = $row["account"];					//가상계좌(입금액)
			$va_date = $row["va_date"];					//가상계좌(입금기한)
			$vaDate = $row["vaDate"];					//가상계좌 입금일시
		}

		//회원정보
		$sql = "select * from ks_userlist where name='$name' and userNum='$userNum'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$sex = $row['sex'];
		$bDate = $row['bDate'];
		$userType = $row['userType'];
		$reduction = $row["reduction"];
		$carNum = $row['carNum'];
		$zipcode = $row['zipcode'];
		$addr01 = $row['addr01'];
		$addr02 = $row['addr02'];
		$email01 = $row['email01'];
		$email02 = $row['email02'];
		$phone01 = $row['phone01'];
		$phone01Txt = $row['phone01Txt'];
		$phone02 = $row['phone02'];
		$phone02Txt = $row['phone02Txt'];

		$addr = '['.$zipcode.'] '.$addr01.' '.$addr02;

		$email = $email01.'@'.$email02;

		if($phone01)	$phone01Str = $phone01;
		if($phone01Txt){
			if($phone01Str) $phone01Str .= ' ';
			$phone01Str .= '('.$phone01Txt.')';
		}

		if($phone02)	$phone02Str = $phone02;
		if($phone02Txt){
			if($phone02Str) $phone02Str .= ' ';
			$phone02Str .= '('.$phone02Txt.')';
		}
	}
?>


<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="euc-kr">
<meta name="viewport" content="width=1300, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
<meta name="viewport" content="width=1300">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />


<title>은평문화재단</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="/module/js/jquery.popupoverlay.js"></script>
<script type="text/javascript" src="/module/js/common.js"> </script> 

<link rel="stylesheet" type="text/css" href="/module/js/style.css">
<link rel="stylesheet" type="text/css" href="/module/js/button.css">
<link rel="stylesheet" type="text/css" href="/module/js/NanumGothic.css">
<link type='text/css' rel='stylesheet' href='/module/js/admin.css'>

<link type='text/css' rel='stylesheet' href='/module/js/placeholder.css'><!-- 웹킷브라우져용 -->
<script src="/module/js/jquery.placeholder.js"></script><!-- placeholder 태그처리용 -->
</head>

<style type='text/css'>
.pTable td table td{border:0;margin:0;padding:0;}
</style>

<form name='frm01' method='post' action=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='name' value='<?=$name?>'>
<input type='hidden' name='userNum' value='<?=$userNum?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>


<div class='mCadeTit02' style='margin-bottom:3px;'>이용자 정보</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th width='17%'><span class='eq'></span> 회원자명</th>
		<td width='33%'><?=$name?></td>
		<th width='17%'><span class='eq'></span> 회원번호</th>
		<td width='33%'><span id="userNumTxt"><?=$userNum?></span></td>
	</tr>

	<tr>
		<th>성별</th>
		<td><span id='sexTxt'><?=$sex?></span></td>
		<th>생년월일</th>
		<td><span id="bDateTxt"><?=$bDate?></span></td>
	</tr>

	<tr>
		<th>회원구분</th>
		<td><span id="userTypeTxt"><?=$userType?></span></td>
		<th>주차권 발급</th>
		<td><span id="carNumTxt"><?=$carNum?></span></td>
	</tr>

	<tr>
		<th>주소</th>
		<td colspan='3'><span id="addrTxt"><?=$addr?></span></td>
	</tr>

	<tr>
		<th>이메일</th>
		<td colspan='3'><span id="emailTxt"><?=$email?></span></td>
	</tr>

	<tr>
		<th>연락처1</th>
		<td><span id="phone01Txt"><?=$phone01Str?></span></td>
		<th>연락처2</th>
		<td><span id="phone02Txt"><?=$phone02Str?></span></td>
	</tr>

	<tr>
		<th>감면구분</th>
		<td colspan='3'><span id="reductionTxt"><?=$reduction?></span></td>
	</tr>

	<tr>
		<th>질병 및 건강상태</th>
		<td colspan='3'><span id="healthTxt"><?=$health?></span></td>
	</tr>
</table>





<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수강신청 프로그램</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th><span class='eq'></span> 연도</th>
		<td colspan='3'><?=$year?></td>
	</tr>

	<tr>
		<th width='17%'><span class='eq'></span> 학기</th>
		<td width='33%'><?=$season?></td>
		<th width='17%'><span class='eq'></span> 분류</th>
		<td width='33%'><?=$cade01?></td>
	</tr>

	<tr>
		<th><span class='eq'></span> 기간</th>
		<td colspan='3'><?=$period?></td>
	</tr>

	<tr id='periodTime' <?if($fitnessChk){echo "style='display:none;'";}?>>
		<th>교육기간</th>
		<td><span id='eDateTxt'><?=$eDate?></span></td>
		<th>환불 불가일</th>
		<td><span id='cDateTxt'><?=$cDate01?></span></td>
	</tr>

	<tr>
		<th><span class='eq'></span> 프로그램명</th>
		<td colspan='3'><?=$title?></td>
	</tr>
	<tr>
		<th>강사명</th>
		<td colspan='3'><span id='tutorTxt'><?=$tutor?></span></td>
	</tr>


	<tr>
		<th>대상</th>
		<td><span id='mTargetTxt'><?=$mTarget?></span></td>
		<th>금액</th>
		<td><span id='programAmtTxt'><?=$programAmtTxt?></span></td>
	</tr>

	<tr>
		<th><span class='eq'></span> 신청일</th>
		<td colspan='3'><?=$getDate?></td>
	</tr>

	<tr>
		<th>알림사항</th>
		<td colspan='3'><?=$memo?></td>
	</tr>
</table>


<div class='mCadeTit02' style='margin:30px 0 3px 0;'>수납정보</span></div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
	<tr>
		<th><span class='eq'></span> 감면적용</th>
		<td colspan='3'>
		<?
			if($saleChk)		echo 'O';
			else				echo 'X';
		?>
		</td>
	</tr>
	<tr>
		<th><span class='eq'></span> 결제수단</th>
		<td colspan='3'>
		<?
			if($payMode == '단말기')				echo "<span class='ico02'>단말기</span>";
			elseif($payMode == '신용카드')		echo "<span class='ico04'>신용카드</span>";
			elseif($payMode == '가상계좌')		echo "<span class='ico06'>가상계좌</span>";
			elseif($payMode == '현금')			echo "<span class='ico10'>현금</span>";
			elseif($payMode == '계좌이체')		echo "<span class='ico12'>계좌이체</span>";
		?>
		</td>
	</tr>

	<tr>
		<th><span class='eq'></span> 결제금액</th>
		<td colspan='3'>
		<?
			echo number_format($payAmt).'원';
			if($saleAmt){
				echo "&nbsp;&nbsp;(감면금액 : ".number_format($saleAmt)." 원)";
			}
		?>
		</td>
	</tr>
<?
if($payMode == '가상계좌')	$payTitle = '신청일시';
else									$payTitle = '결제일시';
?>
	<tr>
		<th><span class='eq'></span> <?=$payTitle?></th>
		<td colspan='3'><?=$payDate?> <?=$payHour?>:<?=$payMin?>:<?=$paySec?></td>
	</tr>

	<tr>
		<th width='17%'>
			<span id='payColumn'>
			<?
				if($payMode == '단말기')			echo "<span class='eq'></span> 카드승인번호";
				elseif($payMode == '신용카드')	echo "<span class='eq'></span> 카드승인번호";
				elseif($payMode == '가상계좌')	echo "<span class='eq'></span> 거래번호";
				elseif($payMode == '현금')		echo "<span class='eq'></span> 현금영수증";
				elseif($payMode == '계좌이체')	echo "<span class='eq'></span> 현금영수증";
			?>
			</span>
		</th>
		<td width='33%'>
			<div id='cardDiv' <?if($payMode != '단말기' && $payMode != '신용카드' && $payMode != '가상계좌'){echo "style='display:none;'";}?>>
				<?=$billNum?>
			</div>

			<div id='cashDiv' <?if($payMode != '현금' && $payMode != '계좌이체'){echo "style='display:none;'";}?>>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td><?=$cashBill?></td>
					</tr>
				</table>
			</div>
		</td>

		<th width='17%'>
			<span id='payColumn2'>
			<?
				if($payMode == '단말기' || $payMode == '신용카드')		echo "<span class='eq'></span> 카드사";
				elseif($payMode == '현금' || $payMode == '계좌이체')		echo "현금영수증 번호";
			?>
			</span>
		</th>
		<td width='33%'>
			<div id='cardNameDiv' <?if($payMode != '단말기' && $payMode != '신용카드'){echo "style='display:none;'";}?>>
				<?=$cardName?>
			</div>

			<div id='cashBillNumDiv' <?if($payMode != '현금' && $payMode != '계좌이체'){echo "style='display:none;'";}?>>
				<?=$cashBillNum?>
			</div>
		</td>
	</tr>

	<?
		if($payMode == '가상계좌' && $paynum){
			$va_date = substr($va_date,0,4).'-'.substr($va_date,4,2).'-'.substr($va_date,6,2).' '.substr($va_date,8,2).':'.substr($va_date,10,2).':'.substr($va_date,12,2);
	?>
	<tr>
		<th>입금일</th>
		<td colspan='3'>
		<?
			if($payOk == '결제확인')	echo $vaDate;
			else								echo '입금대기';
		?>
		</td>
	</tr>
	<tr>
		<th>입금은행</th>
		<td><?=$bankname?></td>
		<th>예금주</th>
		<td><?=$depositor?></td>
	</tr>
	<tr>
		<th>계좌번호</th>
		<td><?=$account?></td>
		<th>입금기한</th>
		<td><?=$va_date?></td>
	</tr>
	<?
		}
	?>

	<tr>
		<th>비고</th>
		<td colspan='3'><?=$payMemo?></td>
	</tr>
</table>
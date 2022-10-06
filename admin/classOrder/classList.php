<?
	include "../../module/login/head.php";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";

	//이용자 > 회원정보관리 리스트에서 넘어오는 경우
	if($userid){
		$sql = "select * from ks_userlist where userid='$userid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$name = $row['name'];
		$userNum = $row['userNum'];
	}

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	if($userid)	$query_ment = " where userid='$userid'";
	else			$query_ment = " where name='$name' and userNum='$userNum'";

	//정렬방식
	$sort_ment = "order by uid desc";

	$query = "select * from ks_userClass $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_userClass $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
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


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable' style='margin:10px 0 20px 0;'>
	<tr>
		<th width='17%'><span class='eq'></span> 회원자명</th>
		<td width='33%'><?=$name?></td>
		<th width='17%'><span class='eq'></span> 회원번호</th>
		<td width='33%'><?=$userNum?></td>
	</tr>
</table>

<div style='float:right;margin-bottom:5px;'>
	<span class='saleIco'>S</span>감면적용
</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>연도</th>
			<th>분류</th>
			<th>기간</th>
			<th>프로그램명</th>
			<th>결제금액</th>
			<th>결제수단</th>
			<th>신청일</th>
		</tr>
	</thead>
<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$year = $row["year"];
		$season = $row["season"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$period = $row["period"];
		$title = $row["title"];
		$fitnessDate01 = $row["fitnessDate01"];
		$fitnessDate02 = $row["fitnessDate02"];
		$eDate01 = $row["eDate01"];
		$eDate02 = $row["eDate02"];
		$getDate = $row["getDate"];
		$payMode = $row["payMode"];
		$payAmt = $row["payAmt"];
		$reFund = $row["reFund"];
		$package = $row["package"];
		$saleChk = $row["saleChk"];

		if($package)	$title = "<span class='packIco'>P</span> ".$title;

		//기간
		$periodTxt = str_replace('프로그램','',$period);

		$payAmtTxt = number_format($payAmt);
		if($saleChk)		$payAmtTxt = "<span class='saleIco'>S</span> ".$payAmtTxt;

		if($season == '상시' && $cade01 == '휘트니스센터'){
			$periodDate = $fitnessDate01.' ~ '.$fitnessDate02;
		}else{
			$periodDate = $eDate01.' ~ '.$eDate02;
		}

		if($payMode == '단말기')			$payModeTxt = "<span class='ico02'>단말기</span>";
		elseif($payMode == '신용카드')	$payModeTxt = "<span class='ico04'>신용카드</span>";
		elseif($payMode == '가상계좌')	$payModeTxt = "<span class='ico06'>가상계좌</span>";
		elseif($payMode == '현금')		$payModeTxt = "<span class='ico10'>현금</span>";
		elseif($payMode == '계좌이체')	$payModeTxt = "<span class='ico12'>계좌이체</span>";
		else										$payModeTxt = '';

		if($reFund){
			if($payModeTxt)	$payModeTxt .= '<br>';

			if($reFund == '환불')				$payModeTxt .= "<span class='ico09'>환불</span>";
			elseif($reFund == '취소')		$payModeTxt .= "<span class='ico07'>취소</span>";
			elseif($reFund == '환불신청')	$payModeTxt .= "<span class='ico03'>환불신청</span>";
		}
?>
	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:default;'>
		<td><?=$i?></td>
		<td><?=$year?></td>
		<td><?=$cade01?></td>
		<td><?=$periodTxt?></td>
		<td><?=$title?></td>
		<td><?=$payAmtTxt?></td>
		<td style='line-height:25px;'><?=$payModeTxt?></td>
		<td><?=$getDate?></td>
	</tr>
<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="8" align='center' height='50'>등록된 수강신청 정보가 없습니다</td>
	</tr>
<?
}
?>
</table>

</form>


<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
	include '../../module/TableFix.php';
?>
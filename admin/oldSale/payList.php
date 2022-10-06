<?
	include "../../module/login/head.php";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";

	$sql = "select * from zz_member where userNum='$userNum'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$userid = $row['userid'];
	$name = $row['name'];

	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where userNum='$userNum'";

	//정렬방식
	$sort_ment = "order by pTime desc, uid desc";

	$query = "select * from zz_classSale $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from zz_classSale $query_ment $sort_ment limit $record_start, $record_count";

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

.zTable th, .zTable td{font-size:16px;}
.pTable th, .pTable td{font-size:16px;}
.gTable th, .gTable td{font-size:14px;}
</style>

<form name='frm01' method='post' action=''>
<input type='hidden' name='type' value=''>
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

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
	<thead>
		<tr>
			<th>번호</th>
			<th>매출일자</th>
			<th>종목명</th>
			<th>중분류</th>
			<th>강습반명</th>
			<th>프로그램명</th>
			<th>할인내역</th>
			<th>할인금액</th>
			<th>판매금액</th>
		</tr>
	</thead>
<?
if($total_record){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){
		$uid = $row["uid"];
		$pDate = $row["pDate"];
		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$cade01 = $row["cade01"];
		$cade02 = $row["cade02"];
		$className = $row["className"];
		$title = $row["title"];
		$saleType = $row["saleType"];
		$saleAmt = $row["saleAmt"];
		$amt = $row["amt"];

		$saleAmtTxt = number_format($saleAmt);
		$amtTxt = number_format($amt);
?>
	<tr align='center' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:default;'>
		<td><?=$i?></td>
		<td><?=$pDate?></td>
		<td><?=$cade01?></td>
		<td><?=$cade02?></td>
		<td><?=$className?></td>
		<td><?=$title?></td>
		<td><?=$saleType?></td>
		<td><?=$saleAmtTxt?></td>
		<td><?=$amtTxt?></td>
	</tr>
<?
		$i--;
	}

}else{
?>
	<tr> 
		<td colspan="9" align='center' height='50'>감면 정보가 없습니다</td>
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
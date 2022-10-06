<?
	include "../module/login/head.php";
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";
	include "../module/class/class.Msg.php";

	if(!$GBL_USERID){
		Msg::goMsg('접근오류','/');
		exit;
	}


	//쿼리조건
	$query_ment = "where uid>0";

	//연도
	if($f_year)		$query_ment .= " and year='$f_year'";
	if($f_season)	$query_ment .= " and season='$f_season'";

	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";
	if($f_period)	$query_ment .= " and period='$f_period'";

	//프로그램명
	if($f_title)		$query_ment .= " and title like '%$f_title%'";


	if($query_ment == '')		$searchQuery = "where uid=0";		//검색전에는 리스트를 불러올 필요가 없다.
	else							$searchQuery = $query_ment;


	//정렬조건
	$sort_ment = "order by uid desc";


	$sql = "select * from ks_program $query_ment $sort_ment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>


<html >
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="euc-kr">
<meta name="viewport" content="width=1300, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densitydpi=device-dpi" />
<meta name="viewport" content="width=1300">
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr" />

<meta property="og:url" content="http://ggwc.i-sign.kr">
<meta property="og:title" content="은평문화재단">
<meta property="og:type" content="website">
<meta property="og:image" content="http://ggwc.i-sign.kr/images/logo.png">
<meta property="og:description" content="은평문화재단">
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

<body onload="document.form1.f_title.focus();">


<script type='text/javascript' language='JavaScript'>
function TabCheck(c){
	chkstatus = $('#'+c).is(":checked");

	if(chkstatus)	$('#'+c).prop('checked', false);
	else				$('#'+c).prop('checked', true);

	$('#'+c).click();
}

function UserCheck(chk,uid){
	if(chk == false)		uid = '';

	parent.userInfo(uid);

	window.parent.$('.multiBox_close').click();
}
</script>



<form name='form1' method='post' action=''>
<input type='hidden' name='type' value=''>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:15px 0 0 0;'>
		<?
			include 'program_search.php';
		?>
		</td>
	</tr>

	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
				<tr>
					<th width='35'>-</th>
					<th width='150'>회원명</th>
					<th width='150'>회원번호</th>
					<th width='150'>회원구분</th>
					<th width='150'>연락처1</th>
					<th width='50'>성별</th>
					<th>생년월일</th>
				</tr>
			</table>

			<div style='width:100%;height:415px;overflow-x:hidden; overflow-y:scroll;border-bottom:1px solid #ccc;font-size:1x;'>
				<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;font-size:12px;" bordercolor="cccccc"  frame="hsides">

	<?
		if($num){
			$listChk = false;
			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);
				$uid = $row["uid"];
				$name = $row["name"];
				$userNum = $row["userNum"];
				$userType = $row["userType"];
				$phone01 = $row["phone01"];
				$sex = $row["sex"];
				$bDate = $row["bDate"];

				if($chkUserName == $name && $chkUserNum == $userNum){
					$focusID = $uid;
					$chk = 'checked';
					$bgc = "bgcolor='#dcdcdc'";
					$bgover = '';
				}else{
					$chk = '';
					$bgc = '';
					$bgover = "onmouseover=\"this.style.backgroundColor='#F8F8F8'\" onmouseout=\"this.style.backgroundColor='#ffffff'\"";
				}
	?>

					<tr align='center' height='30' <?=$bgc?> <?=$bgover?> id='f_<?=$uid?>'> 
						<td width="35"><input name='chk[]' id='c<?=$uid?>' type='checkbox' value='<?=$uid?>' <?=$chk?> onclick="UserCheck(this.checked,this.value);"></td>
						<td width='150' onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$name?></td>
						<td width='150' onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$userNum?></td>
						<td width='150' onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$userType?></td>
						<td width='150' onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$phone01?></td>
						<td width='50' onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$sex?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$bDate?></td>
					</tr>

	<?
			}
		}else{
			if($searchQuery)	$msg = "검색 결과가 없습니다.";
			else					$msg = '';

			echo ("<tr><td align='center' height='410'>$msg</td></tr>");
		}
	?>

				</table>
			</div>

		</td>
	</tr>
</table>

</form>


<iframe name='ifra_clist' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>

<?
	if($focusID){
?>
<script>
$(document).ready(function () {
	fID = 'f_<?=$focusID?>';
	$("#"+fID).attr("tabindex", -1).focus();
	
});
</script>
<?
	}
?>
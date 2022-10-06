<?
	include "../module/login/head.php";
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";
	include "../module/class/class.Msg.php";

	if(!$GBL_USERID){
		Msg::goMsg('접근오류','/');
		exit;
	}


	//쿼리조건(승인회원)
	$query_ment = "where status='1'";

	$searchQuery = '';

	if($f_name)		 $searchQuery .= " and name like '%$f_name%'";
	if($f_userNum)	 $searchQuery .= " and userNum like '%$f_userNum%'";

	if($searchQuery == '')	$query_ment = "where uid=0";		//검색전에는 리스트를 불러올 필요가 없다.
	else							$query_ment .= $searchQuery;


	//정렬조건
	$sort_ment = "order by name";


	$sql = "select * from ks_userlist $query_ment $sort_ment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>

<link type='text/css' rel='stylesheet' href='/css/admin.css'>

<body onload="document.form1.f_name.focus();">


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
<input type='hidden' name='chkUserName' value='<?=$chkUserName?>'>
<input type='hidden' name='chkUserNum' value='<?=$chkUserNum?>'>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:15px 0 0 0;'>
		<?
			include 'user_search.php';
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
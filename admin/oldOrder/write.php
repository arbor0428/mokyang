<?
	$sql = "select * from zz_classOrder where userNum='$userNum' order by pTime desc";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>

<script language='javascript'>
function reg_list(){
	form = document.frm01;
	form.type.value = '';
	form.uid.value = '';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}
</script>

<form name='frm01' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_mobile' value='<?=$f_mobile?>'>
<input type='hidden' name='f_title' value='<?=$f_title?>'>
<input type='hidden' name='f_str' value='<?=$f_str?>'>
<input type='hidden' name='f_pDate01' value='<?=$f_pDate01?>'>
<input type='hidden' name='f_pDate02' value='<?=$f_pDate02?>'>
<!-- /검색관련 -->


	<div class='mCadeTit02' style='margin-bottom:3px;'>결제 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
		<thead>
			<tr>
				<th>번호</th>
				<th>회원번호</th>
				<th>회원자명</th>
				<th>연락처</th>
				<th>강습반명</th>
				<th>매출일자</th>
				<th>매출금액</th>
				<th>유효시작일</th>
				<th>유효종료일</th>
			</tr>
		</thead>
<?
if($num){
	$i = $num;
	while($row = mysql_fetch_array($result)){
		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$title = $row["title"];
		$pDate = $row["pDate"];
		$amt = $row["amt"];
		$sDate = $row["sDate"];
		$eDate = $row["eDate"];

		$amtTxt = number_format($amt);
?>

		<tr align='center' style='cursor:pointer;' onmouseover="this.style.backgroundColor='#F8F8F8'" onmouseout="this.style.backgroundColor='#ffffff'">
			<td><?=$i?></td>
			<td><?=$userNum?></td>		
			<td><?=$name?></td>
			<td><?=$mobile?></td>
			<td><?=$title?></td>
			<td><?=$pDate?></td>
			<td><?=$amtTxt?></td>
			<td><?=$sDate?></td>
			<td><?=$eDate?></td>
		</tr>

<?
		$i--;
	}

}else{
?>
		<tr> 
			<td colspan="9" align='center' height='50'>매출 정보가 없습니다</td>
		</tr>
<?
}
?>
	</table>


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'></td>
		</tr>
	</table>


</form>
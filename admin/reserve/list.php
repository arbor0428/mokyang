<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where uid > 0";

	if($f_status)		$query_ment .= " and status='$f_ctype'";
	if($f_rType)		$query_ment .= " and rType='$f_rType'";
	if($f_team)		$query_ment .= " and team like '%$f_team%'";
	if($f_name)		$query_ment .= " and name like '%$f_name%'";
	if($f_staff)		$query_ment .= " and staff like '%$f_staff%'";

	$sort_ment = "order by uid desc";



	$query = "select * from ks_reserve $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from ks_reserve $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
?>

<script language='javascript'>
function goViewer(uid,r){
	form = document.frm01;

	if(r == 'art')				form.type.value = 'view01';
	else if(r == 'forest')	form.type.value = 'view02';
	else						form.type.value = 'view00';

	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='mCade01' value=''>
<input type='hidden' name='mCade02' value=''>
<input type='hidden' name='passChk' value=''><!-- 미승인 상품도 확인할 수 있도록하는 변수 -->

<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
		<?
			include 'search.php';
		?>
		</td>
	</tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0" style='margin-top:10px;'>
	<tr>						
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable1'>
				<tr>
					<th width="5%">번호</th>
					<th width="10%">상태</th>
					<th width="10%">시설명</th>
					<th width="20%">단체명<br>(신청자)</th>
					<th align='center'>사용기간</th>
					<th width="10%">신청일시</th>
				</tr>



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$rType = $row['rType'];	//art:예술회관, forest:숲속극장
		$status = $row["status"];	//상태
		$hall01 = $row["hall01"];	//시설
		$team = $row["team"];		//단체명
		$name = $row["name"];		//신청자
		$title = $row["title"];			//행사명

		$sDate01 = $row["sDate01"];		//사용기간(예술회관)
		$sTime01 = $row["sTime01"];
		$eDate01 = $row["eDate01"];
		$eTime01 = $row["eTime01"];

		$sDate02 = $row["sDate02"];		//공연기간(숲속극장)
		$sTime02 = $row["sTime02"];
		$eDate02 = $row["eDate02"];
		$eTime02 = $row["eTime02"];

		$rDate = $row["rDate"];		//신청일시

		if($status == '접수')			$statusTxt = "<span class='ico01'>접수</span>";
		elseif($status == '심사중')	$statusTxt = "<span class='ico03'>심사중</span>";
		elseif($status == '승인')		$statusTxt = "<span class='ico04'>승인</span>";
		elseif($status == '미승인')	$statusTxt = "<span class='ico09'>미승인</span>";
		elseif($status == '취소')		$statusTxt = "<span class='ico11'>취소</span>";

		

		$hallTxt = str_replace("|^|", "<br>", $hall01);
		$pDate = $sDate01.' '.date('H',$sTime01).'시 ~ '.$eDate01.' '.date('H',$eTime01).'시';
?>
				<tr onmouseover="this.style.backgroundColor='#f9f9f9'" onmouseout="this.style.backgroundColor='#ffffff'" style='cursor:pointer;' onclick="goViewer('<?=$uid?>','<?=$rType?>');">
					<td><?=$i?></td>
					<td><?=$statusTxt?></td>
					<td style='line-height:18px;'><?=$hallTxt?></td>
					<td><?=$team?><br><?=$name?></td>
					<td style='line-height:18px;padding:5px 0;'><?=$pDate?></td>
					<td><?=$rDate?></td>
				</tr>
<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="6" align='center' height='50'>접수된 대관신청 내역이 없습니다.</td>
				</tr>
<?
}
?>
			</table>									
		</td>
	</tr>
</table>





</form>


<?
	$fName = 'frm01';
	include '../../module/pageNum.php';
?>
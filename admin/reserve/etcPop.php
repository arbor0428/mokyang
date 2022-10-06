<?
	include "../../module/login/head.php";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";


	$revTime = mktime(0,0,0,$month,$day,$year);

	$week = date('w',$revTime);
	if($week == 0)			$weekTxt = '일';
	elseif($week == 1)	$weekTxt = '월';
	elseif($week == 2)	$weekTxt = '화';
	elseif($week == 3)	$weekTxt = '수';
	elseif($week == 4)	$weekTxt = '목';
	elseif($week == 5)	$weekTxt = '금';
	elseif($week == 6)	$weekTxt = '토';

	$revDate = $year.'-'.sprintf('%02d',$month).'-'.sprintf('%02d',$day).' ('.$weekTxt.')';



	//해당일자의 대관정보
	$revHall = Array();
	$revTemp = Array();
	$revTeam = Array();
	$revName = Array();
	$revPhone = Array();
	$revStatus = Array();

	$sql = "select * from ks_reserve_list where revTime='$revTime' order by uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$uid = $row['uid'];
		$hall = $row['hall'];
		$temp = $row['temp'];
		$team = $row['team'];
		$name = $row['staff'];
		$phone = $row['phone'];
		$status = $row['status'];

		$revHall[$uid] = $hall;
		$revTemp[$uid] = $temp;
		$revTeam[$uid] = $team;
		$revName[$uid] = $name;
		$revPhone[$uid] = $phone;
		$revStatus[$uid] = $status;
	}

?>

<script language='javascript'>
function set_reserve(){
	form = document.frm;

    chk = document.getElementsByName('chk[]');
	isChk = false;

	for(i=0; i<chk.length; i++){
		if(chk[i].checked){
			isChk = true;
			isValue = chk[i].value;
			if(isFrmEmpty(form['team_'+isValue], "단체명을 입력해 주십시오"))	return;
		}
	}

	form.action = 'etcPop_proc.php';
	form.submit();
}
</script>

<form name='frm' method='post' action='etcPop_proc.php'>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='year' value='<?=$year?>'>
<input type='hidden' name='month' value='<?=$month?>'>
<input type='hidden' name='day' value='<?=$day?>'>
<input type='hidden' name='revTime' id='revTime' value='<?=$revTime?>'>
<input type='hidden' name='revDate' value='<?=$revDate?>'>
<input type='text' name='' style='display:none;'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr>
		<th width='20%'>대관일자</th>
		<td width='80%'><p style='color:#ff5432;font-size:16px;font-weight:600;'><?=$revDate?></p></td>
	</tr>
</table>

<div style='margin:30px 0 0 0'>
<?
	//대관장소
	include 'hallList.php';
?>
</div>

</form>

<div style='width:100%;margin:30px 0 0 0;text-align:center;'>
	<a href="javascript://" onclick="set_reserve();" class="sbig cbtn blue">저장</a>&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="javascript://" onclick="parent.$('.multiBox_close').click();" class="sbig cbtn black">닫기</a>
</div>
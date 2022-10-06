<script language='javascript'>
var timerID = null;
var timerRunning = false;


function timeNow(){
	i = 0;
	now = new Date();

	hours = now.getHours();
	minutes = now.getMinutes();
	seconds = now.getSeconds();

	timeStr1 = ((hours < 10) ? "0" : "") + hours;
	timeStr2 = ((minutes < 10) ? "0" : "") + minutes;
	timeStr3 = ((seconds < 10) ? "0" : "") + seconds;

	if(seconds < 10){
		i = 0;
	}else if(seconds < 20){
		i = 1;
	}else if(seconds < 30){
		i = 2;
	}else if(seconds < 40){
		i = 3;
	}else if(seconds < 50){
		i = 4;
	}else if(seconds < 60){
		i = 5;
	}

	str = timeStr1+'시&nbsp;'+timeStr2+'분&nbsp;'+timeStr3+'초';

	document.getElementById("tt").innerHTML = str;




	setTimeout("timeNow()",1000);
}
</script>


<body onload='timeNow();'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
	<tr>
		<td style='padding:3px;'>
			<table width="100%" border="0" cellspacing="1" cellpadding="5" bgcolor="#dddddd">

				<tr>
					<td bgcolor='#ffffff'>
						<table width='100%' border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td height="15" align='right'>
								<?
									$today = date('Y년 m월 d일');
									switch(date(w)){
										case '0' : $day = '일요일';
														break;
										case '1' : $day = '월요일';
														break;
										case '2' : $day = '화요일';
														break;
										case '3' : $day = '수요일';
														break;
										case '4' : $day = '목요일';
														break;
										case '5' : $day = '금요일';
														break;
										case '6' : $day = '토요일';
														break;
									}
									echo $today.' '.$day;
								?>
								</td>
							</tr>
							<tr>
								<td height='15' align='right' id='tt'></td>
							</tr>
						</table>

					</td>
				</tr>


<!-- 방문자 카운터 -->
<?
	//총방문자
	$sql = "select count(*) from tb_visit_log";
	$result = mysql_query($sql);
	$visit_tot = mysql_result($result,0,0);
	$visit_tot = number_format($visit_tot).'명';

	//오늘방문자
	$datey = date('Y');
	$datem = date('m');
	$dated = date('d');
	$sql = "select count(*) from tb_visit_log where datey='$datey' and datem='$datem' and dated='$dated'";
	$result = mysql_query($sql);
	$visit_today = mysql_result($result,0,0);
	$visit_today = number_format($visit_today).'명';
?>

				<tr>
					<td bgcolor="ffffff">
						<table width="100%" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td>오늘방문자</td>
								<td align='right'><?=$visit_today?></td>
							</tr>
							<tr>
								<td>총방문자</td>
								<td align='right'><?=$visit_tot?></td>
							</tr>
						</table>
					</td>
				</tr>
<!-- /방문자 카운터 -->
			</table>
		</td>
	</tr>
</table>
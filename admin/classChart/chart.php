<?
if($type == 'chart' && $uid){
	$sql = "select p.*, e.eDate01, e.eDate02, e.eTime01, e.eTime02 from ks_program as p left join ks_programPeriod as e on p.periodID=e.uid where p.uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$year = $row["year"];
	$season = $row["season"];
	$cade01 = $row["cade01"];
	$period = $row["period"];
	$title = $row["title"];
	$maxNum = $row["maxNum"];
	$eDate01 = $row["eDate01"];
	$eDate02 = $row["eDate02"];
	$eTime01 = $row["eTime01"];
	$eTime02 = $row["eTime02"];
	$yoilList = $row["yoilList"];

	$maxNumTxt = number_format($maxNum);

	$logArr = Array();

	//해당 프로그램 수강신청 정보
	$sql = "select * from ks_userClass where programID='$uid' and reFund='' order by uid desc";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);

		$userid = $row["userid"];

		//수강했던 프로그램정보
		$psql = "select * from ks_userClass where userid='$userid' and programID!='$uid' and reFund='' order by programID desc limit 10";
		$presult = mysql_query($psql);
		$pnum = mysql_num_rows($presult);

//		echo $userid.'<br>';

		for($p=0; $p<$pnum; $p++){
			$prow = mysql_fetch_array($presult);
			$pid = $prow['programID'];
//			echo $pid.' / ';
			$logArr[$pid] += 1;
		}
	}

	arsort($logArr);

	$reArr = Array();

	foreach($logArr as $k => $v){
		$reArr[$v][] = $k;
	}

	$cntArr = Array();
	$pidArr = Array();
	$e = 0;

	foreach($reArr as $cnt => $value){
		if($e > 9)	break;

		$arr = $reArr[$cnt];
		arsort($arr);
		foreach($arr as $keys => $pid){
//			echo $cnt." / ".$pid."<br>";
			$cntArr[$e] = $cnt;
			$pidArr[$e] = $pid;
			$e++;
			if($e > 9)	break;
		}
	}

/*
	$arr01 = $logArr;
	$arr02 = $logArr;

	arsort($arr01);
	krsort($arr02);

	echo '<br>==========<br>';

	foreach($arr01 as $k => $v){
		echo $k.' => '.$v.'<br>';
	}

	echo '<br>==========<br>';

	foreach($arr02 as $k => $v){
		echo $k.' => '.$v.'<br>';
	}
*/

}else{
	Msg::backMsg('접근오류');
	exit;
}
?>






<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>프로그램 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>연도</th>
			<td width='33%'><?=$year?></td>
			<th width='17%'>학기</th>
			<td width='33%'><?=$season?></td>
		</tr>

		<tr>
			<th>분류</th>
			<td><?=$cade01?></td>
			<th>기간</th>
			<td><?=$period?></td>
		</tr>

		<tr>
			<th>프로그램명</th>
			<td colspan='3'><?=$title?></td>
		</tr>

		<tr>
			<th>정원</th>
			<td><?=$maxNumTxt?></td>
			<th>교육기간</th>
			<td><?=$eDate01?> ~ <?=$eDate02?></td>
		</tr>
	</table>
</div>










<?
$mArr = Array();
$titArr = Array();
$locArr = Array();

$pNum = count($pidArr);

if($pNum > 0){

for($i=0; $i<$pNum; $i++){
	$programID = $pidArr[$i];
	$cnt = $cntArr[$i];

	//프로그램정보
	$sql = "select * from ks_program where uid='$programID'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$year = $row['year'];
	$period = $row['period'];
	$title = $row['title'];

	$mArr[$i] = '['.$year.' - '.$period.']';
	$titArr[$i] = $title;
	$locArr[$i] = $cnt;
}

$canvasWidth = $pNum * 100;
if($canvasWidth < 300)		$canvasWidth = 300;
?>
<script src="/module/ChartJs/Chart.js"></script>
<script src="/module/ChartJs/samples/utils.js"></script>
<style>
canvas {
	-moz-user-select: none;
	-webkit-user-select: none;
	-ms-user-select: none;
}
</style>

<div style='width:1000px;'>
<div id="container" style="width:<?=$canvasWidth?>;height:700px;margin:30px auto 0 auto;">
	<canvas id="canvas"></canvas> 
</div>
</div>

<script>
var color = Chart.helpers.color;

var barChartData = {
    labels: [
		<?
			for($i=0; $i<count($titArr); $i++){
				if($i>0)	echo ",";
		?>
			"<?=$titArr[$i]?>"
		<?
			}
		?>
	],

	datasets: [{
		backgroundColor: [
			color(window.chartColors.orange).alpha(0.5).rgbString(),
			color(window.chartColors.darksalmon).alpha(0.5).rgbString(),
			color(window.chartColors.red).alpha(0.5).rgbString(),
			color(window.chartColors.lightgreen).alpha(0.5).rgbString(),
			color(window.chartColors.greenyellow).alpha(0.5).rgbString(),
			color(window.chartColors.mediumspringgreen).alpha(0.5).rgbString(),
			color(window.chartColors.lightblue).alpha(0.5).rgbString(),
			color(window.chartColors.lightskyblue).alpha(0.5).rgbString(),
			color(window.chartColors.blue).alpha(0.5).rgbString(),
			color(window.chartColors.violet).alpha(0.5).rgbString()
		],
		borderColor: [
			window.chartColors.orange,
			window.chartColors.darksalmon,
			window.chartColors.red,
			window.chartColors.lightgreen,
			window.chartColors.greenyellow,
			window.chartColors.mediumspringgreen,
			window.chartColors.lightblue,
			window.chartColors.lightskyblue,
			window.chartColors.blue,
			window.chartColors.violet
		],
		borderWidth: 1,
		data: [
		<?
		for($i=0; $i<count($titArr); $i++){
			if($i>0)	echo ",";
		?>
			"<?=$locArr[$i]?>"
		<?
			}
		?>
		]
	}]

};

Chart.plugins.register({
	afterDatasetsDraw: function(chart) {
		var ctx = chart.ctx;
		
		chart.data.datasets.forEach(function(dataset, i) {
			var meta = chart.getDatasetMeta(i);
			if (!meta.hidden) {
				meta.data.forEach(function(element, index) {
					// Draw the text in black, with the specified font
					ctx.fillStyle = 'rgb(0, 0, 0)';
					var fontSize = 16;
					var fontStyle = 'normal';
					var fontFamily = 'Helvetica Neue';
					ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

					// Just naively convert to string for now
					var dataString = dataset.data[index].toString();
					
					// Make sure alignment settings are correct
					ctx.textAlign = 'center';
					ctx.textBaseline = 'middle';
					
					var padding = 5;
					var position = element.tooltipPosition();
					ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
				});
			}
		});
	}
});

window.onload = function() {
	var mArr = new Array(
	<?
		for($i=0; $i<count($mArr); $i++){
			if($i>0)	echo ",";
	?>
		"<?=$mArr[$i]?>"
	<?
		}
	?>
		);
	var ctx = document.getElementById('canvas').getContext('2d');
	ctx.canvas.height = '300px';
	window.myBar = new Chart(ctx, {
		type: 'bar',
		data: barChartData,
		options: {
			responsive: true,
			legend: {
				display: false,
				position: 'top',
			},
			title: {
				display: true,
				fontSize:'16',
				padding:'16',
				text: '해당 프로그램 수강생이 수강했던 프로그램 정보'
			},
			tooltips:{ 
				enabled: true,
				displayColors: false,
				callbacks: { 
					label: function(tooltipItem) { 
						return mArr[Number(tooltipItem.index)];
					} 
				} 
			},
			scales: { 
				yAxes: [{ 
					ticks: { 
						beginAtZero: true,
						callback: function(value) {if (value % 1 === 0) {return value;}}
					} 
				}]  ,
				xAxes: [{ 
					ticks: { 
						autoSkip: false 
					} 
				}]
			} 
		}
	});

};
</script>

<?
}else{
?>
<div style='width:1000px;margin-top:50px;text-align:center;'>데이터가 없습니다.</div>
<?
}
?>
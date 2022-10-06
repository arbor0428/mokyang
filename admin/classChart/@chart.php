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
$colorArr = Array('#fbe739','#d9ec39','#76ce38','#4da338','#93dadc','#75b6d2','#a6d9fd','#3982d2','#899ee8','#8b7aeb');

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
	$title = $row['title'];

	$titArr[$i] = $title;
	$locArr[$i] = $cnt;
}

if(max($locArr) >= 5000)	$step = 500;
elseif(max($locArr) >= 4000)	$step = 400;
elseif(max($locArr) >= 3000)	$step = 300;
elseif(max($locArr) >= 2000)	$step = 200;
elseif(max($locArr) >= 1000)	$step = 100;
elseif(max($locArr) >= 500)	$step = 50;
elseif(max($locArr) >= 400)	$step = 40;
elseif(max($locArr) >= 300)	$step = 30;
elseif(max($locArr) >= 200)	$step = 20;
elseif(max($locArr) >= 50)		$step = 10;
else									$step = 1;

$maxNum = round((max($locArr) + $step) / $step);

$canvasWidth = $pNum * 100;
?>

<script src="/module/Chart.js-master/Chart.js"></script>

<div style='width:1000px;text-align:right;margin-top:30px;'>* 해당 프로그램 수강생이 수강했던 프로그램 정보입니다.</div>
<canvas id="myChart" width="<?=$canvasWidth?>" height="700"></canvas>
<script>
var ctx2 = document.getElementById("myChart").getContext("2d");
var options2= { 'pointLabelFontSize':12,
 	scaleOverride: true,
	scaleSteps: <?=$maxNum?>,
	scaleStepWidth: <?=$step?>,
	scaleStartValue: 0
	 };
var data2 = {
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
 
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(255,255,255,0)",
            highlightFill: "#AAA",
            highlightStroke: "rgba(220,220,220,1)",
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
        }
    ]
};

var myRadarChart = new Chart(ctx2).Bar(data2, options2);
<?
for($i=0; $i<count($titArr); $i++){
	$m = $i % 10;
?>
myRadarChart.datasets[0].bars[<?=$i?>].fillColor = "<?=$colorArr[$m]?>";
<?
}
?>
myRadarChart.update();

</script>

<?
}else{
?>
<div style='width:1000px;margin-top:50px;text-align:center;'>데이터가 없습니다.</div>
<?
}
?>
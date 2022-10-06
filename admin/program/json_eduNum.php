<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';

	$year = iconv("utf-8","euc-kr",$year);
	$season = iconv("utf-8","euc-kr",$season);
	$cade01 = iconv("utf-8","euc-kr",$c1);
	$title = iconv("utf-8","euc-kr",$title);
	$yoilList = iconv("utf-8","euc-kr",$yoilList);

	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$title'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$eTime01 = $row['eTime01'];
	$eTime02 = $row['eTime02'];

	$eduNum = Util::yoilChk($eTime01,$eTime02,$yoilList);

	echo $eduNum;
?>
<?
	include './class/class.DbCon.php';

	//지역
	$sql = "select distinct(cade02) from ks_vCade02 where cade01='$c1' order by sort";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cade02List = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$cade02 = $row['cade02'];

		$cade02List[$i] = urlencode($cade02);
	}

	$json = json_encode($cade02List);
	echo $json;
?>
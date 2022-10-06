<?
	include '../../module/class/class.DbCon.php';


	$cade01 = iconv("utf-8","euc-kr",$cade01);

	$sql = "select * from zz_program where cade01='$cade01' order by title";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$titleList = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$title = $row['title'];

		$title = iconv("euc-kr","utf-8",$title);
		$titleList[$i] = urlencode($title);
	}

	$json = json_encode($titleList);
	echo $json;
?>
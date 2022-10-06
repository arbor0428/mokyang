<?
	include '../../module/class/class.DbCon.php';

	if (!function_exists('json_decode')) {  
		function json_decode($content, $assoc=false) {  
			require_once '../../module/JSON.php';  
		   if ($assoc) {  
			   $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);  
		   }  
		   else {  
			   $json = new Services_JSON;  
		   }  
		   return $json->decode($content);  
	   }  
	}  
	  
	if (!function_exists('json_encode')) {  
	   function json_encode($content) {  
		   require_once '../../module/JSON.php';  
		   $json = new Services_JSON;  
		   return $json->encode($content);  
	   }  
	}


	$year = iconv("utf-8","euc-kr",$year);
	$season = iconv("utf-8","euc-kr",$season);
	$cade01 = iconv("utf-8","euc-kr",$c1);

	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' order by title";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$titleList = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$title = $row['title'];

		$c1 = iconv("euc-kr","utf-8",$title);
		$titleList[$i] = urlencode($c1);
	}

	$json = json_encode($titleList);
	echo $json;
?>
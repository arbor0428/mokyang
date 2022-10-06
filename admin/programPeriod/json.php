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


	$userid = iconv("utf-8","euc-kr",$userid);
	$season = iconv("utf-8","euc-kr",$season);
	

	$sql = "select * from ks_programCode where season='$season' order by sort";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cade01List = Array();

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$cade01 = $row['cade01'];

		$c1 = iconv("euc-kr","utf-8",$cade01);
		$cade01List[$i] = urlencode($c1);
	}

	$json = json_encode($cade01List);
	echo $json;
?>
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


	$sql = "select * from ks_program where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$pArr = Array();

	$pArr[0] = urlencode(iconv("euc-kr","utf-8",$row['year']));
	$pArr[1] = urlencode(iconv("euc-kr","utf-8",$row['season']));
	$pArr[2] = urlencode(iconv("euc-kr","utf-8",$row['cade01']));
	$pArr[3] = urlencode(iconv("euc-kr","utf-8",$row['period']));
	$pArr[4] = urlencode(iconv("euc-kr","utf-8",$row['mTarget']));
	$pArr[5] = urlencode(iconv("euc-kr","utf-8",$row['mTargetEtc']));

	$json = json_encode($pArr);
	echo $json;
?>
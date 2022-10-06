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


	$sql = "select * from tb_member where uid='$uid'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$info = Array();

	if($num){
		$row = mysql_fetch_array($result);
		$name = iconv("euc-kr","utf-8",$row['name']);
		$userid = iconv("euc-kr","utf-8",$row['userid']);

		$info[0] = urlencode($name);
		$info[1] = urlencode($userid);
	}

	$json = json_encode($info);
	echo $json;
?>
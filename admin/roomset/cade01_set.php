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


	$c1 = iconv("utf-8","euc-kr",$c1);

	$sql = "select * from ks_roomlist where cade01='$c1'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cList = Array();

	if($num){
		$row = mysql_fetch_array($result);
		$cade01 = $row['cade01'];
		$memo01 = $row['memo01'];

		$cade01 = iconv("euc-kr","utf-8",$cade01);
		$cList[0] = urlencode($cade01);
		$memo01 = iconv("euc-kr","utf-8",$memo01);
		$cList[1] = urlencode($memo01);


	}

	$json = json_encode($cList);
	echo $json;
?>
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


	$season = iconv("utf-8","euc-kr",$season);
	$cade01 = iconv("utf-8","euc-kr",$cade01);
	$title = iconv("utf-8","euc-kr",$title);

	$sql = "select * from ks_programPeriod where season='$season' and cade01='$cade01' and title='$title'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$aDate01 = $row['aDate01'];
	$aDate02 = $row['aDate02'];
	$oDate01 = $row['oDate01'];
	$oDate02 = $row['oDate02'];
	$eDate01 = $row['eDate01'];
	$eDate02 = $row['eDate02'];
	$cDate01 = $row['cDate01'];

	$aDate = $aDate01;
	if($aDate02){
		if($aDate)	$aDate .= ' ~ ';
		$aDate .= $aDate02;
	}

	$oDate = $oDate01;
	if($oDate02){
		if($oDate)	$oDate .= ' ~ ';
		$oDate .= $oDate02;
	}

	$eDate = $eDate01;
	if($eDate02){
		if($eDate)	$eDate .= ' ~ ';
		$eDate .= $eDate02;
	}

	$pList = Array();

	$a = iconv("euc-kr","utf-8",$aDate);
	$o = iconv("euc-kr","utf-8",$oDate);
	$e = iconv("euc-kr","utf-8",$eDate);
	$c = iconv("euc-kr","utf-8",$cDate01);

	$pList[0] = urlencode($a);
	$pList[1] = urlencode($o);
	$pList[2] = urlencode($e);
	$pList[3] = urlencode($c);

	$json = json_encode($pList);
	echo $json;
?>
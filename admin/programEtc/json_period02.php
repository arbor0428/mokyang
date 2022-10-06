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
	$period = iconv("utf-8","euc-kr",$period);

	$sql = "select * from ks_programPeriod where year='$year' and season='$season' and cade01='$cade01' and title='$period'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$eDate01 = $row['eDate01'];
	$eDate02 = $row['eDate02'];
	$cDate01 = $row['cDate01'];


	$eDate = $eDate01;
	if($eDate02){
		if($eDate)	$eDate .= ' ~ ';
		$eDate .= $eDate02;
	}

	$pList = Array();
	$e = iconv("euc-kr","utf-8",$eDate);
	$c = iconv("euc-kr","utf-8",$cDate01);

	$pList[0] = urlencode($e);
	$pList[1] = urlencode($c);




	//프로그램정보
	$sql = "select * from ks_program where year='$year' and season='$season' and cade01='$cade01' and period='$period' order by title";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($i=0; $i<$num; $i++){
		$n = $i + 2;
		$row = mysql_fetch_array($result);
		$title = $row['title'];

		$p = iconv("euc-kr","utf-8",$title);
		$pList[$n] = urlencode($p);
	}

	$json = json_encode($pList);
	echo $json;
?>
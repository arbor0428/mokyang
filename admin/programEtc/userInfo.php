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


	$sql = "select * from ks_userlist where uid='$uid'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$info = Array();

	if($num){
		$row = mysql_fetch_array($result);
		$userid = iconv("euc-kr","utf-8",$row['userid']);
		$name = iconv("euc-kr","utf-8",$row['name']);
		$userNum = iconv("euc-kr","utf-8",$row['userNum']);
		$sex = iconv("euc-kr","utf-8",$row['sex']);
		$bDate = iconv("euc-kr","utf-8",$row['bDate']);
		$userType = iconv("euc-kr","utf-8",$row['userType']);
		$carNum = iconv("euc-kr","utf-8",$row['carNum']);
		$zipcode = iconv("euc-kr","utf-8",$row['zipcode']);
		$addr01 = iconv("euc-kr","utf-8",$row['addr01']);
		$addr02 = iconv("euc-kr","utf-8",$row['addr02']);
		$email = $row['email01'].'@'.$row['email02'];
		$email = iconv("euc-kr","utf-8",$email);
		$phone01 = iconv("euc-kr","utf-8",$row['phone01']);
		$phone01Txt = iconv("euc-kr","utf-8",$row['phone01Txt']);
		$phone02 = iconv("euc-kr","utf-8",$row['phone02']);
		$phone02Txt = iconv("euc-kr","utf-8",$row['phone02Txt']);
		$reduction = iconv("euc-kr","utf-8",$row['reduction']);
		$health = iconv("euc-kr","utf-8",$row['health']);
		$healthBaby = iconv("euc-kr","utf-8",$row['healthBaby']);
		$healthEtc = iconv("euc-kr","utf-8",$row['healthEtc']);

		$addrTxt = '['.$zipcode.'] '.$addr01.' '.$addr02;

		if($phone01)	$phone01Str = $phone01;
		if($phone01Txt){
			if($phone01Str) $phone01Str .= ' ';
			$phone01Str .= '('.$phone01Txt.')';
		}

		if($phone02)	$phone02Str = $phone02;
		if($phone02Txt){
			if($phone02Str) $phone02Str .= ' ';
			$phone02Str .= '('.$phone02Txt.')';
		}

		$eTxt01 = iconv("euc-kr","utf-8","임산부");
		$eTxt02 = iconv("euc-kr","utf-8","기타");
		$eTxt03 = iconv("euc-kr","utf-8","주차");

		//질병 및 건강상태
		$healthTxt = '';
		$healthlist = explode(',',$health);
		for($i=0; $i<count($healthlist); $i++){
			$hTxt = $healthlist[$i];
			if($hTxt == $eTxt01)			$hTxt .= '('.$healthBaby.$eTxt03.')';
			elseif($hTxt == $eTxt02)	$hTxt .= '('.$healthEtc.')';

			if($healthTxt)	$healthTxt .= ',';
			$healthTxt .= $hTxt;
		}




		$info[0] = urlencode($userid);
		$info[1] = urlencode($name);
		$info[2] = urlencode($userNum);
		$info[3] = urlencode($sex);
		$info[4] = urlencode($bDate);
		$info[5] = urlencode($userType);
		$info[6] = urlencode($carNum);
		$info[7] = urlencode($addrTxt);
		$info[8] = urlencode($email);
		$info[9] = urlencode($phone01Str);
		$info[10] = urlencode($phone02Str);
		$info[11] = urlencode($reduction);
		$info[12] = urlencode($healthTxt);
	}

	$json = json_encode($info);
	echo $json;
?>
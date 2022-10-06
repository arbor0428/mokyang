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

	$cardArr = Array();
	$cardArr['CCBC'] = '비씨';
	$cardArr['CCKM'] = '국민';
	$cardArr['CCNH'] = '농협';
	$cardArr['CCSU'] = '수협';
	$cardArr['CCHM'] = '한미';
	$cardArr['CCPH'] = '평화';
	$cardArr['CCCT'] = '씨티';
	$cardArr['CCSG'] = '신세계';
	$cardArr['CCKE'] = '외환';
	$cardArr['CCCJ'] = '제주';
	$cardArr['CCHN'] = '하나';
	$cardArr['CCSS'] = '삼성';
	$cardArr['CCLG'] = '신한';
	$cardArr['CCKJ'] = '광주';
	$cardArr['CCJB'] = '전북';
	$cardArr['CJCF'] = '해외JCB';
	$cardArr['CCDI'] = '현대';
	$cardArr['CDIF'] = '해외다이너스';
	$cardArr['CCAM'] = '롯데';
	$cardArr['CAMF'] = '해외아멕스';
	$cardArr['CCLO'] = '롯데';
	$cardArr['CVSF'] = '해외비자';
	$cardArr['CMCF'] = '해외마스타';


	$sql = "select * from kcp_pos where uid='$uid'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$info = Array();

	if($num){
		$row = mysql_fetch_array($result);

		$amt1 = $row['amt1'];				//결제금액
		$authdate = $row['authdate'];	//결제일자
		$authtime = $row['authtime'];		//결제시간
		$authno = $row['authno'];			//승인번호
		$hid = $row['hid'];					//카드사

		$authdateTxt = substr($authdate,0,4).'-'.substr($authdate,4,2).'-'.substr($authdate,6,2);
		$authHour = substr($authtime,0,2);
		$authMin = substr($authtime,2,2);
		$authSec = substr($authtime,4,2);

		$hidTxt = iconv("euc-kr","utf-8",$cardArr[$hid]);


		$info[0] = urlencode($amt1);
		$info[1] = urlencode($authdateTxt);
		$info[2] = urlencode($authHour);
		$info[3] = urlencode($authMin);
		$info[4] = urlencode($authSec);
		$info[5] = urlencode($authno);
		$info[6] = urlencode($hidTxt);
	}

	$json = json_encode($info);
	echo $json;
?>
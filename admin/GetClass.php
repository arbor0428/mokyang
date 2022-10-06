<?
	include "../module/class/class.DbCon.php";

	$cade01 = iconv('utf-8','euc-kr',$cade01);
	if($cade02)		$cade02 = iconv('utf-8','euc-kr',$cade02);
	if($cade03)		$cade03 = iconv('utf-8','euc-kr',$cade03);


	//지국명 옵션설정
	$qment = "where cade01='$cade01'";
	$sment = "order by cade02 asc";

	$sql = "select * from ks_mgroup02 $qment $sment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cTxt2 = '';

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$c02 = $row['cade02'];

		//기존에 선택된 지국이 없는 경우 첫번째 인수값을 기준으로..
//		if($cade02 == '' && $i == 0)	$cade02 = $c02;

		if($c02 == $cade02)		$chk = 'selected';
		else							$chk = '';

		$val02 = iconv('euc-kr','utf-8',$c02);
		$cTxt2 .= "<option value='$val02' $chk>$val02</option>";
	}




	//팀명 옵션설정
	$qment .= " and cade02='$cade02'";
	$sment = "order by cade03 asc";

	$sql = "select * from ks_mgroup03 $qment $sment";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	$cTxt3 = '';

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$c03 = $row['cade03'];

		//기존에 선택된 팀이 없는 경우 첫번째 인수값을 기준으로..
//		if($cade03 == '' && $i == 0)	$cade03 = $c03;

		if($c03 == $cade03)		$chk = 'selected';
		else							$chk = '';

		$val03 = iconv('euc-kr','utf-8',$c03);
		$cTxt3 .= "<option value='$val03' $chk>$val03</option>";
	}













//php5.1 이하에서는 json 모듈이 없기 때문에 아래와 같이 함수를 생성하여 사용한다
/*
if (!function_exists('json_decode')) {  
    function json_decode($content, $assoc=false) {  
        require_once 'JSON.php';  
       if ($assoc) {  
           $json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);  
       }  
       else {  
           $json = new Services_JSON;  
       }  
       return $json->decode($content);  
   }  
}  
*/

if (!function_exists('json_encode')) {  
   function json_encode($content) {  
       require_once '../module/JSON.php';  
       $json = new Services_JSON;  
       return $json->encode($content);  
   }  
} 





	$callback = Array();
	$callback['c2'] = $cTxt2;
	$callback['c3'] = $cTxt3;

	echo json_encode($callback); // JSON 인코드
?>
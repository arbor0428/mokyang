<?
	include '../../module/class/class.DbCon.php';
	include '../../module/class/class.Util.php';


	//쿼리조건
	$query_ment = " where uid>0";

	//회원자명
	if($f_name)	$query_ment .= " and name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and userNum like '%$f_userNum%'";

	//성별
	if($f_sex)		$query_ment .= " and sex='$f_sex'";

	//생년월일
	if($f_bDate01){
		$f_sArr = explode('-',$f_bDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and bTime>='$start_date'";
	}

	if($f_bDate02){
		$f_eArr = explode('-',$f_bDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and bTime<='$end_date'";
	}

	//가입상태
	if($f_status)		$query_ment .= " and status='$f_status'";

	//가입일자
	if($f_getDate01){
		$f_sArr = explode('-',$f_getDate01);
		$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
		$query_ment .= " and getTime>='$start_date'";
	}

	if($f_getDate02){
		$f_eArr = explode('-',$f_getDate02);
		$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);
		$query_ment .= " and getTime<='$end_date'";
	}

	//회원구분
	if($f_userType)		$query_ment .= " and userType='$f_userType'";

	//감면구분
	if($f_reduction)	$query_ment .= " and reduction='$f_reduction'";

	//선호채널
	if($f_cokPost)		$query_ment .= " and cokPost='$f_cokPost'";
	if($f_cokSms)		$query_ment .= " and cokSms='$f_cokSms'";
	if($f_cokEmail)		$query_ment .= " and cokEmail='$f_cokEmail'";
	if($f_cokPhone)	$query_ment .= " and cokPhone='$f_cokPhone'";

	//특이질환
	if($f_health)			$query_ment .= " and concat(',',health,',') like '%,$f_health,%'";

	//가입경로
	if($f_joinType)		$query_ment .= " and joinType like '%$f_joinType%'";


	//정렬방식
	if($f_sort == 'nameUp')					$sort_ment = "order by name";
	elseif($f_sort == 'nameDown')			$sort_ment = "order by name desc";
	elseif($f_sort == 'userNumUp')		$sort_ment = "order by userNum";
	elseif($f_sort == 'userNumDown')		$sort_ment = "order by userNum desc";
	else											$sort_ment = "order by getTime desc";

	$query = "select * from ks_userlist $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);


	$file_name = '이용자('.date('YmdHis').')';
	header("Content-Type: application/vnd.ms-excel"); 
	header("Content-Disposition: attachment; filename=$file_name.xls"); 

?>






<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table cellpadding='0' cellspacing='0' border='1'>
	<tr align='center' height='30'>
		<th bgcolor='eeeeee'>회원번호</th>
		<th bgcolor='eeeeee'>회원자명</th>
		<th bgcolor='eeeeee'>성별</th>
		<th bgcolor='eeeeee'>생년월일</th>
		<th bgcolor='eeeeee'>회원구분</th>
		<th bgcolor='eeeeee'>차량보유</th>
		<th bgcolor='eeeeee'>주소</th>
		<th bgcolor='eeeeee'>계좌정보</th>
		<th bgcolor='eeeeee'>이메일</th>
		<th bgcolor='eeeeee'>연락처1</th>
		<th bgcolor='eeeeee'>연락처2</th>
		<th bgcolor='eeeeee'>감면구분</th>
		<th bgcolor='eeeeee'>선호채널</th>
		<th bgcolor='eeeeee'>가입경로</th>
		<th bgcolor='eeeeee'>비고</th>
		<th bgcolor='eeeeee'>접수일</th>
	</tr>

<?
if($total_record != '0'){
	$i = $total_record;

	while($row = mysql_fetch_array($result)){

		$userNum = $row["userNum"];
		$name = $row["name"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$carNum = $row["carNum"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$bank = $row["bank"];
		$accName = $row["accName"];
		$account = $row["account"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$phone02 = $row["phone02"];
		$phone02Txt = $row["phone02Txt"];
		$memo = $row["memo"];
		$reduction = $row["reduction"];
		$cok = $row["cok"];
		$cokPost = $row["cokPost"];
		$cokSms = $row["cokSms"];
		$cokEmail = $row["cokEmail"];
		$cokPhone = $row["cokPhone"];
		$joinType = $row["joinType"];
		$getDate = $row["getDate"];

		$email = '';
		$pstr01 = '';
		$pstr02 = '';
		$channel = '';

		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}

		if($phone01){
			$pstr01 = $phone01;
			if($phone01Txt){
				$pstr01 .= ' ('.$phone01Txt.')';
			}
		}

		if($phone02){
			$pstr02 = $phone02;
			if($phone02Txt){
				$pstr02 .= ' ('.$phone02Txt.')';
			}
		}

		if($cokPost){
			$channel = $cokPost;
		}

		if($cokSms){
			if($channel)		$channel .= ',';
			$channel .= $cokSms;
		}

		if($cokEmail){
			if($channel)		$channel .= ',';
			$channel .= $cokEmail;
		}

		if($cokPhone){
			if($channel)		$channel .= ',';
			$channel .= $cokPhone;
		}


?>


	<tr align='center' height='30'>
		<td><?=$userNum?></td>
		<td><?=$name?></td>
		<td><?=$sex?></td>
		<td style=mso-number-format:'\@'><?=$bDate?></td>
		<td><?=$userType?></td>
		<td><?=$carNum?></td>
		<td>[<?=$zipcode?>] <?=$addr01?> <?=$addr02?></td>
		<td><?=$bank?> <?=$accName?> <?=$account?></td>
		<td><?=$email?></td>
		<td><?=$pstr01?></td>
		<td><?=$pstr02?></td>
		<td><?=$reduction?></td>
		<td><?=$channel?></td>
		<td><?=$joinType?></td>
		<td><?=$memo?></td>
		<td><?=$getDate?></td>
	</tr>
<?
		$i--;
	}
}
?>

</table>
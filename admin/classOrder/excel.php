<?
	include '../../module/class/class.DbCon.php';

	if(!$f_year)	$f_year = date('Y');

	if(!$f_record)	$f_record = 30;
	
	$record_count = $f_record;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = " where uid>0";

	$searchQuery = '';

	//회원자명
	if($f_name)		$searchQuery .= " and name like '%$f_name%'";

	//회원번호
	if($f_userNum)	$searchQuery .= " and userNum like '%$f_userNum%'";

	//결제상태
	if($f_payMode)	$searchQuery .= " and payMode='$f_payMode'";

	//환불/취소
	if($f_reFund)	$searchQuery .= " and reFund='$f_reFund'";

	//연도
	if($f_year)		$searchQuery .= " and year='$f_year'";

	//학기
	if($f_season)		$searchQuery .= " and season='$f_season'";

	//분류
	if($f_cade01)		$searchQuery .= " and cade01='$f_cade01'";

	//기간
	if($f_period)		$searchQuery .= " and period='$f_period'";

	//프로그램
	$f_proCnt = count($f_prolist);
	if($f_proCnt){
		$proQuery = '';
		for($i=0; $i<$f_proCnt; $i++){
			$f_proID = $f_prolist[$i];
			if($proQuery)	$proQuery .= " or ";
			$proQuery .= "programID='$f_proID'";
		}
		$searchQuery .= " and (".$proQuery.")";
	}

	//프로그램명 직접입력
	if($f_title)		$searchQuery .= " and title like '%$f_title%'";
	
	//패키지 프로그램
	if($f_package)	$searchQuery .= " and package!=''";

	//정렬방식
	if($f_reFund == '환불신청')	$sort_ment = "order by reTime desc";
	else									$sort_ment = "order by rTime desc";

	if($searchQuery == '')	$query_ment = "where uid=0";		//검색전에는 리스트를 불러올 필요가 없다.
	else							$query_ment .= $searchQuery;

	$query = "select * from ks_userClass $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);


	$agent = $_SERVER['HTTP_USER_AGENT'];


	$file_name = '결제목록('.date('YmdHis').')';

	//사파리
	if(preg_match('/Safari/i',$agent)){
		$file_name = iconv('euc-kr','utf-8',$file_name);
	}

	header( "Content-type: application/vnd.ms-excel; charset=euc-kr" );
	header("Content-Disposition: attachment; filename=$file_name.xls"); 
?>






<meta http-equiv='Content-Type' content='text/html; charset=euc-kr'>


<style>
br{mso-data-placement:same-cell;}
</style>


<table cellpadding='0' cellspacing='0' border='1'>
	<tr align='center' height='30'>
		<th bgcolor='eeeeee'>번호</th>
		<th bgcolor='eeeeee'>회원번호</th>
		<th bgcolor='eeeeee'>회원자명</th>
		<th bgcolor='eeeeee'>연락처</th>
		<th bgcolor='eeeeee'>강습반명</th>
		<th bgcolor='eeeeee'>강사명</th>
		<th bgcolor='eeeeee'>강습요일</th>
		<th bgcolor='eeeeee'>시작시간</th>
		<th bgcolor='eeeeee'>종료시간</th>
		<th bgcolor='eeeeee'>매출일자</th>
		<th bgcolor='eeeeee'>매출금액</th>
		<th bgcolor='eeeeee'>상태</th>
		<th bgcolor='eeeeee'>환불액</th>
	</tr>

<?
$oYear = date('Y');

if($total_record != '0'){
	$i = $total_record;

	while($row = mysql_fetch_array($result)){

		$userNum = $row["userNum"];
		$name = $row["name"];
		$phone01 = $row["phone01"];
		$getDate = $row["getDate"];
		$payAmt = $row["payAmt"];
		$reFund = $row["reFund"];
		$reAmt = $row["reAmt"];

		//프로그램정보
		$programID = $row["programID"];
		$psql = "select * from ks_program where uid='$programID'";
		$presult = mysql_query($psql);
		$prow = mysql_fetch_array($presult);

		$title = $prow["title"];
		$tutor = $prow["tutor"];
		$yoilList = $prow['yoilList'];
		$sEduHour = $prow['sEduHour'];
		$sEduMin = $prow['sEduMin'];
		$eEduHour = $prow['eEduHour'];
		$eEduMin = $prow['eEduMin'];

		$yoilList = str_replace('1','월',$yoilList);
		$yoilList = str_replace('2','화',$yoilList);
		$yoilList = str_replace('3','수',$yoilList);
		$yoilList = str_replace('4','목',$yoilList);
		$yoilList = str_replace('5','금',$yoilList);
		$yoilList = str_replace('6','토',$yoilList);



		$amtTxt = number_format($payAmt);


		//회원정보
		$usql = "select * from ks_userlist where name='$name' and userNum='$userNum'";
		$uresult = mysql_query($usql);
		$unum = mysql_num_rows($uresult);

		if($unum){
			$urow = mysql_fetch_array($uresult);
			$phone01 = $urow['phone01'];
		}
?>


	<tr align='center' height='30'>
		<td><?=$i?></td>
		<td><?=$userNum?></td>
		<td><?=$name?></td>
		<td style="mso-number-format:'\@';"><?=$phone01?></td>
		<td><?=$title?></td>
		<td><?=$tutor?></td>
		<td><?=$yoilList?></td>
		<td><?=$sEduHour?>:<?=$sEduMin?></td>
		<td><?=$eEduHour?>:<?=$eEduMin?></td>
		<td><?=$getDate?></td>
		<td><?=$amtTxt?></td>
		<td><?=$reFund?></td>
		<td>
		<?
			if($reFund){
				echo number_format($reAmt);
			}
		?>
		</td>
	</tr>
<?
		$i--;
	}
}?>

</table>
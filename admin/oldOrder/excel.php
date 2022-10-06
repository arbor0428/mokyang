<?
	include '../../module/class/class.DbCon.php';

	//검색기간
	$f_sArr = explode('-',$f_pDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_pDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);

	//쿼리조건
	$query_ment = " where o.pTime>='$start_date' and o.pTime<='$end_date'";

	//강습반명 직접입력
	if($f_str)	$query_ment .= " and o.title like '%$f_str%'";

	//회원번호
	if($f_userNum)	$query_ment .= " and o.userNum like '%$f_userNum%'";
	
	//회원자명
	if($f_name)	$query_ment .= " and o.name like '%$f_name%'";

	//연락처
	if($f_mobile)	$query_ment .= " and o.mobile like '%$f_mobile%'";
	
	//강습반명
	if($f_title)	$query_ment .= " and o.title='$f_title'";

	//종목
	if($f_cade01)	$query_ment .= " and o.cade01='$f_cade01'";

	$sort_ment = "order by o.uid desc";

	$query = "select o.*, p.tutor, p.yoil, p.sHour, p.sMin, p.eHour, p.eMin from zz_classOrder as o left join zz_program as p on o.title=p.title $query_ment $sort_ment";

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
	</tr>

<?
$oYear = date('Y');

if($total_record != '0'){
	$i = $total_record;

	while($row = mysql_fetch_array($result)){

		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$title = $row["title"];
		$pDate = $row["pDate"];
		$amt = $row["amt"];

		//프로그램정보
		$tutor = $row["tutor"];
		$yoil = $row["yoil"];
		$sHour = $row["sHour"];
		$sMin = $row["sMin"];
		$eHour = $row["eHour"];
		$eMin = $row["eMin"];

		$amtTxt = number_format($amt);
?>


	<tr align='center' height='30'>
		<td><?=$i?></td>
		<td><?=$userNum?></td>
		<td><?=$name?></td>
		<td><?=$mobile?></td>
		<td><?=$title?></td>
		<td><?=$tutor?></td>
		<td><?=$yoil?></td>
		<td><?=$sHour?>:<?=$sMin?></td>
		<td><?=$eHour?>:<?=$eMin?></td>
		<td><?=$pDate?></td>
		<td><?=$amtTxt?></td>
	</tr>
<?
		$i--;
	}
}?>

</table>
<?
include "../../module/login/head.php";
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";

//대관장소 및 부대시설 목록
include '../../module/HallArray.php';

//$HallTotal = array_merge($HallArr01,$HallArr02);
$HallTotal = $HallArr00;

$next_url = "calendar.php?year=".$year."&month=".$month."&day=1";

$userip = $_SERVER[REMOTE_ADDR];
$rTime = mktime();
$rDate = date('Y-m-d H:i:s');


//기존에 등록된 대관장소를 배열로 저장
$sql = "select * from ks_reserve_list where revTime='$revTime'";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

$dbArr = Array();

for($i=0; $i<$num; $i++){
	$row = mysql_fetch_array($result);
	$dbArr[$i] = $row['hall'];
}



//이번에 신청한 대관장소를 배열로 저장
$newArr = Array();

for($i=0; $i<count($chk); $i++){	
	$c = $chk[$i];
	$hall = $HallTotal[$c];			//대관장소
	$temp = ${'temp_'.$c};			//냉난방
	$team = ${'team_'.$c};			//단체명
	$staff = ${'staff_'.$c};			//신청자
	$phone = ${'phone_'.$c};		//연락자
	$status = ${'status_'.$c};		//상태

	$sql01 = "select * from ks_reserve_list where revTime='$revTime' and hall='$hall'";
	$result01 = mysql_query($sql01);
	$num01 = mysql_num_rows($result01);

	//기존정보수정
	if($num01){
		$sql = "update ks_reserve_list set ";
		$sql .= "temp='$temp',";
		$sql .= "team='$team',";
		$sql .= "staff='$staff',";
		$sql .= "phone='$phone',";
		$sql .= "status='$status'";
		$sql .= " where revTime='$revTime' and hall='$hall'";
		$result = mysql_query($sql);

	//신규등록
	}else{
		$sql = "insert into ks_reserve_list (userid,revDate,revTime,hall,hallNo,temp,team,staff,phone,status,userip,rDate,rTime) values ";
		$sql .= "('$userid','$revDate','$revTime','$hall','$c','$temp','$team','$staff','$phone','$status','$userip','$rDate','$rTime')";
		$result = mysql_query($sql);
	}

	$newArr[$i] = $hall;
}



//기존 대관홀과 신규 대관홀을 비교하여 선택되지않은 기존 대관홀을 삭제한다.
$delArr = array_values(array_diff($dbArr, $newArr));

for($i=0; $i<count($delArr); $i++){
	$hall = $delArr[$i];

	$sql = "delete from ks_reserve_list where revTime='$revTime' and hall='$hall'";
	$result = mysql_query($sql);
}

Msg::goKorea($next_url);
exit;
?>
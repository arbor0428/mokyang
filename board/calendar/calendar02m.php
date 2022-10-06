<?
//--------------------------------------------------------------------
//  PREVIL Calendar
//
//  - calendar.php / lun2sil.php(open source)
//
//  - Programmed by previl(previl@hanmail.net, http://dev.previl.net)
//
//--------------------------------------------------------------------
?>

<style>
.all { /*border-width:1; border-color:#cccccc; border-style:solid;*/ }
font {font-size: 12px; color:#505050;}
font.title {font-size: 24px; font-weight: 600; color:#111111; margin:0 12px;}

.arr-btns img {width:32px; height:32px;}

.week {color:#666;font-size:14px;height:40px; font-weight:600; border-top:1px solid #fff; border-right:2px solid #fff; border-bottom:2px solid #01010d;}


.sholy{font-family:tahoma; font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:link{font-family:tahoma; font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:hover{font-family:tahoma; font-size:16px; color:#F47C46;text-decoration: none;font-weight:bold;}
.sholy:visited{font-family:tahoma; font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:active{font-family:tahoma; font-size:16px; color:#F47C46;text-decoration: none;}

.ssat{font-family:tahoma; font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:link{font-family:tahoma; font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:hover{font-family:tahoma; font-size:16px; color:#1464B0;text-decoration: none;font-weight:bold;}
.ssat:visited{font-family:tahoma; font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:active{font-family:tahoma; font-size:16px; color:#1464B0;text-decoration: none;}

.snum{font-family:tahoma; font-size:16px;color:#505050;text-decoration: none;}
.snum:link{font-family:tahoma; font-size:16px;color:#505050;text-decoration: none;}
.snum:hover{font-family:tahoma; font-size:16px;color:#505050;text-decoration: none;font-weight:bold;}
.snum:visited{font-family:tahoma; font-size:16px;color:#505050;text-decoration: none;}
.snum:active{font-family:tahoma; font-size:16px;color:#505050;text-decoration: none;}

.snum2{font-family:tahoma; font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:link{font-family:tahoma; font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-family:tahoma; font-size:16px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-family:tahoma; font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-family:tahoma; font-size:16px; color:#bbbbbb;text-decoration: none;}

.sover{font-family:tahoma; font-size:16px; color:#0000ff;text-decoration: none;font-weight:bold;}

.scBox{
	word-break:break-all;
	line-height:1.5;
	font-size:15px;
	width:100%;
	padding:3px;
	border:0px solid transparent;
	word-break:keep-all;
}

.scBox:hover{
	border:0px solid #e1e1e1;
	cursor:pointer;
	background:#f7f7f7;
}

.scBox:hover .scBoxTitle {
	text-decoration:underline;
}

.ico_01 {color:#6fbc00; font-weight:600; font-size:16px;}/*공연*/
.ico_04 {color:#e25656; font-weight:600; font-size:16px;}/*전시*/
.ico_06 {color:#763fc0; font-weight:600; font-size:16px;}/*축제*/
.ico_08 {color:#2fcbf2; font-weight:600; font-size:16px;}/*예술교육*/




.r0{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#e25656; color:#fff;}
.r1{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#5da6e4; color:#fff;}
.r2{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#6fbc00; color:#fff;}
.r3{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#ffc000; color:#fff;}
.r4{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#216ca6; color:#fff;}
.r5{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#00b361; color:#fff;}
.r6{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#e45dc1; color:#fff;}
.r7{font-size:13px;height:14px; padding:2px 5px; border-radius:3px; background:#7401DF; color:#fff;}

.rHide{display:none;}


.more-btn {border:1px solid #d1d1d1; background:#f8f8f8; font-size:13px; padding:5px; box-sizing:border-box;margin:5px 0;width:55px;display:block;text-align:center;}
.more-btn:hover {background:#d1d1d1;}

.snum, .ssat, .sholy{font-size:14px;font-weight:normal;}
.snum:hover, .ssat:hover, .sholy:hover{font-size:14px;font-weight:normal;}


.cal_zTable {
    border-collapse: collapse;
    border-spacing: 0px;
    width: 100%;
    border-top: 2px solid #8d8d8d;
    border-bottom: 2px solid #8d8d8d;
}
.cal_zTable th {
    border: 1px solid #ccc;
    height: 40px;
    color: #777;
    font-weight: 600;
    font-size: 14px;
    background: #f9f9f9;
    text-align: center;
}
.cal_zTable tr:first-child th {
    border-top: none;
}
.cal_zTable th:first-child {
    border-left: 0px;
}
.cal_zTable td {
    border: 1px solid #ccc;
    height: 40px;
    color: #777;
    font-size: 14px;
    padding: 5px 10px;
}
.cal_zTable tr:first-child td {
    border-top: none;
}
.cal_zTable td:last-child {
    border-right: 0px;
}

.cal_zTable td table td{border:0;}

.holidayTxt {
    width: 100%;
    text-align: center;
    color: #ff5a5f;
}

</style>

<?
//--------------------------------------------------------------------
//  FUNCTION
//--------------------------------------------------------------------
include "lun2sol.php";   //양음변환 인클루드

function ErrorMsg($msg)
{
  echo " <script>                ";
  echo "   window.alert('$msg'); ";
  echo "   history.go(-1);       ";
  echo " </script>               ";
  exit;
}

function SkipOffset($no,$sdate='',$edate='')
{
  for($i=1;$i<=$no;$i++) {
    $ck = $no-$i+1;
    if($sdate) $num = date('d',$sdate-((3600*24)*$ck));
	if($edate) $num=$i;
    echo "  <TD align=center><a href='/' class=snum2>$num</a></TD> \n";
  }
}

//---- 오늘 날짜
$thisyear  = date('Y');  // 2000
$thismonth = date('n');  // 1, 2, 3, ..., 12
$today     = date('j');  // 1, 2, 3, ..., 31


//------ $year, $month 값이 없으면 현재 날짜
if (!$year)		$year = $thisyear;
if (!$month)		$month = $thismonth;
if (!$day)		$day = $today;

//------ 날짜의 범위 체크
if (($year > 2038) or ($year < 1900)) ErrorMsg("연도는 1900~2038년만 가능합니다.");
if (($month > 12) or ($month < 0)) ErrorMsg("달은 1~12만 가능합니다.");
/*
while (checkdate($month,$day,$year)):
    $date++;
endwhile;
$maxdate = date-1;
*/
$maxdate = date(t, mktime(0, 0, 0, $month, 1, $year));   // the final date of $month

if ($day>$maxdate) ErrorMsg("$month 월 에는 $lastday 일이 마지막 날입니다.");

$prevmonth = $month - 1;
$nextmonth = $month + 1;
$prevyear = $nextyear=$year;
if ($month == 1) {
  $prevmonth = 12;
  $prevyear = $year - 1;
} elseif ($month == 12) {
  $nextmonth = 1;
  $nextyear = $year + 1;
}

/****************** 휴일 정의 ************************/
$HOLIDAY = Array();
$HOLIDAY[] = array(0=>'1-1',1=>'신정');
$HOLIDAY[] = array(0=>'3-1',1=>'삼일절');
//$HOLIDAY[] = array(0=>'4-5',1=>'식목일');
$HOLIDAY[] = array(0=>'5-5',1=>'어린이날');
$HOLIDAY[] = array(0=>'6-6',1=>'현충일');
$HOLIDAY[] = array(0=>'7-17',1=>'제헌절');
$HOLIDAY[] = array(0=>'8-15',1=>'광복절');
$HOLIDAY[] = array(0=>'10-3',1=>'개천절');
$HOLIDAY[] = array(0=>'12-25',1=>'성탄절');

$tmp = lun2sol($year."0101");   //설날
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'설연휴');
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'설날');
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'설연휴');;

$tmp = lun2sol($year."0408");   //석탄일
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'석탄일');

$tmp = lun2sol($year."0815");   //추석
$HOLIDAY[] = array(0=>date("n-j",($tmp-(3600*24))),1=>'추석연휴');;
$HOLIDAY[] = array(0=>date("n-j",$tmp),1=>'추석');;
$HOLIDAY[] = array(0=>date("n-j",($tmp+(3600*24))),1=>'추석연휴');;

unset($tmp);

/****************** 휴일 정의 ************************/

?>

<script>
function moreWrap(d){
	if(d){
		t = $('#bt'+d).text();
		if(t == '더보기'){
			$('.wr'+d).show();
			$('#bt'+d).text('숨기기');
		}else{
			$('.wr'+d).hide();
			$('#bt'+d).text('더보기');
		}
	}
}
</script>

<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td align='center' style='padding-top:10px;padding-bottom:20px;' height='35'>
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td>
						<!--
						<a href="javascript:setCalendar('<?=$year-1?>','<?=$month?>');" onfocus='this.blur()'>
							<img src='<?=$boardRoot?>img/prev.jpg' border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'>
						</a>
						-->
						<a href="javascript:setCalendar('<?=$year-1?>','<?=$month?>');" onfocus='this.blur()' class="arr-btns">
							<img src='/images/arr-r02.png' border='0' onfocus='this.blur();' align='absmiddle' style='margin:0 4px;'>
						</a>
					</td>
					<td>
						<!--
						<a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'>
							<img src='<?=$boardRoot?>img/prev.jpg' border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'>
						</a>
						-->
						<a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()' class="arr-btns">
							<img src='/images/arr-r01.png' border='0' onfocus='this.blur();' align='absmiddle' style='margin:0 4px;'>
						</a>
					</td>
					<!--년 월-->
					<td style='padding:0 30 0 30;' align='center'>
						<font class='title'><?=$year?>. <?=sprintf('%02d',$month)?>.</font>
					</td>
					<!--//년 월-->
					<td>
						<!--
						<a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'>
							<img src='<?=$boardRoot?>/img/next.jpg' border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'>
						</a>
						-->
						<a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()' class="arr-btns">
							<img src='/images/arr-l01.png' border='0' onfocus='this.blur();' align='absmiddle' style=' margin:0 4px;'>
						</a>
					</td>
					<td>
						<!--
						<a href="javascript:setCalendar('<?=$year+1?>','<?=$month?>');" onfocus='this.blur()'>
							<img src='<?=$boardRoot?>/img/next.jpg' border='0' onfocus='this.blur();' align='absmiddle' style='margin-bottom:2px;'>
						</a>
						-->
						<a href="javascript:setCalendar('<?=$year+1?>','<?=$month?>');" onfocus='this.blur()' class="arr-btns">
							<img src='/images/arr-l02.png' border='0' onfocus='this.blur();' align='absmiddle' style=' margin:0 4px;'>
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height='5'></td>
	</tr>
</table>



<table cellpadding="0" cellspacing="0" border="0" width="100%" class="cal_zTable">
	<colgroup>
		<col width="15%">
		<col width="85%">
	</colgroup>
	<tbody>
<?
//표시하는 컨텐츠 개수
$dispNum = 3;

$date   = 1;
$offset = 0;
$ck_row=0; //프레임 사이즈 조절을 위한 체크인자

$yoilArr = Array('일','월','화','수','목','금','토');

while ($date <= $maxdate) {
	if($date == '1') {
		$offset = date('w', mktime(0, 0, 0, $month, $date, $year));  // 0: sunday, 1: monday, ..., 6: saturday
	}

   if($offset == 0)			$style = "sholy";
   elseif($offset == 6)	$style = "ssat";
   else						$style = "snum";

   $date_title = '';

   $hChk = $HOLIDAY[$year.sprintf("%02d",$month).sprintf("%02d",$date)];

   if($hChk){
	   $style="sholy";
	   $date_title = "title='{$month}월 {$date}일은 ".$hChk." 입니다'";
   }


   if($date == $today  &&  $year == $thisyear &&  $month == $thismonth){
	   $style = 'snum';
	   $tdgcolor = "background-color:#f5f5f5;";

   }else{
	   $tdgcolor = '';
   }

   $ymds = $year.'-'.sprintf('%02d',$month).'-'.sprintf('%02d',$date);
?>

		<tr>
			<th><span class="<?=$style?>"><?=$date?>(<?=$yoilArr[$offset]?>)</span></th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>

				<?
					//스케쥴데이터를 가져온다
					$monthTxt = sprintf('%02d',$month);
					$sql = "select * from tb_board_list where table_id='$table_id' and data01='$year' and data02='$monthTxt' and data03='$date' order by uid";
					$result = mysql_query($sql);
					$num = mysql_num_rows($result);
					for($i=0; $i<$num; $i++){
						$row = mysql_fetch_array($result);
						$uid = $row['uid'];
						$title = $row['title'];
						$data04 = $row['data04'];
						$data05 = $row['data05'];	//공연정보 uid값
						$userid = $row['userid'];
						$pwd_chk = $row['pwd_chk'];
						$sData06 = $row['sData06'];

						//글읽기 권한 설정
						include $boardRoot.'chk_view.php';

						//공연정보 상세페이지 이동
						if($data05 && $GBL_MTYPE != 'A'){
							$btn_link = "onclick=show_view('$data05');";
						}

						if($data04 == '공연')			$data04Txt = "<span class='ico_01'>공연</span>";
						elseif($data04 == '전시')		$data04Txt = "<span class='ico_04'>전시</span>";
						elseif($data04 == '예술교육')	$data04Txt = "<span class='ico_08'>예술교육</span>";
						elseif($data04 == '축제')		$data04Txt = "<span class='ico_06'>축제</span>";
						else									$data04Txt = '';

						echo ("<tr><td class='scBox' $btn_link>");
						echo ("$data04Txt<br><span class='scBoxTitle'>$title</span>");
						if($sData06)	echo ("<br>소요시간 : $sData06");
						echo ("</td></tr>");
					}
				?>
				</table>


			</td>
		</tr>

<?
	$date++;
	$offset++;

	if($offset == 7)		$offset = 0;
}
?>
	</tbody>
</table>

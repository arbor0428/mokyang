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
.all { border-width:1; border-color:#cccccc; border-style:solid; }
font {font-family:굴림체; font-size: 12px; color:#505050;}
font.title {font-family: 굴림체; font-size: 12px; font-weight: bold; color:#2579CF;}


.week {font-family:돋움,돋움체;background-color:#eeeeee;color:#ffffff;font-size:12px;font-weight:bold;letter-spacing:-1;height:30px;}


.sholy{font-family:tahoma; font-size:15px; color:#FF6C21;text-decoration: none;}
.sholy:link{font-family:tahoma; font-size:15px; color:#FF6C21;text-decoration: none;}
.sholy:hover{font-family:tahoma; font-size:15px; color:#FF6C21;text-decoration: none;font-weight:bold;}
.sholy:visited{font-family:tahoma; font-size:15px; color:#FF6C21;text-decoration: none;}
.sholy:active{font-family:tahoma; font-size:15px; color:#FF6C21;text-decoration: none;}

.ssat{font-family:tahoma; font-size:15px; color:#0000ff;text-decoration: none;}
.ssat:link{font-family:tahoma; font-size:15px; color:#0000ff;text-decoration: none;}
.ssat:hover{font-family:tahoma; font-size:15px; color:#0000ff;text-decoration: none;font-weight:bold;}
.ssat:visited{font-family:tahoma; font-size:15px; color:#0000ff;text-decoration: none;}
.ssat:active{font-family:tahoma; font-size:15px; color:#0000ff;text-decoration: none;}

.snum{font-family:tahoma; font-size:15px;color:#505050;text-decoration: none;}
.snum:link{font-family:tahoma; font-size:15px;color:#505050;text-decoration: none;}
.snum:hover{font-family:tahoma; font-size:15px;color:#505050;text-decoration: none;font-weight:bold;}
.snum:visited{font-family:tahoma; font-size:15px;color:#505050;text-decoration: none;}
.snum:active{font-family:tahoma; font-size:15px;color:#505050;text-decoration: none;}

.snum2{font-family:tahoma; font-size:15px; color:#bbbbbb;text-decoration: none;}
.snum2:link{font-family:tahoma; font-size:15px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-family:tahoma; font-size:15px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-family:tahoma; font-size:15px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-family:tahoma; font-size:15px; color:#bbbbbb;text-decoration: none;}

.sover{font-family:tahoma; font-size:12px; color:#0000ff;text-decoration: none;font-weight:bold;}



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
if (!$year=$HTTP_POST_VARS['year']) $year = $thisyear;
if (!$month=$HTTP_POST_VARS['month']) $month = $thismonth;
if (!$day=$HTTP_POST_VARS['day']) $day = $today;

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

<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0'>
	<tr>
		<td align='center' style='padding-top:9px;' height='35'>
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td><a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'><img src='<?=$boardRoot?>img/prev2.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
					<td style='padding:0 30 0 30;' align='center'><font class='title'><?=$year?>년 <?=$month?>월</font></td>
					<td><a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'><img src='<?=$boardRoot?>img/next2.gif' border='0' onfocus='this.blur();' align='absmiddle'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height='5'></td>
	</tr>
	<tr>
		<td align='center'>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides" class='s'>
				<tr align='center'>
					<td width='14%' class='week'>일</td>            
					<td width='14%' class='week'>월</td>
					<td width='14%' class='week'>화</td>
					<td width='14%' class='week'>수</td>
					<td width='14%' class='week'>목</td>
					<td width='14%' class='week'>금</td>
					<td width='14%' class='week'>토</td>
				</tr>

				<tr height=<?=$cellh?>>


        <!-- 날짜 테이블 -->


<?

$date   = 1;
$offset = 0;
$ck_row=0; //프레임 사이즈 조절을 위한 체크인자

while ($date <= $maxdate) {   
   if ($date < 10) $date2 = "&nbsp;".$date;
   else $date2 = $date;
   if($date == '1') {
    $offset = date('w', mktime(0, 0, 0, $month, $date, $year));  // 0: sunday, 1: monday, ..., 6: saturday
//	SkipOffset($offset,mktime(0, 0, 0, $month, $date, $year));
	$no = $offset;
	$sdate = mktime(0, 0, 0, $month, $date, $year);
	$edate = '';
	include $c_path.'/SkipOffset.php';

   }
   if($offset == 0) $style ="sholy";
   elseif($offset == 6) $style ="ssat";
   else $style = "snum";

   $date_title = '';
   
   for($i=0;$i<count($HOLIDAY);$i++){	   
       if($HOLIDAY[$i][0] =="$month-$date") {
		   $style="sholy"; 
		   $date_title = "title='{$month}월 {$date}일은 ".$HOLIDAY[$i][1]." 입니다'";    
		   break;
       }	   
   }


   if($date == $today  &&  $year == $thisyear &&  $month == $thismonth){
	   $style = 'snum';
	   $tdgcolor = "bgcolor='#ededed'";

   }else{
	   $tdgcolor = '';
   }




   //날짜출력
	echo ("
		<td $tdgcolor valign='top'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td style='padding-bottom:3px;'><a href=javascript:time_set('$year','$month','$date'); class=$style $date_title>$date2</a></td>
				</tr>");

	//스케쥴데이터를 가져온다
	$sql = "select * from ks_board_list where table_id='$table_id' and data01='$year' and data02='$month' and data03='$date' order by uid";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$uid = $row['uid'];
		$title = $row['title'];
		$userid = $row['userid'];
		$pwd_chk = $row['pwd_chk'];

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,14,'..');


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';

		echo ("<tr><td style='font-size:11px;'>$btn_tit_view</td></tr>");
	}

	echo ("
			</table>
		</td>");



  
  $date++;
  $offset++;

  if($offset == 7){
	  echo ("</tr>");
	  if($date <= $maxdate){
		  echo ("<tr height=$cellh>");
		  $ck_row++;
	  }
	  $offset = 0;
  }
} // end of while

if($offset != 0){
//  SkipOffset((7-$offset),'',mktime(0, 0, 0, $month, $date, $year));
  $no = 7-$offset;
  $sdate = '';
  $edate = mktime(0, 0, 0, $month, $date, $year);
  include $c_path.'/SkipOffset.php';
  echo ("</tr>");
}

?>
<!-- 날짜 테이블 끝 -->


				</td>
			</tr>
		</table>
	<tr>
		<td height=3></td>
	</tr>
</table>

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
.pcfac-cal, .CAL{width:100%; border-collapse:collapse; box-sizing:border-box;}
.yeartit{padding:0 0 20px;}

font {font-size: 12px; color:#505050;}
font.title {font-size: 42px; font-weight: 600; color:#111111; margin:0 12px;}

.CAL td{width:14.28571428571429%;}

.week {color:#666;font-size:16px;height:40px; font-weight:600; border-top:1px solid #fff; border-right:2px solid #fff; border-bottom:2px solid #01010d;}
.week:nth-child(1) {color:#f30;}
.week:nth-child(7) {color:#2162af;}

.datett{height:170px;}


.sholy{font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:link{font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:hover{ font-size:16px; color:#F47C46;text-decoration: none;font-weight:bold;}
.sholy:visited{font-size:16px; color:#F47C46;text-decoration: none;}
.sholy:active{font-size:16px; color:#F47C46;text-decoration: none;}

.ssat{font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:link{font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:hover{font-size:16px; color:#1464B0;text-decoration: none;font-weight:bold;}
.ssat:visited{font-size:16px; color:#1464B0;text-decoration: none;}
.ssat:active{font-size:16px; color:#1464B0;text-decoration: none;}

.snum{font-size:16px;color:#505050;text-decoration: none;}
.snum:link{font-size:16px;color:#505050;text-decoration: none;}
.snum:hover{font-size:16px;color:#505050;text-decoration: none;font-weight:bold;}
.snum:visited{font-size:16px;color:#505050;text-decoration: none;}
.snum:active{font-size:16px;color:#505050;text-decoration: none;}

.snum2 {font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:link{font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:hover{font-size:16px; color:#bbbbbb;text-decoration: none;font-weight:bold;}
.snum2:visited{font-size:16px; color:#bbbbbb;text-decoration: none;}
.snum2:active{font-size:16px; color:#bbbbbb;text-decoration: none;}

.sover{font-size:16px; color:#0000ff;text-decoration: none;font-weight:bold;}

.scBox{
	word-break:break-all;
	line-height:1.5;
	font-size:15px;
	width:100%;
	padding:3px;
	border:1px solid transparent;
	word-break:keep-all;
}
.scBoxTitle{display: -webkit-box; display: -ms-flexbox; display: box; margin-top:1px; max-height:80px; overflow:hidden; vertical-align:top; text-overflow: ellipsis; word-break:break-all; -webkit-box-orient:vertical; -webkit-line-clamp:2;}

.scBox:hover{
	/*border:1px solid #1464B0;*/
	border:1px solid #e1e1e1;
	/*color:#1464B0;*/ 
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

/* 모바일 */
@media screen and (max-width:768px) {
	.cal-arrow1 img, .cal-arrow2 img, .cal-arrow3 img, .cal-arrow4 img{width:50%;}
	font.title {font-size: 20px;}

	.week {width:14.28571428571429%; font-size:13px;}	
	.week:nth-child(1) {color:#f30;}
	.week:nth-child(7) {color:#2162af;}

	.datett{height:100px;}

	.sholy{font-size:13px;}
	.sholy:link{font-size:13px;}
	.sholy:hover{ font-size:13px;}
	.sholy:visited{font-size:13px;}
	.sholy:active{font-size:13px;}

	.ssat{font-size:13px;}
	.ssat:link{font-size:13px;}
	.ssat:hover{font-size:13px;}
	.ssat:visited{font-size:13px;}
	.ssat:active{font-size:13px;}

	.snum{font-size:13px;}
	.snum:link{font-size:13px;}
	.snum:hover{font-size:13px;}
	.snum:visited{font-size:13px;}
	.snum:active{font-size:13px;}

	.snum2 {font-size:13px;}
	.snum2:link{font-size:13px;}
	.snum2:hover{font-size:13px;}
	.snum2:visited{font-size:13px;}
	.snum2:active{font-size:13px;}

	.scBox{word-break:break-all; font-size:13px;}
	.scBoxTitle{
		display: -webkit-box;
		display: -ms-flexbox;
		display: box;
		margin-top:1px;
		max-height:80px;
		overflow:hidden;
		vertical-align:top;
		text-overflow: ellipsis;
		word-break:break-all;
		-webkit-box-orient:vertical;
		-webkit-line-clamp:2;
	}

	.ico_01, .ico_04, .ico_06,  .ico_08{font-size:13px;}
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

<table cellSpacing='0' cellPadding='0' width='<?=$tablew?>' border='0' class="pcfac-cal">
	<tr>
		<td align='center' class="yeartit">
			<table cellSpacing='0' cellPadding='0' border='0'>
				<tr>
					<td class="cal-arrow1">
						<a href="javascript:setCalendar('<?=$year-1?>','<?=$month?>');" onfocus='this.blur()'>
							<img src='/images/arr-r02.png' border='0' onfocus='this.blur();' align='absmiddle' style='margin:0 4px;' alt="전년도이동">
						</a>
					</td>
					<td class="cal-arrow2">
						<a href="javascript:setCalendar('<?=$prevyear?>','<?=$prevmonth?>');" onfocus='this.blur()'>
							<img src='/images/arr-r01.png' border='0' onfocus='this.blur();' align='absmiddle' style='margin:0 4px;' alt="전달이동">
						</a>
					</td>
					<!--년 월-->
					<td style='padding:0 30 0 30;' align='center'>
						<font class='title'><?=$year?>. <?=sprintf('%02d',$month)?>.</font>
					</td>
					<!--//년 월-->
					<td class="cal-arrow3">
						<a href="javascript:setCalendar('<?=$nextyear?>','<?=$nextmonth?>');" onfocus='this.blur()'>
							<img src='/images/arr-l01.png' border='0' onfocus='this.blur();' align='absmiddle' style=' margin:0 4px;' alt="다음달이동">
						</a>
					</td>
					<td class="cal-arrow4">
						<a href="javascript:setCalendar('<?=$year+1?>','<?=$month?>');" onfocus='this.blur()'>
							<img src='/images/arr-l02.png' border='0' onfocus='this.blur();' align='absmiddle' style=' margin:0 4px;' alt="다음년도이동">
						</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td height='5'></td>
	</tr>
	<tr>
		<td align='center'>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" bordercolor="e1e1e1" frame="hsides" class='CAL'>
				<tr align='center'>
					<td class='week'>Sun</td>
					<td class='week'>Mon</td>
					<td class='week'>Tue</td>
					<td class='week'>Wed</td>
					<td class='week'>Thu</td>
					<td class='week'>Fri</td>
					<td class='week'>Sat</td>
				</tr>

				<tr >


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
								$tdgcolor = "bgcolor='#f5f5f5'";

							}else{
								$tdgcolor = '';
							}
						?>



						<td <?=$tdgcolor?> valign='top' class="datett">
							<table cellpadding='0' cellspacing='0' border='0' width='100%'>
								<tr>
									<td style=''>
										<?
											if($write_chk == 'ok'){
											?>
											<a href="javascript:reg_register('<?=$year?>','<?=$month?>','<?=$date?>');" class=<?=$style?> <?=$date_title?>><?=$date2?></a>
											<?
											}else{
											?>
											<span class=<?=$style?> <?=$date_title?>><?=$date2?></span>
											<?
											}
										?>
									</td>
								</tr>


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
											if($sData06)	echo ("");
										echo ("</td></tr>");
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

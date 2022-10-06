<?
	include "../module/login/head.php";
	include "../module/class/class.DbCon.php";
	include "../module/class/class.Util.php";
	include "../module/class/class.Msg.php";

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


	//제이쿼리 달력
	$sRange = date('Y') - 2016;
	$eRange = '1';
	include '../module/Calendar.php';


	if(!$GBL_USERID){
		Msg::goMsg('접근오류','/');
		exit;
	}

	if($payDate){
		$f_payDate01 = $payDate;
		$f_payDate02 = $payDate;
	}


	if(!$f_payDate01)	$f_payDate01 = date('Y-m-d');
	if(!$f_payDate02)	$f_payDate02 = date('Y-m-d');

	//쿼리조건(proccode=000050 은 현금영수증)
	$query_ment = " where proccode='000010'";

	//검색기간
	$f_sArr = explode('-',$f_payDate01);
	$start_date = mktime(0,0,0,$f_sArr[1],$f_sArr[2],$f_sArr[0]);
	$f_eArr = explode('-',$f_payDate02);
	$end_date = mktime(23,59,59,$f_eArr[1],$f_eArr[2],$f_eArr[0]);


	//결제일 또는 취소일 기준검색
	$query_ment .= " and ((payTime>='$start_date' and payTime<='$end_date') or (reTime>='$start_date' and reTime<='$end_date'))";


	//카드번호
	if($f_cdno)		$query_ment .= " and cdno like '%$f_cdno%'";

	//승인번호
	if($f_authno)	$query_ment .= " and (authno like '%$f_authno%' or cancel_authno like '%$f_authno%')";

	//결제일 또는 취소일 기준검색
	$query_ment .= " and ((payTime>='$start_date' and payTime<='$end_date') or (reTime>='$start_date' and reTime<='$end_date'))";


	//카드번호
	if($f_cdno)		$query_ment .= " and cdno like '%$f_cdno%'";

	//승인번호
	if($f_authno)	$query_ment .= " and (authno like '%$f_authno%' or cancel_authno like '%$f_authno%')";

	$query = "select * from kcp_pos $query_ment order by payTime desc";
	$result = mysql_query($query) or die("연결실패");
	$num = mysql_num_rows($result);
?>

<link type='text/css' rel='stylesheet' href='/css/admin.css'>

<body onload="document.form1.f_name.focus();">


<script type='text/javascript' language='JavaScript'>
function TabCheck(c){
	chkstatus = $('#'+c).is(":checked");

	if(chkstatus)	$('#'+c).prop('checked', false);
	else				$('#'+c).prop('checked', true);

	$('#'+c).click();
}

function PosCheck(chk,uid){
	if(chk == false)		uid = '';

	parent.posInfo(uid);

	window.parent.$('.multiBox_close').click();
}

function formatDate(date) {

    var mymonth = date.getMonth() + 1;

    var myweekday = date.getDate();

	if(mymonth < 10)			mymonth = '0'+mymonth;
	if(myweekday < 10)		myweekday = '0'+myweekday;

    return (date.getFullYear() + "-" + mymonth + "-" + myweekday);
}

//어제
function SetYesterday() {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);

	setdate = formatDate(mydate);

	$('#fpicker1').val(setdate);
	$('#fpicker2').val(setdate);
}

//금일
function SetToday() {
    var mydate = new Date();

    mydate.setDate(mydate.getDate() - 1);

	setdate = formatDate(new Date());

	$('#fpicker1').val(setdate);
	$('#fpicker2').val(setdate);
}

//이번주
function SetWeek() {
    var now = new Date();

    var nowDayOfWeek = now.getDay();

    var nowDay = now.getDate();

    var nowMonth = now.getMonth();

    var nowYear = now.getFullYear();

    nowYear += (nowYear < 2000) ? 1900 : 0;

    var weekStartDate = new Date(nowYear, nowMonth, nowDay - nowDayOfWeek);

    var weekEndDate = new Date(nowYear, nowMonth, nowDay + (6 - nowDayOfWeek));	


	setdate = formatDate(weekStartDate);
	$('#fpicker1').val(setdate);

	setdate = formatDate(weekEndDate);
	$('#fpicker2').val(setdate);
}

// 이번달
function SetCurrentMonthDays() {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth());    

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth() + 1, "");


	setdate = formatDate(d22);
	$('#fpicker1').val(setdate);

	setdate = formatDate(d33);
	$('#fpicker2').val(setdate);   
}

// 지난달
function SetPrevMonthDays() {
    var d2, d22;
    d2 = new Date();
    d22 = new Date(d2.getFullYear(), d2.getMonth() -1);

    var d3, d33;
    d3 = new Date();
    d33 = new Date(d3.getFullYear(), d3.getMonth(), "");


	setdate = formatDate(d22);
	$('#fpicker1').val(setdate);

	setdate = formatDate(d33);
	$('#fpicker2').val(setdate);   

}
</script>



<form name='form1' method='post' action=''>
<input type='hidden' name='type' value=''>
<input type='hidden' name='posID' value='<?=$posID?>'>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:15px 0 0 0;'>
		<?
			include 'pos_search.php';
		?>
		</td>
	</tr>

	<tr>
		<td>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable fix'>
				<thead>
					<tr>
						<th width='35'>-</th>
						<th>승인번호</th>
						<th>카드번호</th>
						<th>거래금액</th>
						<th>승인일자</th>
						<th>카드사</th>
						<th>KCP 거래번호</th>
						<th>취소금액</th>
						<th>취소일자</th>
					</tr>
				</thead>

	<?
		if($num){
			$listChk = false;
			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);
				$uid = $row['uid'];
				$mtrsno = $row['mtrsno'];
				$cdno = $row['cdno'];
				$amt1 = $row['amt1'];
				$authdate = $row['authdate'];
				$authtime = $row['authtime'];
				$hid = $row['hid'];
				$authno = $row['authno'];

				$cancel_amt1 = $row['cancel_amt1'];
				$cancel_authdate = $row['cancel_authdate'];
				$cancel_authno = $row['cancel_authno'];
				$reTime = $row['reTime'];

				$amt1Txt = number_format($amt1);
				$authdateTxt = substr($authdate,0,4).'-'.substr($authdate,4,2).'-'.substr($authdate,6,2).'<br>';
				$authdateTxt .= substr($authtime,0,2).':'.substr($authtime,2,2).':'.substr($authtime,4,2);
				$hidTxt = $cardArr[$hid];

				//취소관련
				if($cancel_amt1)	$cancel_amt1Txt = number_format($cancel_amt1);
				else					$cancel_amt1Txt = '';

				if($cancel_authdate)	$cancel_authdateTxt = substr($cancel_authdate,0,4).'-'.substr($cancel_authdate,4,2).'-'.substr($cancel_authdate,6,2);
				else						$cancel_authdateTxt = '';



				if($cancel_authno){
					//취소일자가 검색기간내 포함되는 경우에만 표시
					if($reTime >= $start_date && $reTime <= $end_date){
						$cancel_amt1Txt = '-'.number_format($cancel_amt1);

					}else{
						$cancel_amt1 = 0;
						$cancel_amt1Txt = '';
					}


				}else{
					$cancel_amt1 = 0;
					$cancel_amt1Txt = '';
				}

				if($posID == $uid){
					$chk = 'checked';
					$bgc = "bgcolor='#dcdcdc'";
					$bgover = '';
				}else{
					$chk = '';
					$bgc = '';
					$bgover = "onmouseover=\"this.style.backgroundColor='#F8F8F8'\" onmouseout=\"this.style.backgroundColor='#ffffff'\"";
				}
	?>

					<tr align='center' height='30' <?=$bgc?> <?=$bgover?> id='f_<?=$uid?>'> 
						<td><input name='chk[]' id='c<?=$uid?>' type='checkbox' value='<?=$uid?>' <?=$chk?> onclick="PosCheck(this.checked,this.value);"></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$authno?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$cdno?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$amt1Txt?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$authdateTxt?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$hidTxt?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$mtrsno?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$cancel_amt1Txt?></td>
						<td onclick="TabCheck('c<?=$uid?>');" style='cursor:pointer;'><?=$cancel_authdateTxt?></td>
					</tr>

	<?
			}
		}else{
			echo ("<tr><td align='center' height='410' colspan='9'>검색 결과가 없습니다.</td></tr>");
		}
	?>

			</table>

		</td>
	</tr>
</table>

</form>


<iframe name='ifra_clist' src='about:blank' width='0' height='0' frameborder='0' scrolling='no'></iframe>

<?
	if($posID){
?>
<script>
$(document).ready(function () {
	fID = 'f_<?=$posID?>';
	$("#"+fID).attr("tabindex", -1).focus();
	
});
</script>
<?
	}


	include '../module/TableFix.php';
?>
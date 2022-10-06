<script language='javascript'>
function go_search(){
	form = document.frm01;

	f_payDate01 = form.f_payDate01.value;
	f_payDate02 = form.f_payDate02.value;

	input1 = f_payDate01.replace(/-/g,'');
	input2 = f_payDate02.replace(/-/g,'');
	date1 = new Date(input1.substr(0,4),input1.substr(4,2),input1.substr(6,2)); 
	date2 = new Date(input2.substr(0,4),input2.substr(4,2),input2.substr(6,2)); 
	interval =  date2 - date1; 
	day = 1000*60*60*24; 
	month = day*30; 
	year = month*12; 

	diffDay = parseInt(interval/day); 
	diffMonth = parseInt(interval/month); 
	diffYear = parseInt(interval/year);

	if(diffDay > 31 || diffDay < 0){
		GblMsgBox('검색기간은 최대 1개월입니다.\n다시 선택하여 주십시오.','');
		return;

	}else{
		form.type.value = '';
		form.record_start.value = '';
		form.action = '<?=$PHP_SELF?>';
		form.submit();
	}
}

function reset_search(){
	form = document.frm01;

	form.f_payDate01.value = "<?=date('Y-m-d')?>";
	form.f_payDate02.value = "<?=date('Y-m-d')?>";
	form.f_cdno.value = '';
	form.f_authno.value = '';

	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
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




<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>검색기간</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='f_payDate01' id='fpicker1' value='<?=$f_payDate01?>' readonly> ~ 
									<input type='text' name='f_payDate02' id='fpicker2' value='<?=$f_payDate02?>' readonly>
								</td>
								<td style='padding:0 0 0 20px;'>
									<a href="javascript:SetYesterday();" class="small cbtn black">어제</a>
									<a href="javascript:SetToday();" class="small cbtn black">금일</a>
									<a href="javascript:SetWeek();" class="small cbtn black">이번주</a>
									<a href="javascript:SetPrevMonthDays();" class="small cbtn black">지난달</a>
									<a href="javascript:SetCurrentMonthDays();" class="small cbtn black">이번달</a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<th width='17%'>카드번호</th>
					<td width='33%'><input name="f_cdno" type="text" style='width:100%;' value='<?=$f_cdno?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>승인번호</th>
					<td width='33%'><input name="f_authno" type="text" style='width:100%;' value='<?=$f_authno?>' onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>
			</table>
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'>
			<a href='javascript:go_search();' class='small cbtn blue'>검색</a>
			<a href='javascript:reset_search();' class='small cbtn black'>초기화</a>
		</td>
	</tr>						
</table>

<br><br>
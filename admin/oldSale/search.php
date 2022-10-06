<script language='javascript'>
function programChk(){
	cade01 = $('#f_cade01').find('option:selected').val();

	$.post('json.php',{'cade01':cade01}, function(c1){
		//강습반명 selectbox 초기화
		$('#f_title').empty();
		$('#f_title').append("<option value=''>:: 전체 ::</option>");

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//강습반명 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#f_title').append(option);
		}
	});
}

function go_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm01;

	form.f_cade01.selectedIndex = 0;
	form.f_title.selectedIndex = 0;
	form.f_userNum.value = '';
	form.f_name.value = '';
	form.f_mobile.value = '';
	form.f_pDate01.value = "2019-12-01";
	form.f_pDate02.value = "2019-12-31";

	form.type.value = '';
	form.record_start.value = '';
	form.target = '';
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

<?
	$cArr01 = Array('어학','음악','국악','무용','역학','미술');
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
				<tr>
					<th>강습반명</th>
					<td colspan='3'>
						<select name='f_cade01' id='f_cade01' onchange='programChk();' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 전체 ::</option>
						<?
							for($i=0; $i<count($cArr01); $i++){
								$cTxt01 = $cArr01[$i];

								if($f_cade01 == $cTxt01)	$chk = 'selected';
								else								$chk = '';

								echo ("<option value='$cTxt01' $chk>$cTxt01</option>");
							}
						?>
						</select>

						<select name='f_title' id='f_title' style='border:1px solid #ccc;height:30px;'>
							<option value=''>:: 전체 ::</option>
						<?
							if($f_cade01){
								$fsql = "select * from zz_program where cade01='$f_cade01' order by title";
								$fresult = mysql_query($fsql);
								$fnum = mysql_num_rows($fresult);

								for($i=0; $i<$fnum; $i++){
									$frow = mysql_fetch_array($fresult);
									$ftitle = $frow['title'];

									if($f_title == $ftitle)	$chk = 'selected';
									else						$chk = '';

									echo ("<option value='$ftitle' $chk>$ftitle</option>");
								}
							}
						?>
						</select>
					</td>
				</tr>

				<tr>
					<th width='17%'>회원번호</th>
					<td width='33%'><input name="f_userNum" type="text" style='width:150px;' value="<?=$f_userNum?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
					<th width='17%'>회원자명</th>
					<td width='33%'><input name="f_name" type="text" style='width:150px;' value="<?=$f_name?>" onkeypress="if(event.keyCode==13){go_search();}"></td>
				</tr>

				<tr>
					<th>연락처</th>
				<td colspan='3'><input name="f_mobile" id="f_mobile" style="width:150px;" type="text" value="<?=$f_mobile?>" onkeypress="if(event.keyCode==13){go_search();}"></td>

				</tr>
				<tr>
					<th>매출기간</th>
					<td colspan='3'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td>
									<input type='text' name='f_pDate01' id='fpicker1' value='<?=$f_pDate01?>' readonly> ~ 
									<input type='text' name='f_pDate02' id='fpicker2' value='<?=$f_pDate02?>' readonly>
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
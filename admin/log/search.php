<script language="JavaScript">
function go_search(){
	form = document.frm_list;

	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reset_search(){
	form = document.frm_list;

	form.f_sy.value = '';
	form.f_sm.value = '';
	form.f_sd.value = '';
	form.f_ey.value = '';
	form.f_em.value = '';
	form.f_ed.value = '';

	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table width="100%" border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse;" bordercolor="cccccc"  frame="hsides" class='s'>
				<tr> 
					<td width='17%' class='tab_tit'>접속일</td>
					<td width='83%' class='tab'>
<?
$today = mktime();

if(!$f_ey)	$f_ey = date('Y',$today);
if(!$f_em)	$f_em = date('m',$today);
if(!$f_ed)	$f_ed = date('d',$today);

?>
<script language='javascript'>
var loadDt = new Date();

function set_date(mod){

	form = document.frm_list;

	Tdt = new Date(Date.parse(loadDt)); //당일
	TSt = timeSt(Tdt);
	TCt = TSt.split('-');

	form.f_ey.value = TCt[0];
	form.f_em.value = TCt[1];
	form.f_ed.value = TCt[2];

	

	if(mod == 5){	//전체
		form.f_sy.value = '';
		form.f_sm.value = '';
		form.f_sd.value = '';

	}else{

		if(mod == 1)	dt = new Date(Date.parse(loadDt) - 1 * 1000 * 60 * 60 * 24); //어제
		else if(mod == 2)	dt = new Date(Date.parse(loadDt)); //당일
		else if(mod == 3)	dt = new Date(Date.parse(loadDt) - 7 * 1000 * 60 * 60 * 24); //일주일
		else if(mod == 4)	dt = new Date(Date.parse(loadDt) - 30 * 1000 * 60 * 60 * 24); //한달

		St = timeSt(dt);
		Ct = St.split('-');

		form.f_sy.value = Ct[0];
		form.f_sm.value = Ct[1];
		form.f_sd.value = Ct[2];

		if(mod == 1){
			form.f_ey.value = Ct[0];
			form.f_em.value = Ct[1];
			form.f_ed.value = Ct[2];
		}

	}



}

function timeSt(dt){

	var d = new Date(dt);
	var yyyy = d.getFullYear();
	var MM = d.getMonth()+1;
	var dd = d.getDate();


	return (yyyy + '-' + MM + '-' + dd);

}

</script>

											<!-- 시작년월일 -->

						<select name="f_sy">
							<option value=''>==</option>
						<?
							$f_year = date('Y') + 1;
							for($i=2010; $i<$f_year; $i++){
								if($f_sy == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>년

						<select name="f_sm">
							<option value=''>==</option>
						<?
							for($i=1; $i<13; $i++){
								if($f_sm == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>월

						<select name="f_sd">
							<option value=''>==</option>
						<?
							for($i=1; $i<31; $i++){
								if($f_sd == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>일~ 

					<!-- /시작년월일 -->




					<!-- 종료년월일 -->

						<select name="f_ey">
						<?
							$f_year = date('Y') + 1;
							for($i=2010; $i<$f_year; $i++){
								if($f_ey == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>년

						<select name="f_em">
						<?
							for($i=1; $i<13; $i++){
								if($f_em == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>월

						<select name="f_ed">
						<?
							for($i=1; $i<31; $i++){
								if($f_ed == $i)	$chk = 'selected';
								else	$chk = '';
						?>
							<option value='<?=$i?>' <?=$chk?>><?=$i?></option>
						<?
							}
						?>
						</select>일

					<!-- 종료년월일 -->

						<a href="javascript:set_date(1);"><img src='/images/common/date_01.gif' align='absmiddle'></a>
						<a href="javascript:set_date(2);"><img src='/images/common/date_02.gif' align='absmiddle'></a>
						<a href="javascript:set_date(3);"><img src='/images/common/date_03.gif' align='absmiddle'></a>
						<a href="javascript:set_date(4);"><img src='/images/common/date_04.gif' align='absmiddle'></a>
						<a href="javascript:set_date(5);"><img src='/images/common/date_05.gif' align='absmiddle'></a>
					</td>
				</tr>

			</table>
		<!-- /검색부분 -->
		</td>
	</tr>						
	<tr>
		<td height="35" align='center'><a href='javascript:go_search();'><img src="/images/common/search.gif" alt="검색"></a> <a href='javascript:reset_search();'><img src="/images/common/reset.gif" alt="초기화"></a></td>
	</tr>						
</table>
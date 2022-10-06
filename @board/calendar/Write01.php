<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$sData04 = $row["sData04"];
		$sData05 = $row["sData05"];
		$sData06 = $row["sData06"];
		$sData07 = $row["sData07"];
		$sData08 = $row["sData08"];
	}else{
		$data04 = '공연';
	}

	if(!$name){
		if($GBL_COMPANY)	 $name = $GBL_COMPANY;
		else	$name = $GBL_NAME;
	}

	if($year)	 $data01 = $year;
	if($month)	 $data02 = $month;
	if($day)	 $data03 = $day;

	if($data01 && $data02 && $data03){
		$yoil = date('w',strtotime($data01.'-'.$data02.'-'.$data03));

		if($yoil == 0)	$yoiltxt = '(일요일)';
		elseif($yoil == 1)	$yoiltxt = '(월요일)';
		elseif($yoil == 2)	$yoiltxt = '(화요일)';
		elseif($yoil == 3)	$yoiltxt = '(수요일)';
		elseif($yoil == 4)	$yoiltxt = '(목요일)';
		elseif($yoil == 5)	$yoiltxt = '(금요일)';
		elseif($yoil == 6)	$yoiltxt = '(토요일)';
	}



?>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);
	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}
}

function art_show(){
	atxt = $("#data05 option:selected").text();
	$("#title").val(atxt);
}
</script>



<form name='FRM' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>

<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$userfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$userfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$userfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$userfile05?>'>

<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>

<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->

<input type='hidden' name='name' value='<?=$name?>'>
<input type='hidden' name='passwd' value='1234'>
<input type='hidden' name='pwd_chk' value=''>

<input type='hidden' name='data01' value='<?=$data01?>'>
<input type='hidden' name='data02' value='<?=sprintf('%02d',$data02)?>'>
<input type='hidden' name='data03' value='<?=$data03?>'>

<input type='hidden' name='board_list_mod' value='schedule'>




<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th><?=$ico01?> 날 짜</th>
					<td colspan='3'><?=$data01?>년 <?=$data02?>월 <?=$data03?>일 <?=$yoiltxt?></td>
				</tr>

				<tr>
					<th><?=$ico01?> 구 분</th>
					<td colspan='3'>
						<li style='float:left;'><input type='radio' name='data04' value='공연' <?if($data04 == '공연'){echo 'checked';}?>> <span class='ico01'>공연</span></li>
						<li style='float:left;margin-left:10px;'><input type='radio' name='data04' value='전시' <?if($data04 == '전시'){echo 'checked';}?>> <span class='ico04'>전시</span></li>
						<li style='float:left;margin-left:10px;'><input type='radio' name='data04' value='예술교육' <?if($data04 == '예술교육'){echo 'checked';}?>> <span class='ico08'>예술교육</span></li>
						<li style='float:left;margin-left:10px;'><input type='radio' name='data04' value='축제' <?if($data04 == '축제'){echo 'checked';}?>> <span class='ico06'>축제</span></li>
					</td>
				</tr>

				<tr> 
					<th><?=$ico02?> 공연정보</th>
					<td colspan='3'>
					<?
						$asql = "select * from tb_board_list where table_id='table_1512610572' order by uid desc";
						$aresult = mysql_query($asql);
						$anum = mysql_num_rows($aresult);
					?>
						<select name='data05' id='data05' onchange='art_show();'>
							<option value=''>:: 공연정보선택 ::</option>
					<?
						for($i=0; $i<$anum; $i++){
							$arow = mysql_fetch_array($aresult);
							$auid = $arow['uid'];
							$atitle = $arow['title'];

							if($data05 == $auid)	$chk = 'selected';
							else						$chk = '';

							echo ("<option value='$auid' $chk>$atitle</option>");
						}
					?>
						</select>
					</td>
				</tr>

				<tr> 
					<th><?=$ico01?> 제 목</th>
					<td colspan='3'><input name="title" id="title" type="text" style='width:100%;' value='<?=$title?>'></td>
				</tr>

				<tr> 
					<th width='17%'><?=$ico02?> 일 시</th>
					<td width='33%'><input type="text" name="sData01" value="<?=$sData01?>" style='width:70%;'></td>
					<th width='17%'><?=$ico02?> 장 소</th>
					<td width='33%'><input type="text" name="sData02" value="<?=$sData02?>" style='width:70%;'></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 주최/주관</th>
					<td><input type="text" name="sData03" value="<?=$sData03?>" style='width:70%;'></td>
					<th><?=$ico02?> 티 켓</th>
					<td><input type="text" name="sData04" value="<?=$sData04?>" style='width:70%;'></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 관 람</th>
					<td><input type="text" name="sData05" value="<?=$sData05?>" style='width:70%;'></td>
					<th><?=$ico02?> 소요시간</th>
					<td><input type="text" name="sData06" value="<?=$sData06?>" style='width:70%;'></td>
				</tr>

				<tr> 
					<th><?=$ico02?> 장 르</th>
					<td><input type="text" name="sData07" value="<?=$sData07?>" style='width:70%;'></td>
					<th><?=$ico02?> 문 의</th>
					<td><input type="text" name="sData08" value="<?=$sData08?>" style='width:70%;'></td>
				</tr>
			</table>

		</td>
	</tr>

	<tr>
		<td style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src='<?=$BTN_register?>'></a>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_cancel?>'></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src='<?=$BTN_modify01?>'></a>&nbsp;
			<a href="javascript:reg_del();"><img src='<?=$BTN_del01?>'></a>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_list?>'></a>
		</td>
	</tr>
<?
}
?>
			
</table>


</form>



<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "/smarteditor/SmartEditor2Skin.html",

	/* 페이지 벗어나는 경고창 없애기 */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
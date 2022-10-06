<?
if($coment_chk){

	//한줄의견 글쓰기 권한설정
	include $boardRoot.'chk_coment.php';
?>


<script language='javascript'>

function chk_ment(){
	form = document.FRM;

	if(isFrmEmpty(form.co_name,"이름을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.co_pwd,"비밀번호를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.coment,"내용을 입력해 주십시오"))	return;
	form.type.value = 'write';
	form.action = '<?=$boardRoot?>coment_proc.php';
	form.submit();
}

function chk_del(pid){
	form = document.FRM;

	if(confirm('정말 삭제하시겠습니까?')){
		form.type.value = 'del';
		form.pid.value = pid;
		form.action = '<?=$boardRoot?>coment_proc.php';
		form.submit();
	}
}

function chk_pwd_del(pid){
	form = document.FRM;

	if(isFrmEmpty(form['co_pwd_chk_'+pid],"비밀번호를 입력해 주십시오"))	return;
	form.type.value = 'pwd_del';
	form.pid.value = pid;
	form.action = '<?=$boardRoot?>coment_proc.php';
	form.submit();

}

function tblData(tot,i,pid){
 
	var tr = document.getElementById("tbl_" + i);
	if(tr.style.display == ''){
		tr.style.display = 'none';

	}else{
		for(k=1; k<=tot; k++){
			var tr = document.getElementById("tbl_" + k);

			if(k==i){
				tr.style.display='';
				form = document.FRM;
				form['co_pwd_chk_'+pid].focus();

			}else{
				tr.style.display='none';

			}

		}
	}



 
}

function isEnter3(pid){
	if(event.keyCode==13){
		chk_pwd_del(pid);
		return;
	}
}

</script>



<input type='hidden' name='pid' value=''><!-- 한줄의견 uid -->
<input type='hidden' name='co_userid' value='<?=$GBL_USERID?>'>



<!-- 한줄의견등록 -->
<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
	<tr>
		<td height='50'></td>
	</tr>
	<tr>
		<td style='padding-left:10px;'><b>한줄의견</b></td>
	</tr>
	<tr>
		<td align='center'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' bgcolor='#ffffff'>
				<tr>
					<td width='14'><img src='<?=$boardRoot?>img/gbox01.gif'></td>
					<td background='<?=$boardRoot?>img/gbox02.gif'></td>
					<td width='14'><img src='<?=$boardRoot?>img/gbox03.gif'></td>
				</tr>
				<tr>
					<td background='<?=$boardRoot?>img/gbox04.gif'></td>
					<td height='100'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
							<tr>
								<td>
									<table cellpadding='0' cellspacing='0' border='0' style='padding-bottom:5px;'>
										<tr>
											<td>이름 <input type='text' name='co_name' style='width:130px;' value='<?=$GBL_NAME?>'></td>
											<td width='10'></td>
											<td>비밀번호 <input type='password' name='co_pwd' style='width:130px;'></td>
										</tr>
									</table>									
								</td>
								<td></td>
								<td></td>
							</tr>							
							<tr>
								<td><textarea name='coment' style='width:100%;height:80px;' <?=$read?>><?=$mmsg?></textarea></td>
								<td width='10'></td>
								<td width='84'><?=$btn_cowrite?></td>
							</tr>
						</table>
					</td>
					<td background='<?=$boardRoot?>img/gbox05.gif'></td>
				</tr>					
				<tr>
					<td width='14'><img src='<?=$boardRoot?>img/gbox06.gif'></td>
					<td background='<?=$boardRoot?>img/gbox07.gif'></td>
					<td width='14'><img src='<?=$boardRoot?>img/gbox08.gif'></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<!-- /한줄의견등록 -->









<!-- 의견리스트 -->
<?

$sql = "select * from tb_board_coment where pid='$uid' order by uid desc";
$result = mysql_query($sql);
$num = mysql_num_rows($result);

if($num){

?>

<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center' style='padding-top:30px;'>
	<tr>
		<td align='center'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='14'><img src='<?=$boardRoot?>img/gbox01.gif'></td>
					<td background='<?=$boardRoot?>img/gbox02.gif'></td>
					<td width='14'><img src='<?=$boardRoot?>img/gbox03.gif'></td>
				</tr>
				<tr>
					<td background='<?=$boardRoot?>img/gbox04.gif'></td>
					<td height='100' valign='top'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>

						<?
							for($i=0; $i<$num; $i++){
								$k = $i + 1;
								$row = mysql_fetch_array($result);
								$co_userid = $row[userid];
								$co_name = $row[name];
								$co_pwd = $row[pwd];
								$coment = $row[coment];
								$pid = $row[uid];


								$reg_date = date('Y-m-d H:i:s',$row[reg_date]);



								//한줄의견 삭제버튼 설정
								if($GBL_MTYPE == 'A'){
									$del_type = "ok";

								}else{
									if($GBL_USERID){
										if($GBL_USERID == $co_userid)	$del_type = "ok";
										else	$del_type = "pwd";

									}else{
										$del_type = "pwd";

									}

								}


								if($del_type == 'ok')	$del_btn = "<a href=javascript:chk_del('$pid')><img src='".$boardRoot."img/del_btn.gif'></a>";
								else	$del_btn = "<a href=javascript:tblData($num,$k,$pid) onfocus='this.blur();'><img src='".$boardRoot."img/del_btn.gif'></a>";



								$tbl_name = 'tbl_'.$k;



						?>
						<!-- 의견내용 -->
							<tr>
								<td height='35' background='<?=$boardRoot?>img/line_bg.gif' style='padding-left:10px;'>
									<table cellpadding='0' cellspacing='0' border='0'>
										<tr>
											<td><span class='note01'><?=$co_name?>&nbsp;&nbsp;(<?=$reg_date?>)</span></td>
											<td width='10'></td>
											<td><?=$del_btn?></td>
											<td style='padding-left:20px;'>
												<table cellpadding='0' cellspacing='0' border='0' id='<?=$tbl_name?>' style="display:'none'">
													<tr>
														<td><b>비밀번호</b></td>
														<td width='5'></td>
														<td><input type='password' name='co_pwd_chk_<?=$pid?>' style='width:130px;' onKeyPress="javascript:isEnter3('<?=$pid?>')"></td>
														<td width='5'></td>
														<td><a href="javascript:chk_pwd_del('<?=$pid?>');"><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a></td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td height='60' style='padding-left:25px;' bgcolor='#ffffff'><span class='note01'><?=$coment?></span></td>
							</tr>
						<!-- /의견내용 -->






							<tr>
								<td height='15' bgcolor='#ffffff'></td>
							</tr>
						<?
							}
						?>

						</table>
					</td>
					<td background='<?=$boardRoot?>img/gbox05.gif'></td>
				</tr>					
				<tr>
					<td width='14'><img src='<?=$boardRoot?>img/gbox06.gif'></td>
					<td background='<?=$boardRoot?>img/gbox07.gif'></td>
					<td width='14'><img src='<?=$boardRoot?>img/gbox08.gif'></td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<?
}
?>
<!-- /의견리스트 -->







<?
}
?>
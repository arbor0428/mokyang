<script language='javascript'>
function setUpDown01(mode){
	var form = document.frm01;
    var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		alert('부서를 선택해 주십시오');
		return;

	}else{

		if(mode=='up'){
			if(intPos!=0 && intLen>=2){
				strValue = code_list[intPos-1].value;
				strText = code_list[intPos-1].text;
				code_list[intPos-1].value = code_list[intPos].value;
				code_list[intPos-1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos-1].selected = true;
			}
		}else{
			if(intPos!=intLen-1 && intLen>=2){
				strValue = code_list[intPos+1].value;
				strText = code_list[intPos+1].text;
				code_list[intPos+1].value = code_list[intPos].value;
				code_list[intPos+1].text = code_list[intPos].text;
				code_list[intPos].value = strValue;
				code_list[intPos].text = strText;
				code_list[intPos+1].selected = true;
			}
		}


	}


}


function saveOrder01(){
	var form = document.frm01;
	var order_list = "";

    code_list = form.code_list01;
	
	for (i=0; i<code_list.length; i++){
		order_list += code_list[i].value+"|+|";
	}	

	form.sort_cade01.value=order_list;

	form.type.value = 'sort';
	form.action = 'cade01_proc.php';
	form.submit();
}

function selChk01(){
	c1 = $('#code_list01').find('option:selected').val();

	form = document.frm01;

	form.e_cade01.value = c1;
	form.o_cade01.value = c1;

	$.post('cade01_set.php',{'c1':c1}, function(info){
		
		info = urldecode(info);
		parData = JSON.parse(info);

		memo = parData[1];
		form.e_memo01.value = memo;
	});
}


function cade01_save(){
	form = document.frm01;
	if(isFrmEmpty(form.w_cade01,"강의실명을 입력해 주십시오"))	return;
	
	form.type.value = 'write';
	form.action = 'cade01_proc.php';
	form.submit();
}



function cade01_modify(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		alert('수정하실 부서를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmpty(form.e_cade01,"부서를 입력해 주십시오"))	return;
	
		form.type.value = 'edit';
		form.action = 'cade01_proc.php';
		form.submit();

	}
}


function cade01_delete(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		alert('삭제하실 부서를 선택해 주십시오');
		return;

	}else{
		strText = code_list[intPos].text;
		if(confirm(strText+'을(를) 삭제하시겠습니까?')){
			form.type.value = 'del';
			form.action = 'cade01_proc.php';
			form.submit();

		}else{
			return;

		}

	}
}
</script>




<input type='hidden' name='o_cade01' value="<?=$cade01?>">
<input type='hidden' name='sort_cade01' value="">

<div class='mCadeTit02' style='margin-bottom:3px;'>강의실 정보</div>
<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr> 
		<th width="17%">등록</th>
		<td width="83%">
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='w_cade01' value="" style='width:200px;' onKeyPress="javascript:isMenuKey()" placeholder='강의실명'></td>
							</tr>
							<tr>
								<td style='padding-top:5px;'><input type='text' name='w_memo01' value="" style='width:200px;' placeholder='비고'></td>
							</tr>
						</table>
					</td>
					<td style='padding-left:5px;'><a href="javascript:cade01_save();"><img src='./img/reg.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<th width="17%">순서변경</th>
		<td width="83%">

			<table cellpadding='0' cellspacing='0' border='0' valign='top'>
				<tr>
					<td bgcolor='#ffffff' class='s' style='padding-left:1px;'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
							<tr>
								<td valign='top'>									


							<?
								$sql = "select * from ks_roomlist order by sort asc";
								$result = mysql_query($sql);
								$num = mysql_num_rows($result);

								if($num<=2) $sel_size=3;
								else $sel_size=$num;

								if($cade01)		$cade01 = eregi_replace("\\\'", "'", $cade01);
							?>

									<select name="code_list01" id="code_list01" size='<?=$sel_size?>' style="width:200px;height:auto !important;" onchange="selChk01();">

							<?

								for($i=0; $i<$num; $i++){
									$row = mysql_fetch_array($result);
									$db_cade01 = $row[cade01];

									if($cade01 == $db_cade01)	$chk = 'selected';
									else	$chk = '';


									echo ("<option value=\"$db_cade01\" style='padding:5px;' $chk>$db_cade01</option>");
								}
							?>

									</select>
								</td>
								<td width=29>
									<table cellpadding=0 cellspacing=0 border=0 width=29>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown01('up')"><img src="./img/up.gif" border=0></a></td>
											<td width=5></td>
										</tr>
										<tr>
											<td height=3 colspan=3></td>
										</tr>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown01('down')"><img src="./img/down.gif" border=0></a></td>
											<td width=5></td>
										</tr>
									</table>
								</td>
								<td width=50><a href="javascript:saveOrder01();"><img src="./img/save.gif" border=0></a></td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

		</td>
	</tr>

	<tr> 
		<th>수정</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><input type='text' name='e_cade01' value="<?=$cade01?>" style='width:200px;color:#52809a;' onKeyPress="javascript:isMenuKey()" class='3inputs'></td>
							</tr>
							<tr>
								<td style='padding-top:5px;'><input type='text' name='e_memo01' value="<?=$memo01?>" style='width:200px;color:#52809a;' onKeyPress="javascript:isMenuKey()" class='3inputs'></td>
							</tr>
						</table>
					</td>
					<td style='padding:0 5px;'><a href='javascript:cade01_modify();'><img src='./img/modify.gif'></a></td>
					<td><a href='javascript:cade01_delete();'><img src='./img/delete.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<iframe src="<?=$gurl?>" name='ifra01' width='0' height='0' frameborder='0' scrolling='no'></iframe>
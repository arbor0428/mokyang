<script language='javascript'>
function setUpDown02(mode){
	var form = document.frm01;
    var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		GblMsgBox('분야#2를 선택해 주십시오');
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


function saveOrder02(){
	var form = document.frm01;
	var order_list = "";

    code_list = form.code_list02;
	
	for (i=0; i<code_list.length; i++){
		order_list += code_list[i].value+"|+|";
	}	

	form.sort_cade02.value=order_list;

	form.type.value = 'sort';
	form.action = 'cade02_proc.php';
	form.submit();
}

function selChk02(){
	c1 = $('#code_list01').find('option:selected').val();
	c2 = $('#code_list02').find('option:selected').val();

	form = document.frm01;

	form.e_cade01.value = c1;
	form.o_cade01.value = c1;

	form.e_cade02.value = c2;
	form.o_cade02.value = c2;
}


function cade02_save(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('분야#1을 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.w_cade02,"분야#2를 입력해 주십시오"))	return;
		
		form.type.value = 'write';
		form.action = 'cade02_proc.php';
		form.submit();

	}
}



function cade02_modify(){
	form = document.frm01;
	var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('수정하실 분야#2를 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.e_cade02,"분야#2를 입력해 주십시오"))	return;

		c2 = $('#code_list02').find('option:selected').val();
		e2 = $('#e_cade02').val();

		if(c2 == e2){
			GblMsgBox('분야#2 내용이 변경되지 않았습니다.');
			return;

		}else{	
			form.type.value = 'edit';
			form.action = 'cade02_proc.php';
			form.submit();
		}
	}
}


function cade02_delete(){
	form = document.frm01;
	var code_list = form.code_list02;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('삭제하실 분야#2를 선택해 주십시오');
		return;

	}else{
		strText = code_list[intPos].text;
		if(confirm(strText+'을(를) 삭제하시겠습니까?')){
			form.type.value = 'del';
			form.action = 'cade02_proc.php';
			form.submit();

		}else{
			return;

		}

	}
}
</script>


<body onfocus='document.frm01.w_cade02'>

<input type='hidden' name='o_cade02' value="<?=$cade02?>">
<input type='hidden' name='sort_cade02' value="">




<div style='margin:30px 0 3px 0; font-size:20px;' class='mCadeTit01'>분야#2</div>


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr> 
		<th width="17%"><span class="smooth dp_ir">등록</span></th>
		<td width="83%">
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='w_cade02' value="" style='width:200px;' onKeyPress="javascript:isMenuKey()" class='inputBox01'></td>
					<td width='5'></td>
					<td><a href="javascript:cade02_save();"><img src='./img/reg.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<th width="17%"><span class="smooth dp_ir">순서변경</span></th>
		<td width="83%">

			<table cellpadding='0' cellspacing='0' border='0' valign='top'>
				<tr>
					<td bgcolor='#ffffff' class='s' style='padding-left:1px;'>
						<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
							<tr>
								<td valign='top'>									


							<?
								if($cade01){
									$sql = "select * from ks_vCade02 where cade01=\"$cade01\" order by sort asc";
									$result = mysql_query($sql);
									$num = mysql_num_rows($result);

								}else{
									$num = 0;

								}

									if($num<=2) $sel_size=4;
									else $sel_size=$num;
							?>

									<select name="code_list02" id="code_list02" size='<?=$sel_size?>' onchange="selChk02();">

							<?

								for($i=0; $i<$num; $i++){
									$row = mysql_fetch_array($result);
									$db_cade02 = $row[cade02];

									if($cade02 == $db_cade02)	$chk = 'selected';
									else	$chk = '';


									echo ("<option value=\"$db_cade02\" style='padding:5px;' $chk>$db_cade02</option>");
								}
							?>

									</select>
								</td>
								<td width=29>
									<table cellpadding=0 cellspacing=0 border=0 width=29>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown02('up')"><img src="./img/up.gif" border=0></a></td>
											<td width=5></td>
										</tr>
										<tr>
											<td height=3 colspan=3></td>
										</tr>
										<tr>
											<td width=5></td>
											<td><a href="javascript:setUpDown02('down')"><img src="./img/down.gif" border=0></a></td>
											<td width=5></td>
										</tr>
									</table>
								</td>
								<td width=50><a href="javascript:saveOrder02();"><img src="./img/save.gif" border=0></a></td>
								<td>&nbsp;</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>

		</td>
	</tr>

	<tr> 
		<th><span class="smooth dp_ir">수정</span></th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='e_cade02' id='e_cade02' value="<?=$cade02?>" style='width:200px;color:#52809a;' onKeyPress="javascript:isMenuKey()" class='inputBox01'></td>
					<td width='5'></td>
					<td><a href='javascript:cade02_modify();'><img src='./img/modify.gif'></a></td>
					<td width='5'></td>
					<td><a href='javascript:cade02_delete();'><img src='./img/delete.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<iframe src="<?=$gurl?>" name='ifra01' width='0' height='0' frameborder='0' scrolling='no'></iframe>
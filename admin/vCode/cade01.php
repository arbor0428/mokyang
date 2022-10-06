<script language='javascript'>
function setUpDown01(mode){
	var form = document.frm01;
    var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;
	var intLen = code_list.length;
	var strValue, strText;

	
	if(intPos == -1){
		GblMsgBox('분야#1을 선택해 주십시오');
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

	form.e_cade02.value = '';
	form.o_cade02.value = '';

	//분야#2
	$.post('cade01_set.php',{'c1':c1}, function(c2){		
		//분야#2 selectbox 초기화
		$('#code_list02').empty();

		c2 = urldecode(c2);
		parData = JSON.parse(c2);

		//분야#2 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"' style='padding:5px !important;'>"+txt+"</option>");
			$('#code_list02').append(option);
		}
	});
}


function cade01_save(){
	form = document.frm01;
	if(isFrmEmptyModal(form.w_cade01,"분야 #1을 입력해 주십시오"))	return;
	
	form.type.value = 'write';
	form.action = 'cade01_proc.php';
	form.submit();
}



function cade01_modify(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('수정하실 분야 #1을 선택해 주십시오');
		return;

	}else{
		if(isFrmEmptyModal(form.e_cade01,"분야 #1을 입력해 주십시오"))	return;

		c1 = $('#code_list01').find('option:selected').val();
		e1 = $('#e_cade01').val();

		if(c1 == e1){
			GblMsgBox('분야#1 내용이 변경되지 않았습니다.');
			return;

		}else{	
			form.type.value = 'edit';
			form.action = 'cade01_proc.php';
			form.submit();
		}

	}
}


function cade01_delete(){
	form = document.frm01;
	var code_list = form.code_list01;
	var intPos = code_list.selectedIndex;

	if(intPos == -1){
		GblMsgBox('삭제하실 분야 #1을 선택해 주십시오');
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


<div style='margin:30px 0 3px 0; font-size:20px;' class='mCadeTit01'>분야 #1</div>


<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr> 
		<th width="17%"><span class="smooth dp_ir">등록</span></th>
		<td width="83%">
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='w_cade01' value="" onKeyPress="javascript:isMenuKey()" class='inputBox01'></td>
					<td width='5'></td>
					<td><a href="javascript:cade01_save();"><img src='./img/reg.gif'></a></td>
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
								$sql = "select * from ks_vCade01 order by sort asc";
								$result = mysql_query($sql);
								$num = mysql_num_rows($result);

								if($num<=2) $sel_size=7;
								else $sel_size=$num;

								if($cade02)		$cade02 = str_replace("\\\'", "'", $cade02);
							?>

									<select name="code_list01" id="code_list01" size='<?=$sel_size?>' onchange="selChk01();">

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
		<th><span class="smooth dp_ir">수정</span></th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><input type='text' name='e_cade01' id='e_cade01' value="<?=$cade01?>" style='width:200px;color:#52809a;' onKeyPress="javascript:isMenuKey()" class='inputBox01'></td>
					<td width='5'></td>
					<td><a href='javascript:cade01_modify();'><img src='./img/modify.gif'></a></td>
					<td width='5'></td>
					<td><a href='javascript:cade01_delete();'><img src='./img/delete.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<iframe src="<?=$gurl?>" name='ifra00' width='0' height='0' frameborder='0' scrolling='no'></iframe>
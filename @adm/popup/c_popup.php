<?php


if(!$type)	$type = 'write';

if($type == 'edit' && $uid){

	//해당팝업의 정보를 가지고온다
	$que = "select * from tb_popup where uid='$uid'";
	$result = mysql_query($que);
	$row = mysql_fetch_array($result);


	$ptype=$row["ptype"];
	$pop_width=$row["pop_width"];
	$pop_height=$row["pop_height"];

	$pop_left=$row["pop_left"];
	$pop_top=$row["pop_top"];
	$pos_mod=$row["pos_mod"];

	$chk_width=$row["chk_width"];
	if($chk_width == "0"){$chk_width_0 = "checked";}
	if($chk_width == "1"){$chk_width_1 = "checked";}
	if($chk_width == "2"){$chk_width_2 = "checked";}
	if($chk_width == "100"){$chk_width_100 = "checked";}

	$title=$row["title"];
	$ment=$row["ment"];
	$pop_day=$row["pop_day"];
	$chk_enable=$row["chk_enable"];
	if($chk_enable == "1"){$chk_enable_ment = "활성화";}
	if($chk_enable == "0"){$chk_enable_ment = "비활성화";}

	$scrolling=$row["scrolling"];

}


if(!$pop_left)	$pop_left = '100';
if(!$pop_top)	$pop_top = '100';

if(!$pop_width)	$pop_width = '300';
if(!$pop_height)	$pop_height = '500';

if(!$pop_day)	$pop_day = '1';

?>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>
<script language="javascript">
function pos_view(id){
	if(id == 'user')	document.getElementById('pos_id').style.display='';
	else	document.getElementById('pos_id').style.display='none';
}

function chk_form(){
	form = document.FORM1;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;

	if(form.pos01.value == 'user'){
		if(isFrmEmpty(form.pop_left,"팝업위치의 x좌표를 입력해 주십시오"))	return;
		if(isFrmEmpty(form.pop_top,"팝업위치의 y좌표를 입력해 주십시오"))	return;
	}

	if(form.chk_width[3].checked){
		if(isFrmEmpty(form.pop_width,"팝업의 넓이를 입력해 주십시오"))	return;
		if(form.pop_width.value < 250){
			alert('팝업의 넓이는 최소 250픽셀 이상이어야 합니다');
			form.pop_width.focus();
			return;
		}

		if(isFrmEmpty(form.pop_height,"팝업의 높이를 입력해 주십시오"))	return;
		if(form.pop_height.value < 250){
			alert('팝업의 높이는 최소 250픽셀 이상이어야 합니다');
			form.pop_height.focus();
			return;
		}
	}

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	if(form.ment.value == ''){
		alert('내용을 입력해 주십시오');
		return;
	}

	if(isFrmEmpty(form.pop_day,"날짜설정을 입력해 주십시오"))	return;

	form.submit();




}

</script>


<!-- 팝업위치 미리보기 -->
<script language='javascript'>

var win;

function pos_play(){

	form = document.FORM1;

	var	chk_size = document.getElementsByName("chk_width");	//팝업크기
	var	chk_pos = form.pos01.value	//팝업위치


	size01 = '';
	size02 = '';
	pos01 = '';
	pos02 = '';


/* 팝업크기 */

	size_len = chk_size.length;

	for(i=0; i<size_len; i++){
		if(chk_size[i].checked)	size = chk_size[i].value;
	}

	if(size == 0){	//대
		size01 = 600;
		size02 = 800;

	}else if(size == 1){	 //중
		size01 = 500;
		size02 = 300;

	}else if(size == 2){	 //소
		size01 = 250;
		size02 = 300;

	}else if(size == 100){	//사용자 지정

		if(form.pop_width.value < 250){
			alert('팝업의 넓이는 최소 250픽셀 이상이어야 합니다');
			form.pop_width.focus();
			return;
		}


		size01 = document.FORM1.pop_width.value;
		size02 = document.FORM1.pop_height.value;

	}

/* 팝업크기 */





/* 팝업위치 */



	if(chk_pos == 'left'){	//왼쪽상단
		pos01 = 10;
		pos02 = 10;

	}else if(chk_pos == 'center'){	//가운데
		pos01 = (screen.width)?(screen.width-size01)/2:100;
		pos02 = (screen.height)?(screen.height-size02)/2:100;

	}else if(chk_pos == 'right'){	//오른쪽상단
		pos01 = screen.width-20-size01;
		pos02 = 10;

	}else if(chk_pos == 'user'){	//사용자 지정
		pos01 = document.FORM1.pop_left.value;
		pos02 = document.FORM1.pop_top.value;
	}



/* 팝업위치 */


	var w = size01;
	var h = size02;
	var left = pos01;
    var top = pos02;

	if(win != null)	win.close();

	win = window.open("position.php","win","width="+w+", height="+h+", left="+left+", top="+top+", scrollbars=no");



}

</script>


<!-- / 팝업위치 미리보기 -->

<form name='FORM1' method='post' action='proc.php' enctype='multipart/form-data'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type="hidden" name="record_start" value="<?=$record_start?>">
<input type="hidden" name="word" value="<?=$word?>">
<input type="hidden" name="field" value="<?=$field?>">

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
	<tr>
		<th width='20%'>유형</th>
		<td width="80%">
			<input type='radio' name='ptype' value='layer' <?if($ptype=='layer' || !$ptype)	echo 'checked';?>>레이어팝업&nbsp;&nbsp;
			<!--<input type='radio' name='ptype' value='winpop' <?if($ptype=='winpop')	echo 'checked';?>>윈도우팝업창-->
		</td>
	</tr>
	<tr style='display:none;'>
		<td colspan='2'><li>윈도우팝업창의 경우 사용자 컴퓨터 환경에 따라 팝업이 차단될 수 있습니다</td>
	</tr>
	<tr> 
		<th>제목</th>
		<td><input name="title" type="text" size="50" value='<?=$title?>'></td>
	</tr>
	<tr> 
		<th>위치</th>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td> 
									<select name="pos01" onclick="pos_view(this.value)">
										<option value='left' <?if($pos_mod=='left') echo 'selected';?>>왼쪽상단</option>
										<option value='center' <?if($pos_mod=='center') echo 'selected';?>>가운데</option>
										<option value='right' <?if($pos_mod=='right') echo 'selected';?>>오른쪽상단</option>
										<option value='user' <?if($pos_mod=='user') echo 'selected';?>>사용자지정</option>
									</select>
								</td>
								<td width='10'></td>
<?
	if($pos_mod == 'user')	$pos_id_dis = '';
	else	$pos_id_dis = 'none';
?>
								<td>
									<div id='pos_id' style="display:<?=$pos_id_dis?>">
									x좌표 : <input type='text' name='pop_left' value='<?=$pop_left?>' style='width:40px;height:17px;IME-MODE:disabled;' onkeypress='onlyNumber();'>
									&nbsp;&nbsp;
									y좌표 : <input type='text' name='pop_top' value='<?=$pop_top?>' style='width:40px;height:17px;IME-MODE:disabled;' onkeypress='onlyNumber();'>
									</div>
								</td>
							</tr>
						</table>
					</td>
					<td width='100' align='right'><a href='javascript:pos_play();'><img src='./img/position.gif'></a></td>
				</tr>
			</table>
		</td>
	</tr>

<?
	if($chk_width == '100')	 $pop_id_dis = '';
	else	$pop_id_dis = 'none';
?>

	<tr> 
		<th>크기</th>
		<td>
			<input type='radio' name='chk_width' value='0' <?if($chk_width=='0') echo 'checked';?>  onClick="document.getElementById('pop_id').style.display='none'; window.document.FORM1.pop_width.value='600'; window.document.FORM1.pop_height.value='800'; parent.calcHeight('ifra_skin');">대(가로:600,세로:800)
			<input type='radio' name='chk_width' value='1' <?if($chk_width=='1') echo 'checked';?>  onClick="document.getElementById('pop_id').style.display='none'; window.document.FORM1.pop_width.value='500'; window.document.FORM1.pop_height.value='300'; parent.calcHeight('ifra_skin');" checked>중(가로:500,세로:300)
			<input type='radio' name='chk_width' value='2' <?if($chk_width=='2') echo 'checked';?>  onClick="document.getElementById('pop_id').style.display='none'; window.document.FORM1.pop_width.value='250'; window.document.FORM1.pop_height.value='300'; parent.calcHeight('ifra_skin');">소(가로:250,세로:300)<br>
			<input type='radio' name='chk_width' value='100' <?if($chk_width=='100') echo 'checked';?>  onClick="document.getElementById('pop_id').style.display=''; parent.calcHeight('ifra_skin');">사용자 지정
			<div id='pop_id' style="display:<?=$pop_id_dis?>">
			- 넓이 : <input type='text' name='pop_width' value='<?=$pop_width?>' size='3' onkeypress='onlyNumber();' style='IME-MODE:disabled;'>PX
			&nbsp;&nbsp;
			높이 : <input type='text' name='pop_height' value='<?=$pop_height?>' size='3' onkeypress='onlyNumber();' style='IME-MODE:disabled;'>PX
			</div>
		</td>
	</tr>
	
	<tr> 
		<th>스크롤바사용</th>
		<td><input type='radio' name='scrolling' value='no' <?if($scrolling=='no' || $scrolling=='') echo 'checked';?>>사용안함 <input type='radio' name='scrolling' value='yes' <?if($scrolling=='yes') echo 'checked';?>>사용함</td>
	</tr>
	
	<tr>
		<td colspan='2'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></td>
	</tr>
	<tr> 
		<th>날짜설정</th>
		<td>해당팝업을<input type='text' name='pop_day' value='<?=$pop_day?>' size='3'>일 동안 띄우지 않습니다.</td>
	</tr>
	<tr> 
		<th>활성화</th>
		<td>
			<select name='chk_enable'>
				<option value='1' <?if($chk_enable=='1') echo 'selected';?>>활성화</option>
				<option value='0' <?if($chk_enable=='0') echo 'selected';?>>비활성화</option>
			</select>
		</td>
	</tr>
	<tr> 
		<td colspan='2'>
		<li>팝업을 등록을 하시더라도 비활성화를 시키시면 팝업이 동작하지 않습니다 
		<li>팝업을 띄우지않고 기존 팝업을 삭제하지않고 다음에 사용하고 싶을 경우에는 비활성화를 선택하시기 바랍니다 
		<li>비활성화 시킨 팝업은 새로 등록을 하지 않더라도 언제든지 활성화를 시키실수가 있습니다.</td>
	</tr>

</table>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td style='padding:20px 0;' align='right'><a href="javascript:chk_form();" class="btn blk">등록</a></td>
	</tr>
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
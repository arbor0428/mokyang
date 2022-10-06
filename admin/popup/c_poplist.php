<?
	$record_count = 30;  //한 페이지에 출력되는 레코드수

	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "";

	if($word)	$query_ment .= "where $field like '%$word%'";

	$sort_ment = "order by uid desc";



	$query = "select * from tb_popup $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_popup $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);

?>

<script language='javascript'>

var win;

function click_del(txt,uid){

	if(confirm(txt+'을(를) 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = 'proc.php';
		form.submit();
	}else{
		return;
	}

	

}


function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 팝업을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 팝업을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = 'proc.php';
		form.submit();

	}

}

function preview(uid,w,h,size01,size02,mod){

	if(mod == 'left'){	//왼쪽상단
		pos01 = 10;
		pos02 = 10;

	}else if(mod == 'center'){	//가운데
		pos01 = (screen.width)?(screen.width-w)/2:100;
		pos02 = (screen.height)?(screen.height-h)/2:100;

	}else if(mod == 'right'){	//오른쪽상단
		pos01 = screen.width-20-w;
		pos02 = 10;

	}else if(mod == 'user'){	//사용자 지정
		pos01 = size01;
		pos02 = size02;
	}

	var left = pos01;
    var top = pos02;

	if(win != null)	win.close();

	win = window.open("preview.php?uid="+uid,"view_win","width="+w+", height="+h+", left="+left+", top="+top+", scrollbars=no");

}

function pop_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = 'up_index.php';
	form.submit();
}
</script>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='/images/common/allselect.gif' align='absmiddle'></a> <a href="javascript:All_del()"><img src='/images/common/alldelete.gif' align='absmiddle'></a></td>
		<td height='50' align='right'>
			<select name="field" class="select1"><option value='title' selected>제목</option></select>
			<input name="word" type="text" size="20" value='<?=$word?>'> <a href='javascript:document.frm01.submit();' class="scbtn">검색</a>
		</td>
	</tr>
	
	<tr>
		<td colspan='2'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='pTable'>
				<tr> 
					<th width="5%"><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></th>
					<th width="5%"><span class="smooth dp_ir">번호</span></th>
					<th width="35%"><span class="smooth dp_ir">제목</span></th>
					<th width="10%"><span class="smooth dp_ir">넓이/높이</span></th>
					<th width="8%"><span class="smooth dp_ir">활성화</span></th>
					<th width="10%"><span class="smooth dp_ir">등록일</span></th>
					<th width="8%"><span class="smooth dp_ir">미리보기</span></th>
					<th width="19%"><span class="smooth dp_ir">편집</span></th>
				</tr>
<?
$nTime = mktime();

if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid=$row["uid"];
		$cade=$row["cade"];
		$title=$row["title"];
		$pop_width=$row["pop_width"];
		$pop_height=$row["pop_height"];
		$real_pop_height=$pop_height+30;
		$pop_left=$row["pop_left"];
		$pop_top=$row["pop_top"];
		$pos_mod=$row["pos_mod"];


		$chk_enable=$row["chk_enable"];
		if($chk_enable == "0")		$chk_enable_ment = "비활성화";
		elseif($chk_enable == "1")	$chk_enable_ment = "활성화";
		elseif($chk_enable == "2"){
			$chk_enable_ment = "활성화";
			$eTime = $row["eTime"];

			if($nTime > $eTime)	$chk_enable_ment = '기간만료';
		}


		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);

?>
				<tr <?if($chk_enable_ment == '활성화'){?>style='background:#f6f6f6;'<?}?>>
					<td align='center'><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td align='center'><?=$i?></td>
					<td align='center'><?=$title?></td>
					<td align='center'><?=$pop_width?> / <?=$pop_height?></td>
					<td align='center'><?=$chk_enable_ment?></td>
					<td align='center'><?=$reg_date?></td>
					<td align='center'><a href="javascript:preview('<?=$uid?>','<?=$pop_width?>','<?=$real_pop_height?>','<?=$pop_left?>','<?=$pop_top?>','<?=$pos_mod?>')"><img src="./img/preview.gif" align='absmiddle'></a></td>
					<td align='center'><a href="javascript:pop_modify('<?=$uid?>');"><img src="/images/common/modify.gif" alt="수정" width="50" height="21"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="/images/common/delete.gif" alt="삭제" width="50" height="21"></a></td>
				</tr>
<?
		$i--;
	}
}else{
?>
				<tr> 
					<td colspan="8" align='center'><span class="smooth dp_ir">등록된 팝업이 없습니다</span></td>
				</tr>
<?
}
?>
			</table>									
		</td>
	</tr>
	<tr> 
		<td style='padding:20px 0;' colspan='2' align='right'><a href='./up_index.php?type=write'><img src='/images/common/register.gif'></a></td>
	</tr>
</table>
						<!--/팝업관리-->

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr>
		<td align='center'>
			<table border="0" align="center" cellpadding="1" cellspacing="0" style='margin-top:15px;'>
				<tr>

<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		echo ("<td>");

		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_group_start');><img src='/images/common/prev2.gif'></a>");
		}else{
			echo("<img src='/images/common/prev2.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo("<a href=javascript:pageing('frm01','$pre_page_start');><img src='/images/common/prev1.gif'></a>");
		}else{
			echo ("<img src='/images/common/prev1.gif'>");
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo("<a onclick=pageing('frm01','$input_start'); style='cursor:hand'>$link</a>&nbsp;&nbsp;");
				} else {
					echo("<b>$link</b>&nbsp;&nbsp;");
				}
			}
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo("<a href=javascript:pageing('frm01','$next_page_start');><img src='/images/common/next1.gif'></a>");
		}else{
			echo ("<img src='/images/common/next1.gif'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:pageing('frm01','$next_group_start');><img src='/images/common/next2.gif'></a>");
		}else{
			echo ("<img src='/images/common/next2.gif'>");
		}

		echo ("</td>");



		  
	}else{
		echo "<td><b>1</b></td>";
	}
}
?>
				</td>
			</tr>
		</table>
	</tr>
</table>


						<!--/버튼-->


</form>
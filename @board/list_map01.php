<?
	if($word == '서울')		$loc_no = '0';
	elseif($word == '인천')	$loc_no = '1';
	elseif($word == '경기')	$loc_no = '2';
	elseif($word == '강원')	$loc_no = '3';
	elseif($word == '충북')	$loc_no = '4';
	elseif($word == '충남')	$loc_no = '5';
	elseif($word == '대전')	$loc_no = '6';
	elseif($word == '경북')	$loc_no = '7';
	elseif($word == '경남')	$loc_no = '8';
	elseif($word == '대구')	$loc_no = '9';
	elseif($word == '울산')	$loc_no = '10';
	elseif($word == '부산')	$loc_no = '11';
	elseif($word == '전북')	$loc_no = '12';
	elseif($word == '전남')	$loc_no = '13';
	elseif($word == '광주')	$loc_no = '14';
	elseif($word == '제주')	$loc_no = '15';
?>

<script language='javascript'>

function click_del(txt,uid){

	if(confirm(txt+' 글을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
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
		alert('삭제하실 글을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 글을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();

	}

}


function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}


function error_msg(mod){
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}


function boardsearch(loc){
	form = document.frm01;
	form.type.value = '';
	form.word.value = loc;
	form.record_start.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
function board_search(){
	form = document.frm01;
	form.type.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
function is_Key(){
	if(event.keyCode==13)	board_search();
}
</script>


<form name='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->

<!-- 검색관련 -->
<input type='hidden' name='field' value='name'>
<input type='hidden' name='field22' value='title'>
<input type='hidden' name='word' value='<?=$word?>'>







<style>
.map_btn{/*min-width:90px;*/width:19%;height:40px;line-height:40px;font-size:17px;text-align:center;float:left;margin-right:3px;background:#ffffff;border:1px solid #d1d1d1;cursor:pointer;box-sizing:border-box;}
.map_btn:hover{background:#212121;color:#ffffff;}
.map_btn_a{background:#212121;color:#ffffff;}
.bbs01{font-size:15px;]
</style>


<table width="100%" border="0" cellspacing="0" cellpadding="0" align='center'>	
	<tr>
		<td width='320' height='400' align='center' valign='top' style=''>
		<div style='width:320px;height:400px;'>
		<?
			include '../board/map.php';
		?>
		</div>
		</td>
		<td style='padding-left:20px;'>
			<div style='width:100%;min-width:430px;height:400px; padding:40px 30px;box-sizing:border-box;background:#f3f3f3;'>
				<div style='font-size:20px;color:#212121;font-weight:bold;margin-bottom:15px;'>지역 검색</div>
				<div style='margin-bottom:3px;' class='clearfix'>
					<div class='map_btn <?if(!$word)echo'map_btn_a';?>' onclick='go_branch("all")'>전체</div>
					<div class='map_btn <?if($word=='서울')echo'map_btn_a';?>' onclick='go_branch("seoul")'>서울</div>
					<div class='map_btn <?if($word=='경기')echo'map_btn_a';?>' onclick='go_branch("gyeonggi")'>경기</div>
					<div class='map_btn <?if($word=='강원')echo'map_btn_a';?>' onclick='go_branch("gangwon")'>강원</div>
					<div class='map_btn <?if($word=='경남')echo'map_btn_a';?>' onclick='go_branch("gyeongnam")'>경남</div>
				</div>
				<div style='margin-bottom:3px;' class='clearfix'>
					<div class='map_btn <?if($word=='경북')echo'map_btn_a';?>' onclick='go_branch("gyeongbuk")'>경북</div>
					<div class='map_btn <?if($word=='광주')echo'map_btn_a';?>' onclick='go_branch("gwangju")'>광주</div>
					<div class='map_btn <?if($word=='대구')echo'map_btn_a';?>' onclick='go_branch("daegu")'>대구</div>
					<div class='map_btn <?if($word=='대전')echo'map_btn_a';?>' onclick='go_branch("daejeon")'>대전</div>
					<div class='map_btn <?if($word=='부산')echo'map_btn_a';?>' onclick='go_branch("busan")'>부산</div>
				</div>
				<div style='margin-bottom:3px;' class='clearfix'>
					<div class='map_btn <?if($word=='세종')echo'map_btn_a';?>' onclick='go_branch("sejong")'>세종</div>
					<div class='map_btn <?if($word=='울산')echo'map_btn_a';?>' onclick='go_branch("ulsan")'>울산</div>
					<div class='map_btn <?if($word=='인천')echo'map_btn_a';?>' onclick='go_branch("incheon")'>인천</div>
					<div class='map_btn <?if($word=='전남')echo'map_btn_a';?>' onclick='go_branch("jeonnam")'>전남</div>
					<div class='map_btn <?if($word=='전북')echo'map_btn_a';?>' onclick='go_branch("jeonbuk")'>전북</div>
				</div>
				<div style='margin-bottom:3px;' class='clearfix'>
					<div class='map_btn <?if($word=='제주')echo'map_btn_a';?>' onclick='go_branch("jeju")'>제주</div>
					<div class='map_btn <?if($word=='충남')echo'map_btn_a';?>' onclick='go_branch("chungnam")'>충남</div>
					<div class='map_btn <?if($word=='충북')echo'map_btn_a';?>' onclick='go_branch("chungbuk")'>충북</div>
				</div>
				
				<div style='font-size:20px;color:#212121;font-weight:bold;margin-bottom:10px;margin-top:40px;'>지점명 검색</div>
				<div style='width:403px;'>
					<input name="word2" type="text" size="20" value='<?=$word2?>' style='display:block;padding-left:5px;float:left;height:40px;line-height:40px;width:350px;border:3px solid #9b9b9b;box-sizing:border-box;' onkeypress='is_Key();'>
					<a href='javascript:board_search();' style='display:block;float:left;width:50px;height:40px;line-height:40px;font-size:14px;text-align:center;background:#9b9b9b;color:#ffffff;margin-left:3px;;'>검색</a>
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td height='30' colspan='2'></td>
	</tr>
	<tr>
		<td valign='top' colspan='2'>

<?
if($GBL_MTYPE == 'A'){
	$cols = '7';
?>
				
			<div><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='select all'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='delete selected'></a></div>
				

		

			<div style='width:100%;height:40px;line-height:34px;border:3px solid #9b9b9b;box-sizing:border-box;margin-bottom:5px;font-size:14px;'>
				<div style='width:5%;float:left;text-align:center;font-weight:600;color:#575757;padding-top:5px;'><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');"></div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>지역</div>
				<div style='width:20%;float:left;text-align:center;font-weight:600;color:#575757;'>제목</div>
				<div style='width:30%;float:left;text-align:center;font-weight:600;color:#575757;'>주소</div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>연락처</div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>홈페이지</div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>편집</div>
			</div>



<?
}else{
	$cols = '6';
?>



			<div style='width:100%;height:40px;line-height:34px;border:3px solid #9b9b9b;box-sizing:border-box;margin-bottom:5px;font-size:14px;'>
				<div style='width:5%;float:left;text-align:center;font-weight:600;color:#575757;'>번호</div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>지역</div>
				<div style='width:20%;float:left;text-align:center;font-weight:600;color:#575757;'>제목</div>
				<div style='width:40%;float:left;text-align:center;font-weight:600;color:#575757;'>주소</div>
				<div style='width:15%;float:left;text-align:center;font-weight:600;color:#575757;'>연락처</div>
				<div style='width:10%;float:left;text-align:center;font-weight:600;color:#575757;'>홈페이지</div>
			</div>

<?
}
?>

		
			<table width="100%" border="0" cellspacing="0" cellpadding="0">		

<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysqli_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$name = $row["name"];
		$hit = $row["hit"];
		$hit = number_format($hit);
		$pwd_chk = $row["pwd_chk"];

		$data01 = $row["data01"];
		$data02 = $row["data02"];//주소
		$data03 = $row["data03"];//홈페이지

		$dataTxt03='';

		if($data03){
			$dataTxt03="<a class='cbtn small blue' href='$data03' target='_blank'>보기</a>";
		}

		$reg_date=$row["reg_date"];
		$reg_date_txt = date("Y.m.d",$reg_date);

		//글제목css
		$title_color = $row["title_color"];
		$title_bold = $row["title_bold"];


		//공지글 배경색상지정
		if($notice_chk)	 $bgcolor=" bgcolor='#efefef'";
		else	$bgcolor='';

		//비밀글설정
		if($pwd_chk){
			$lock_icon=" <img src='".$BTN_lock."'>";

			if($GBL_MTYPE == 'A')	 $str_len = '42';
			else	 $str_len = '52';

			if($secret_title)		$title = '비밀글입니다';

		}else{
			$lock_icon='';

			if($GBL_MTYPE == 'A')	 $str_len = '46';
			else	 $str_len = '56';

		}

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,$str_len,'..');



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';


		if($GBL_MTYPE == 'A'){

?>
				<tr height='45'>
					<td class='bbs01' width='5%' align='center' <?=$bgcolor?>><input name='chk[]' type='checkbox' value='<?=$uid?>'></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><?=$name?></td>
					<td class='bbs01' width='20%' style='padding-left:10px;' <?=$bgcolor?>><?=$lock_icon?> <?=$btn_tit_view?></td>
					<td class='bbs01' width='30%' align='left' <?=$bgcolor?>><?=$data02?></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><?=$data01?></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><?=$dataTxt03?></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><a href="javascript:reg_modify('<?=$uid?>');"><img src="<?=$BTN_modify02?>" alt="Edit"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="<?=$BTN_del02?>" alt="삭제" width="50"></a></td>
				</tr>

<?
		}else{
?>

				<tr height='45'>
					<td class='bbs01' width='5%' align='center' <?=$bgcolor?>><?=$i?></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><?=$name?></td>
					<td class='bbs01' width='20%' style='padding-left:10px;' <?=$bgcolor?>><?=$lock_icon?> <?=$btn_tit_view?></td>
					<td class='bbs01' width='40%' align='left' <?=$bgcolor?>><?=$data02?></td>
					<td class='bbs01' width='15%' align='center' <?=$bgcolor?>><?=$data01?></td>
					<td class='bbs01' width='10%' align='center' <?=$bgcolor?>><?=$dataTxt03?></td>
				</tr>

<?
		}
?>
				<tr> 
					<td bgcolor="e2e2e2"  height="1" colspan="<?=$cols?>"></td>
				</tr>



<?
//답글리스트
include $boardRoot.'reply_list01.php';
?>





<?
		$i--;
		$line_num++;
	}
}else{
?>

				<tr> 
					<td colspan="<?=$cols?>" align='center' height='50'>등록된 게시물이 없습니다</td>
				</tr>

<?
}
?>

				<tr>
					<td colspan="<?=$cols?>" height="1" bgcolor="e2e2e2"></td>
				</tr>


<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>


			</table>									
		</td>
	</tr>

				<tr> 
					<td height="20" colspan="<?=$cols?>" align='right' style="padding:5px 5px 0 0"><?=$btn_write?></td>
				</tr>



</table>





</form>
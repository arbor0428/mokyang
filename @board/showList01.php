<style type='text/css'>
.blog_wrap{
	margin:0px auto;
	width:100%;/*총 넓이*/
}

.blog_wrap li{
	width:48%;
	float:left;
	overflow:hidden;
	margin-bottom:4%;
	margin-top:1%;
	margin-right:4%;
	background:#f5f5f5;
}

.blog_wrap li:nth-child(2n+2) { margin-right:0;}

.blog_wrap a{
	display:block;
	height:100%;
}

.blog_wrap .photo_cell{
	overflow:hidden;
	width:43.5%;
	padding:1%;
	height:auto;
	text-align:center;
	float:left;
}

.blog_wrap .grow {
	transition: all .35s ease-in-out;
	width:100%;
}

.blog_wrap .text_cell{
	overflow:hidden;
	width:51%;
	margin-left:3%;
	line-height:1.5;
	float:left;
}
.text_cell .culture_title{
	font-size:22px;
	letter-spacing:-0.5px;
	color:#111111;
	font-weight:bold;
	padding:10% 0 5%;

	width:100%;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	white-space:nowrap;
}
.culture_text{
	font-size:16px;
	line-height:2;

	width:100%;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	white-space:nowrap;
}
</style>


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
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
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

function goSearch(){
	form = document.frm01;

	form.type.value = '';
	form.uid.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}
</script>


<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>


<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';
?>

<div style='float:left;'>
	<table cellpadding='0' cellspacing='0' border='0'>
		<tr>
			<td><?=$btn_write?></td>

			<td>
				<select name="f_year" style='width:90px;height:32px;border:1px solid #dddddd;border-radius:3px;padding:5px;' onchange='goSearch();'>
				<?
					for($i=2017; $i<=date('Y')+1; $i++){
						if($f_year == $i)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$i' $chk>{$i}년</option>");
					}
				?>
				</select>

				<select name="f_month" style='width:70px;height:32px;border:1px solid #dddddd;border-radius:3px;padding:5px;' onchange='goSearch();'>
					<option value=''>전체</option>
				<?
					for($i=1; $i<=12; $i++){
						if($f_month == $i)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$i' $chk>{$i}월</option>");
					}
				?>
				</select>
			</td>

		</tr>
	</table>
</div>

<div style='float:right;'>
	<select name='field' style='height:30px;'>
		<option value='title' <?if($field == 'titile'){echo 'selected';}?>>제목</option>
		<option value='sData01' <?if($field == 'sData01'){echo 'selected';}?>>장르</option>
		<option value='sData02' <?if($field == 'sData02'){echo 'selected';}?>>장소</option>
		<option value='sData05' <?if($field == 'sData05'){echo 'selected';}?>>주최</option>
	</select>
	<input type='text' name='word' value="<?=$word?>" style='width:180px;height:30px;' onkeypress="if(event.keyCode==13){goSearch();}"> <a href="javascript:goSearch();" class="big cbtn black">검색</a>
</div>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' id='list_table'>
				<ul class="blog_wrap clearfix ">



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysqli_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$sData04 = $row["sData04"];
		$sData05 = $row["sData05"];
		$sData06 = $row["sData06"];
		$sDataUrl = $row["sDataUrl"];
		$startDate = $row["startDate"];
		$endDate = $row["endDate"];


		$startDate = eregi_replace("-", ".", $startDate);
		$endDate = eregi_replace("-", ".", $endDate);

		$sData03 = $startDate;
		if($endDate){
			$eDateTxt = substr($endDate,5,10);
			$sData03 .= '~'.$eDateTxt;
		}

		//비밀글설정
		if($pwd_chk){
			$lock_icon=" <img src='".$BTN_lock."'>";

			if($GBL_MTYPE == 'A')	 $str_len = '62';
			else	 $str_len = '72';

		}else{
			$lock_icon='';

			if($GBL_MTYPE == 'A')	 $str_len = '66';
			else	 $str_len = '76';

		}


		$geturl = $boardRoot."img/no_txt.gif";

		if($userfile01){
			$file_s = $userfile01;
			$file_tmp = explode(".", $file_s);
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){

				$file_path = $boardRoot.'upfile/';
/*
				//원본이미지 넓이
				$fw = Util::GetImgSize($file_path.$userfile01);

				//썸네일 넓이와 비교후 파일설정
				if($fw > $img_w)	$geturl = $file_path.'small/s_'.$userfile01;
				else					$geturl = $file_path.$userfile01;
*/

				$geturl = $file_path.$userfile01;
			}
		}


		$userfile = "<img src='".$geturl."' class='grow'>";



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';
?>

					<li>
						<div class="photo_cell"><?=$btn_view?></div>
						<div class="text_cell">
							<span class='culture_title'><?=$title?></span>
							<span class='culture_text'>
								<b style='margin-right:4%;letter-spacing:10;'>장르</b> <?=$sData01?><br>
								<b style='margin-right:4%;letter-spacing:10;'>장소</b> <?=$sData02?><br>
								<b style='margin-right:4%;letter-spacing:10;'>일자</b> <?=$sData03?><br>
								<b style='margin-right:4%;letter-spacing:10;'>연령</b> <?=$sData04?><br>
								<b style='margin-right:4%;letter-spacing:10;'>주최</b> <?=$sData05?><br>
								<b style='margin-right:4%;letter-spacing:10;'>문의</b> <?=$sData06?><br>
							</span>
							<div style='width:40%;line-height:3;margin-top:8%;margin-right:5px;float:right;border:1px solid #aaaaaa;font-size:13px;color:#888888;text-align:center;cursor:pointer;' <?=$btn_link?>><span>자세히보기</span></div>
						<?
							if($sDataUrl){
						?>
							<div style='width:40%;line-height:3;margin-top:8%;margin-right:5px;float:right;border:1px solid #aaaaaa;font-size:13px;color:#888888;text-align:center;'><a href="<?=$sDataUrl?>" target="_blank"><span>예매하기</span></a></div>
						<?
							}
						?>
						</div>
					</li>



<?
		$i--;
	}
}else{
?>

					<div style='width:100%;margin-top:100px;font-size:15px;text-align:center;'>등록된 게시물이 없습니다.</div>

<?
}
?>


				</ul>
			</table>
		</td>
	</tr>
</table>

</form>
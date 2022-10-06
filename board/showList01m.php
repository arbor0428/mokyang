<style type='text/css'>
.blog_wrap{
	margin:0px auto;
	width:100%;/*총 넓이*/
}

.blog_wrap li{
	width:100%;
	float:left;
	overflow:hidden;
	margin-bottom:4%;
	margin-top:1%;
}

.blog_wrap li:nth-child(2n+2) { margin-right:0;}

.blog_wrap a{
	display:block;
	height:100%;
}

.blog_wrap .photo_cell{
	overflow:hidden;
	width:45.5%;
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
	width:49.5%;
	margin-left:5%;
	line-height:1.5;
	float:left;
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
//echo $btn_write;
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' id='list_table'>
				<ul class="blog_wrap clearfix ">



<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysql_fetch_array($result)){

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

		$startDate = $row["startDate"];
		$endDate = $row["endDate"];


		$startDate = eregi_replace("-", ".", $startDate);
		$endDate = eregi_replace("-", ".", $endDate);

		$sData03 = $startDate;
		if($endDate){
			$eDateTxt = substr($endDate,5,10);
			$sData03 .= '~'.$eDateTxt;
			if($startDate==$endDate) $sData03=$startDate;
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

				$geturl = $file_path.$userfile01;

				//원본이미지 넓이
				$fw = Util::GetImgSize($file_path.$userfile01);

				//썸네일 넓이와 비교후 파일설정
				if($fw > $img_w){
					$geturl = $file_path.'s_'.$userfile01;

					if(!is_file($geturl))		$geturl = $file_path.$userfile01;
				}
			}
		}


		$userfile = "<img src='".$geturl."' class='grow'>";



		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';
?>

					<li>
						<div class="photo_cell"><?=$btn_view?></div>
						<div class="text_cell" <?=$btn_link?>>
							<span style='font-size:22px;letter-spacing:-0.5px;color:#111111;font-weight:bold;'><?=$title?></span><br><br>
							<span style='font-size:16px;line-height:2.3;'>
								<b style='margin-right:4%;letter-spacing:15;'>장르</b> <?=$sData01?><br>
								<b style='margin-right:4%;letter-spacing:15;'>장소</b> <?=$sData02?><br>
								<b style='margin-right:4%;letter-spacing:15;'>일자</b> <?=$sData03?><br>
								<b style='margin-right:4%;letter-spacing:15;'>연령</b> <?=$sData04?><br>
								<b style='margin-right:4%;letter-spacing:15;'>주최</b> <?=$sData05?><br>
								<b style='margin-right:4%;letter-spacing:15;'>문의</b> <?=$sData06?><br>
							</span>
							<div style='width:40%;line-height:3;margin-top:15.5%;border:1px solid #aaaaaa;font-size:13px;color:#888888;text-align:center;cursor:pointer;'><span>자세히보기</span></div>
						</div>
					</li>



<?
		$i--;
	}
}else{
?>

						<p style='padding:30px 0;'>등록된 게시물이 없습니다.</p>

<?
}
?>


				</ul>
			</table>
		</td>
	</tr>
</table>

</form>
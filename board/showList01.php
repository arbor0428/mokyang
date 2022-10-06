<style type='text/css'>
/* 검색박스 */
.f_year{width:90px;height:32px;border:1px solid #dddddd;padding:5px; }
.f_month{width:70px;height:32px;border:1px solid #dddddd;padding:5px;}

.sel-field{float:right;}
.sctxt{width:180px; height:30px;}

/* 공연리스트 */
.blog_wrap{margin:0px auto; width:100%;/*총 넓이*/}

.blog_wrap li{
	position:relative;
	width:100%;
	overflow:hidden;
	margin: 1% auto 5%;
	border:1px solid #ddd;
	box-sizing:border-box;
}

.blog_wrap li:nth-child(2n+2) {margin-right:0;}

.blog_wrap a{position:relative; display:block; height:100%;}
			

.blog_wrap .photo_cell{
	width: 38%;
	padding: 2%;
	box-sizing:border-box;
	height:auto;
	float:left;
}
.photo_cell img{border:1px solid #eee; box-sizing:border-box;}

.blog_wrap .grow {transition: all .35s ease-in-out; width:100%;}

.blog_wrap .text_cell{
	    box-sizing: border-box;
    margin: 3% 2%;
    padding: 3% 2%;
    width: 55%;
    line-height: 1.5;
    float: left;
    border: 2px solid #b8bbbb;
    border-width: 2px 0;
}
.text_cell .culture_title{
	width:100%;
	word-break: keep-all;
	font-size: 26px;
	letter-spacing:-0.9px;
	color:#111111;
	font-weight: 800;
	padding:0% 0 5%;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	white-space:nowrap;
}
.culture_text{
	font-size: 16px;
	line-height:2;
	width:100%;
	display:inline-block;
	text-overflow:ellipsis;
	overflow:hidden;
	white-space:nowrap;
}
.box_cell{
	width:40px;height:40px;line-height:40px;text-align:center;color:#ffffff;font-weight:bold;
	background:#f05a68;position:absolute;top:15px;left:15px;
}
.box_cell2{
	width:40px;height:40px;line-height:40px;text-align:center;color:#ffffff;font-weight:bold;
	background:#5b2a7a;position:absolute;top:15px;left:15px;
}

/* 버튼 */
.text_cell .btn1{
	width:40%;
	line-height:3;
	margin-top:8%;
	margin-right:5px;
	float:right;
	border:1px solid #aaaaaa;
	font-size:13px;
	color:#888888;
	text-align:center;
	cursor:pointer;
}



/* 모바일 */
@media screen and (max-width:768px) {
	.f_year{width:80px;height: 30px; margin-bottom:5px;}
	.f_month{width: 60px;height: 30px; margin-bottom:5px;}
	.sel-field{float: left;}

	.blog_wrap{margin:0px auto; width:100%;/*총 넓이*/}
	.blog_wrap li{margin: 5% auto 8%;}

	.blog_wrap a{position:relative; display:block; height:100%;}				

	.blog_wrap .photo_cell{width: 100%; padding: 8%; margin: 0 auto; float: none;}
	.blog_wrap .text_cell{width: 90%;margin: 0 auto;float: none;padding: 0 2%;border: none;}

	.text_cell .culture_title{
		width: 100%;
		font-size: 20px;
		text-overflow:visible;
		overflow:visible;
		white-space:normal;
		padding: 5% 0;
		text-align: center;
	}
	.culture_text{font-size: 13px;	}
	.box_cell{top: 22px; left: 22px; box-shadow: 5px 5px 7px rgb(0 0 0 / 20%);}
	.box_cell2{top: 22px; left: 22px; box-shadow: 5px 5px 7px rgb(0 0 0 / 20%);}

	/* 버튼 */
	.text_cell .btn1{width: 100%; margin: 10px auto; float: none;	}
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
<label><input type="text" style="display: none;"></label>  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
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
				<label for="f_year">
				<select name="f_year" onchange='goSearch();' class="f_year">
				<?
					for($i=2021; $i<=date('Y')+1; $i++){
						if($f_year == $i)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$i' $chk>{$i}년</option>");
					}
				?>
				</select>

				<select name="f_month" class="f_month" onchange='goSearch();'>
					<option value=''>전체</option>
				<?
					for($i=1; $i<=12; $i++){
						if($f_month == $i)	$chk = 'selected';
						else					$chk = '';

						echo ("<option value='$i' $chk>{$i}월</option>");
					}
				?>
				</select>
				</label>
			</td>

		</tr>
	</table>
</div>

<div class="sel-field">
	<label for="field">
		<select name='field'>
			<option value='title' <?if($field == 'titile'){echo 'selected';}?>>제목</option>
			<option value='sData01' <?if($field == 'sData01'){echo 'selected';}?>>장르</option>
		</select>
	</label>
		<label for="word"><input type='text' name='word' value="<?=$word?>" class="sctxt" onkeypress="if(event.keyCode==13){goSearch();}"></label><a href="javascript:goSearch();" class="scbtn">검색</a>
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
		$sData07 = $row["sData07"];
		$sDataUrl = $row["sDataUrl"];
		$startDate = $row["startDate"];
		$endDate = $row["endDate"];


		$startDate = eregi_replace("-", ".", $startDate);
		$endDate = eregi_replace("-", ".", $endDate);

		$sData08 = $startDate;
		if($endDate){
			$eDateTxt = substr($endDate,5,10);
			$sData08 .= '~'.$eDateTxt;
			if($startDate==$endDate) $sData08=$startDate;
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


		$userfile = "<img src='".$geturl."' class='grow' alt='".$title."'>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';
?>

					<li class="clearfix">

						<div class="photo_cell">
						<?=$btn_view?>
							<?
								if($sData03=='공연'){
							?>
							<div class='box_cell'><?=$sData03?></div>
							<?
								}elseif($sData03=='전시'){
							?>
							<div class='box_cell2'><?=$sData03?></div>
							<?
								}
							?>
						</div>
						<div class="text_cell">
							<span class='culture_title'><?=$title?></span>
							<span class='culture_text'>
								<b style='margin-right:4%;letter-spacing:10;'>장르</b> <?=$sData01?><br>
								<b style='margin-right:4%;letter-spacing:10;'>장소</b> <?=$sData02?><br>
								<b style='margin-right:4%;letter-spacing:10;'>일자</b> <?=$sData08?><br>
								<b style='margin-right:4%;letter-spacing:10;'>연령</b> <?=$sData04?><br>
								<b style='margin-right:4%;letter-spacing:10;'>주최</b> <?=$sData05?><br>
								<?
									if($sData07){	
								?>
								<b style='margin-right:4%;letter-spacing:10;'>주관</b> <?=$sData07?><br>
								<?
									}	
								?>
								<b style='margin-right:4%;letter-spacing:10;'>문의</b> <?=$sData06?><br>
							</span>
							<div class="btn1" <?=$btn_link?>><span>자세히보기</span></div>
						<?
							if($sDataUrl){
						?>
							<div class="btn1"><a href="<?=$sDataUrl?>" target="_blank"><span>예매하기</span></a></div>
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
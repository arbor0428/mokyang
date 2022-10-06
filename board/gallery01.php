<style type='text/css'>
.gal_eff{
	margin:0px auto;
	width:100%;/*게시판 넓이*/
}

.gal_eff li:nth-child(4n+4) { margin-right:0;}

.gal_eff li{
	width:25%;
	float:left;
	overflow:hidden;
	/*margin-right:2%;*/
	margin-bottom:2%;
	/*
	background-color:#f3f3f3;
	
	border-bottom:1px solid #e1e1e1;
	*/
}

.gal_eff a{
	display:block;
	height:100%;
}

.gal_eff .photo_cell{
	overflow:hidden;
	width:90%;
	height:200px;
	margin:5% auto;
	text-align:center;
}

.gal_eff .photo_cell img {width:100%; height:140% !important;}

.gal_eff .grow {
	transition: all .35s ease-in-out;
	width:100%;
	height:200px;
}

.gal_eff li:hover .grow {
	transform: scale(1.12);

}

.gal_eff_ttl{
	text-align:center;
	font-size:0.875rem !important;
	color:#333;
}

.board1{font-size:14px;}
.b-text{word-break:keep-all;}
.select1 {height:30px;border:1px solid #dddddd;border-radius:3px;padding:5px; margin-right:4px; vertical-align:middle;}

@media screen and (max-width:1024px) {
	.gal_eff li {width:33.33%;}
}

@media screen and (max-width:768px) {
	.gal_eff li {width:50%;}
	.board1{font-size:13px;}
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

function reg_search(){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = 0;
	form.action = '<?=$PHP_SELF?>';
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
<label><input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');" style="display: none;"></label>


<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<?
	//글쓰기 권한 설정
	include $boardRoot.'chk_write.php';
?>




<table width="100%" border="0" cellspacing="0" cellpadding="0" class="listTbl">
	<tr>
		<td style='padding:0 0 5px 0;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td width='20%'><?=$btn_write?></td>
					<td width='80%' align='right' style='padding-bottom:20px;'>
						<label for="field">
							<select name="field" class="select1">
								<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
								<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>
								<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
							</select>
						</label>
						<label for="word"><input name="word" type="text" value='<?=$word?>' style='vertical-align:middle;'></label>
						<a href="javascript:reg_search();" class="scbtn">검색</a>
					</td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td align='center' id='list_table'>
			<ul class="gal_eff clearfix ">


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$pwd_chk = $row["pwd_chk"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);

		//제목 글자수 제한


		$thumbImg = $boardRoot."img/no_txt.gif";

		if($userfile01){
			$file_s = $userfile01;
			$file_tmp = explode(".", $file_s);
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){

				$file_path = $boardRoot.'upfile/';
				$thumbImg = $file_path.$userfile01;
			}

		}elseif($row["sDataUrl"]){
			$tmpArr = explode('/',$row["sDataUrl"]);
			$videoCode = $tmpArr[count($tmpArr)-1];
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/default.jpg";			//120×90
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/mqdefault.jpg";		//320×180
			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/hqdefault.jpg";		//480×360
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/sddefault.jpg";		//640×480
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/maxresdefault.jpg";	//1920×1080
		}


		$userfile = "<img src='".$thumbImg."' class='grow' alt=''>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';
?>
					<li style='cursor:pointer;'>
						<a href="javascript:<?=$btn_link?>">
							<div class="photo_cell"><?=$userfile?></div>
							<div class="eff3_ttl limitTxt"><?=$title?></div>
						</a>
					</li>


<?
		$i--;
	}

}else{
?>


					<p style='padding:30px 0; text-aign:center; font-size:14px;'>등록된 게시물이 없습니다.</p>


<?
}
?>


			</ul>
		</td>
	</tr>
</table>




</form>
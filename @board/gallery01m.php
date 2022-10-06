<style type='text/css'>
.gal_eff{
	padding:0;
	margin:0px auto;
	box-sizing:border-box;
	width:340px;
}

.gal_eff li:nth-child(3n+3) { margin-right:0;}

.gal_eff li{
	width:32%;
	float:left;
	overflow:hidden;
	margin-right:2%;
	margin-bottom:5%;
	background-color:#f3f3f3;
	border-bottom:2px solid #ddd;
}

.gal_eff a{
	display:block;
	height:100%;
}

.gal_eff .photo_cell{
	position:relative;
	overflow:hidden;
	width:90%;
	height:auto;
	margin:5% auto;
	text-align:center;
}

.gal_eff .grow {
	transition: all .35s ease-in-out;
	width:100%;
}

.gal_eff li:hover .grow {
	transform: scale(1.12);

}

.gal_eff_ttl{
	text-align:center;
	font-size:14px !important;
	color:#333;
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
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input name='all_chk' type='checkbox' onclick="All_chk('all_chk','chk[]');" style="display: none;">


<!-- 비밀번호 테이블 -->
<? include $boardRoot.'pwd_pop.php'; ?>
<!-- /비밀번호 테이블 -->

<?
	//글쓰기 권한 설정
	include $boardRoot.'chk_write.php';
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td style='padding:0 0 5px 0;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr height='30'>
				<?
					if($GBL_MTYPE == 'A'){	 //관리자일 경우에만 버튼을 활성화 한다.
				?>
					<td><a href="javascript:All_chk_btn('all_chk','chk[]')"><img src='<?=$BTN_allsel?>' align='absmiddle' alt='전체선택'></a> <a href="javascript:All_del()"><img src='<?=$BTN_alldell?>' align='absmiddle' alt='선택삭제'></a></td>
				<?
					}
				?>
					<td align='right'>
						<select name="field" style='height:30px;border:1px solid #dddddd;border-radius:3px;padding:5px;'>
							<option value='title' <?if($field == 'title') echo 'selected';?>>제목</option>
							<option value='name' <?if($field == 'name') echo 'selected';?>>글쓴이</option>
							<option value='ment' <?if($field == 'ment') echo 'selected';?>>내용</option>
						</select>
						<input name="word" type="text" style='width:200px;height:30px;border:1px solid #dddddd;border-radius:3px;padding:5px;' value='<?=$word?>' onkeypress="if(event.keyCode==13){goSearch();}"> <a href="javascript:goSearch();" class="big cbtn black">검색</a>
					</td>
				</td>
			</table>
		</td>
	</tr>

	<tr>
		<td align='center'>
			<ul class="gal_eff clearfix ">


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 1;

	while($row = mysqli_fetch_array($result)){

		$uid = $row["uid"];
		$site = $row["site"];
		$userid = $row["userid"];
		$notice_chk = $row["notice_chk"];
		$title = $row["title"];
		$pwd_chk = $row["pwd_chk"];
		$userfile01 = $row["userfile01"];
		$realfile01 = $row["realfile01"];

		$reg_date=$row["reg_date"];
		$reg_date = date("Y-m-d",$reg_date);

		//제목 글자수 제한

		
		$site=$row["site"];
		if($site)	$siteTxt = "<span class='".$siteClass2[$site]."'>".$site."</span>";
		else		$siteTxt = '';




		$geturl = $boardRoot."img/no_txt.gif";

		if($userfile01){
			$file_s = $userfile01;
			$file_tmp = explode(".", $file_s);
			$file_tmp_len = count($file_tmp);
			$file_name = $file_tmp[$file_tmp_len-1];

			$file_exe = strtolower($file_name);

			if($file_exe == 'jpg' || $file_exe == 'jpeg' || $file_exe == 'gif' || $file_exe == 'png' || $file_exe == 'bmp'){
				if($site=='재단'){
					$file_path='https://ansanyouth.or.kr/board/upfile/';
				}elseif($site=='상록'){
					$file_path='https://sangnok.ansanyouth.or.kr//board/upfile/';
				}elseif($site=='단원'){
					$file_path='https://danwon.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='일동'){
					$file_path='https://ildong.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='사동'){
					$file_path='https://sadong.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='선부'){
					$file_path='https://seonbu.ansanyouth.or.kr/board/upfile/';
				}elseif($site=='예절'){
					$file_path='https://etiquette.ansanyouth.or.kr/board/upfile/';
				}


				//$file_path = $boardRoot.'upfile/';
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



		//$userfile = "<img src='".$geturl."' class='grow'>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';



?>
					<li style='cursor:pointer;'>
						<a href="javascript:<?=$btn_link?>">
							<div class="photo_cell" style='background:url(<?=$geturl?>) center center;background-size:cover;'>
								<div style='position:absolute;top:5%;left:0;'><?=$siteTxt?></div>
								<?=$userfile?>
								</div>
							<div class="eff3_ttl limitTxt"><?=$title?></div>
						</a>
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
		</td>
	</tr>
</table>


</form>

<script>
$(function(){
	$(".photo_cell").height($(".photo_cell").width());
})
</script>
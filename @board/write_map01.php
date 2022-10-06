<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];
		$reg_date = $row["reg_date"];
		$hit = $row["hit"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);


		//저장된 파일명
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];

		//실제 파일명
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];

		//상품구매후기관련
		$order_review_uid = $row['order_review_uid'];
		$order_review_grade = $row['order_review_grade'];

	}else{
		//게시판 기본문구
		$ment = $default_msg;
	}

	if(!$name){
		if($SET_chk_nicname && $GBL_NICKNAME)		$name = $GBL_NICKNAME;		//회원가입시 닉네임을 이용하면서 로그인 정보중 닉네임이 있는 경우..
		elseif($GBL_COMPANY)								$name = $GBL_COMPANY;		//로그인된 상호명이 있는 경우
		else															$name = $GBL_NAME;				//로그인된 성명이 있는 경우
	}

	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>

<style type='text/css'>
.gfTxt01{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 15px;
}

.gfTxt02{
	color:#317034;
	font-weight:600;
	padding:0px 0px 0px 35px;
}
</style>

<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.name,"지역을 선택해 주십시오"))	return;
	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;


	if(form.type.value == 'write' && form.policy01.value){
		if(form.a1[0].checked == false){
			alert('개인정보 수집 및 이용에 동의해 주시기 바랍니다.');
			form.a1[0].focus();
			return;

		}else if(form.a2[0].checked == false){
			alert('개인정보 수집 및 이용에 동의해 주시기 바랍니다.');
			form.a1[0].focus();
			return;
		}
	}

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	//한글메뉴명 인코딩 문제로 인하여 에디터 내용제거
	form.ment.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();

}

function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

}
</script>



<form name='FRM' action="<?=$_SERVER['PHP_SELF']?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='userid' value='<?=$GBL_USERID?>'>
<input type='hidden' name='SITE_ID' id='SITE_ID' value='<?=$SITE_ID?>'>
<input type='hidden' name='board_width' id='board_width' value='<?=$board_width?>'>

<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='dbfile01' value='<?=$userfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$userfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$userfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$userfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$userfile05?>'>

<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>

<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->
<input type='hidden' name='list_mod' value='<?=$list_mod?>'><!-- 게시판형태 -->
<input type='hidden' name='img_w' value='<?=$img_w?>'><!-- 썸네일 크기 -->
<input type='hidden' name='img_h' value='<?=$img_h?>'><!-- 썸네일 크기 -->

<input type='hidden' name='order_review_uid' value='<?=$order_review_uid?>'><!-- 구매후기 작성시 상품번호 -->

<input type='hidden' name='pwd_chk' value=''><!-- 공개글 설정 -->
<input type='hidden' name='passwd' value='1234'><!-- 비밀번호 -->

<input type='hidden' name='policy01' value='<?=$policy01?>'><!-- 약관동의사용 -->

<?
//상품번호가 있는 경우 구매후기 작성이기 때문에 상품정보를 표시한다
if($order_review_uid){
	include '../../board/product_view01.php';
}
?>

<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td colspan='2' height="3" bgcolor="317034"></td>
	</tr>
<?
if($GBL_MTYPE == 'A'){
?>
	<tr height='40'>
		<td class='gfTxt01'>공 지</td>
		<td> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> 체크하실 경우 리스트의 최상단에 출력됩니다</td>
	</tr>
	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>

<?
}
?>

	<tr height='40'>
		<td class='gfTxt01'>지 역</td>
		<td>
			<select name='name' style='width:120px;height:30px;'>
				<option value="서울" <?if($name=='서울') echo 'selected';?>>서 울</option>
				<option value="경기" <?if($name=='경기') echo 'selected';?>>경 기</option>
				<option value="강원" <?if($name=='강원') echo 'selected';?>>강 원</option>
				<option value="경남" <?if($name=='경남') echo 'selected';?>>경 남</option>
				<option value="경북" <?if($name=='경북') echo 'selected';?>>경 북</option>
				<option value="광주" <?if($name=='광주') echo 'selected';?>>광 주</option>
				<option value="대구" <?if($name=='대구') echo 'selected';?>>대 구</option>
				<option value="대전" <?if($name=='대전') echo 'selected';?>>대 전</option>
				<option value="부산" <?if($name=='부산') echo 'selected';?>>부 산</option>
				<option value="세종" <?if($name=='세종') echo 'selected';?>>세 종</option>
				<option value="울산" <?if($name=='울산') echo 'selected';?>>울 산</option>
				<option value="인천" <?if($name=='인천') echo 'selected';?>>인 천</option>
				<option value="전남" <?if($name=='전남') echo 'selected';?>>전 남</option>
				<option value="전북" <?if($name=='전북') echo 'selected';?>>전 북</option>
				<option value="제주" <?if($name=='제주') echo 'selected';?>>제 주</option>
				<option value="충남" <?if($name=='충남') echo 'selected';?>>충 남</option>
				<option value="충북" <?if($name=='충북') echo 'selected';?>>충 북</option>
			</select>
		</td>
	</tr>

	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>

	<tr height='40'>
		<td width="15%" class='gfTxt01'>제 목</td>
		<td width="85%">
		<?
			if($title_css){
				include $boardRoot.'TitleField.php';

			}else{
		?>
			<input name="title" type="text" style='width:99%;height:30px;' value='<?=$title?>'>
		<?
			}
		?>
		</td>
	</tr>

	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>

	<tr height='40'>
		<td class='gfTxt01'>연락처</td>
		<td><input name="data01" type="text" style='width:200px;height:30px;' value='<?=$data01?>'></td>
	</tr>

	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>	

	<tr height='40'>
		<td class='gfTxt01'>주소</td>
		<td><input name="data02" type="text" style='width:200px;height:30px;' value='<?=$data02?>'></td>
	</tr>

	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>	

	<tr height='40'>
		<td class='gfTxt01'>홈페이지</td>
		<td><input name="data03" type="text" style='width:200px;height:30px;' value='<?=$data03?>'></td>
	</tr>

	<tr>
		<td height="1" colspan="2" bgcolor="e2e2e2"></td>
	</tr>	

<?
	if($BoardDayHit){
?>

	<tr height='40'>
		<td class='gfTxt01'>등록일시</td>
		<td>
			<select name='set_ry' style='height:30px;'>
			<?
				for($i=date('Y')+1; $i>=2010; $i--){
					if($i == $set_ry)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>년
			<select name='set_rm' style='height:30px;'>
			<?
				for($i=1; $i<=12; $i++){
					$set_rm_no = sprintf('%02d',$i);
					if($i == $set_rm)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>월
			<select name='set_rd' style='height:30px;'>
			<?
				for($i=1; $i<=31; $i++){
					$set_rd_no = sprintf('%02d',$i);
					if($i == $set_rd)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>일&nbsp;&nbsp;

			<select name='set_rh' style='height:30px;'>
			<?
				for($i=0; $i<=23; $i++){
					$set_rh_no = sprintf('%02d',$i);
					if($i == $set_rh)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>시
			<select name='set_ri' style='height:30px;'>
			<?
				for($i=0; $i<=59; $i++){
					$set_ri_no = sprintf('%02d',$i);
					if($i == $set_ri)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>분
			<select name='set_rs' style='height:30px;'>
			<?
				for($i=0; $i<=59; $i++){
					$set_rs_no = sprintf('%02d',$i);
					if($i == $set_rs)	$chk = 'selected';
					else					$chk = '';

					echo ("<option value='$i' $chk>$i</option>");
				}
			?>
			</select>초&nbsp;&nbsp;
			<input type='button' name='btn_set' value='현재시간' onclick='setToDate(this.form);' style='height:30px;cursor:pointer;'>
		</td>
	</tr>

	<tr>
		<td height="1" style="padding:1px 0px 0px 0px;" colspan="2" bgcolor="e2e2e2"></td>
	</tr>

	<tr height='40'>
		<td class='gfTxt01'>조회수</td>
		<td><input name="hit" type="text" style='width:75px;height:30px;ime-mode:disabled;' value='<?=$hit?>' onkeydown='return onlyNumberNew(event)'></td>
	</tr>

	<tr>
		<td height="1" style="padding:1px 0px 0px 0px;" colspan="2" bgcolor="e2e2e2"></td>
	</tr>
<?
	}
?>

		

<?

for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);

	if($i == '1' && ($list_mod == '갤러리형' || $list_mod == '블로그형')){
		$file_field_txt = "썸네일";
		$file_field_notice = '* 게시판 리스트에 출력되는 작은이미지를 올려주시기 바랍니다<br>';
		$file_size_txt = "<br>* 가로 : $img_w px * 세로 : $img_h px";

	}else{
		$file_field_txt = "첨부파일";
		$file_field_notice = '';
		$file_size_txt = '';
	}
?>


	<tr height='40'>
		<td class='gfTxt01'><?=$file_field_txt?></td>					
		<td>
			<?=$file_field_notice?>
			<input type='file' name='upfile<?=$file_num?>' style='width:300px;height:30px;'>
		<?
			if(${'userfile'.$file_num}){
		?>
			<input type='checkbox' name='del_upfile<?=$file_num?>' value='Y'>삭제 (<?=${'realfile'.$file_num}?>)
		<?
			}
		?>
			<?=$file_size_txt?>

		</td>
	</tr>
	<tr>
		<td bgcolor="cccccc" height="1" colspan="2" nowrap></td>
	</tr>

<?
}
?>


	<tr> 
		<td colspan='2' style='padding-top:5px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>
</table>


<?
	if($policy01 && $type == 'write'){
		include $boardRoot.'writePolicy01.php';
	}
?>


<table cellpadding='0' cellspacing='0' border='0' width='100%'>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<img src='<?=$BTN_register?>' onclick='check_form();' style='cursor:pointer;'>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_cancel?>'></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<img src='<?=$BTN_register?>' onclick='check_form();' style='cursor:pointer;'>&nbsp;
			<img src='<?=$BTN_del01?>' onclick='reg_del();' style='cursor:pointer;'>&nbsp;
			<a href="javascript:reg_list();"><img src='<?=$BTN_list?>'></a>
		</td>
	</tr>
<?
}
?>
	
		</td>
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
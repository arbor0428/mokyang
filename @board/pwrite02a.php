<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		$pid = $row["pid"];
		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$pwd_chk = $row["pwd_chk"];
		$notice_chk = $row["notice_chk"];
		$notice_chk = $row["notice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];


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
	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>


function check_form(){
	form = document.FRM;

	if(isFrmEmpty(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmpty(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmpty(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.action = '<?=$PHP_SELF?>';
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



<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='field' value='<?=$field?>'>
<input type='hidden' name='word' value='<?=$word?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>

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

<input type='hidden' name='pid' value='<?=$pid?>'><!-- 상품번호 -->

<!--등록-->

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
<?
	if($pid){
?>
	<tr> 
		<th style='border-top:2px solid #8c8c8c !important;'>상품정보</th>
		<td style='border-top:2px solid #e86261 !important;' colspan='3'>
		<?
			$psql = "select * from ks_product where uid='$pid'";
			$presult = mysqli_query($dbc,$psql);
			$prow = mysqli_fetch_array($presult);

			$pcade01 = $prow["cade01"];		//분류
			$ptitle = $prow["title"];					//상품명
			$pupfile01 = $prow["upfile01"];		//이미지
			$pprice = $prow["price"];				//판매가격
			$ppriceTxt = number_format($pprice);

			$imgTag = '';

			if($pupfile01){
				$imgFile = $path.'thumb_'.$pupfile01;
				if(!is_file($imgFile))	$imgFile = $path.$pupfile01;
				$resize = Util::AutoImgSize($imgFile,150,187);
				$imgTag = "<img src='$imgFile' $resize>";

				if($pcade01 == '신부한복')				$act = '/sub02/sub01.php';
				elseif($pcade01 == '신랑한복')			$act = '/sub03/sub01.php';
				elseif($pcade01 == '신랑신부세트')		$act = '/sub04/sub01.php';
				elseif($pcade01 == '혼주한복')			$act = '/sub05/sub01.php';
				elseif($pcade01 == '장신구')				$act = '/sub06/sub01.php';
		?>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td align='center' style='padding:5px 0px 5px 0px;'><?=$imgTag?></td>
					<td style='padding:0px 0px 0px 120px;'>
						<table cellpadding='2' cellspacing='0' border='0'>
							<tr>
								<td><b><?=$ptitle?></b></td>
							</tr>
							<tr>
								<td style='color:#52809a;'><b><?=$ppriceTxt?>원</b></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		<?
			}
		?>
		</td>
	</tr>
<?
	}
?>
	<tr> 
		<th>제목</th>
		<td colspan='3'><input name="title" type="text" style='width:98%;' value='<?=$title?>' class='3tt5'></td>
	</tr>
	<tr> 
		<th width="17%" class='tab_bbs'>작성자</th>
		<td width="33%" class='tab'><input name="name" type="text" style='width:205px;' value='<?=$name?>' class='3tt5'></td>
		<th width="17%" class='tab_bbs'>비밀번호</th>
		<td width="33%" class='tab'>
			<input name="passwd" type="password" style='width:100px;' value='<?=$passwd?>' class='3tt5'>
			<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>공개
			<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>비공개
		</td>
	</tr>


<?
for($i=1; $i<=$upload_chk; $i++){
	$file_num = sprintf("%02d",$i);
?>


	<tr> 
		<th>첨부파일#<?=$i?></td>
		<td colspan='3'>
			<input type='file' name='upfile<?=$file_num?>' class='file01'>
		<?
			if(${'userfile'.$file_num}){
		?>
			<input type='checkbox' name='del_upfile<?=$file_num?>' value='Y'>삭제 (<?=${'realfile'.$file_num}?>)
		<?
			}
		?>

		</td>
	</tr>

<?
}
?>






</table>
<div style='width:100%;margin:5px 0 20px 0;'><textarea name="ment" id="ment" style='width:100%;height:400px;'><?=$ment?></textarea></div>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>

<?
if($type == 'write'){
?>
	<tr>
		<td align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>작성완료</a>&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='center'>
			<a href="javascript:check_form();" class='big cbtn blue'>수정</a>&nbsp;
			<a href="javascript:reg_del();" class='big cbtn red'>삭제</a>&nbsp;
			<a href="javascript:reg_list();" class='big cbtn black'>취소</a>
		</td>
	</tr>
<?
}
?>
			
</table>

</form>




<script type="text/javascript">

var oEditors = [];

nhn.husky.EZCreator.createInIFrame({

    oAppRef: oEditors,

    elPlaceHolder: "ment",

    sSkinURI: "../smarteditor/SmartEditor2Skin.html",

    fCreator: "createSEditor2"

});

</script>
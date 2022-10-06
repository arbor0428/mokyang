<?

	if($type=='edit' && $uid){
		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];

		if($title){
			$title = eregi_replace("&lt;", "<", $title);
			$title = eregi_replace("&gt;", ">", $title);
			$title = eregi_replace("&quot;", "\"", $title);
			$title = eregi_replace("&#124;", "\|", $title);
			$title = eregi_replace("<P>", "\r\n\r\n", $title);
			$title = eregi_replace("<BR>", "\r\n", $title);
		}

		if($ment){
			$ment = eregi_replace("&lt;", "<", $ment);
			$ment = eregi_replace("&gt;", ">", $ment);
			$ment = eregi_replace("&quot;", "\"", $ment);
			$ment = eregi_replace("&#124;", "\|", $ment);
			$ment = eregi_replace("<P>", "\r\n\r\n", $ment);
			$ment = eregi_replace("<BR>", "\r\n", $ment);
		}

	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;

	//레슨동영상 단계구분용
	if($f_data01)	$data01 = $f_data01;



?>





<script language='javascript'>


function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.name,"분류를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.title,"질문을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.ment,"답변을 입력해 주십시오"))	return;


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
	
	if(confirm('질문을 삭제하시겠습니까?')){
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
<input type='hidden' name='type' value="<?=$type?>">
<input type='hidden' name='uid' value="<?=$uid?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='strRoot' value="<?=$strRoot?>">
<input type='hidden' name='boardRoot' value="<?=$boardRoot?>">

<input type='hidden' name='table_id' value="<?=$table_id?>">
<input type='hidden' name='dbfile01' value="<?=$userfile01?>">
<input type='hidden' name='dbfile02' value="<?=$userfile02?>">
<input type='hidden' name='dbfile03' value="<?=$userfile03?>">
<input type='hidden' name='dbfile04' value="<?=$userfile04?>">
<input type='hidden' name='dbfile05' value="<?=$userfile05?>">

<input type='hidden' name='realfile01' value="<?=$realfile01?>">
<input type='hidden' name='realfile02' value="<?=$realfile02?>">
<input type='hidden' name='realfile03' value="<?=$realfile03?>">
<input type='hidden' name='realfile04' value="<?=$realfile04?>">
<input type='hidden' name='realfile05' value="<?=$realfile05?>">

<input type='hidden' name='list_mod' value="<?=$list_mod?>">



<!--등록-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>

			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th width="17%">분류</th>
					<td width="83%"><input name="name" type="text" style='width:250px;' value=""></td>
				</tr>

				<tr> 
					<th>질문</th>
					<td><input name="title" type="text" style='width:50%;' value="<?=$title?>"></td>
				</tr>
				<tr> 
					<th>답변</th>
					<td><textarea name='ment' style='width:100%;height:150px;'><?=$ment?></textarea></td>
				</tr>



			</table>


		</td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/register.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/cancel.gif" border=0></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
			<a href="javascript:reg_del();"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list();"><img src="<?=$boardRoot?>img/list01.gif" border=0></a>
		</td>
	</tr>
<?
}
?>
			
</table>


</form>


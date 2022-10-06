<?


	if($type=='re_edit'){
		$sql = "select * from tb_board_reply where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$upid = $row["upid"];
		$title = $row["title"];
		$name = $row["name"];
		$email = $row["email"];
		$passwd = $row["passwd"];
		$ment = $row["ment"];

	}

	if(!$name)	$name = $GBL_NAME;
	if(!$passwd)	$passwd = $GBL_PASSWORD;


	if($upid){
		//원글의 제목을 가져온다.
		$sql = "select * from tb_board_list where uid='$upid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$otitle = '[답글]'.$row[title];
		$oment = $row[ment];
	}

	if(!$title)	$title = $otitle;




?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.title,"제목을 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.name,"작성자를 입력해 주십시오"))	return;
	if(isFrmEmptyModal(form.passwd,"비밀번호를 입력해 주십시오"))	return;

	oEditors.getById["ment"].exec("UPDATE_CONTENTS_FIELD", []);

	form.action = '<?=$boardRoot?>proc.php';
	form.submit();
}



function reg_list(mod){
	form = document.FRM;

	if(mod == 'v')	form.type.value = 'view';
	else	form.type.value = 're_view';

	form.action = '<?=$PHP_SELF?>';
	form.submit();

}

function reg_del(){
	
	if(confirm('글을 삭제하시겠습니까?')){
		form = document.FRM;
		form.type.value = 're_del'
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
<input type='hidden' name='upid' value='<?=$upid?>'>




<!--등록-->



<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
				<tr> 
					<th>제목</th>					
					<td colspan='3'><input name="title" type="text" style='width:99%;' value='<?=$title?>'></td>
				</tr>

				<tr> 
					<th width="17%">작성자</th>					
					<td width="33%"><input name="name" type="text" style='width:95%;' value='<?=$name?>'></td>					
					<th width="17%">비밀번호</th>					
					<td width="33%"><input name="passwd" type="password" style='width:50%;' value='<?=$passwd?>'></td>
				</tr>

				<tr> 
					<th>원문</td>					
					<td colspan='3'><div style='width:100%;margin:5px 0;min-height:80px;'><?=$oment?></td>
				</tr>
			</table>
		</td>
	</tr>

	<tr>
		<td style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>

<?
if($type == 're_write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/register.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list('v');"><img src="<?=$boardRoot?>img/cancel.gif" border=0></a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();"><img src="<?=$boardRoot?>img/modify2.gif" border=0></a>&nbsp;
			<a href="javascript:reg_del();"><img src="<?=$boardRoot?>img/delete1.gif" border=0></a>&nbsp;
			<a href="javascript:reg_list('e');"><img src="<?=$boardRoot?>img/cancel.gif" border=0></a>
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
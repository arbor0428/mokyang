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
		$totalNotice_chk = $row["totalNotice_chk"];
		$ment = $row["ment"];
		$data01 = $row["data01"];
		$data02 = $row["data02"];
		$data03 = $row["data03"];
		$data04 = $row["data04"];
		$data05 = $row["data05"];

		$reg_date = $row["reg_date"];

		//����� ���ϸ�
		$userfile01 = $row["userfile01"];
		$userfile02 = $row["userfile02"];
		$userfile03 = $row["userfile03"];
		$userfile04 = $row["userfile04"];
		$userfile05 = $row["userfile05"];

		//���� ���ϸ�
		$realfile01 = $row["realfile01"];
		$realfile02 = $row["realfile02"];
		$realfile03 = $row["realfile03"];
		$realfile04 = $row["realfile04"];
		$realfile05 = $row["realfile05"];

		$set_ry = date('Y',$reg_date);
		$set_rm = date('m',$reg_date);
		$set_rd = date('d',$reg_date);
		$set_rh = date('H',$reg_date);
		$set_ri = date('i',$reg_date);
		$set_rs = date('s',$reg_date);

	//��ܼҰ� > �濵���� > ����������
	}elseif($table_id == 'table_1521100078'){
		$data01 = $f_data01;

	}

	if($GBL_MTYPE == 'A'){
		if(!$name)	$name = '�����̺�ġ��';
		if(!$passwd)	$passwd = '1234';
	}



?>



<script type="text/javascript" src="/smarteditor/js/HuskyEZCreator.js" charset="euc-kr"></script>

<script language='javascript'>
function check_form(){
	form = document.FRM;
	<?
		if($table_id=='table_1628232234'){
	?>
	if(!isOneCheckModal(form.check_1,"���� �̿����� ������ �ֽʽÿ�","fc1"))	return;
	<?
		}
	?>
	if(isFrmEmptyModal(form.title,"������ �Է��� �ֽʽÿ�"))	return;
	if(isFrmEmptyModal(form.name,"�ۼ��ڸ� �Է��� �ֽʽÿ�"))	return;
	if(isFrmEmptyModal(form.passwd,"��й�ȣ�� �Է��� �ֽʽÿ�"))	return;

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
	
	if(confirm('���� �����Ͻðڽ��ϱ�?')){
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
<input type='hidden' name='userid' value="<?=$GBL_USERID?>">
<input type='hidden' name='next_url' value="<?=$PHP_SELF?>">
<input type='hidden' name='record_start' value="<?=$record_start?>">
<input type='hidden' name='field' value="<?=$field?>">
<input type='hidden' name='word' value="<?=$word?>">
<input type='hidden' name='f_data01' value="<?=$f_data01?>">
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


<style>
select#data01 {
width: 200px;
padding: .6rem .5rem;
border: 1px solid #bbb;
font-family: inherit;
/*background: url("/images/arrow.jpg") no-repeat 100%;*/
background: #fff url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='4' height='5' viewBox='0 0 4 5'%3e%3cpath fill='%235a5c69' d='M2 0L0 2h4zm0 5L0 3h4z'/%3e%3c/svg%3e") right 0.75rem center/8px 10px no-repeat;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
}
@media screen and (max-width:640px){
#smart_editor2 {min-width:100% !important; outline:1px solid red;}
}
</style>

<!--���-->



<?
	if($table_id=='table_1628232234'){
		include'agree.php';
	}
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td>


			<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable2'>
<?
if($GBL_MTYPE == 'A'){
?>
				<tr> 
					<th>����</th>
					<td colspan='3'> <input name="notice_chk" type="checkbox" value='1' <?if($notice_chk=='1') echo 'checked';?>> üũ�Ͻ� ��� ����Ʈ�� �ֻ�ܿ� ��µ˴ϴ�</td>
				</tr>
<?
}else{
?>
<input type='hidden' name='notice_chk' value='<?=$notice_chk?>'>
<?
}
?>

				<tr> 
					<th style="border-top:1px solid #ddd;">����</th>
					<td colspan='3' style="border-top:1px solid #ddd;"><input name="title" type="text" style='width:99%;' value="<?=$title?>"></td>
				</tr>
				<?
					if($table_id=='table_1628232234'){
				?>
				<tr> 
					<th width="17%">��㱸��</th>
					<td width="33%">
						<select name="data01" id="data01">
							<option <?if($data01=='���ö�Ʈ') echo'selected';?> value='���ö�Ʈ'>���ö�Ʈ</option>
							<option <?if($data01=='��̳���Ʈ') echo'selected';?> value='��̳���Ʈ'>��̳���Ʈ</option>
							<option <?if($data01=='ġ�ƹ̹�') echo'selected';?> value='ġ�ƹ̹�'>ġ�ƹ̹�</option>
							<option <?if($data01=='��ġ/���溸��ġ��') echo'selected';?> value='��ġ/���溸��ġ��'>��ġ/���溸��ġ��</option>
							<option <?if($data01=='����Ϲ�ġ') echo'selected';?> value='����Ϲ�ġ'>����Ϲ�ġ</option>
							<option <?if($data01=='��Ÿ') echo'selected';?> value='��Ÿ'>��Ÿ</option>
						</select>
					</td>
					<th width="17%">����ó</th>	
					<td width="33%">
						<input name="data02" type="text" style='width:98%;' value="<?=$data02?>">
					</td>
				</tr>
				<?
					}else{
				?>
				<tr> 
					<th width="17%">����ó</th>	
					<td colspan='3'>
						<input name="data02" type="text" style='width:98%;' value="<?=$data02?>">
					</td>
				</tr>
				<?
					}
				?>
				<tr> 
					<th width="17%">�ۼ���</th>
					<td width="33%"><input name="name" type="text" style='width:98%;' value="<?=$name?>"></td>
					<th width="17%">��й�ȣ</th>	
					<td width="33%">
						<input name="passwd" type="password" style='width:50%;' value="<?=$passwd?>">&nbsp;
								
						<input type='radio' name='pwd_chk' value='' <?if(!$pwd_chk) echo 'checked';?>>����
						<input type='radio' name='pwd_chk' value='1' <?if($pwd_chk) echo 'checked';?>>�����
					
					</td>
				</tr>

<?
	if($GBL_MTYPE == 'A'){
?>
				<tr>
					<th>����Ͻ�</th>
					<td colspan='3'>
						<select name='set_ry' style='height:30px;'>
						<?
							for($i=date('Y')+1; $i>=2016; $i--){
								if($i == $set_ry)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��
						<select name='set_rm' style='height:30px;'>
						<?
							for($i=1; $i<=12; $i++){
								$set_rm_no = sprintf('%02d',$i);
								if($i == $set_rm)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��
						<select name='set_rd' style='height:30px;'>
						<?
							for($i=1; $i<=31; $i++){
								$set_rd_no = sprintf('%02d',$i);
								if($i == $set_rd)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��&nbsp;&nbsp;

						<select name='set_rh' style='height:30px;'>
						<?
							for($i=0; $i<=23; $i++){
								$set_rh_no = sprintf('%02d',$i);
								if($i == $set_rh)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��
						<select name='set_ri' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_ri_no = sprintf('%02d',$i);
								if($i == $set_ri)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��
						<select name='set_rs' style='height:30px;'>
						<?
							for($i=0; $i<=59; $i++){
								$set_rs_no = sprintf('%02d',$i);
								if($i == $set_rs)	$chk = 'selected';
								else					$chk = '';

								echo ("<option value='$i' $chk>$i</option>");
							}
						?>
						</select>��&nbsp;&nbsp;
						<input type='button' name='btn_set' value='����ð�' onclick='setToDate(this.form);' style='height:30px;cursor:pointer;'>
					</td>
				</tr>
<?
	}
?>


			</table>


		</td>
	</tr>

	<tr>
		<td style='padding:5px 0px;'><textarea name="ment" id="ment" style='width:100%;height:500px;'><?=$ment?></textarea></td>
	</tr>

<?
if($type == 'write'){
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();" class="btn blk">���</a>&nbsp;
			<a href="javascript:reg_list();" class="btn gry"><!--<a href="javascript:reg_list();">-->���</a>
		</td>
	</tr>
<?
}else{
?>
	<tr>
		<td align='right' height='50'>
			<a href="javascript:check_form();" class="btn grn">����</a>&nbsp;
			<a href="javascript:reg_del();" class="btn red">����</a>&nbsp;
			<a href="javascript:reg_list();" class="btn blk">��Ϻ���</a>
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

	/* ������ ����� ���â ���ֱ� */
	htParams : {
		bUseToolbar : true,
		bUseVerticalResizer : false,
		fOnBeforeUnload : function(){},
		fOnAppLoad : function(){}
	}, 

    fCreator: "createSEditor2"

});

</script>
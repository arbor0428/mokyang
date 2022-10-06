<script language='javascript'>

function reg_review(uid){
	form = document.frm01;
	form.type.value = 're_view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

</script>


<?
if($reply_chk){

	$query01 = "select * from tb_board_reply where upid='$uid' order by uid desc";
	$query02 = mysql_query($query01);
	$r_tot_num = mysql_num_rows($query02);

	for($k=0; $k<$r_tot_num; $k++){
		$row01 = mysql_fetch_array($query02);

		$title = $row01["title"];
		$uid = $row01["uid"];

		//제목 글자수 제한		
		$title = Util::Shorten_String($title,100,'..');


		//답글읽기권한
		include $boardRoot.'chk_review.php';



		if($GBL_MTYPE == 'A'){

?>
				<tr> 
					<td align='center' height='30'></td>
					<td align='center'></td>
					<td style='padding-left:5px;' colspan='5'><img src='<?=$boardRoot?>img/arrow_re.gif'> <?=$btn_review?></td>
				</tr>

<?
		}else{
?>

				<tr> 
					<td align='center' height='31' height='30'></td>
					<td style='padding-left:5px;' colspan='4'><img src='<?=$boardRoot?>img/arrow_re.gif'> <?=$btn_review?></td>
				</tr>

<?
		}
?>
				<tr> 
					<td bgcolor="cccccc"  height="1" colspan="<?=$cols?>"></td>
				</tr>





<?
	}

}
?>
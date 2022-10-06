<?
	include '../header.php';

	$userid = 'efac';
?>

<script language='javascript'>
function isMenuKey(){
	key = event.keyCode;
	arr_filter = Array(33,34,35,36,37,38,39,42,44,46,58,59,60,61,62,63,64,91,92,93,94,96);

	for(i=0; i<arr_filter.length; i++){
		if(key == arr_filter[i]){
			alert('사용할수 없는 문자입니다 ');
			event.returnValue = false;
		}
	}
}
</script>

<style type='text/css'>
.mCadeTit01{
	color:#317cc1;
	font-weight:bold;
	font-size:15px;
}
</style>

	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '3';
			$sNum02 = '3';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
						<form name='frm01' action="<?=$PHP_SELF?>" method='post'>
						<input type='hidden' name='userid' value='<?=$userid?>'>
						<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
						<input type='hidden' name='type' value=''>

						<table cellpadding='0' cellspacing='0' border='0' width='100%'>
							<tr>
								<td>
								<?
									include 'cade01.php';
								?>
								</td>
							</tr>
						</table>

						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>
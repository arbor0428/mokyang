<?
	include '../header.php';

	if(!$type)	$type = 'list';

	$ico01 = "<span class='eq'></span>";
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '1';
			$sNum02 = '2';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
		<form name='frm01' method='post' action=''>
		<input type='text' name='' style='display:none;'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?
						$cellh = '120';	// date cell height
						$tablew = '1000';	// table width
						$c_path = "../../module/calendar";

						include $c_path.'/admin.php';
					?>
					</td>
				</tr>
			</table>
		<input type='hidden' name='year' value='<?=$year?>'>
		<input type='hidden' name='month' value='<?=$month?>'>
		<input type='hidden' name='day' value=''>
		</form>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>
<?
	include '../header.php';

	if(!$type)	$type = 'list';
?>



	<tr>
		<td width='200' valign='top' class='mCon'>
		<?
			$sNum01 = '1';
			$sNum02 = '3';
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1200'>
				<tr>
					<td>
					<?
						switch($type){
							case 'write' :
							case 'edit' : include 'c_popup.php';
												break;
							case 'list' : include 'c_poplist.php';
											break;
						}
					?>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>
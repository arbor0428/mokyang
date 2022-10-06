<?
	include '../header.php';

	if(!$type)	$type = 'list';
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '1';
			$sNum02 = '4';
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?

						switch($type){
							case 'write' :
							case 'edit' : include 'write.php';
												break;
							case 'list' : include 'list.php';
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
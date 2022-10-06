<?
	include '../header.php';

	if(!$type)	$type = 'list';
?>

	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '4';
			$sNum02 = '2';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						if($type == 'list')			include 'list.php';
						elseif($type == 'view')	include 'view.php';
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
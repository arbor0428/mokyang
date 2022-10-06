<?
	include '../header.php';
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '2';
			$sNum02 = '1';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1200'>
				<tr>
					<td>
					<?
						if(!$type)	$type = 'list';

						if($type == 'list')			include 'list.php';
						elseif($type == 'view')	include 'view.php';
						elseif($type == 'edit')	include 'write.php';
						elseif($type == 'write')	include 'write.php';
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
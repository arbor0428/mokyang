<?
	include '../header.php';
?>

	<tr>
		<td width='200' valign='top'>
		<?
			if($GBL_MTYPE == 'P1'){
				$sNum01 = '1';
				$sNum02 = '2';

			}elseif($GBL_MTYPE == 'P2'){
				$sNum01 = '1';
				$sNum02 = '1';

			}else{
				$sNum01 = '4';
				$sNum02 = '2';
			}
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						if(!$type)	$type = 'list';

						if($type == 'list')			include 'list.php';
						elseif($type == 'view')	include 'view.php';
						elseif($type == 'chart')	include 'chart.php';
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
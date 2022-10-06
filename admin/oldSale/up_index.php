<?
	include '../header.php';

	$ico01 = "<span class='eq'></span>";
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '5';
			$sNum02 = '3';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						//제이쿼리 달력
						$sRange = '90';
						$eRange = '0';
						include '../../module/Calendar.php';

						include 'list.php';
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
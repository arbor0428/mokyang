<?
	include '../header.php';
?>

	<tr>
		<td width='200' valign='top'>
		<?
			if($GBL_MTYPE == 'P1' || $GBL_MTYPE == 'P2'){
				$sNum01 = '2';
				$sNum02 = '3';
			}else{
				$sNum01 = '4';
				$sNum02 = '3';
			}
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						//제이쿼리 달력
						$sRange = date('Y') - 2016;
						$eRange = '1';
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
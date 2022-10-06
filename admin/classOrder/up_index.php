<?
	include '../header.php';

	if(!$type)	$type = 'list';
?>

	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '4';
			$sNum02 = '1';
			
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

						//취소버튼활성화 ID
						$cancleBtnID = "fpicker5,fpicker6";

						include '../../module/Calendar.php';

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
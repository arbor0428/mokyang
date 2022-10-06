<?
	include '../header.php';

	if(!$type)	$type = 'list';

	$ico01 = "<span class='eq'></span>";

	//대관장소 및 부대시설 목록
	include '../../module/HallArray.php';
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '1';
			$sNum02 = '1';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?
						if($type == 'list')				include 'list.php';
						elseif($type == 'edit00')		include 'write00.php';
						elseif($type == 'view00')	include 'view00.php';
						elseif($type == 'edit01')		include 'write01.php';	//과거 예술회관 신청폼
						elseif($type == 'view01')	include 'view01.php';	//과거 예술회관 신청폼
						elseif($type == 'edit02')		include 'write02.php';	//과거 숲속극장 신청폼
						elseif($type == 'view02')	include 'view02.php';	//과거 숲속극장 신청폼
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
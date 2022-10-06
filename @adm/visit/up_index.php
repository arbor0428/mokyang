<?
	include '../header.php';

	//최고관리자 & 마스터 & 일반 권한만 허용
	if($GBL_MTYPE != 'A'){
		Msg::goNext('/adm/');
		exit;
	}

	if(!$type)	$type = 'list';

?>

	<tr>
		<td width='200' valign='top' class='mCon'>
		<?
			$sNum01 = '1';
			$sNum02 = '2';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon' height='900'>
			<table cellpadding='0' cellspacing='0' border='0' width='1200'>
				<tr>
					<td>
					<?
						//제이쿼리 달력
						$sRange = '90';
						$eRange = '0';
						include '../../module/Calendar.php';

						if($type == 'list')			include 'list.php';
						elseif($type == 'edit')	include 'write.php';
						elseif($type == 'edit2')	include 'write02.php';
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
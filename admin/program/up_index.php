<?
	include '../header.php';

	if(!$type)	$type = 'list';

	//프로그램 > 강의실 정보관리에서 설정한 값
	$rArr = Array();

	$sql = "select * from ks_roomlist order by sort";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	for($i=0; $i<$num; $i++){
		$row = mysql_fetch_array($result);
		$dbCade01 = $row['cade01'];

		$rArr[$i] = $dbCade01;
	}
?>

	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '3';
			$sNum02 = '4';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						if($type == 'list')			include 'list.php';
						elseif($type == 'edit')	include 'write.php';
						elseif($type == 'write')	include 'write.php';
						elseif($type == 'copy')	include 'copy.php';	//프로그램복사
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
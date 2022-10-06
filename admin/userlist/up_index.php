<?
	include '../header.php';

	if(!$type)	$type = 'list';

	$ico01 = "<span class='eq'></span>";

	//감면구분
	$reductionArr = Array('국가유공자','장애인할인');

	//가입경로
	$joinTypeArr = Array('인터넷검색','지인추천');
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '6';
			if($type == 'write')	$sNum02 = '2';
			else						$sNum02 = '1';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
		<?
			//제이쿼리 달력
			$sRange = '90';
			$eRange = '0';
			include '../../module/Calendar.php';

			if($type == 'list')			include 'list.php';
			elseif($type == 'edit')	include 'write.php';
			elseif($type == 'write')	include 'write.php';
		?>
		</td>
	</tr>
</table>


<?
	include '../footer.php';
?>
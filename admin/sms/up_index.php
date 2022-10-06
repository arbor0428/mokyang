<?
	include '../header.php';

	$SMS_ADMIN = 'efac';

	if(!$type)	$type = 'list';

	if(!$f_year)		$f_year = date('Y');
	if(!$f_month)	$f_month = date('m');
?>



	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '2';
			$sNum02 = '4';

			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
			<table cellpadding='0' cellspacing='0' border='0' width='1000'>
				<tr>
					<td>
					<?
						mysql_close($dbconn);
						unset($db);
						unset($dbconn);

						include '../../module/class/class.DbConSmsHub.php';
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
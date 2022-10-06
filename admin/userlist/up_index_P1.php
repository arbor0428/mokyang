<?
	include '../header.php';

	//강사_1 & 강사2만 허용
	if($GBL_MTYPE != 'P1' && $GBL_MTYPE != 'P2'){
		Msg::goNext('/manager/');
		exit;
	}

	if(!$type)	$type = 'list';

	//감면구분
	$reductionArr = Array('국민기초생활보장수급(생계/의료)','국민기초생활보장수급(주거/교육)','장애인(1~3급)','장애인(4~6급)','국가보훈대상(본인 및 직계가족)','차상위계층','다자녀가족','경로','직원');

	//가입경로
	$joinTypeArr = Array('인터넷검색','지인추천');
?>

	<tr>
		<td width='200' valign='top' class='mCon'>
		<?
			$sNum01 = '1';
			$sNum02 = '1';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon' height='900'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td>
					<?
						//제이쿼리 달력
						$sRange = '90';
						$eRange = '0';
						include '../../module/Calendar.php';

						if($type == 'list')			include 'list_P1.php';
						elseif($type == 'view')	include 'view_P1.php';
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
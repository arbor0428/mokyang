<?
	include '../header.php';

	//최고관리자 & 마스터 허용
	if($GBL_MTYPE != 'A' && $GBL_MTYPE != 'S'){
		Msg::goNext('/manager/');
		exit;
	}

	$cardArr = Array();
	$cardArr['CCBC'] = '비씨';
	$cardArr['CCKM'] = '국민';
	$cardArr['CCNH'] = '농협';
	$cardArr['CCSU'] = '수협';
	$cardArr['CCHM'] = '한미';
	$cardArr['CCPH'] = '평화';
	$cardArr['CCCT'] = '씨티';
	$cardArr['CCSG'] = '신세계';
	$cardArr['CCKE'] = '외환';
	$cardArr['CCCJ'] = '제주';
	$cardArr['CCHN'] = '하나';
	$cardArr['CCSS'] = '삼성';
	$cardArr['CCLG'] = '신한';
	$cardArr['CCKJ'] = '광주';
	$cardArr['CCJB'] = '전북';
	$cardArr['CJCF'] = '해외JCB';
	$cardArr['CCDI'] = '현대';
	$cardArr['CDIF'] = '해외다이너스';
	$cardArr['CCAM'] = '롯데';
	$cardArr['CAMF'] = '해외아멕스';
	$cardArr['CCLO'] = '롯데';
	$cardArr['CVSF'] = '해외비자';
	$cardArr['CMCF'] = '해외마스타';
?>

	<tr>
		<td width='200' valign='top' class='mCon'>
		<?
			$sNum01 = '4';
			$sNum02 = '4';
			
			include '../include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon' height='900'>
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
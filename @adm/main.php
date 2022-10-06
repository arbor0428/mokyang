<?
	if(!($GBL_MTYPE == 'A' || $GBL_MTYPE == 'C')){
		Msg::goMsg('접근오류','/');
		exit;
	}

	$bgc = '#6e9e86';
?>
<link type='text/css' rel='stylesheet' href='/css/admin.css'>
<link type='text/css' rel='stylesheet' href='/css/button.css'>

<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
	<tr>
		<td colspan='2' height='60' style="background:<?=$bgc?>;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
				<tr>
					<td width='200' align='center'><a href="/" onfocus='this.blur();' class="top_m" target='_top'><span class="lnr lnr-home f18"></span>&nbsp; 홈페이지 바로가기</a></td>
					<td align='right' style='padding-right:20px;'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
								<td><a href='/adm/' target='ifra' onfocus='this.blur();' class="top_m">Edit</a></td>
								<td align='center' style='padding:0 20px;color:#fff;'>ㅣ</td>
								<td><a href='/module/login/logout_proc.php' class="top_m" target='_top'>Logout</a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>


	<tr>
		<td width='200' valign='top'>
		<?
			$sNum01 = '1';
			$sNum02 = '1';
			include './include/side_menu.php';
		?>
		</td>
		<td valign='top' class='aCon'>
		<?
			include 'form.php';
		?>
		</td>
	</tr>

</table>




<?
	include 'footer.php';
?>
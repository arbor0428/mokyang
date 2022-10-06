<?
	include "/home/mokyang/www/module/login/headAdmin.php";
	include "/home/mokyang/www/module/class/class.DbCon.php";
	include "/home/mokyang/www/module/class/class.Util.php";
	include "/home/mokyang/www/module/class/class.Msg.php";


	if($GBL_MTYPE && $GBL_MTYPE == 'M'){
		Msg::goMsg('접근오류','/');
		exit;
	}

	$bgc = '#6e9e86';
?>
<meta name='viewport' content='width=1280'>
<link type='text/css' rel='stylesheet' href='/css/admin.css'>
<link type='text/css' rel='stylesheet' href='/css/button.css'>
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">

<style type='text/css'>
.packIco{
	background-color:#cf1919;
	padding:2px 6px;
	text-align:center;
	border-radius:10px;
	color:#fff;
}

.saleIco{
	background-color:#e88402;
	padding:2px 6px;
	text-align:center;
	border-radius:10px;
	color:#fff;
}

</style>
<script src="/js/jquery-migrate-1.2.1.min.js"></script>


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
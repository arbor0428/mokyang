<?
	include "../../module/login/head.php";
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Util.php";
	include "../../module/class/class.Msg.php";

	$programManger = false;

	if($GBL_MTYPE != 'A'){
		$gblArr = Util::ManagerType($GBL_MTYPE);

		$adminBlock = true;


		if(in_array('C',$gblArr)){
			$adminBlock = false;
			$adminReserve = true;
		}

		if(in_array('B',$gblArr))	$adminBlock = false;
		if(in_array('D',$gblArr))	$adminBlock = false;
		if(in_array('P',$gblArr)){
			$adminBlock = false;
			$programManger = true;
		}

		if($adminBlock){
			Msg::goMsg('접근오류','/');
			exit;
		}


	//최고관리자
	}else{
		//대관관리 메뉴활성화
		$adminReserve = true;
	}
?>

<link type='text/css' rel='stylesheet' href='/css/admin.css'>

<style type='text/css'>
.zTable th, .zTable td{font-size:16px;}
.zTable1 th, .zTable1 td{font-size:16px;}
.pTable th, .pTable td{font-size:16px;}
.gTable th, .gTable td{font-size:14px;}
</style>

<table cellpadding='0' cellspacing='0' border='0' width='100%' height='100%'>
	<tr>
		<td colspan='2' height='64' style="background:url('/admin/img/top_bg.gif') repeat-x;">
			<table cellpadding='0' cellspacing='0' border='0' width='100%' align='center'>
				<tr>
					<td width='200' align='center'><a href='/' onfocus='this.blur();' class="top_m" target='_top'>[홈페이지 바로가기]</a></td>
					<td align='right'>
						<table cellpadding='0' cellspacing='0' border='0'>
							<tr>
							<!--
								<td><a href='javascript:file_down()' class="top_m">관리자매뉴얼</a></td>
								<td align='center' style='padding:0 10px;color:#fff;'>|</td>
								-->
								<td><a href='/admin/' target='ifra' onfocus='this.blur();' class="top_m">정보수정</a></td>
								<td align='center' style='padding:0 10px;color:#fff;'>|</td>
								<td><a href='/module/login/logout_proc.php' class="top_m" target='_top'>로그아웃</a></td>
								<td width='20'></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
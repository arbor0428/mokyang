<?
include '../../module/login/head.php';
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Util.php';
include '../../module/class/class.Msg.php';
include '../../module/class/class.FileUpload.php';
include '../../module/file_filtering.php';

if($type == 'edit'){
	//파일업로드
	include 'fileChk.php';



	for($i=1; $i<=10; $i++){
		$n = sprintf('%02d',$i);

		if(${'sDate'.$n})	${'sTime'.$n} = strtotime(${'sDate'.$n});
		else					${'sTime'.$n} = 0;

		if(${'eDate'.$n})	${'eTime'.$n} = strtotime(${'eDate'.$n}) + 86399;
		else					${'eTime'.$n} = 0;
	}



	$sql = "update ks_mainimg set ";
	$sql .= "link01='$link01', ";
	$sql .= "target01='$target01', ";
	$sql .= "sDate01='$sDate01', ";
	$sql .= "sTime01='$sTime01', ";
	$sql .= "eDate01='$eDate01', ";
	$sql .= "eTime01='$eTime01', ";
	$sql .= "upfile01='$arr_new_file[1]',";
	$sql .= "realfile01='$real_name[1]',";
	$sql .= "upfile02='$arr_new_file[2]',";
	$sql .= "realfile02='$real_name[2]',";

	$sql .= "link02='$link02', ";
	$sql .= "target02='$target02', ";
	$sql .= "sDate02='$sDate02', ";
	$sql .= "sTime02='$sTime02', ";
	$sql .= "eDate02='$eDate02', ";
	$sql .= "eTime02='$eTime02', ";
	$sql .= "upfile03='$arr_new_file[3]',";
	$sql .= "realfile03='$real_name[3]',";
	$sql .= "upfile04='$arr_new_file[4]',";
	$sql .= "realfile04='$real_name[4]',";

	$sql .= "link03='$link03', ";
	$sql .= "target03='$target03', ";
	$sql .= "sDate03='$sDate03', ";
	$sql .= "sTime03='$sTime03', ";
	$sql .= "eDate03='$eDate03', ";
	$sql .= "eTime03='$eTime03', ";
	$sql .= "upfile05='$arr_new_file[5]',";
	$sql .= "realfile05='$real_name[5]',";
	$sql .= "upfile06='$arr_new_file[6]',";
	$sql .= "realfile06='$real_name[6]',";

	$sql .= "link04='$link04', ";
	$sql .= "target04='$target04', ";
	$sql .= "sDate04='$sDate04', ";
	$sql .= "sTime04='$sTime04', ";
	$sql .= "eDate04='$eDate04', ";
	$sql .= "eTime04='$eTime04', ";
	$sql .= "upfile07='$arr_new_file[7]',";
	$sql .= "realfile07='$real_name[7]',";
	$sql .= "upfile08='$arr_new_file[8]',";
	$sql .= "realfile08='$real_name[8]',";

	$sql .= "link05='$link05', ";
	$sql .= "target05='$target05', ";
	$sql .= "sDate05='$sDate05', ";
	$sql .= "sTime05='$sTime05', ";
	$sql .= "eDate05='$eDate05', ";
	$sql .= "eTime05='$eTime05', ";
	$sql .= "upfile09='$arr_new_file[9]',";
	$sql .= "realfile09='$real_name[9]',";
	$sql .= "upfile10='$arr_new_file[10]',";
	$sql .= "realfile10='$real_name[10]',";

	$sql .= "link06='$link06', ";
	$sql .= "target06='$target06', ";
	$sql .= "sDate06='$sDate06', ";
	$sql .= "sTime06='$sTime06', ";
	$sql .= "eDate06='$eDate06', ";
	$sql .= "eTime06='$eTime06', ";
	$sql .= "upfile11='$arr_new_file[11]',";
	$sql .= "realfile11='$real_name[11]',";
	$sql .= "upfile12='$arr_new_file[12]',";
	$sql .= "realfile12='$real_name[12]',";

	$sql .= "link07='$link07', ";
	$sql .= "target07='$target07', ";
	$sql .= "sDate07='$sDate07', ";
	$sql .= "sTime07='$sTime07', ";
	$sql .= "eDate07='$eDate07', ";
	$sql .= "eTime07='$eTime07', ";
	$sql .= "upfile13='$arr_new_file[13]',";
	$sql .= "realfile13='$real_name[13]',";
	$sql .= "upfile14='$arr_new_file[14]',";
	$sql .= "realfile14='$real_name[14]',";

	$sql .= "link08='$link08', ";
	$sql .= "target08='$target08', ";
	$sql .= "sDate08='$sDate08', ";
	$sql .= "sTime08='$sTime08', ";
	$sql .= "eDate08='$eDate08', ";
	$sql .= "eTime08='$eTime08', ";
	$sql .= "upfile15='$arr_new_file[15]',";
	$sql .= "realfile15='$real_name[15]',";
	$sql .= "upfile16='$arr_new_file[16]',";
	$sql .= "realfile16='$real_name[16]',";

	$sql .= "link09='$link09', ";
	$sql .= "target09='$target09', ";
	$sql .= "sDate09='$sDate09', ";
	$sql .= "sTime09='$sTime09', ";
	$sql .= "eDate09='$eDate09', ";
	$sql .= "eTime09='$eTime09', ";
	$sql .= "upfile17='$arr_new_file[17]',";
	$sql .= "realfile17='$real_name[17]',";
	$sql .= "upfile18='$arr_new_file[18]',";
	$sql .= "realfile18='$real_name[18]',";

	$sql .= "link10='$link10', ";
	$sql .= "target10='$target10', ";
	$sql .= "sDate10='$sDate10', ";
	$sql .= "sTime10='$sTime10', ";
	$sql .= "eDate10='$eDate10', ";
	$sql .= "eTime10='$eTime10', ";
	$sql .= "upfile19='$arr_new_file[19]',";
	$sql .= "realfile19='$real_name[19]',";
	$sql .= "upfile20='$arr_new_file[20]',";
	$sql .= "realfile20='$real_name[20]'";


	$result = mysql_query($sql);

	Msg::GblMsgBoxParent("저장되었습니다.","location.href='up_index.php';");
	exit;







}elseif($type=='sort'){

	if($dir=='up'){
		$num = sprintf("%02d",$num);
		$num2 = sprintf("%02d",2*$num-1);
		$num3 = sprintf("%02d",2*$num);
		$cnum = sprintf("%02d",$num-1);
		$cnum2 = sprintf("%02d",2*$cnum-1);
		$cnum3 = sprintf("%02d",2*$cnum);

	}elseif($dir=='down'){
		$num = sprintf("%02d",$num);
		$num2 = sprintf("%02d",2*$num-1);
		$num3 = sprintf("%02d",2*$num);
		$cnum = sprintf("%02d",$num+1);
		$cnum2 = sprintf("%02d",2*$cnum-1);
		$cnum3 = sprintf("%02d",2*$cnum);
	}




	$sql = "update ks_mainimg set ";	
	$sql .= "link".$cnum."='${'link'.$num}', ";
	$sql .= "target".$cnum."='${'target'.$num}', ";
	$sql .= "upfile".$cnum2."='${'dbfile'.$num2}',";
	$sql .= "realfile".$cnum2."='${'realfile'.$num2}',";
	$sql .= "upfile".$cnum3."='${'dbfile'.$num3}',";
	$sql .= "realfile".$cnum3."='${'realfile'.$num3}', ";
	$sql .= "link".$num."='${'link'.$cnum}', ";
	$sql .= "target".$num."='${'target'.$cnum}', ";
	$sql .= "upfile".$num2."='${'dbfile'.$cnum2}',";
	$sql .= "realfile".$num2."='${'realfile'.$cnum2}',";
	$sql .= "upfile".$num3."='${'dbfile'.$cnum3}',";
	$sql .= "realfile".$num3."='${'realfile'.$cnum3}'";
	$result = mysql_query($sql);



	Msg::goNext("up_index.php");
	
}
?>
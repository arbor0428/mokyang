<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
include "../../module/class/class.Util.php";
include "../../module/class/class.FileUpload.php";
include "../../module/file_filtering.php";


$tot_num = '3';	//첨부파일 최대갯수
$UPLOAD_DIR = '../../upfile/';


if($type == 'edit'){
	$etxt = 'jpg, gif, png, doc, hwp, pdf, zip 파일만 등록이 가능합니다.';
	$filelist = 'jpg|gif|png|doc|hwp|pdf|zip';


	for($i=1; $i<=$tot_num; $i++){
		$file_num = sprintf("%02d",$i);
		$doc_name	= 'upfile'.$file_num;

		if($_FILES[$doc_name][name]){
			$temp_doc = $_FILES[$doc_name][name];
			file_strip_cut($temp_doc,$etxt,$filelist);

			//용량제한
			if($_FILES[$doc_name][size] > 5242880){
				Msg::backMsg("5MB이상의 파일은 등록할 수 없습니다.");
				exit();
			}
		}
	}



	//파일관련처리
	for($i=1; $i<=$tot_num; $i++){
		$file_num = sprintf("%02d",$i);
		$doc_name	= 'upfile'.$file_num;
		$db_set_file = ${'dbfile'.$file_num};
		$db_real_file = ${'realfile'.$file_num};


		if($_FILES[$doc_name][name]){
			$temp_doc = $_FILES[$doc_name][name];

			//이미지의 경우 자동번호 부여
//			$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
			
			$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

			if($fileUpload->uploadFile()){
				$arr_new_file[$i] = $fileUpload->fileInfo[rename];
			}else{
				Msg::backMsg("파일을 다시 선택해 주십시오");
				exit();
			}

			if($db_set_file){
				unlink($UPLOAD_DIR."/".$db_set_file);
			}

		


			$real_name[$i] = $temp_doc;


		}else{
			if($_POST["del_".$doc_name]=='Y'){
				unlink($UPLOAD_DIR."/".$db_set_file);

				$arr_new_file[$i] = '';
				$real_name[$i] = '';

			}else{
				$arr_new_file[$i] = $db_set_file;
				$real_name[$i] = $db_real_file;
			}
		}
	}


	//예술회관
	$hall01 = '';
	for($i=0; $i<count($hallChk01); $i++){
		$etxt = $hallChk01[$i];
		if($hall01)		$hall01 .= '|^|';
		$hall01 .= $etxt;
	}

	//예술회관 > 부대시설
	$opt01 = '';
	for($i=0; $i<count($optChk01); $i++){
		$etxt = $optChk01[$i];
		if($opt01)		$opt01 .= '|^|';
		$opt01 .= $etxt;
	}

	//숲속극장
	$hall02 = '';

	//숲속극장 > 부대시설
	$opt02 = '';

	//사용기간
	$sDate01Txt = substr($sDate01,0,10);
	$sDate01Arr = explode('-',$sDate01Txt);
	$sTime01 = mktime($sHour01,0,0,$sDate01Arr[1],$sDate01Arr[2],$sDate01Arr[0]);
	$eDate01Txt = substr($eDate01,0,10);
	$eDate01Arr = explode('-',$eDate01Txt);
	$eTime01 = mktime($eHour01,0,0,$eDate01Arr[1],$eDate01Arr[2],$eDate01Arr[0]);

	//기타사항
	if($memo)	$memo = Util::textareaEncodeing($memo);

	//입장료
	if($ticket == '무')	$ticketAmt = 0;

	//비고
	if($notice)	$notice = Util::textareaEncodeing($notice);

	//신청정보수정
	$sql = "update ks_reserve set ";
	$sql .= "status='$status',";
	$sql .= "team='$team',";
	$sql .= "name='$name',";
	$sql .= "phone='$phone',";
	$sql .= "email='$email',";
	$sql .= "title='$title',";
	$sql .= "biznum='$biznum',";
	$sql .= "address='$address',";
	$sql .= "sDate01='$sDate01',";
	$sql .= "sTime01='$sTime01',";
	$sql .= "eDate01='$eDate01',";
	$sql .= "eTime01='$eTime01',";
	$sql .= "hall01='$hall01',";
	$sql .= "opt01='$opt01',";
	$sql .= "temp='$temp',";
	$sql .= "tsHour='$tsHour',";
	$sql .= "teHour='$teHour',";
	$sql .= "memo='$memo',";
	$sql .= "amNum='$amNum',";
	$sql .= "pmNum='$pmNum',";
	$sql .= "ngNum='$ngNum',";
	$sql .= "ticket='$ticket',";
	$sql .= "ticketAmt='$ticketAmt',";
	$sql .= "upfile01='$arr_new_file[1]',";
	$sql .= "realfile01='$real_name[1]',";
	$sql .= "upfile02='$arr_new_file[2]',";
	$sql .= "realfile02='$real_name[2]',";
	$sql .= "upfile03='$arr_new_file[3]',";
	$sql .= "realfile03='$real_name[3]',";
	$sql .= "staff='$staff',";
	$sql .= "notice='$notice'";
	$sql .= " where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '수정되었습니다.';




}elseif($type == 'del'){

	$sql = "select * from ks_reserve where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$upfile01 = $row['upfile01'];
	$upfile02 = $row['upfile02'];
	$upfile03 = $row['upfile03'];

	for($i=1; $i<=$tot_num; $i++){
		$no = sprintf('%02',$i);

		$upfile = ${'upfile'.$no};
		if($upfile)	unlink($UPLOAD_DIR."/".$upfile);
	}


	$sql = "delete from ks_reserve where uid='$uid'";
	$result = mysql_query($sql);

	$msg = '삭제되었습니다.';
}
?>

<?
	if($msg){
?>

<script language='javascript'>
function OrderSave(){
	parent.GblMsgBox("<?=$msg?>","reg_list();");
}

OrderSave();
</script>

<?
	}
?>

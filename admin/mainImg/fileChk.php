<?


	$tot_num = '20';	//첨부파일 최대갯수
	$UPLOAD_DIR = '../../upfile/main/';


	$etxt = 'jpg, gif, png, 파일만 등록이 가능합니다.';
	$filelist = 'jpg|gif|png';


	for($i=1; $i<=$tot_num; $i++){
		$file_num = sprintf("%02d",$i);
		$doc_name	= 'upfile'.$file_num;

		if($_FILES[$doc_name][name]){
			$temp_doc = $_FILES[$doc_name][name];
			file_strip_cut($temp_doc,$etxt,$filelist);

			//용량제한
			$fsize = $_FILES[$doc_name][size] / 1024;

			if($fsize > 5210){
				Msg::GblMsgBoxParent("5M이상의 파일은 등록할 수 없습니다.",'');
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

			//자동번호 부여			
			$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'M');

			if($fileUpload->uploadFile()){
				$arr_new_file[$i] = $fileUpload->fileInfo[rename];
			}else{
				Msg::GblMsgBoxParent("파일을 다시 선택해 주십시오",'');
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
?>
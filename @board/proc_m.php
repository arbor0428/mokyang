<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";
include "../module/class/class.FileUpload.php";
include "../module/class/class.gd.php";
include "../module/class/class.Util.php";



$tot_num = '5';	//첨부파일 최대갯수

$UPLOAD_DIR = "./upfile";







switch($type){
	case 'write' :
	case 'edit' :


		//첨부파일제한
		include '../module/file_filtering.php';


		//파일관련처리
		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$doc_name	= 'upfile'.$file_num;
			$db_set_file = ${'dbfile'.$file_num};
			$db_real_file = ${'realfile'.$file_num};

			if($_FILES[$doc_name][name]){
				$temp_doc = $_FILES[$doc_name][name];		

				//파일필터링
				file_strip($temp_doc);


				//이미지의 경우 자동번호 부여
				$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
				$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

				if($db_set_file){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/small/s_".$db_set_file))	unlink($UPLOAD_DIR."/small/s_".$db_set_file);
				}

				if($fileUpload->uploadFile()){
					$arr_new_file[$i] = $fileUpload->fileInfo[rename];
				}else{
					Msg::backMsg("파일을 다시 선택해 주십시오");
					exit();
				}

				if(in_array($ext, array('jpg','jpeg','gif','bmp'))){
/*

				##### 썸네일 생성관련 #####

					$Thumb_size = '250';

					$file_path = './upfile/';
					$Thumb_name = 's_'.$arr_new_file[$i];
					$copy_file = copy($file_path.$arr_new_file[$i], $file_path.'small/'.$Thumb_name);

					if(!$copy_file){
						echo ("file copy error");
					}else{
						//작은이미지
						$file = $file_path.$arr_new_file[$i];
						$saveDir = $file_path.'small/'; // 저장할 경로
						$saveName = $Thumb_name; // 이미지명
						$sFactor = $Thumb_size; // 허용이미지 사이즈
						$s_img = imgThumbo($file, $saveName, $sFactor, $saveDir);

					}

				###################
*/

				}


				$real_name[$i] = $temp_doc;


			}else{
				if($_POST["del_".$doc_name]=='Y'){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/small/s_".$db_set_file))	unlink($UPLOAD_DIR."/small/s_".$db_set_file);
					$arr_new_file[$i] = '';
					$real_name[$i] = '';
				}else{
					$arr_new_file[$i] = $db_set_file;
					$real_name[$i] = $db_real_file;
				}
			}


		}




		if($ment){
			$ment = Util::textareaEncodeing($ment);
		}

		



		$reg_date = mktime();
		$user_ip = $_SERVER['REMOTE_ADDR'];


		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
			$title = eregi_replace("'", "&#39;", $title);
		}

		if($name){
			$name = eregi_replace("\|", "&#124;", $name);
			$name = eregi_replace("<", "&lt;", $name);
			$name = eregi_replace(">", "&gt;", $name);
			$name = eregi_replace("\"", "&quot;", $name);
			$name = eregi_replace("'", "&#39;", $name);
		}

		if($ment)		$ment = addslashes($ment);

//		$ment = iconv('CP949','EUC-KR//IGNORE',$ment);


		if($set_ry && $set_rm && $set_rd){
			$set_reg_date = mktime($set_rh,$set_ri,$set_rs,$set_rm,$set_rd,$set_ry);
			$reg_date = $set_reg_date;
		}
		

		if($type=='write'){

			if(!$userid)	$userid = '비회원';

			$sql = "insert into tb_board_list  (userid,table_id,site,title,name,email,passwd,pwd_chk,notice_chk,ment,data01,data02,data03,data04,data05,sData01 ,sData02 ,hit,ip,userfile01,userfile02,userfile03,userfile04,userfile05,realfile01,realfile02,realfile03,realfile04,realfile05,reg_date) values ";
			$sql .= "('$userid','$table_id','$GBL_SITE','$title','$name','$email','$passwd','$pwd_chk','$notice_chk','$ment','$data01','$data02','$data03','$data04','$data05','$sData01','$sData02',0,'$user_ip','$arr_new_file[1]','$arr_new_file[2]','$arr_new_file[3]','$arr_new_file[4]','$arr_new_file[5]','$real_name[1]','$real_name[2]','$real_name[3]','$real_name[4]','$real_name[5]','$reg_date')";
			$result = mysqli_query($dbc,$sql);
			$msg = '등록되었습니다';

			$next_url .= '?field='.$field.'&word='.$word.'&f_data01='.$f_data01;


		}else{
			$sql = "update tb_board_list set ";
			$sql .= "title='$title', ";
			$sql .= "name='$name', ";
			$sql .= "email='$email', ";
			$sql .= "passwd='$passwd', ";
			$sql .= "pwd_chk='$pwd_chk', ";
			$sql .= "notice_chk='$notice_chk', ";
			$sql .= "ment='$ment', ";
			$sql .= "sData01='$sData01', ";
			$sql .= "sData02='$sData02', ";
			$sql .= "data01='$data01', ";
			$sql .= "data02='$data02', ";
			$sql .= "data03='$data03', ";
			$sql .= "data04='$data04', ";
			$sql .= "data05='$data05' ";

			if($arr_new_file[1] || $del_upfile01=='Y'){
				$sql .= ", userfile01='$arr_new_file[1]' ";
				$sql .= ", realfile01='$real_name[1]' ";
			}

			if($arr_new_file[2] || $del_upfile02=='Y'){
				$sql .= ", userfile02='$arr_new_file[2]' ";
				$sql .= ", realfile02='$real_name[2]' ";
			}

			if($arr_new_file[3] || $del_upfile03=='Y'){
				$sql .= ", userfile03='$arr_new_file[3]' ";
				$sql .= ", realfile03='$real_name[3]' ";
			}

			if($arr_new_file[4] || $del_upfile04=='Y'){
				$sql .= ", userfile04='$arr_new_file[4]' ";
				$sql .= ", realfile04='$real_name[4]' ";
			}

			if($arr_new_file[5] || $del_upfile05=='Y'){
				$sql .= ", userfile05='$arr_new_file[5]' ";
				$sql .= ", realfile05='$real_name[5]' ";
			}

			if($set_reg_date){
				$sql .= ", reg_date='$set_reg_date' ";
			}


			$sql .= " where uid=$uid";
			$result = mysqli_query($dbc,$sql);

			$msg = '수정되었습니다';
			
		}

		$next_url .= '?field='.$field.'&word='.$word.'&f_data01='.$f_data01;


		break;




	case 'del' :

		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysqli_query($dbc,$sql);
		$row = mysqli_fetch_array($result);

		for($i=1; $i<=5; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
				if(is_file($UPLOAD_DIR."/small/s_".$del_file))	unlink($UPLOAD_DIR."/small/s_".$del_file);
			}
		}

		$sql = "delete from tb_board_list where uid=$uid";
		$result = mysqli_query($dbc,$sql);



		//등록된 한줄의견 삭제
		$sql = "delete from tb_board_coment where pid=$uid";
		$result = mysqli_query($dbc,$sql);


		//등록된 답글 삭제
		$sql = "delete from tb_board_reply where upid=$uid";
		$result = mysqli_query($dbc,$sql);


		$msg = '삭제되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;


	case 'all_del' :

		for($k=0; $k<count($chk); $k++){

			$sql = "select * from tb_board_list where uid='$chk[$k]'";
			$result = mysqli_query($dbc,$sql);
			$row = mysqli_fetch_array($result);

			for($i=1; $i<=5; $i++){
				$file_num = sprintf("%02d",$i);
				$del_file = $row["userfile".$file_num];

				if($del_file){
					unlink($UPLOAD_DIR."/".$del_file);
					if(is_file($UPLOAD_DIR."/small/s_".$del_file))	unlink($UPLOAD_DIR."/small/s_".$del_file);
				}
			}

			$sql = "delete from tb_board_list where uid=$chk[$k]";
			$result = mysqli_query($dbc,$sql);

			//등록된 한줄의견 삭제
			$sql = "delete from tb_board_coment where pid=$chk[$k]";
			$result = mysqli_query($dbc,$sql);

			//등록된 답글 삭제
			$sql = "delete from tb_board_reply where upid=$chk[$k]";
			$result = mysqli_query($dbc,$sql);

		}

		$msg = '삭제되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;







	case 're_write' :

		$reg_date = mktime();
		$user_ip = $_SERVER['REMOTE_ADDR'];


		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
		}

		if(!$userid)	$userid = '비회원';

		$sql = "insert into tb_board_reply  (upid,userid,title,name,email,passwd,ment,hit,ip,reg_date) values ";
		$sql .= "('$upid','$userid','$title','$name','$email','$passwd','$ment',0,'$user_ip','$reg_date')";
		$result = mysqli_query($dbc,$sql);
		$msg = '등록되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;





	case 're_edit' :

		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
		}

		$sql = "update tb_board_reply set ";
		$sql .= "title='$title', ";
		$sql .= "name='$name', ";
		$sql .= "email='$email', ";
		$sql .= "passwd='$passwd', ";
		$sql .= "ment='$ment' ";
		$sql .= " where uid=$uid";
		$result = mysqli_query($dbc,$sql);

		$msg = '수정되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;




	case 're_del' :


		$sql = "delete from tb_board_reply where uid=$uid";
		$result = mysqli_query($dbc,$sql);

		$msg = '삭제되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;



}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>

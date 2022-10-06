<?
include "../module/class/class.DbCon.php";
include "../module/class/class1.Msg.php";
include "../module/class/class.FileUpload.php";
include "../module/class/class.gd.php";
include "../module/class/class.Util.php";


$tot_num = '5';	//÷������ �ִ밹��

$UPLOAD_DIR = "./upfile";

switch($type){

	case 'write' :
	case 'edit' :

		//÷����������
		include '../module/file_filtering.php';

		//���ϰ���ó��
		for($i=1; $i<=$tot_num; $i++){
			$file_num = sprintf("%02d",$i);
			$doc_name	= 'upfile'.$file_num;
			$db_set_file = ${'dbfile'.$file_num};
			$db_real_file = ${'realfile'.$file_num};

			if($_FILES[$doc_name][name]){
				$temp_doc = $_FILES[$doc_name][name];		

				//�������͸�
				file_strip($temp_doc);

				//�̹����� ��� �ڵ���ȣ �ο�
				$ext = FileUpload::getFileExtension($_FILES[$doc_name][name]);
				$fileUpload = new FileUpload($UPLOAD_DIR,$_FILES[$doc_name],'P');

				if($db_set_file){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/small/s_".$db_set_file))	unlink($UPLOAD_DIR."/small/s_".$db_set_file);
				}

				if($fileUpload->uploadFile()){
					$arr_new_file[$i] = $fileUpload->fileInfo[rename];
				}else{
					Msg::backMsg("������ �ٽ� ������ �ֽʽÿ�");
					exit();
				}

				if(in_array($ext, array('jpg','jpeg','gif','bmp'))){
/*

				##### ����� �������� #####

					$Thumb_size = '250';

					$file_path = './upfile/';
					$Thumb_name = 's_'.$arr_new_file[$i];
					$copy_file = copy($file_path.$arr_new_file[$i], $file_path.'small/'.$Thumb_name);

					if(!$copy_file){
						echo ("file copy error");
					}else{
						//�����̹���
						$file = $file_path.$arr_new_file[$i];
						$saveDir = $file_path.'small/'; // ������ ���
						$saveName = $Thumb_name; // �̹�����
						$sFactor = $Thumb_size; // ����̹��� ������
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

		if($list_mod == '�������亯��' && $ment){
			$ment = Util::textareaEncodeing($ment);
		}

		//����/���� > ��������
		if($table_id == 'table_1512610572'){
			//����
			if($sDate){
				$startDate = $sDate;
				$sDateTxt = substr($sDate,0,10);
				$sDateArr = explode('-',$sDateTxt);
				$startTime = mktime(0,0,0,$sDateArr[1],$sDateArr[2],$sDateArr[0]);
			}

			if($eDate){
				$endDate = $eDate;
				$eDateTxt = substr($eDate,0,10);
				$eDateArr = explode('-',$eDateTxt);
				$endTime = mktime(0,0,0,$eDateArr[1],$eDateArr[2],$eDateArr[0]);
			}

			//���ܼ���
			if($sDataTxt)	$sDataTxt = Util::textareaEncodeing($sDataTxt);
		}

		//����ü� > ����ȭ����ȸ�� or ���ӱ���
		if($table_id == 'table_1512604386' || $table_id == 'table_1512977894'){
			if($data01)	$data01 = Util::textareaEncodeing($data01);
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

//		if($ment)		$ment = addslashes($ment);

//		$ment = iconv('CP949','EUC-KR//IGNORE',$ment);

		if($set_ry && $set_rm && $set_rd){
			$set_reg_date = mktime($set_rh,$set_ri,$set_rs,$set_rm,$set_rd,$set_ry);
			$reg_date = $set_reg_date;
		}
		
		if($type=='write'){

			if(!$userid)	$userid = '��ȸ��';

			$sql = "insert into tb_board_list  (pid,userid,table_id,title,name,email,passwd,pwd_chk,notice_chk,totalNotice_chk,ment,data01,data02,data03,data04,data05,sData01 ,sData02,sData03,sData04,sData05,sData06,sData07 ,hit,ip,userfile01,userfile02,userfile03,userfile04,userfile05,realfile01,realfile02,realfile03,realfile04,realfile05,reg_date) values ";
			$sql .= "('$pid','$userid','$table_id','$title','$name','$email','$passwd','$pwd_chk','$notice_chk','$totalNotice_chk','$ment','$data01','$data02','$data03','$data04','$data05','$sData01','$sData02','$sData03','$sData04','$sData05','$sData06','$sData07',0,'$user_ip','$arr_new_file[1]','$arr_new_file[2]','$arr_new_file[3]','$arr_new_file[4]','$arr_new_file[5]','$real_name[1]','$real_name[2]','$real_name[3]','$real_name[4]','$real_name[5]','$reg_date')";
			$result = mysqli_query($dbc,$sql);

			//include "../module/email.php";

			$msg = '��ϵǾ����ϴ�';

			$next_url .= '?field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		}else{
			$sql = "update tb_board_list set ";
			$sql .= "title='$title', ";
			$sql .= "name='$name', ";
			$sql .= "email='$email', ";
			$sql .= "passwd='$passwd', ";
			$sql .= "pwd_chk='$pwd_chk', ";
			$sql .= "notice_chk='$notice_chk', ";
			$sql .= "totalNotice_chk='$totalNotice_chk', ";
			$sql .= "ment='$ment', ";
			$sql .= "sData01='$sData01', ";
			$sql .= "sData02='$sData02', ";
			$sql .= "sData03='$sData03', ";
			$sql .= "sData04='$sData04', ";
			$sql .= "sData05='$sData05', ";
			$sql .= "sData06='$sData06', ";
			$sql .= "sData07='$sData07', ";
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

			$msg = '�����Ǿ����ϴ�';
			
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



		//��ϵ� �����ǰ� ����
		$sql = "delete from tb_board_coment where pid=$uid";
		$result = mysqli_query($dbc,$sql);


		//��ϵ� ��� ����
		$sql = "delete from tb_board_reply where upid=$uid";
		$result = mysqli_query($dbc,$sql);


		$msg = '�����Ǿ����ϴ�';
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

			//��ϵ� �����ǰ� ����
			$sql = "delete from tb_board_coment where pid=$chk[$k]";
			$result = mysqli_query($dbc,$sql);

			//��ϵ� ��� ����
			$sql = "delete from tb_board_reply where upid=$chk[$k]";
			$result = mysqli_query($dbc,$sql);

		}

		$msg = '�����Ǿ����ϴ�';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;







	case 're_write' :

		$reg_date = mktime();
		$user_ip = $_SERVER['REMOTE_ADDR'];

		if($set_ry && $set_rm && $set_rd){
			$set_reg_date = mktime($set_rh,$set_ri,$set_rs,$set_rm,$set_rd,$set_ry);
			$reg_date = $set_reg_date;
		}

		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
		}

		if(!$userid)	$userid = '��ȸ��';

		$sql = "insert into tb_board_reply  (upid,userid,title,name,email,passwd,ment,hit,ip,reg_date) values ";
		$sql .= "('$upid','$userid','$title','$name','$email','$passwd','$ment',0,'$user_ip','$reg_date')";
		$result = mysqli_query($dbc,$sql);
		$msg = '��ϵǾ����ϴ�';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;





	case 're_edit' :

		if($title){
			$title = eregi_replace("\|", "&#124;", $title);
			$title = eregi_replace("<", "&lt;", $title);
			$title = eregi_replace(">", "&gt;", $title);
			$title = eregi_replace("\"", "&quot;", $title);
		}

		if($set_ry && $set_rm && $set_rd){
			$set_reg_date = mktime($set_rh,$set_ri,$set_rs,$set_rm,$set_rd,$set_ry);
			$reg_date = $set_reg_date;
		}

		$sql = "update tb_board_reply set ";
		$sql .= "title='$title', ";
		$sql .= "name='$name', ";
		$sql .= "email='$email', ";
		$sql .= "passwd='$passwd', ";
		if($set_reg_date){
			$sql .= " reg_date='$set_reg_date', ";
		}
		$sql .= "ment='$ment' ";
		$sql .= " where uid=$uid";
		$result = mysqli_query($dbc,$sql);


		$msg = '�����Ǿ����ϴ�';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;




	case 're_del' :


		$sql = "delete from tb_board_reply where uid=$uid";
		$result = mysqli_query($dbc,$sql);

		$msg = '�����Ǿ����ϴ�';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;



}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>

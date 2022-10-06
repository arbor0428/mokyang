<?
include "../module/class/class.DbCon.php";
include "../module/class/class.Msg.php";
include "../module/class/class.FileUpload.php";
include "../module/class/class.gd.php";
include "../module/class/class.Util.php";






$tot_num = '10';	//첨부파일 최대갯수

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
					if(is_file($UPLOAD_DIR."/s_".$db_set_file))	unlink($UPLOAD_DIR."/s_".$db_set_file);
				}

				if($fileUpload->uploadFile()){
					$arr_new_file[$i] = $fileUpload->fileInfo[rename];
				}else{
					Msg::backMsg("파일을 다시 선택해 주십시오");
					exit();
				}


				$real_name[$i] = $temp_doc;


			}else{
				if($_POST["del_".$doc_name]=='Y'){
					unlink($UPLOAD_DIR."/".$db_set_file);
					if(is_file($UPLOAD_DIR."/s_".$db_set_file))	unlink($UPLOAD_DIR."/s_".$db_set_file);
					$arr_new_file[$i] = '';
					$real_name[$i] = '';
				}else{
					$arr_new_file[$i] = $db_set_file;
					$real_name[$i] = $db_real_file;
				}
			}


		}



		if($list_mod == '질문과답변형' && $ment){
			$ment = Util::textareaEncodeing($ment);
		}


		//공유 자원 플랫폼 > 인적자원
		if($table_id == 'table_1639985724'){
			$bsTime = strtotime($bsDate);
			$beTime = strtotime($beDate) + 86399;

			$gsTime = strtotime($gsDate);
			$geTime = strtotime($geDate) + 86399;

			$yoil = '';
			if($ylist){
				foreach($ylist as $k => $v){
					if($yoil)	$yoil .= ',';
					$yoil .= $v;
				}
			}

		//공유 자원 플랫폼 > 물적자원
		}elseif($table_id == 'table_1639985732'){
			if($sData01)	$sData01 = str_replace(',','',$sData01);
		}

		if($startDate)	$startTime = strtotime($startDate);
		if($endDate)	$endTime = strtotime($endDate) + 86399;
		if($sDate)		$sTime = strtotime($sDate);
		if($eDate)		$eTime = strtotime($eDate) + 86399;


		$reg_date = time();
		$user_ip = $_SERVER['REMOTE_ADDR'];

		$title = Util::textareaEncodeing($title);
		$name = Util::textareaEncodeing($name);

		if($title)		$title = addslashes($title);
		if($name)	$name = addslashes($name);
		if($ment)		$ment = addslashes($ment);

//		$ment = iconv('CP949','EUC-KR//IGNORE',$ment);


		if($set_ry && $set_rm && $set_rd){
			$set_reg_date = mktime($set_rh,$set_ri,$set_rs,$set_rm,$set_rd,$set_ry);
			$reg_date = $set_reg_date;
		}
		

		if($type=='write'){

			if(!$userid)	$userid = '비회원';

			$sql = "insert into tb_board_list  (userid,table_id,title,name,email,passwd,pwd_chk,notice_chk,ment,data01,data02,data03,data04,data05,hit,ip,userfile01,userfile02,userfile03,userfile04,userfile05,userfile06,userfile07,userfile08,userfile09,userfile10,realfile01,realfile02,realfile03,realfile04,realfile05,realfile06,realfile07,realfile08,realfile09,realfile10,reg_date,sData01,sData02,sData03,sData04,sData05,sData06,sData07,sData08,sDataTxt,sDataUrl,startDate,startTime,endDate,endTime,sDate,sTime,eDate,eTime) values ";
			$sql .= "('$userid','$table_id','$title','$name','$email','$passwd','$pwd_chk','$notice_chk','$ment','$data01','$data02','$data03','$data04','$data05',0,'$user_ip','$arr_new_file[1]','$arr_new_file[2]','$arr_new_file[3]','$arr_new_file[4]','$arr_new_file[5]','$arr_new_file[6]','$arr_new_file[7]','$arr_new_file[8]','$arr_new_file[9]','$arr_new_file[10]','$real_name[1]','$real_name[2]','$real_name[3]','$real_name[4]','$real_name[5]','$real_name[6]','$real_name[7]','$real_name[8]','$real_name[9]','$real_name[10]','$reg_date','$sData01','$sData02','$sData03','$sData04','$sData05','$sData06','$sData07','$sData08','$sDataTxt','$sDataUrl','$startDate','$startTime','$endDate','$endTime','$sDate','$sTime','$eDate','$eTime')";
			$result = mysql_query($sql);


			//공유 자원 플랫폼 > 인적자원
			if($table_id == 'table_1639985724'){
				$pid = sqlRowOne("select uid from tb_board_list where reg_date='$reg_date' order by uid desc limit 1");
				sqlExe("insert into ks_bongsa01 (pid,bsDate,bsTime,beDate,beTime,bsHour,bsMin,beHour,beMin,gsDate,gsTime,geDate,geTime,yoil,people,cade01,cade02,adult,boy,agent,loc01,loc02,place,bTarget,actType) values ('$pid','$bsDate','$bsTime','$beDate','$beTime','$bsHour','$bsMin','$beHour','$beMin','$gsDate','$gsTime','$geDate','$geTime','$yoil','$people','$cade01','$cade02','$adult','$boy','$agent','$loc01','$loc02','$place','$bTarget','$actType')");
			}
				


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
			$sql .= "data01='$data01', ";
			$sql .= "data02='$data02', ";
			$sql .= "data03='$data03', ";
			$sql .= "data04='$data04', ";
			$sql .= "data05='$data05', ";
			$sql .= "sData01='$sData01', ";
			$sql .= "sData02='$sData02', ";
			$sql .= "sData03='$sData03', ";
			$sql .= "sData04='$sData04', ";
			$sql .= "sData05='$sData05', ";
			$sql .= "sData06='$sData06', ";
			$sql .= "sData07='$sData07', ";
			$sql .= "sData08='$sData08', ";
			$sql .= "sDataTxt='$sDataTxt', ";
			$sql .= "sDataUrl='$sDataUrl', ";			
			$sql .= "startDate='$startDate', ";
			$sql .= "startTime='$startTime', ";
			$sql .= "endDate='$endDate', ";
			$sql .= "endTime='$endTime', ";
			$sql .= "sDate='$sDate', ";
			$sql .= "sTime='$sTime', ";
			$sql .= "eDate='$eDate', ";
			$sql .= "eTime='$eTime' ";

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

			if($arr_new_file[6] || $del_upfile06=='Y'){
				$sql .= ", userfile06='$arr_new_file[6]' ";
				$sql .= ", realfile06='$real_name[6]' ";
			}

			if($arr_new_file[7] || $del_upfile07=='Y'){
				$sql .= ", userfile07='$arr_new_file[7]' ";
				$sql .= ", realfile07='$real_name[7]' ";
			}

			if($arr_new_file[8] || $del_upfile08=='Y'){
				$sql .= ", userfile08='$arr_new_file[8]' ";
				$sql .= ", realfile08='$real_name[8]' ";
			}

			if($arr_new_file[9] || $del_upfile09=='Y'){
				$sql .= ", userfile09='$arr_new_file[9]' ";
				$sql .= ", realfile09='$real_name[9]' ";
			}

			if($arr_new_file[10] || $del_upfile10=='Y'){
				$sql .= ", userfile10='$arr_new_file[10]' ";
				$sql .= ", realfile10='$real_name[10]' ";
			}

			if($set_reg_date){
				$sql .= ", reg_date='$set_reg_date' ";
			}


			$sql .= " where uid=$uid";
			$result = mysql_query($sql);




			//공유 자원 플랫폼 > 인적자원
			if($table_id == 'table_1639985724'){
				$sql = "update ks_bongsa01 set ";
				$sql .= "bsDate='$bsDate', ";
				$sql .= "bsTime='$bsTime', ";
				$sql .= "beDate='$beDate', ";
				$sql .= "beTime='$beTime', ";
				$sql .= "bsHour='$bsHour', ";
				$sql .= "bsMin='$bsMin', ";
				$sql .= "beHour='$beHour', ";
				$sql .= "beMin='$beMin', ";
				$sql .= "gsDate='$gsDate', ";
				$sql .= "gsTime='$gsTime', ";
				$sql .= "geDate='$geDate', ";
				$sql .= "geTime='$geTime', ";
				$sql .= "yoil='$yoil', ";
				$sql .= "people='$people', ";
				$sql .= "cade01='$cade01', ";
				$sql .= "cade02='$cade02', ";
				$sql .= "adult='$adult', ";
				$sql .= "boy='$boy', ";
				$sql .= "agent='$agent', ";
				$sql .= "loc01='$loc01', ";
				$sql .= "loc02='$loc02', ";
				$sql .= "place='$place', ";
				$sql .= "bTarget='$bTarget', ";
				$sql .= "actType='$actType' ";
				$sql .= "where pid=$uid";
				sqlExe($sql);
			}



			$msg = '수정되었습니다';
			
		}

		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;


		break;


	//공유 자원 플랫폼 > 인적자원 신청
	case 'join01' :
		$userip = $_SERVER['REMOTE_ADDR'];
		$rDate = date('Y-m-d H:i:s');
		$rTime = time();

		//신청접수
		sqlExe("insert into ks_bongsa01_join (pid,userid,userip,rDate,rTime) values ('$uid','$userid','$userip','$rDate','$rTime')");

		$msg = '접수되었습니다';

		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;


	case 'del' :

		$sql = "select * from tb_board_list where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$table_id = $row['table_id'];

		for($i=1; $i<=5; $i++){
			$file_num = sprintf("%02d",$i);
			$del_file = $row["userfile".$file_num];

			if($del_file){
				unlink($UPLOAD_DIR."/".$del_file);
				if(is_file($UPLOAD_DIR."/s_".$del_file))	unlink($UPLOAD_DIR."/s_".$del_file);
			}
		}

		$sql = "delete from tb_board_list where uid=$uid";
		$result = mysql_query($sql);



		//등록된 한줄의견 삭제
		$sql = "delete from tb_board_coment where pid=$uid";
		$result = mysql_query($sql);


		//등록된 답글 삭제
		$sql = "delete from tb_board_reply where upid=$uid";
		$result = mysql_query($sql);


		//공유 자원 플랫폼 > 인적자원
		if($table_id == 'table_1639985724'){
			$sql = "delete from ks_bongsa01 where pid=$uid";
			$result = mysql_query($sql);
		}


		$msg = '삭제되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;


	case 'all_del' :

		for($k=0; $k<count($chk); $k++){

			$sql = "select * from tb_board_list where uid='$chk[$k]'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			for($i=1; $i<=5; $i++){
				$file_num = sprintf("%02d",$i);
				$del_file = $row["userfile".$file_num];

				if($del_file){
					unlink($UPLOAD_DIR."/".$del_file);
					if(is_file($UPLOAD_DIR."/s_".$del_file))	unlink($UPLOAD_DIR."/s_".$del_file);
				}
			}

			$sql = "delete from tb_board_list where uid=$chk[$k]";
			$result = mysql_query($sql);

			//등록된 한줄의견 삭제
			$sql = "delete from tb_board_coment where pid=$chk[$k]";
			$result = mysql_query($sql);

			//등록된 답글 삭제
			$sql = "delete from tb_board_reply where upid=$chk[$k]";
			$result = mysql_query($sql);

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
		$result = mysql_query($sql);
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
		$result = mysql_query($sql);

		$msg = '수정되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;




	case 're_del' :


		$sql = "delete from tb_board_reply where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';
		$next_url .= '?record_start='.$record_start.'&field='.$field.'&word='.$word.'&f_data01='.$f_data01;

		break;



}


unset($objProc);
unset($dbconn);

Msg::goMsg($msg,$next_url);
?>

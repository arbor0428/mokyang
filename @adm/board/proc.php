<?
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";



switch($type){
	case 'write' :
	case 'edit' :

		$reg_date = time();


		if($title){
			$title = str_replace("\|", "&#124;", $title);
			$title = str_replace("<", "&lt;", $title);
			$title = str_replace(">", "&gt;", $title);
			$title = str_replace("\"", "&quot;", $title);
		}

		if(!$write_chk)	$write_chk = $db_write_chk;
		if(!$write_chk)	$write_chk = '전체';

		if(!$read_chk)	$read_chk = '전체';

		

		if($type=='write'){

			$table_id = 'table_'.$reg_date;

			$sql = "insert into tb_board_set  (table_id,title,write_chk,read_chk,reply_chk,coment_chk,upload_chk,download_chk,list_mod,reg_date) values ";
			$sql .= "('$table_id','$title','$write_chk','$read_chk','$reply_chk','$coment_chk','$upload_chk','$download_chk','$list_mod','$reg_date')";
			$result = mysql_query($sql);
			$msg = '등록되었습니다';

		}else{
			$sql = "update tb_board_set set ";
			$sql .= "title='$title', ";
			$sql .= "write_chk='$write_chk', ";
			$sql .= "read_chk='$read_chk', ";
			$sql .= "reply_chk='$reply_chk', ";
			$sql .= "coment_chk='$coment_chk', ";
			$sql .= "upload_chk='$upload_chk', ";
			$sql .= "download_chk='$download_chk', ";
			$sql .= "list_mod='$list_mod' ";
			$sql .= " where uid=$uid";
			$result = mysql_query($sql);


			$msg = '수정되었습니다';
			$next_url = './up_index.php?record_count='.$record_count.'&field='.$field.'&word='.$word;
		}


		break;




	case 'del' :

		$UPLOAD_DIR = "../../board/upfile";

		//삭제할 게시판에 등록된 글 삭제
		$sql = "select * from tb_board_set where uid=$uid";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);
		$table_id = $row[table_id];

		$sql = "select * from tb_board_list where table_id='$table_id'";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);


		for($k=0; $k<$num; $k++){

			$row = mysql_fetch_array($result);
			$board_id = $row[uid];

			for($i=1; $i<=5; $i++){
				$file_num = sprintf("%02d",$i);
				$del_file = $row["userfile".$file_num];

				if($del_file){
					unlink($UPLOAD_DIR."/".$del_file);
					unlink($UPLOAD_DIR."/small/s_".$del_file);
				}
			}

			$sql01 = "delete from tb_board_list where uid=$board_id";
			$result01 = mysql_query($sql01);



			//등록된 한줄의견 삭제
			$sql02 = "delete from tb_board_coment where pid=$board_id";
			$result02 = mysql_query($sql02);


			//등록된 답글 삭제
			$sql03 = "delete from tb_board_reply where upid=$board_id";
			$result03 = mysql_query($sql03);


		}




		$sql = "delete from tb_board_set where uid=$uid";
		$result = mysql_query($sql);

		$msg = '삭제되었습니다';
		$next_url = './up_index.php?record_count='.$record_count.'&field='.$field.'&word='.$word;

		break;


	case 'all_del' :

		$UPLOAD_DIR = "../../board/upfile";

		for($i=0; $i<count($chk); $i++){

			//삭제할 게시판에 등록된 글 삭제
			$sql = "select * from tb_board_set where uid=$chk[$i]";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);
			$table_id = $row[table_id];

			$sql = "select * from tb_board_list where table_id='$table_id'";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);


			for($k=0; $k<$num; $k++){

				$row = mysql_fetch_array($result);
				$board_id = $row[uid];

				for($p=1; $p<=5; $p++){
					$file_num = sprintf("%02d",$p);
					$del_file = $row["userfile".$file_num];

					if($del_file){
						unlink($UPLOAD_DIR."/".$del_file);
						unlink($UPLOAD_DIR."/small/s_".$del_file);
					}
				}

				$sql01 = "delete from tb_board_list where uid=$board_id";
				$result01 = mysql_query($sql01);



				//등록된 한줄의견 삭제
				$sql02 = "delete from tb_board_coment where pid=$board_id";
				$result02 = mysql_query($sql02);


				//등록된 답글 삭제
				$sql03 = "delete from tb_board_reply where upid=$board_id";
				$result03 = mysql_query($sql03);


			}


			$sql = "delete from tb_board_set where uid=$chk[$i]";
			$result = mysql_query($sql);

		}

		$msg = '삭제되었습니다';
		$next_url = './up_index.php?record_count='.$record_count.'&field='.$field.'&word='.$word;

		break;


}



unset($dbconn);

Msg::goMsg($msg,$next_url);
?>

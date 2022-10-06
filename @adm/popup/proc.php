<?php
####DB에 접속한다###
include "../../module/class/class.DbCon.php";
include "../../module/class/class.Msg.php";
?>


<?

$reg_date = time();


if($type == 'write'){	 //팝업 등록
	$sql="insert into tb_popup (ptype,chk_width,pop_width,pop_height,pop_location,pop_left,pop_top,pos_mod,scrolling,title,ment,pop_day,chk_enable,reg_date)values('$ptype','$chk_width','$pop_width','$pop_height','$pop_location','$pop_left','$pop_top','$pos01','$scrolling','$title','$ment','$pop_day','$chk_enable','$reg_date')"; 

	$query=mysql_query($sql);	




}elseif($type == 'edit'){	 //팝업 수정
	$sql = "update tb_popup set ";
	$sql .= "ptype='$ptype', ";
	$sql .= "chk_width='$chk_width', ";
	$sql .= "pop_width='$pop_width', ";
	$sql .= "pop_height='$pop_height', ";
	$sql .= "pop_left='$pop_left', ";
	$sql .= "pop_top='$pop_top', ";
	$sql .= "pos_mod='$pos01', ";
	$sql .= "scrolling='$scrolling', ";
	$sql .= "title='$title', ";
	$sql .= "ment='$ment', ";
	$sql .= "pop_day='$pop_day', ";
	$sql .= "chk_enable='$chk_enable' ";
	$sql .= "where uid='$uid'";
	$query=mysql_query($sql);	





}elseif($type == 'del'){	//팝업 삭제

	//html_editor로 등록된 파일 삭제
	$del_file_list = '';

	$que = "select * from tb_popup where uid='$uid'";

	$result = mysql_query($que);
	$row = mysql_fetch_array($result);
	$ment = $row["ment"];	


	while($start_pos	= strpos($ment, "/html_editor/uploaded/",$start_pos)){
		$end_pos	= strpos(substr($ment,$start_pos), '"');
		$del_file_list = substr($ment,$start_pos, $end_pos);
		exec("rm ../../$del_file_list");
		$start_pos++;
	}


	$que="delete from tb_popup where uid='$uid'";
	$query=mysql_query($que);






}elseif($type == 'all_del'){	 //팝업 체크삭제

	for($i=0; $i<count($chk); $i++){

		//html_editor로 등록된 파일 삭제
			$del_file_list = '';
		
			$que = "select * from tb_popup where uid='$chk[$i]'";


			$result = mysql_query($que);
			$row = mysql_fetch_array($result);
			$ment = $row["ment"];	
		
/*
			while($start_pos	= strpos($ment, "/html_editor/uploaded/",$start_pos)){
				$end_pos	= strpos(substr($ment,$start_pos), '"');
				$del_file_list = substr($ment,$start_pos, $end_pos);
				exec("rm ../../$del_file_list");
				$start_pos++;
			}
*/



		$que="delete from tb_popup where uid='$chk[$i]'";
		$query=mysql_query($que);
	}

}

Msg::goNext('up_index.php?record_start='.$record_start.'&field='.$field.'&word='.$word);
exit;

?>

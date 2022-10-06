<?
	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건
	$query_ment = "where t.table_id='$table_id'";

	if($f_loc01)		$query_ment .= " and loc01='$f_loc01'";
	if($f_loc02)		$query_ment .= " and loc02='$f_loc02'";
	if($f_cade01)	$query_ment .= " and cade01='$f_cade01'";
	if($f_cade02)	$query_ment .= " and cade02='$f_cade02'";
	if($f_actType)	$query_ment .= " and actType='$f_actType'";
	if($f_bTarget)	$query_ment .= " and bTarget='$f_bTarget'";
	if($f_status == '모집중')		$query_ment .= " and gsTime<=$nTime and geTime>=$nTime";

	if($f_bsDate){
		$f_bsTime = strtotime($f_bsDate);
		$query_ment .= " and bsTime<=$f_bsTime";
	}
	if($f_beDate){
		$f_beTime = strtotime($f_beDate);
		$query_ment .= " and beTime>=$f_beTime";
	}

	if($f_adult)	$query_ment .= " and adult='$f_adult'";
	if($f_boy)	$query_ment .= " and boy='$f_boy'";

	if($f_title)	$query_ment .= " and title like '%$f_title%'";
	if($f_agent)	$query_ment .= " and agent like '%$f_agent%'";

	$sort_ment = "order by t.reg_date desc";

	$query = "select t.uid, t.title, b.* from tb_board_list as t left join ks_bongsa01 as b on t.uid=b.pid $query_ment $sort_ment";


	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 .= $query." limit $record_start, $record_count";

	$result = mysql_query($query2);
?>
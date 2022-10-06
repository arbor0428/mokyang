<?

if($list_mod != '스케쥴러형'){

	if(!$record_start){
		$record_start = 0;
	}

	$current_page = ($record_start / $record_count) + 1;

	$group = floor($record_start / ($record_count * $link_count));

	//쿼리조건


	$query_ment = "where table_id='$table_id'";

	if($f_sData01)	$query_ment .= " and sData01='$f_sData01'";
	if($f_sData02)	$query_ment .= " and sData02='$f_sData02'";

	if($word)	{
		if($field == 'total')		$query_ment .= " and (title like '%$word%' or ment like '%$word%')";	//통합검색에서 [더보기]로 넘어오는 경우
		else						$query_ment .= " and $field like '%$word%'";
	}

	if($only_you)	$query_ment .= " and userid='$GBL_USERID'";

	if($f_data01)	$query_ment .= " and data01='$f_data01'";
	//공연정보 일자검색문
	if($table_id == 'table_1512610572'){
		if($f_year){
			if($f_month){
				$maxdate = date(t, mktime(0, 0, 0, $f_month, 1, $f_year));	 //검색한달의 마지막일자
				$f_stime = mktime(0,0,0,$f_month,1,$f_year);
				$f_etime = mktime(0,0,0,$f_month,$maxdate,$f_year);

				$query_ment .= " and ((startTime>=$f_stime and startTime<=$f_etime) or (endTime>=$f_stime and endTime<=$f_etime))";

			}else{
				$f_stime = mktime(0,0,0,1,1,$f_year);
				$f_etime = mktime(0,0,0,12,31,$f_year);

				$query_ment .= " and ((startTime>=$f_stime and startTime<=$f_etime) or (endTime>=$f_stime and endTime<=$f_etime))";
			}
		}
	}

	$sort_ment = "order by notice_chk desc, reg_date desc";

	$query = "select * from tb_board_list $query_ment $sort_ment";

	$result = mysql_query($query) or die("연결실패");

	$total_record = mysql_num_rows($result);

	$total_page = (int)($total_record / $record_count);

	if($total_record % $record_count){
		$total_page++;
	}

	$query2 = "select * from tb_board_list $query_ment $sort_ment limit $record_start, $record_count";

	$result = mysql_query($query2);
}
?>
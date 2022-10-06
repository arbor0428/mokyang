<style>
.pagination {padding:50px 0; text-align:center;}
.pagination a.lnr {display:inline-block; padding:12px; box-sizing:border-box; vertical-align:middle; }
.pagination ol, .pagination ol li {display:inline-block;}
.pagination ol li {width:32px; height:32px; line-height:32px; font-size:0.875rem; transform:skew(-0.03deg); text-align:center; box-sizing:border-box; vertical-align:middle; }
.pagination ol li.active {background:#7aaf88; color:#fff; border-radius:50%;}
</style>


<div class="pagination">
<?
if(!$fName)	$fName = 'frm01';

if($total_record != '0'){
	if($total_record > $record_count){
		
		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
		}

		echo ("<a href=javascript:pageNum('$fName','$pre_group_start'); class='lnr lnr-chevron-left'></a> ");

/*
		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo ("<a href=javascript:pageNum('$fName','$pre_page_start'); class='direction'>Prev</a> ");
		}else{
			echo ("<a href=javascript:pageNum('$fName','$pre_page_start'); class='direction'>Prev</a> ");
		}
*/



		echo ("<ol>");


		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo ("<li><a href=javascript:pageNum('$fName','$input_start');>$link</a></li>");
				} else {
					echo ("<li class='active'><a href=javascript:pageNum('$fName','$input_start');>$link</a></li>");
				}
			}
		}

		echo ("</ol>");


/*
		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo ("<a href=javascript:pageNum('$fName','$next_page_start'); class='direction'>Next</a> ");
		}else{
			$next_page_start = $record_start;
			echo ("<a href=javascript:pageNum('$fName','$next_page_start'); class='direction'>Next</a> ");
		}
*/

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
		}else{
			$next_group_start = $record_start;			
		}

		echo("<a href=javascript:pageNum('$fName','$next_group_start'); class='lnr lnr-chevron-right'></a>");



		  
	}else{
		echo ("<ol><li class='active'><a href='#'>1</a></li></ol>");

		
	}
}
?>
</div>
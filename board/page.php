<script language='javascript'>
function page(rs){
	form = document.frm01;
	form.type.value = '';
	form.record_start.value = rs;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>






<table border="0" align="center" cellpadding="1" cellspacing="0" style='margin-top:15px;'>
	<tr>

<?
if($total_record != '0'){
	if($total_record > $record_count){
		
		echo ("<td>");

		if($current_page * $record_count > $record_count * $link_count) {
			$pre_group_start = ($group * $record_count * $link_count) - $record_count;
			echo("<a href=javascript:page('$pre_group_start');><img src='".$BTN_prev2."'></a>");
		}else{
			echo("<img src='".$BTN_prev2."'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start !=0 )) {
			$pre_page_start = $record_start - $record_count;
			echo("<a href=javascript:page('$pre_page_start');><img src='".$BTN_prev1."'></a>");
		}else{
			echo ("<img src='".$BTN_prev1."'>");
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		for($i=0; $i<$link_count; $i++){
			$input_start = ($group * $link_count + $i) * $record_count; 

			$link = ($group * $link_count + $i) + 1;

			if($input_start < $total_record) {
				if($input_start != $record_start) {
					echo("<a onclick=page('$input_start'); style='cursor:hand'>$link</a>&nbsp;&nbsp;");
				} else {
					echo("<font color='#000000'><b>$link</b></font>&nbsp;&nbsp;");
				}
			}
		}

		echo ("</td><td width='5'></td>");



		echo ("<td>");

		if($total_page > 1 && ($record_start != ($total_page * $record_count - $record_count))) {
			$next_page_start = $record_start + $record_count;
			echo("<a href=javascript:page('$next_page_start');><img src='".$BTN_next01."'></a>");
		}else{
			echo ("<img src='".$BTN_next01."'>");
		}

		echo ("</td>");



		echo ("<td>");

		if($total_record > (($group + 1) * $record_count * $link_count)) {
			$next_group_start = ($group + 1) * $record_count* $link_count;
			echo("<a href=javascript:page('$next_group_start');><img src='".$BTN_next02."'></a>");
		}else{
			echo ("<img src='".$BTN_next02."'>");
		}

		echo ("</td>");



		  
	}else{
		echo "<td><b>1</b></td>";
	}
}
?>

	</tr>
</table>

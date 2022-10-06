<?
	//공지사항
	$table_id = 'table_1440131012';

	$sql = "select * from tb_board_list where table_id='$table_id' order by uid desc limit 8";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);
?>

<table cellpadding='0' cellspacing='0' border='0' width='90%'>
	<tr>
		<td>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
				<tr>
					<td height='30' style='font-size:14px;font-weight:bold;'>공지사항</td>
					<td align='right'><a href='/sub04/sub01.php'>+ 더보기</a></td>
				</tr>
			</table>		
		</td>
	</tr>
	<tr>
		<td valign='top' style='padding:10px 0px 0px 0px;'>
			<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<?
			for($i=0; $i<$num; $i++){
				$row = mysql_fetch_array($result);

				$uid = $row['uid'];
				$title = $row['title'];
				$reg_date = $row['reg_date'];

				$titleTxt = Util::Shorten_String($title,50,'..');
				$reg_dateTxt = date('Y.m.d',$reg_date);
		?>
				<tr height='24'>
					<td>- <a href="/sub04/sub01.php?type=view&uid=<?=$uid?>"><?=$titleTxt?></a></td>
					<td width='70' align='right'><?=$reg_dateTxt?></td>
				</tr>
		<?
			}
		?>
			</table>
		</td>
	</tr>
</table>
<?
  for($i=1;$i<=$no;$i++) { 
    $ck = $no-$i+1;

    if($sdate){
		$snum = date('d',$sdate-((3600*24)*$ck));
		$sy = date('Y',$sdate);
		$sm = date('m',$sdate);
		$smk = mktime(0,0,0,$sm-1,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('m',$smk);
	}

	if($edate){
		$snum=$i;
		$sy = date('Y',$edate);
		$sm = date('m',$edate);
		$smk = mktime(0,0,0,$sm,1,$sy);
		$yy = date('Y',$smk);
		$mm = date('m',$smk);
	}





	echo ("
		<td valign='top' style='height:120px;padding:5px;'>
			<table cellpadding='0' cellspacing='0' border='0'>
				<tr>
					<td><a href=javascript:reg_register('$yy','$mm','$snum'); class='snum2'>$snum</a></td>
				</tr>");

	//스케쥴데이터를 가져온다
	$sql = "select * from tb_board_list where table_id='$table_id' and data01='$yy' and data02='$mm' and data03='$snum' order by uid";
	$result = mysql_query($sql);
	$trecord = mysql_num_rows($result);

	for($k=0; $k<$trecord; $k++){
		$row = mysql_fetch_array($result);
		$uid = $row['uid'];
		$title = $row['title'];
		$data04 = $row['data04'];
		$data05 = $row['data05'];	//공연정보 uid값
		$userid = $row['userid'];
		$pwd_chk = $row['pwd_chk'];

		if($data04 == '공연')	$data04Txt = "<span class='ico01'>공연</span>";
		elseif($data04 == '전시')	$data04Txt = "<span class='ico04'>전시</span>";
		elseif($data04 == '예술교육')	$data04Txt = "<span class='ico08'>예술교육</span>";
		elseif($data04 == '축제')	$data04Txt = "<span class='ico06'>축제</span>";


		//글읽기 권한 설정
		include $boardRoot.'chk_view.php';

		//공연정보 상세페이지 이동
		if($data05 && $GBL_MTYPE != 'A'){
			$btn_link = "onclick=show_view('$data05');";
		}

		echo ("<tr><td class='scBox' $btn_link>$data04Txt <br> <span class='scBoxTitle'>$title</span></td></tr>");
	}


	echo ("
			</table>
		</td>");
  }
  ?>
<?
include '../../module/class/class.DbCon.php';
include '../../module/class/class.Msg.php';


switch($type){

		case 'write' :

							$result = mysql_query("select * from ks_roomlist where cade01='$w_cade01'");
							$here = mysql_num_rows($result);
							
							if($here){
								Msg::backMsg('동일한 강의실명이 등록되어있습니다.');
								exit;

							}else{

								//제일 큰 sort 가져오기
								$sql = "select max(sort) as top from ks_roomlist";
								$result = mysql_query($sql);
								$one = mysql_result($result,0,'top');
								if($one==''){
									$one = 0;
								}else{
									$one = $one + 1;
								}

								$sql = "insert into ks_roomlist (cade01,memo01,sort) values ('$w_cade01','$w_memo01',$one)";
								$result = mysql_query($sql);
							}

							break;











		case 'edit' :
							if($e_cade01 != $o_cade01){
								$result = mysql_query("select * from ks_roomlist where cade01='$e_cade01'");
								$here = mysql_num_rows($result);
							}
				
							if($here){
								Msg::backMsg("동일한 강의실명이 등록되어있습니다.");
								exit;

							}else{
								//1차 항목수정
								$sql = "update ks_roomlist set cade01='$e_cade01', memo01='$e_memo01' where cade01='$o_cade01'";
								$result = mysql_query($sql);

							}

							$result = mysql_query($sql);

							$next_url .= '?cade01='.$e_cade01.'&memo01='.$e_memo01;

							break;






		case 'del' :

							//삭제하려는 1차 항목의 sort 값
							$sql = "select sort from ks_roomlist where cade01='$o_cade01'";
							$result = mysql_query($sql);
							$old_sort = mysql_result($result,0,'sort');

							//1차 항목 삭제
							$sql = "delete from ks_roomlist where cade01='$o_cade01'";
							$result = mysql_query($sql);



							//삭제한 1차 항목의 sort보다 상위인 1차 항목 수정
							$query2 = "select * from ks_roomlist where sort > $old_sort order by sort asc";
							$result = mysql_query($query2);
							$num = mysql_num_rows($result);

							if($num!='0'){
								for($i=0; $i<$num; $i++){
									$info = mysql_fetch_array($result);
									$Edit_uid = $info[uid];
									$Edit_sort = $old_sort + $i;

									$Edit_sql = "update ks_roomlist set sort='$Edit_sort' where uid='$Edit_uid'";
									$Edit_result = mysql_query($Edit_sql);
								}
							}



							break;





		case 'sort' :

							$cade_list = explode("|+|",$sort_cade01);
							$num = count($cade_list)-1;
						
							for($i=0; $i<$num; $i++){
								$sql = "update ks_roomlist set sort=$i where cade01='$cade_list[$i]'";
								$result = mysql_query($sql);
							}

							break;



}





Msg::goNext($next_url);

?>
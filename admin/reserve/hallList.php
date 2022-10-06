<?
	//대관장소 및 부대시설 목록
	include '../../module/HallArray.php';
?>

<script language='javascript'>
function SetBgColor(uid){
	chk = $('#squaredThree'+uid).is(':checked');

	if(chk){
		$('#list_'+uid).css('background','#f6faff');
	}else{
		$('#list_'+uid).css('background','#ffffff');

		//항목초기화
		$("#temp_"+uid+" option:eq(0)").attr("selected", "selected");
		$('#team_'+uid).val('');
		$('#staff_'+uid).val('');
		$('#phone_'+uid).val('');
		$("#status_"+uid+" option:eq(0)").attr("selected", "selected");
	}
}
</script>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='rTable'>
	<tr>
		<th width='5%'>-</th>
		<th>대관장소</th>
		<th width='15%'>냉/난방</th>
		<th width='18%'>단체명</th>
		<th width='15%'>신청자</th>
		<th width='13%'>연락처</th>
		<th width='10%'>예약상태</th>
	</tr>
<?
	//예약하기 버튼
	$revNo = 0;

//	$HallTot = array_merge($HallArr01,$HallArr02);
	$HallTot = $HallArr00;

	//예술회관
	for($i=0; $i<count($HallTot); $i++){
		$HallName = $HallTot[$i];

		$chk = '';		//예약여부
		$revB = '';		//냉난방
		$revT = '';		//단체명
		$revN = '';		//신청인
		$revP = '';		//연락처
		$revS = '';		//예약상태

		if(in_array($HallName,$revHall)){
			foreach($revHall as $k => $v){
				$chk = 'checked';

				if($v == $HallName){
					$revB = $revTemp[$k];
					$revT = $revTeam[$k];
					$revN = $revName[$k];
					$revP = $revPhone[$k];
					$revS = $revStatus[$k];

					break;
				}
			}
		}
?>
	<tr id='list_<?=$revNo?>' <?if($chk){echo "style='background:#f6faff;'";}?>>
		<td>
			<div class="rl_btn02">
				<div class="squaredThree">
					<input type="checkbox" value="<?=$revNo?>" id="squaredThree<?=$revNo?>" name="chk[]" onclick="SetBgColor('<?=$revNo?>');" <?=$chk?>>
					<label for="squaredThree<?=$revNo?>"></label>
				</div>
			</div>
		</td>
		<td><?=$HallName?></td>
		<td>
			<select name='temp_<?=$revNo?>' id='temp_<?=$revNo?>' style='width:50px;'>
				<option value=''>==</option>
				<option value='냉방' <?if($revB == '냉방'){echo 'selected';}?>>냉방</option>
				<option value='난방' <?if($revB == '난방'){echo 'selected';}?>>난방</option>
			</select>
		</td>
		<td><input type='text' name='team_<?=$revNo?>' id='team_<?=$revNo?>' value="<?=$revT?>" class='textBox01' style='width:100%;'></td>
		<td><input type='text' name='staff_<?=$revNo?>' id='staff_<?=$revNo?>' value="<?=$revN?>" class='textBox01' style='width:100%;'></td>
		<td><input type='text' name='phone_<?=$revNo?>' id='phone_<?=$revNo?>' value="<?=$revP?>" class='textBox01' style='width:100%;'></td>
		<td>
			<select name='status_<?=$revNo?>' id='status_<?=$revNo?>' style='width:50px;'>
				<option value='대관승인' <?if($revS == '대관승인'){echo 'selected';}?>>승인</option>
				<option value='입금대기' <?if($revS == '입금대기'){echo 'selected';}?>>대기</option>
			</select>
		</td>
	</tr>
<?
		$revNo++;
	}
?>
</table>
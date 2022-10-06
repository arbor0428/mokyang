<?
	if($word == '서울')		$loc_no = '0';
	elseif($word == '인천')	$loc_no = '1';
	elseif($word == '경기')	$loc_no = '2';
	elseif($word == '강원')	$loc_no = '3';
	elseif($word == '충북')	$loc_no = '4';
	elseif($word == '충남')	$loc_no = '5';
	elseif($word == '대전')	$loc_no = '6';
	elseif($word == '경북')	$loc_no = '7';
	elseif($word == '경남')	$loc_no = '8';
	elseif($word == '대구')	$loc_no = '9';
	elseif($word == '울산')	$loc_no = '10';
	elseif($word == '부산')	$loc_no = '11';
	elseif($word == '전북')	$loc_no = '12';
	elseif($word == '전남')	$loc_no = '13';
	elseif($word == '광주')	$loc_no = '14';
	elseif($word == '제주')	$loc_no = '15';
?>

<script language='javascript'>

function click_del(txt,uid){

	if(confirm(txt+' 글을 삭제하시겠습니까?')){
		form = document.frm01;
		form.uid.value = uid;
		form.type.value = 'del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();
	}else{
		return;
	}

	

}


function All_del(){

    var chk = document.getElementsByName('chk[]');
	var isChk = false;

    for(var i = 0; i < chk.length; i++){
		if(chk[i].checked)	isChk = true; 
    }

	if(!isChk){
		alert('삭제하실 글을 선택하여 주십시오.');
		return;
	}

	if(confirm('선택하신 글을 삭제하시겠습니까?')){

		form = document.frm01;

		form.type.value = 'all_del'
		form.action = '<?=$boardRoot?>proc.php';
		form.submit();

	}

}


function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}


function error_msg(mod){
	if(mod == 'r'){
		alert('글읽기 권한이 없습니다');
		return;

	}else if(mod == 'w'){
		alert('글쓰기 권한이 없습니다');
		return;

	}
}


//지역(시/도)
$(function(){
	$('#f_sData01').change(function(){
		c1 = $(this).val();

		//시도군 선택
		$.post('/module/jsonLoc.php',{'c1':c1}, function(c2){
			//시도군 selectbox 초기화
			$('#f_sData02').empty();
			$('#f_sData02').append("<option value=''>시&middot;군&middot;구 선택</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			//시도군 selectbox 옵션설정	
			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#f_sData02').append(option);
			}
		});
	});
});

function boardsearch(loc){
	form = document.frm01;

	$("#f_sData01").val(loc).attr("selected", "selected");
	$("#f_sData02 option:eq(0)").prop("selected", true);

	form.type.value = '';
	form.record_start.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
function board_search(){
	form = document.frm01;
	form.type.value = '';
	form.action = "<?=$_SERVER['PHP_SELF']?>";
	form.submit();
}
function is_Key(){
	if(event.keyCode==13)	board_search();
}
</script>


<form name='frm01' method='post' action="<?=$_SERVER['PHP_SELF']?>">
<input type="text" style="display: none;">  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value="<?=$_SERVER['PHP_SELF']?>">
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>
<input type='hidden' name='mCade01' value='<?=$mCade01?>'>
<input type='hidden' name='mCade02' value='<?=$mCade02?>'>
<input type='hidden' name='SET_SKIN_LANG' value='<?=$SET_SKIN_LANG?>'><!-- 스킨언어 -->








<style>
.select1 {min-width:150px; height:30px; border:1px solid #dddddd;border-radius:3px;padding:5px; margin-right:4px;}

.map-location {display:flex; height:400px; margin-bottom:30px;}
.map-location .maps {width:320px;}
.map-location .local {width:920px; margin-left:20px; padding:24px 40px; box-sizing:border-box; background:#f8f8f8;}
.map-location .local p.titles {font-size:1.375rem;color:#212121;font-weight:bold;margin-bottom:15px;}
.map-btn-wrap {display:flex; flex-wrap:wrap;}
.map-btn-wrap .map_btn {width:calc(16.66% - 12px); margin:6px; padding:10px 0; border:1px solid #e1e1e1; text-align:center; background:#fff; box-sizing:border-box; cursor:pointer; transform:skew(-0.03deg);}
.map_btn:hover{background:#212121;color:#fff; transition:.2s;}
.map-btn-wrap .map_btn.map_btn_a{background:#212121;color:#ffffff;}

.map-location input.searchBox_ {display:block;padding-left:5px;float:left;height:40px;line-height:40px;width:400px;border:1px solid #e1e1e1;box-sizing:border-box;}
.map-location a.searchBtn_ {display:block;float:left;width:60px;height:40px;line-height:40px;font-size:14px;text-align:center;background:#9b9b9b;color:#ffffff;margin-left:3px;}
.map-location a.searchBtn_:hover {background:#212121; transition:.2s;}


.locationTbl-wrap {width:100%;}
table#locationTbl {width:100%;}
table#locationTbl th, table#locationTbl td {padding:10px;}
table#locationTbl th {border:1px solid #bcbcbc; border-left:0px; border-right:0px; background-color:#f6f6f6; padding:14px 10px; text-align:center;}
table#locationTbl td.bbs01 {border-bottom:1px solid #e1e1e1;}


@media screen and (max-width:1080px) {
.map-location {flex-direction:column; height:auto;}
.map-location .maps {width:100%; text-align:center; background:#f6f5f1; margin-bottom:10px;}
.map-location .local {width:100%; margin-left:0;}
}

@media screen and (max-width:768px) {
.select1 {min-width:30%;}
.map-location .local {padding:24px 20px;}
.map-btn-wrap .map_btn {width:calc(25% - 12px); margin:6px;}

.map-location input.searchBox_ {width:60%;}
.locationTbl-wrap {width:100%; overflow-x:scroll;}
table#locationTbl {width:800px;}
}


@media screen and (max-width:375px) {
.select1 {min-width:20%;}
}
</style>


<div class="map-location">
	<div class="maps inr-cont">
		<?
			include $boardRoot.'map.php';
		?>
	</div>
	<div class="local inr-cont">
		<p class="titles">지역 검색</p>

		<div class="map-btn-wrap">
			<div class='map_btn <?if(!$f_sData01)echo'map_btn_a';?>' onclick='go_branch("all")'>전체</div>
			<div class='map_btn <?if($f_sData01=='서울')echo'map_btn_a';?>' onclick='go_branch("seoul")'>서울</div>
			<div class='map_btn <?if($f_sData01=='경기')echo'map_btn_a';?>' onclick='go_branch("gyeonggi")'>경기</div>
			<div class='map_btn <?if($f_sData01=='강원')echo'map_btn_a';?>' onclick='go_branch("gangwon")'>강원</div>
			<div class='map_btn <?if($f_sData01=='경남')echo'map_btn_a';?>' onclick='go_branch("gyeongnam")'>경남</div>


			<div class='map_btn <?if($f_sData01=='경북')echo'map_btn_a';?>' onclick='go_branch("gyeongbuk")'>경북</div>
			<div class='map_btn <?if($f_sData01=='광주')echo'map_btn_a';?>' onclick='go_branch("gwangju")'>광주</div>
			<div class='map_btn <?if($f_sData01=='대구')echo'map_btn_a';?>' onclick='go_branch("daegu")'>대구</div>
			<div class='map_btn <?if($f_sData01=='대전')echo'map_btn_a';?>' onclick='go_branch("daejeon")'>대전</div>
			<div class='map_btn <?if($f_sData01=='부산')echo'map_btn_a';?>' onclick='go_branch("busan")'>부산</div>


			<div class='map_btn <?if($f_sData01=='세종')echo'map_btn_a';?>' onclick='go_branch("sejong")'>세종</div>
			<div class='map_btn <?if($f_sData01=='울산')echo'map_btn_a';?>' onclick='go_branch("ulsan")'>울산</div>
			<div class='map_btn <?if($f_sData01=='인천')echo'map_btn_a';?>' onclick='go_branch("incheon")'>인천</div>
			<div class='map_btn <?if($f_sData01=='전남')echo'map_btn_a';?>' onclick='go_branch("jeonnam")'>전남</div>
			<div class='map_btn <?if($f_sData01=='전북')echo'map_btn_a';?>' onclick='go_branch("jeonbuk")'>전북</div>


			<div class='map_btn <?if($f_sData01=='제주')echo'map_btn_a';?>' onclick='go_branch("jeju")'>제주</div>
			<div class='map_btn <?if($f_sData01=='충남')echo'map_btn_a';?>' onclick='go_branch("chungnam")'>충남</div>
			<div class='map_btn <?if($f_sData01=='충북')echo'map_btn_a';?>' onclick='go_branch("chungbuk")'>충북</div>
		</div>
					
		<p class="titles m20">상세 검색</p>

		<div class="m_20">
			<select name="f_sData01" id="f_sData01" class="select1">
				<option value="">시&middot;도 선택</option>
			<?
				$item = sqlArray("select distinct(loc01) from locArea order by sort");
				foreach($item as $k => $v){
					$loc01Txt = $v['loc01'];

					if($f_sData01 == $loc01Txt)		$chk = 'selected';
					else									$chk = '';

					echo ("<option value='$loc01Txt' $chk>$loc01Txt</option>");
				}
			?>
			</select>
			<select name="f_sData02" id="f_sData02" class="select1">
				<option value="">시&middot;군&middot;구 선택</option>
			<?
				if($f_sData01){
					$item = sqlArray("select distinct(loc02) from locArea where loc01='$f_sData01' order by loc02");
					foreach($item as $k => $v){
						$loc02Txt = $v['loc02'];

						if($f_sData02 == $loc02Txt)		$chk = 'selected';
						else									$chk = '';

						echo ("<option value='$loc02Txt' $chk>$loc02Txt</option>");
					}
				}
			?>
			</select>
			<select name="field" id="field" class="select1">
				<option value='title' <?if($field == 'title'){echo 'selected';}?>>센터명</option>
				<option value='sData05' <?if($field == 'sData05'){echo 'selected';}?>>연락처</option>
			</select>
		</div>
		<!--//상세 선택-->
		<div>
			<input name="word" type="text" size="20" value='<?=$word?>' class="searchBox_"onkeypress='is_Key();'>
			<a href='javascript:board_search();' class="searchBtn_">검색</a>
		</div>
	</div>
</div>


<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';
?>


<div class="locationTbl-wrap">
<table cellpadding='0' cellspacing='0' border='0' id="locationTbl">

	<?
	if($chk_type == 'ok'){
		$cols = '9';
	?>

	<tr>
	
					<th width="4%" class='b-text'><span class="smooth dp_ir">번호</span></th>
					<th width="18%" class='b-text'><span class="smooth dp_ir">센터명</span></th>
					<th width="23%" class='b-text'><span class="smooth dp_ir">주소</span></th>
					<th width="5%" class='b-text'><span class="smooth dp_ir">위치</span></th>
					<th width="15%" class='b-text'><span class="smooth dp_ir">연락처</span></th>
					<th width="10%" class='b-text'><span class="smooth dp_ir">운영시간</span></th>
					<th width="7.8%" class='b-text'><span class="smooth dp_ir">정원</span></th>
					<th width="5%" class='b-text'><span class="smooth dp_ir">홈페이지</span></th>
					<th width="10%" class='b-text'><span class="smooth dp_ir">편집</span></th>
	</tr>



	<?
	}else{
		$cols = '8';
	?>

	<tr>
		
					<th width="4%" class='b-text'><span class="smooth dp_ir">번호</span></th>
					<th width="18%" class='b-text'><span class="smooth dp_ir">센터명</span></th>
					<th width="23%" class='b-text'><span class="smooth dp_ir">주소</span></th>
					<th width="10%" class='b-text'><span class="smooth dp_ir">위치</span></th>
					<th width="10%" class='b-text'><span class="smooth dp_ir">연락처</span></th>
					<th width="10%" class='b-text'><span class="smooth dp_ir">운영시간</span></th>
					<th width="7.8%" class='b-text'><span class="smooth dp_ir">정원</span></th>
					<th width="5%" class='b-text'><span class="smooth dp_ir">홈페이지</span></th>

	</tr>

<?
}
?>
</table>

<table cellpadding='0' cellspacing='0' border='0' id="locationTbl">
	<tr>


<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$userid = $row["userid"];
		$title = $row["title"];
		$sData01 = $row["sData01"];
		$sData02 = $row["sData02"];
		$sData03 = $row["sData03"];
		$sData04 = $row["sData04"];
		$sData05 = $row["sData05"];
		$sData06 = $row["sData06"];
		$sData07 = $row["sData07"];
		$sData08 = $row["sData08"];
		$sDataTxt = $row["sDataTxt"];
		$sDataUrl = $row["sDataUrl"];




		//글읽기 권한 설정
//		include $boardRoot.'chk_view.php';


		if($chk_type == 'ok'){

?>

					<td class='bbs01' width='4%' align='center'><span class="smooth dp_ir"><?=$i?></span></td>
					<td class='bbs01' width='18%' align='center'><span class="smooth dp_ir"><?=$title?></span></td>
					<td class='bbs01' width='23%' style='padding-left:10px;'><span class="smooth dp_ir"><?=$sData03?> <?=$sData04?></span></td>
					<td class='bbs01' width='5%' align='center'>
						<span class="smooth dp_ir">
							<?
								if($sData03){
							?>
								<a href="https://map.kakao.com/?q=<?=$sData03?>" target="_blank"><img src="/images/sub/location_icon_gry.png"></a>
							<?
								}
							?>
						</span>
					</td>
					<td class='bbs01' width='15%' align='center'><span class="smooth dp_ir"><?=$sData05?></span></td>
					<td class='bbs01' width='10%' align='center'>
						<span class="smooth dp_ir">
							<?
								if($sData06)	echo "<p>학기중 : ".$sData06."</p>";
								if($sData07)	echo "<p>방학중 : ".$sData07."</p>";
								if($sData08)	echo "<p>토요일 : ".$sData08."</p>";
							?>
						</span>
					</td>
					<td class='bbs01' width='10%' align='center'><span class="smooth dp_ir"><?=$sDataTxt?></span></td>
					<td class='bbs01' width='5%' align='center'>
						<span class="smooth dp_ir">
							<?
								if($sDataUrl){
							?>
								<a href="<?=$sDataUrl?>" target="_blank"><img src="/images/sub/home_icon_gry.png"></a>
							<?
								}
							?>
						</span>
					</td>
					<td class='bbs01' width='10%' align='center'><a href="javascript:reg_modify('<?=$uid?>');"><img src="<?=$BTN_modify02?>" alt="Edit"></a> <a href="javascript:click_del('<?=$title?>','<?=$uid?>')"><img src="<?=$BTN_del02?>" alt="삭제" width="50"></a></td>
</table>
<table cellpadding='0' cellspacing='0' border='0' id="locationTbl">

<?
		}else{
?>
				<tr>
					<td class='bbs01' width='4%' align='center'><span class="smooth dp_ir"><?=$i?></span></td>
					<td class='bbs01' width='18%' align='center'><span class="smooth dp_ir"><?=$title?></span></td>
					<td class='bbs01' width='23%' style='padding-left:10px;'><span class="smooth dp_ir"><?=$sData03?> <?=$sData04?></span></td>
					<td class='bbs01' width='10%' align='center'>
						<span class="smooth dp_ir">
						<?
							if($sData03){
						?>
							<a href="https://map.kakao.com/?q=<?=$sData03?>" target="_blank"><img src="/images/sub/location_icon_gry.png"></a>
						<?
							}
						?>
						</span>
					</td>
					<td class='bbs01' width='10%' align='center'><span class="smooth dp_ir"><?=$sData05?></span></td>
					<td class='bbs01' width='10%' align='center'>
						<span class="smooth dp_ir">
						<?
							if($sData06)	echo "<p>학기중 : ".$sData06."</p>";
							if($sData07)	echo "<p>방학중 : ".$sData07."</p>";
							if($sData08)	echo "<p>토요일 : ".$sData08."</p>";
						?>
						</span>
					</td>
					<td class='bbs01' width='10%' align='center'><span class="smooth dp_ir"><?=$sDataTxt?></span></td>
					<td class='bbs01' width='5%' align='center'>
						<span class="smooth dp_ir">
						<?
							if($sDataUrl){
						?>
							<a href="<?=$sDataUrl?>" target="_blank"><img src="/images/sub/home_icon_gry.png"></a>
						<?
							}
						?>
						</span>
					</td>
				</tr>

<?
		}

		$i--;
		$line_num++;
	}
}else{
?>

				<tr> 
					<td colspan="<?=$cols?>" align='center' height='50'>등록된 게시물이 없습니다</td>
				</tr>

<?
}
?>




<?


?>







</table>

<div class="txt_r m20"><?=$btn_write?></div>

</div>




</form>
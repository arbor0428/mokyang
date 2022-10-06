<script>
function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}

function goSearch(){
	form = document.frm01;

	form.type.value = '';
	form.uid.value = '';
	form.record_start.value = '';
	form.action = '<?=$PHP_SELF?>';
	form.target = '';
	form.submit();
}

function formReset(){
	$("#f_loc01 option:eq(0)").prop("selected", true);
	$("#f_loc02 option:eq(0)").prop("selected", true);
	$("#f_cade01 option:eq(0)").prop("selected", true);
	$("#f_cade02 option:eq(0)").prop("selected", true);
	$("#f_actType option:eq(0)").prop("selected", true);
	$("#f_bTarget option:eq(0)").prop("selected", true);
	$("#f_status option:eq(0)").prop("selected", true);
	$("#f_bsDate").val('');
	$("#f_beDate").val('');
	$(".cb20").prop("checked", false);	//일반 체크박스 공통
	$("#f_title").val('');
	$("#f_agent").val('');
}

$(function(){
	//지역(시/도)
	$('#f_loc01').change(function(){
		c1 = $(this).val();

		//시도군 선택
		$.post('/module/jsonLoc.php',{'c1':c1}, function(c2){
			//시도군 selectbox 초기화
			$('#f_loc02').empty();
			$('#f_loc02').append("<option value=''>전체</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			//시도군 selectbox 옵션설정	
			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#f_loc02').append(option);
			}
		});
	});



	$('#f_cade01').change(function(){
		c1 = $(this).val();

		$.post('/module/jsonvCade.php',{'c1':c1}, function(c2){
			$('#f_cade02').empty();
			$('#f_cade02').append("<option value=''>전체</option>");

			c2 = urldecode(c2);
			parData = JSON.parse(c2);

			for(i=0; i<parData.length; i++){	
				txt = parData[i];
				option = $("<option value='"+txt+"'>"+txt+"</option>");
				$('#f_cade02').append(option);
			}
		});
	});
});
</script>

<style>
.checkbox_wrap li{float:left;margin-right:20px;}
.listLine{border-top:2px solid #666;}
.listLine li{padding:20px 0;border-bottom:1px solid #efefef;}

</style>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<label><input type="text" style="display: none;"></label>  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>


<div class="tbl-st">
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사지역</div>
		<div class="tbl-st-col col-2">
			<select name="f_loc01" id="f_loc01" class="select1">
				<option value="">전체</option>
			<?
				$item = sqlArray("select distinct(loc01) from locArea order by sort");
				foreach($item as $k => $v){
					$loc01Txt = $v['loc01'];

					if($f_loc01 == $loc01Txt)		$chk = 'selected';
					else									$chk = '';

					echo ("<option value='$loc01Txt' $chk>$loc01Txt</option>");
				}
			?>
			</select>
			<select name="f_loc02" id="f_loc02" class="select1">
				<option value="">전체</option>
			<?
				if($f_loc01){
					$item = sqlArray("select distinct(loc02) from locArea where loc01='$f_loc01' order by loc02");
					foreach($item as $k => $v){
						$loc02Txt = $v['loc02'];

						if($f_loc02 == $loc02Txt)		$chk = 'selected';
						else									$chk = '';

						echo ("<option value='$loc02Txt' $chk>$loc02Txt</option>");
					}
				}
			?>
			</select>
		</div>
		<div class="tbl-st-col col-1 f16">봉사분야</div>
		<div class="tbl-st-col col-2">
			<select name="f_cade01" id="f_cade01" class="select1">
				<option value="">전체</option>
			<?
				$item = sqlArray("select * from ks_vCade01 order by sort");
				foreach($item as $k => $v){
					$cade01Txt = $v['cade01'];

					if($f_cade01 == $cade01Txt)		$chk = 'selected';
					else										$chk = '';

					echo ("<option value='$cade01Txt' $chk>$cade01Txt</option>");
				}
			?>
			</select>
			<select name="f_cade02" id="f_cade02" class="select1">
				<option value="">전체</option>
			<?
				if($f_cade01){
					$item = sqlArray("select * from ks_vCade02 where cade02='$f_cade01' order by loc02");
					foreach($item as $k => $v){
						$cade02Txt = $v['cade02'];

						if($f_cade02 == $cade02Txt)		$chk = 'selected';
						else									$chk = '';

						echo ("<option value='$cade02Txt' $chk>$cade02Txt</option>");
					}
				}
			?>
			</select>
		</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">활동구분</div>
		<div class="tbl-st-col col-2">
			<select name="f_actType" id="f_actType" class='select1'>
				<option value=''>전체</option>
				<option value="온라인" <?if($f_actType == '온라인'){echo 'selected';}?>>온라인</option>
				<option value="오프라인" <?if($f_actType == '오프라인'){echo 'selected';}?>>오프라인</option>
				<option value="온·오프라인" <?if($f_actType == '온·오프라인'){echo 'selected';}?>>온·오프라인</option>
			</select>
		</div>
		<div class="tbl-st-col col-1 f16">봉사대상</div>
		<div class="tbl-st-col col-2">
			<select name="f_bTarget" id="f_bTarget" class="select1">
				<option value=''>전체</option>
				<option value="아동·청소년" <?if($f_bTarget == '아동·청소년'){echo 'selected';}?>>아동·청소년</option>
				<option value="장애인" <?if($f_bTarget == '장애인'){echo 'selected';}?>>장애인</option>
				<option value="노인" <?if($f_bTarget == '노인'){echo 'selected';}?>>노인</option>
				<option value="쪽방촌" <?if($f_bTarget == '쪽방촌'){echo 'selected';}?>>쪽방촌</option>
				<option value="다문화가정" <?if($f_bTarget == '다문화가정'){echo 'selected';}?>>다문화가정</option>
				<option value="여성" <?if($f_bTarget == '여성'){echo 'selected';}?>>여성</option>
				<option value="환경" <?if($f_bTarget == '환경'){echo 'selected';}?>>환경</option>
				<option value="사회적기업" <?if($f_bTarget == '사회적기업'){echo 'selected';}?>>사회적기업</option>
				<option value="고향봉사" <?if($f_bTarget == '고향봉사'){echo 'selected';}?>>고향봉사</option>
				<option value="기타" <?if($f_bTarget == '기타'){echo 'selected';}?>>기타</option>
			</select>
		</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">모집상태</div>
		<div class="tbl-st-col col-2">
			<select name="f_status" id="f_status" class="select1">
				<option value=''>전체</option>
				<option value="모집중" <?if($f_status == '모집중'){echo 'selected';}?>>모집중</option>
				<option value="모집완료" <?if($f_status == '모집완료'){echo 'selected';}?>>모집완료</option>
			</select>
		</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사기간</div>
		<div class="tbl-st-col col-2">
			<input type="text" name="f_bsDate" id="f_bsDate" class="fpicker" style='width:140px;' value="<?=$f_bsDate?>"> ~ 
			<input type="text" name="f_beDate" id="f_beDate" class="fpicker" style='width:140px;' value="<?=$f_beDate?>">
		</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사자유형</div>
		<div class="tbl-st-col col-2">
			<ul class="checkbox_wrap">
				<li><input type="checkbox" name="f_adult" id="f_adult" value="1" class='cb20' <?if($f_adult){echo 'checked';}?>><label for="f_adult" class='cb20Label'> 성인</label></li>
				<li><input type="checkbox" name="f_boy" id="f_boy" value="1" class='cb20' <?if($f_boy){echo 'checked';}?>><label for="f_boy" class='cb20Label'> 청소년</label></li>
			</ul>
		</div>
	</div>
	<div class="tbl-st-row clearfix"> 
		<div class="tbl-st-col col-1 f16">봉사명</div>
		<div class="tbl-st-col col-2"><input type="text" name="f_title" style='width:98%;' value="<?=$f_title?>"></div>
		<div class="tbl-st-col col-1 f16">모집기관</div>
		<div class="tbl-st-col col-2"><input type="text" name="f_agent" style='width:98%;' value="<?=$f_agent?>"></div>
	</div>
</div>

<table cellpadding='0' cellspacing='0' border='0' width='100%'>
	<tr> 
		<td align='center' style='padding:20px 0;'>
			<a href="javascript:goSearch();" class="btn blk">검색</a>
			<a href="javascript:formReset();" class="btn gry">초기화</a>
		</td>
	</tr>
</table>


<ul class='listLine m_66'>

<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	$line_num = 0;

	while($row = mysql_fetch_array($result)){
		$gsTime = $row['gsTime'];
		$geTime = $row['geTime'];

		if($gsTime <= $nTime && $geTime >= $nTime)	$status = "<span class='ico06'>모집중</span>";
		else															$status = "<span class='ico10'>모집마감</span>";
?>

	<li>
		<a href="javascript:reg_view('<?=$row['uid']?>');">
			<p class="smooth m_12"><?=$status?> (<?=$row['cade01']?> &gt; <?=$row['cade02']?>)</p>
			<p class="smooth m_20"><?=$row['title']?></p>
			<p class="smooth">[모집기관] <?=$row['agent']?> | [모집기간] <?=$row['gsDate']?>~<?=$row['geDate']?> | [봉사기간] <?=$row['bsDate']?>~<?=$row['beDate']?></p>
		</a>
	</li>

<?
	}
}
?>

</ul>







<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

<div style="text-align:right;">
<?=$btn_write?>
</div>


</form>
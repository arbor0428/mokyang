<?
$sRange = '0';
$eRange = '1';
include '../../module/Calendar.php';

	$sql = "select * from ks_mainimg";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$link01 = $row['link01'];
	$target01 = $row['target01'];
	$sDate01 = $row['sDate01'];
	$eDate01 = $row['eDate01'];
	$upfile01 = $row['upfile01'];
	$realfile01 = $row['realfile01'];
	$upfile02 = $row['upfile02'];
	$realfile02 = $row['realfile02'];

	$link02 = $row['link02'];
	$target02 = $row['target02'];
	$sDate02 = $row['sDate02'];
	$eDate02 = $row['eDate02'];
	$upfile03 = $row['upfile03'];
	$realfile03 = $row['realfile03'];
	$upfile04 = $row['upfile04'];
	$realfile04 = $row['realfile04'];

	$link03 = $row['link03'];
	$target03 = $row['target03'];
	$sDate03 = $row['sDate03'];
	$eDate03 = $row['eDate03'];
	$upfile05 = $row['upfile05'];
	$realfile05 = $row['realfile05'];
	$upfile06 = $row['upfile06'];
	$realfile06 = $row['realfile06'];

	$link04 = $row['link04'];
	$target04 = $row['target04'];
	$sDate04 = $row['sDate04'];
	$eDate04 = $row['eDate04'];
	$upfile07 = $row['upfile07'];
	$realfile07 = $row['realfile07'];
	$upfile08 = $row['upfile08'];
	$realfile08 = $row['realfile08'];

	$link05 = $row['link05'];
	$target05 = $row['target05'];
	$sDate05 = $row['sDate05'];
	$eDate05 = $row['eDate05'];
	$upfile09 = $row['upfile09'];
	$realfile09 = $row['realfile09'];
	$upfile10 = $row['upfile10'];
	$realfile10 = $row['realfile10'];

	$link06 = $row['link06'];
	$target06 = $row['target06'];
	$sDate06 = $row['sDate06'];
	$eDate06 = $row['eDate06'];
	$upfile11 = $row['upfile11'];
	$realfile11 = $row['realfile11'];
	$upfile12 = $row['upfile12'];
	$realfile12 = $row['realfile12'];

	$link07 = $row['link07'];
	$target07 = $row['target07'];
	$sDate07 = $row['sDate07'];
	$eDate07 = $row['eDate07'];
	$upfile13 = $row['upfile13'];
	$realfile13 = $row['realfile13'];
	$upfile14 = $row['upfile14'];
	$realfile14 = $row['realfile14'];

	$link08 = $row['link08'];
	$target08 = $row['target08'];
	$sDate08 = $row['sDate08'];
	$eDate08 = $row['eDate08'];
	$upfile15 = $row['upfile15'];
	$realfile15 = $row['realfile15'];
	$upfile16 = $row['upfile16'];
	$realfile16 = $row['realfile16'];

	$link09 = $row['link09'];
	$target09 = $row['target09'];
	$sDate09 = $row['sDate09'];
	$eDate09 = $row['eDate09'];
	$upfile17 = $row['upfile17'];
	$realfile17 = $row['realfile17'];
	$upfile18 = $row['upfile18'];
	$realfile18 = $row['realfile18'];

	$link10 = $row['link10'];
	$target10 = $row['target10'];
	$sDate10 = $row['sDate10'];
	$eDate10 = $row['eDate10'];
	$upfile19 = $row['upfile19'];
	$realfile19 = $row['realfile19'];
	$upfile20 = $row['upfile20'];
	$realfile20 = $row['realfile20'];

	include 'script.php';
?>


<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='edit'>
<input type='hidden' name='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='dbfile02' value='<?=$upfile02?>'>
<input type='hidden' name='realfile02' value='<?=$realfile02?>'>
<input type='hidden' name='dbfile03' value='<?=$upfile03?>'>
<input type='hidden' name='realfile03' value='<?=$realfile03?>'>
<input type='hidden' name='dbfile04' value='<?=$upfile04?>'>
<input type='hidden' name='realfile04' value='<?=$realfile04?>'>
<input type='hidden' name='dbfile05' value='<?=$upfile05?>'>
<input type='hidden' name='realfile05' value='<?=$realfile05?>'>
<input type='hidden' name='dbfile06' value='<?=$upfile06?>'>
<input type='hidden' name='realfile06' value='<?=$realfile06?>'>
<input type='hidden' name='dbfile07' value='<?=$upfile07?>'>
<input type='hidden' name='realfile07' value='<?=$realfile07?>'>
<input type='hidden' name='dbfile08' value='<?=$upfile08?>'>
<input type='hidden' name='realfile08' value='<?=$realfile08?>'>
<input type='hidden' name='dbfile09' value='<?=$upfile09?>'>
<input type='hidden' name='realfile09' value='<?=$realfile09?>'>
<input type='hidden' name='dbfile10' value='<?=$upfile10?>'>
<input type='hidden' name='realfile10' value='<?=$realfile10?>'>
<input type='hidden' name='dbfile11' value='<?=$upfile11?>'>
<input type='hidden' name='realfile11' value='<?=$realfile11?>'>
<input type='hidden' name='dbfile12' value='<?=$upfile12?>'>
<input type='hidden' name='realfile12' value='<?=$realfile12?>'>
<input type='hidden' name='dbfile13' value='<?=$upfile13?>'>
<input type='hidden' name='realfile13' value='<?=$realfile13?>'>
<input type='hidden' name='dbfile14' value='<?=$upfile14?>'>
<input type='hidden' name='realfile14' value='<?=$realfile14?>'>
<input type='hidden' name='dbfile15' value='<?=$upfile15?>'>
<input type='hidden' name='realfile15' value='<?=$realfile15?>'>
<input type='hidden' name='dbfile16' value='<?=$upfile16?>'>
<input type='hidden' name='realfile16' value='<?=$realfile16?>'>
<input type='hidden' name='dbfile17' value='<?=$upfile17?>'>
<input type='hidden' name='realfile17' value='<?=$realfile17?>'>
<input type='hidden' name='dbfile18' value='<?=$upfile18?>'>
<input type='hidden' name='realfile18' value='<?=$realfile18?>'>
<input type='hidden' name='dbfile19' value='<?=$upfile19?>'>
<input type='hidden' name='realfile19' value='<?=$realfile19?>'>
<input type='hidden' name='dbfile20' value='<?=$upfile20?>'>
<input type='hidden' name='realfile20' value='<?=$realfile20?>'>

<input type='hidden' name='num' value=''>
<input type='hidden' name='dir' value=''>





<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>
		메인이미지<br>
		※ <b style='color:red'>1920px * 500px</b>  크기로 등록해주시기 바랍니다.<br>
		※ 2개이상의 이미지를 넣어야 슬라이드 모션이 실행됩니다.<br>
		※ 노출기간을 입력하지 않으면 상시 표시됩니다.
	</div>
	
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='gTable'>
<?
	$n = 1;

	for($i=1; $i<=10; $i++){
		$ino = sprintf('%02d',$i);
		$no = sprintf('%02d',$n);
		$link = ${'link'.$ino};
		$target = ${'target'.$ino};
		$sDate = ${'sDate'.$ino};
		$eDate = ${'eDate'.$ino};
		$upfile = ${'upfile'.$no};
		$realfile = ${'realfile'.$no};

		$n++;
?>
		<tr>
			<th width='15%' rowspan='4'>이미지 #<?=$i?></th>
			<th width='15%'>링크주소<?=$ino?></th>
			<td width='60%'>
				<select name='target<?=$ino?>'>
					<option value='_self' <?if($target == '_self'){echo 'selected';}?>>현재창</option>
					<option value='_blank' <?if($target == '_blank'){echo 'selected';}?>>새창</option>
				</select>
				<input name="link<?=$ino?>" id="link<?=$ino?>" style="width:80%" type="text" value="<?=$link?>">
			</td>
			<th width='10%' style='text-align:center;padding:0;'>순서변경</th>
		</tr>

		<tr>
			<th>노출기간</th>
			<td>
				<input type='text' name='sDate<?=$ino?>' class='cpicker' value='<?=$sDate?>' readonly> ~ 
				<input type='text' name='eDate<?=$ino?>' class='cpicker' value='<?=$eDate?>' readonly>
			</td>
			<td rowspan='3' align='center'>
				
					<?
						if($i > 1){
					?>
						<a href="javascript:go_sort('<?=$i?>','up');"><img src='/images/common/a_up.gif'></a>
					<?
						}

						if(10 > $i){
					?>
						<a href="javascript:go_sort('<?=$i?>','down');"><img src='/images/common/a_down.gif'></a>
					<?
						}
					?>
			</td>
		</tr>

		<tr>
			<th>PC</th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>
				<?
					if($upfile){
				?>
					<tr>
						<td colspan='2'><!--<img src='/upfile/main/<?=$upfile?>' style='max-width:250px'>--></td>
					</tr>
				<?
					}
				?>
					<tr>
						<td width='360'>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route<?=$no?>" style="width:250px;padding:0 0 0 10px;" placeholder="PC 화면에서 보여지는 이미지 입니다.">
								<label>파일선택<input type="file" name="upfile<?=$no?>" id="upfile<?=$no?>" onchange="fileChk('<?=$no?>');"></label>
							</div>
						</td>
					<?
						if($upfile){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel<?=$no?>" name="del_upfile<?=$no?>">
								<label for="fDel<?=$no?>"></label>
							</div>
							<p style='margin:3px 0 0 25px;font-size:12px;'><span class='ico09'>삭제</span>&nbsp;&nbsp;(<?=$realfile?>)</p>
						</td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>

	<?
		$no = sprintf('%02d',$n);
		$link = ${'link'.$no};
		$upfile = ${'upfile'.$no};
		$realfile = ${'realfile'.$no};

		$n++;
	?>
	
		<tr>
			<th>MOBILE</th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>
				<?
					if($upfile){
				?>
					<tr>
						<td colspan='2'><!--<img src='/upfile/main/<?=$upfile?>' style='max-width:250px'>--></td>
					</tr>
				<?
					}
				?>
					<tr>
						<td width='360'>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route<?=$no?>" style="width:250px;padding:0 0 0 10px;" placeholder="모바일 화면에서 보여지는 이미지 입니다.">
								<label>파일선택<input type="file" name="upfile<?=$no?>" id="upfile<?=$no?>" onchange="fileChk('<?=$no?>');"></label>
							</div>
						</td>
					<?
						if($upfile){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel<?=$no?>" name="del_upfile<?=$no?>">
								<label for="fDel<?=$no?>"></label>
							</div>
							<p style='margin:3px 0 0 25px;font-size:12px;'><span class='ico09'>삭제</span>&nbsp;&nbsp;(<?=$realfile?>)</p>
						</td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>
		
<?
	}
?>
	</table>


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>저장</a>
			</td>
		</tr>
	</table>


</div>

</form>
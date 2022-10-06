<?
	$useridTmp = '';
	$pwdTmp = '';

	if($type=='edit' && $uid){
		$sql = "select * from ks_userlist where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$status = $row["status"];
		$userid = $row["userid"];
		$pwd = $row["pwd"];
		$name = $row["name"];
		$userNum = $row["userNum"];
		$sex = $row["sex"];
		$bDate = $row["bDate"];
		$userType = $row["userType"];
		$car = $row["car"];
		$carNum = $row["carNum"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$addr02 = $row["addr02"];
		$bank = $row["bank"];
		$accName = $row["accName"];
		$account = $row["account"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$phone01 = $row["phone01"];
		$phone01Txt = $row["phone01Txt"];
		$phone02 = $row["phone02"];
		$phone02Txt = $row["phone02Txt"];
		$memo = $row["memo"];
		$reduction = $row["reduction"];
		$upfile01 = $row["upfile01"];
		$realfile01 = $row["realfile01"];
		$cok = $row["cok"];
		$cokPost = $row["cokPost"];
		$cokSms = $row["cokSms"];
		$cokEmail = $row["cokEmail"];
		$cokPhone = $row["cokPhone"];
		$health = $row["health"];
		$healthBaby = $row["healthBaby"];
		$healthEtc = $row["healthEtc"];
		$joinType = $row["joinType"];
		$getDate = $row["getDate"];

		//본인인증정보
		$kcbName = $row["kcbName"];
		$kcbBdate = $row["kcbBdate"];
		$kcbSex = $row["kcbSex"];
		$kcbMobile = $row["kcbMobile"];

		$healthArr = explode(',',$health);

		//비고
		if($memo)	$memo = Util::textareaDecodeing($memo);

	}else{
		$status = '2';
		$userType = '일반';
		$healthArr = Array();
		$getDate = date('Y-m-d');

		//기존회원가입
		if($oldUser){
			$sql = "select * from zz_member where uid='$oldUser'";
			$result = mysql_query($sql);
			$row = mysql_fetch_array($result);

			$userNum = $row["userNum"];
			$name = $row["name"];
			$phone01 = $row["mobile"];
			$email01 = $row["email01"];
			$email02 = $row["email02"];
			$bDate = $row["bDate"];
			$zipcode = $row["zipcode"];
			$addr01 = $row["addr01"];

			$status = '1';
			$phone01Txt = '본인';

			include '../../module/HanEng.php';

			//회원이름의 이니셜
			$hangle = hanCho($name);
			$engTxt = initial($hangle);

			//전화번호뒷자리
			$pArr = explode('-',$phone01);
			$lastNum = str_replace(' ','',$pArr[count($pArr)-1]);

			//이니셜+전화번호뒷자리 아이디 생성
			$useridTmp = $engTxt.$lastNum;
			$useridTmp = $useridTmp;

			$pwdTmp = $lastNum;


			//감면내역확인
			$sql = "select * from zz_classSale where userNum='$userNum' order by uid desc limit 1";
			$result = mysql_query($sql);
			$num = mysql_num_rows($result);

			if($num){
				$row = mysql_fetch_array($result);

				$userType = '감면대상자';
				$reduction = $row['saleType'];
			}
		}
	}

	include 'script.php';
?>

<?
	if($type == 'edit'){
?>
<form name='frm_filedown' method='post'>
<input type='hidden' name='file_dir' value='../upfile/user/'>
<input type='hidden' name='ufile' value="<?=$upfile01?>">
<input type='hidden' name='rfile' value="<?=$realfile01?>">
</form>
<?
	}
?>

<form name='FRM' action="<?=$PHP_SELF?>" method='post' ENCTYPE="multipart/form-data">
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='dbfile01' id='dbfile01' value='<?=$upfile01?>'>
<input type='hidden' name='realfile01' id='realfile01' value='<?=$realfile01?>'>
<input type='hidden' name='oldUser' value='<?=$oldUser?>'>

<!-- 검색관련 -->
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_sex' value='<?=$f_sex?>'>
<input type='hidden' name='f_bDate01' value='<?=$f_bDate01?>'>
<input type='hidden' name='f_bDate02' value='<?=$f_bDate02?>'>
<input type='hidden' name='f_status' value='<?=$f_status?>'>
<input type='hidden' name='f_userType' value='<?=$f_userType?>'>
<input type='hidden' name='f_reduction' value='<?=$f_reduction?>'>
<input type='hidden' name='f_carNum' value='<?=$f_carNum?>'>
<input type='hidden' name='f_phone' value='<?=$f_phone?>'>
<input type='hidden' name='f_sort' value='<?=$f_sort?>'>
<input type='hidden' name='f_record' value='<?=$f_record?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>회원 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><?=$ico01?> 가입상태</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree" id='sexBox'>
								<input type="checkbox" value="1" id="jT1" name="status" onclick='setChkBox(this.name,0);' <?if($status == '1'){echo 'checked';}?>>
								<label for="jT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status0'>승인</p>
						</td>
						<td style='padding:0 0 0 25px;'>
							<div class="squaredThree">
								<input type="checkbox" value="2" id="jT2" name="status" onclick='setChkBox(this.name,1);' <?if($status == '2'){echo 'checked';}?>>
								<label for="jT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='status1'>미승인</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

	<?
		if($type == 'write'){
	?>
		<tr>
			<th><?=$ico01?> 아이디</th>
			<td colspan='3'><input name="userid" id="userid" style="width:250px;" type="text" value="<?=$useridTmp?>">  <a href="javascript:checkID(1);" class="super cbtn black">중복체크</a></td>
		</tr>

		<tr>
			<th><?=$ico01?> 비밀번호</th>
			<td colspan='3'><input name="pwd" id="pwd" style="width:250px;" type="password" value="<?=$pwdTmp?>" onkeyup='pwdChk();'> ※ 4자 ~ 12자 이내</td>
		</tr>

		<tr>
			<th><?=$ico01?> 비밀번호 확인</th>
			<td colspan='3'><input name="re_pwd" id="re_pwd" style="width:250px;" type="password" value="<?=$pwdTmp?>" onkeyup='pwdChk();'> <span id='pwdTxt'></span></td>
		</tr>
	<?
		}else{
	?>
		<tr>
			<th><?=$ico01?> 아이디</th>
			<td colspan='3'><?=$userid?><input type='hidden' name='userid' id='userid' value='<?=$userid?>'></td>
		</tr>

		<tr>
			<th><?=$ico01?> 비밀번호</th>
			<td colspan='3'>
			<?
				if($userid){
					if($_SERVER[REMOTE_ADDR] == '106.246.92.237'){
						echo $pwd.'<Br>';
					}
			?>
				<input name="pwd" id="pwd" style="width:250px;" type="password" value="<?=$pwd?>">
			<?
				}
			?>
			</td>
		</tr>
	<?
		}
	?>

		<tr>
			<th width='17%'><?=$ico01?> 성명</th>
			<td width='33%'><input name="name" id="name" style="width:250px;" type="text" value="<?=$name?>"></td>
			<th width='17%'><?=$ico01?> 회원번호</th>
			<td width='33%'><?=$userNum?><input type='hidden' name='userNum' id='userNum' value='<?=$userNum?>'></td>
		</tr>

		<tr>
			<th><?=$ico01?> 성별</th>
			<td>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree" id='sexBox'>
								<input type="checkbox" value="남" id="squaredThree1" name="sex" onclick='setChkBox(this.name,0);' <?if($sex == '남'){echo 'checked';}?>>
								<label for="squaredThree1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='sex0'>남</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="여" id="squaredThree2" name="sex" onclick='setChkBox(this.name,1);' <?if($sex == '여'){echo 'checked';}?>>
								<label for="squaredThree2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='sex1'>여</p>
						</td>
					</tr>
				</table>
			</td>
			<th><?=$ico01?> 생년월일</th>
			<td><input type='text' name='bDate' id='bDate' value='<?=$bDate?>' autocomplete='off' onkeyup="auto_date_format(event, this)" onkeypress="auto_date_format(event, this)" maxlength="10" /></td>
		</tr>

		<tr>
			<th><?=$ico01?> 감면대상자 구분</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree" id='userTypeBox'>
								<input type="checkbox" value="일반" id="squaredThree3" name="userType" onclick='setChkBox(this.name,0);' <?if($userType == '일반'){echo 'checked';}?>>
								<label for="squaredThree3"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='userType0'>일반</p>
						</td>
						<td style='padding:0 0 0 27px;'>
							<div class="squaredThree">
								<input type="checkbox" value="감면대상자" id="squaredThree4" name="userType" onclick='setChkBox(this.name,1);' <?if($userType == '감면대상자'){echo 'checked';}?>>
								<label for="squaredThree4"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='userType1'>감면대상자</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr id="saleBox01" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<th>감면구분</th>
			<td colspan='3'>
				<select name='reduction' id='reduction' style='border:1px solid #ccc;height:30px;'>
					<option value=''>:: 선택 ::</option>
				<?
					for($i=0; $i<count($reductionArr); $i++){
						$rTxt = $reductionArr[$i];
						if($reduction == $rTxt)	$chk = 'selected';
						else							$chk = '';

						echo ("<option value='$rTxt' $chk>$rTxt</option>");
					}
				?>
				</select>
			</td>
		</tr>

		<tr id="saleBox02" <?if($userType == '일반' || $userType == ''){echo "style='display:none;'";}?>>
			<th>감면자료</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="file_input">
								<input type="text" readonly title="File Route" id="file_route01" style="width:250px;padding:0 0 0 10px;" placeholder="감면관련 서류를 첨부해주세요.">
								<label>파일선택<input type="file" name="upfile01" id="upfile01" onchange="fileChk('01');"></label>
							</div>
						</td>
					<?
						if($upfile01){
					?>
						<td style='padding:0 0 0 10px;'>
							<div class="squaredThree">
								<input type="checkbox" value="Y" id="fDel" name="del_upfile01">
								<label for="fDel"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>삭제&nbsp;&nbsp;(<?=$realfile01?>)</p>
						</td>
						<td style='padding:0 0 0 20px;'><a href="javascript:filedownload();" class='small cbtn green'>다운로드</a></td>
					<?
						}
					?>
					</tr>
				</table>
			</td>
		</tr>

		<tr style='display:none;'>
			<th>차량소유</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="" id="cT1" name="car" onclick='setChkBox(this.name,0);' <?if($car == ''){echo 'checked';}?>>
								<label for="cT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='car0'>아니오</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="예" id="cT2" name="car" onclick='setChkBox(this.name,1);' <?if($car == '예'){echo 'checked';}?>>
								<label for="cT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='car1'>예</p>
						</td>
						<td style='padding:0 0 0 20px;'><div id='carBox' style='display:none;'><input name="carNum" id="carNum" style="width:110px;" type="text" value="<?=$carNum?>" placeholder="차량번호"> <span style='font-size:11px;'>예) 12가3456</span></div></td>
					</tr>
				</table>			
			</td>
		</tr>

		<tr>
			<th>주소</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0' width='100%'>
					<tr>
						<td><input name="zipcode" id="zipcode" style="width:70px;" type="text" value="<?=$zipcode?>" maxlength='5'> <a href="javascript:openDaumPostcode();" class='small cbtn black'>주소찾기</a></td>
					</tr>
					<tr>
						<td style='padding:3px 0;'><input name="addr01" id="addr01" style="width:100%;" type="text" value="<?=$addr01?>"></td>
					</tr>
				<!--
					<tr>
						<td><input name="addr02" id="addr02" style="width:490px;" type="text" value="<?=$addr02?>" placeholder="상세주소"></td>
					</tr>
				-->
				</table>
			</td>
		</tr>

		<tr>
			<th>계좌정보</th>
			<td colspan='3'>
				<input name="bank" id="bank" style="width:150px;" type="text" value="<?=$bank?>" placeholder="은행명">
				<input name="accName" id="accName" style="width:150px;" type="text" value="<?=$accName?>" placeholder="예금주">
				<input name="account" id="account" style="width:150px;" type="text" value="<?=$account?>" placeholder="계좌번호">
			</td>
		</tr>

		<tr>
			<th>이메일</th>
			<td colspan='3'>
				<input name="email01" id="email01" style="width:150px;" type="text" value="<?=$email01?>"> @
				<input name="email02" id="email02" style="width:150px;" type="text" value="<?=$email02?>" placeholder="직접입력">
				<select style='border:1px solid #ccc;height:30px;' onchange="document.FRM.email02.value=this.options[this.selectedIndex].value;">
					<option value="">:: 직접입력 ::</option>
					<option value="naver.com">naver.com</option>
					<option value="hanmail.net">hanmail.net</option>
					<option value="gmail.com">gmail.com</option>
					<option value="nate.com">nate.com</option>
					<option value="daum.net">daum.net</option>
					<option value="hotmail.com">hotmail.com</option>
				</select>
			</td>
		</tr>

		<tr>
			<th><?=$ico01?> 연락처</th>
			<td colspan='3'>
				<input name="phone01" id="phone01" style="width:150px;" type="text" value="<?=$phone01?>" placeholder="연락처">
				<input name="phone01Txt" id="phone01Txt" style="width:110px;" type="text" value="<?=$phone01Txt?>" placeholder="관계">
				<select style='border:1px solid #ccc;height:30px;' onchange="$('#phone01Txt').val(this.options[this.selectedIndex].value);">
					<option value="">:: 직접입력 ::</option>
					<option value="본인">본인</option>
					<option value="부모">부모</option>
					<option value="자녀">자녀</option>
				</select>
			<?
				//사용안함
				if($type == 'editediteditediteditediteditedit'){
			?>
				<a href="javascript:smsPhone();" class="small cbtn blood">문자보내기</a>
			<?
				}
			?>
			</td>
		</tr>

		<tr style='display:none;'>
			<th>연락처2</th>
			<td colspan='3'>
				<input name="phone02" id="phone02" style="width:150px;" type="text" value="<?=$phone02?>" placeholder="연락처">
				<input name="phone02Txt" id="phone02Txt" style="width:110px;" type="text" value="<?=$phone02Txt?>" placeholder="관계">
				<select style='border:1px solid #ccc;height:30px;' onchange="$('#phone02Txt').val(this.options[this.selectedIndex].value);">
					<option value="">:: 직접입력 ::</option>
					<option value="본인">본인</option>
					<option value="부모">부모</option>
					<option value="자녀">자녀</option>
				</select>
			</td>
		</tr>

		<tr>
			<th>비고</th>
			<td colspan='3'><textarea name='memo' style='width:100%;height:100px;border:1px solid #ccc;resize:none;'><?=$memo?></textarea></td>
		</tr>


<!--
		<tr>
			<th>정보제공동의</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="" id="sT7" name="cok" onclick='setChkBox(this.name,0);'>
								<label for="sT7"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='cok0'>제공안함</p>
						</td>
						<td style='padding:0 0 0 40px;'>							
							<div class="squaredThree">
								<input type="checkbox" value="1" id="sT8" name="cok" onclick='setChkBox(this.name,1);'>
								<label for="sT8"></label>
							</div>
							<p style='margin:3px 0 0 25px;' class='cok1'>제공</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
-->

		<tr>
			<th>이메일 수신여부</th>
			<td colspan='3'>
				<label for="ec1"><input type="radio" value="1" id="ec1" name="cokEmail" <?if($cokEmail){echo 'checked';}?>>예</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="ec2"><input type="radio" value="" id="ec2" name="cokEmail" <?if($cokEmail == ''){echo 'checked';}?>>아니오</label>
			</td>
		</tr>

		<tr>
			<th>SMS 수신여부</th>
			<td colspan='3'>
				<label for="sc1"><input type="radio" value="1" id="sc1" name="cokSms" <?if($cokSms){echo 'checked';}?>>예</label>&nbsp;&nbsp;&nbsp;&nbsp;
				<label for="sc2"><input type="radio" value="" id="sc2" name="cokSms" <?if($cokSms == ''){echo 'checked';}?>>아니오</label>
			</td>
		</tr>
<!--
		<tr>
			<th>질병 및 건강상태</th>
			<td colspan='3'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tr height='40'>
						<td>
							<div class="squaredThree">
								<input type="checkbox" value="심장질환" id="sT1" name="healthList[]" <?if(in_array('심장질환',$healthArr)){echo 'checked';}?>>
								<label for="sT1"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>심장질환</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="고혈압 및 당뇨" id="sT2" name="healthList[]" <?if(in_array('고혈압 및 당뇨',$healthArr)){echo 'checked';}?>>
								<label for="sT2"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>고혈압 및 당뇨</p>
						</td>
						<td style='padding:0 0 0 40px;'>
							<div class="squaredThree">
								<input type="checkbox" value="전염성피부병 및 호흡기질환" id="sT3" name="healthList[]" <?if(in_array('전염성피부병 및 호흡기질환',$healthArr)){echo 'checked';}?>>
								<label for="sT3"></label>
							</div>
							<p style='margin:3px 0 0 25px;'>전염성피부병 및 호흡기질환</p>
						</td>
					</tr>

					<tr height='40'>
						<td>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td>
										<div class="squaredThree">
											<input type="checkbox" value="임산부" id="sT4" name="healthList[]" <?if(in_array('임산부',$healthArr)){echo 'checked';}?>>
											<label for="sT4"></label>
										</div>
										<p style='margin:3px 0 0 25px;'>임산부</p>
									</td>
									<td style='padding-left:5px;'><input type='text' name='healthBaby' id='healthBaby' value="<?=$healthBaby?>" style='width:60px;' placeholder='주차'></td>
								</tr>
							</table>
						</td>
						<td style='padding:0 0 0 40px;'>
							<table cellpadding='0' cellspacing='0' border='0'>
								<tr>
									<td>
										<div class="squaredThree">
											<input type="checkbox" value="기타" id="sT5" name="healthList[]" <?if(in_array('기타',$healthArr)){echo 'checked';}?>>
											<label for="sT5"></label>
										</div>
										<p style='margin:3px 0 0 25px;'>기타</p>
									</td>
									<td style='padding-left:5px;'><input type='text' name='healthEtc' id='healthEtc' value="<?=$healthEtc?>" style='width:150px;'></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>

		<tr>
			<th>가입경로</th>
			<td colspan='3'>
				<input name="joinType" id="joinType" style="width:150px;" type="text" value="<?=$joinType?>">
				<select name='joinTypeTxt' id='joinTypeTxt' style='border:1px solid #ccc;height:30px;' onchange="$('#joinType').val(this.options[this.selectedIndex].value);">
					<option value=''>:: 직접입력 ::</option>
				<?
					for($i=0; $i<count($joinTypeArr); $i++){
						$txt = $joinTypeArr[$i];

						echo ("<option value='$txt'>$txt</option>");
					}
				?>
				</select>
			</td>
		</tr>
-->
		<tr>
			<th>가입일</th>
			<td colspan='3'>
			<?
				if($type == 'write'){
			?>
				<input type='text' name='getDate' id='fpicker2' value='<?=$getDate?>' readonly>
			<?
				}else{
					echo $getDate;
				}
			?>
			</td>
		</tr>
	</table>

<?
	if($type == 'write'){
?>
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>이용자등록</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
		</tr>
	</table>

<?
	}else{
?>
<!--
	<div class='mCadeTit02' style='margin:30px 0 3px 0;'>본인인증정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th width='17%'>성명</th>
			<td width='33%'><?=$kcbName?></td>
			<th width='17%'>성별</th>
			<td width='33%'><?=$kcbSex?></td>
		</tr>
		<tr>
			<th>생년월일</th>
			<td><?=$kcbBdate?></td>
			<th>휴대폰번호</th>
			<td><?=$kcbMobile?></td>
		</tr>
	</table>
-->
	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:check_form();" class='big cbtn blue'>정보수정</a>&nbsp;&nbsp;
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'><a href="javascript:checkDel();" class='big cbtn blood'>이용자삭제</a></td>
		</tr>
	</table>

<?
	}
?>
</div>


</form>



<script>
$(document).ready(function () {
	//승인
	if('<?=$status?>' == '1'){
		$('#jT1').click();
		$('#jT1').prop('checked', true);
	}else if('<?=$status?>' == '2'){
		$('#jT2').click();
		$('#jT2').prop('checked', true);
	}

	//성별
	if('<?=$sex?>' == '남'){
		$('#squaredThree1').click();
		$('#squaredThree1').prop('checked', true);
	}else if('<?=$sex?>' == '여'){
		$('#squaredThree2').click();
		$('#squaredThree2').prop('checked', true);
	}

	//회원구분
	if('<?=$userType?>' == '일반'){
		$('#squaredThree3').click();
		$('#squaredThree3').prop('checked', true);
	}else if('<?=$userType?>' == '감면대상자'){
		$('#squaredThree4').click();
		$('#squaredThree4').prop('checked', true);
	}

	//차량보유
	if('<?=$car?>' == ''){
		$('#cT1').click();
		$('#cT1').prop('checked', true);
	}else if('<?=$car?>' == '예'){
		$('#cT2').click();
		$('#cT2').prop('checked', true);
	}

	//대상자 자료제공
	if('<?=$cok?>' == ''){
		$('#sT7').click();
		$('#sT7').prop('checked', true);
	}else{
		$('#sT8').click();
		$('#sT8').prop('checked', true);
	}

	//선호채널
	if('<?=$cokPost?>'){
		$('#cC1').click();
		$('#cC1').prop('checked', true);
	}

	if('<?=$cokSms?>'){
		$('#cC2').click();
		$('#cC2').prop('checked', true);
	}

	if('<?=$cokEmail?>'){
		$('#cC3').click();
		$('#cC3').prop('checked', true);
	}

	if('<?=$cokPhone?>'){
		$('#cC4').click();
		$('#cC4').prop('checked', true);
	}
});
</script>
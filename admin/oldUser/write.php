<?
	if($type=='edit' && $uid){
		$sql = "select * from zz_member where uid='$uid'";
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		$year = $row["year"];
		$userNum = $row["userNum"];
		$name = $row["name"];
		$mobile = $row["mobile"];
		$email01 = $row["email01"];
		$email02 = $row["email02"];
		$bDate = $row["bDate"];
		$zipcode = $row["zipcode"];
		$addr01 = $row["addr01"];
		$userid = $row["userid"];

		$email = '';
		if($email01)		$email = $email01;
		if($email02){
			if($email)	$email .= '@';
			$email .= $email02;
		}
	}
?>

<script language='javascript'>
function reg_list(){
	form = document.frm01;
	form.type.value = '';
	form.uid.value = '';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}

function makeUserID(){
	form = document.frm01;
	form.type.value = 'write';
	form.uid.value = '';
	form.record_start.value = '';
	form.f_year.value = '';
	form.f_userNum.value = '';
	form.f_name.value = '';
	form.f_mobile.value = '';
	form.f_addr01.value = '';

	form.target = '';
	form.action = '/admin/userlist/up_index.php';
	form.submit();
}
</script>

<form name='frm01' action="<?=$PHP_SELF?>" method='post'>
<input type='hidden' name='type' value='<?=$type?>'>
<input type='hidden' name='uid' value='<?=$uid?>'>
<input type='hidden' name='oldUser' value='<?=$uid?>'>
<input type='hidden' name='record_start' value='<?=$record_start?>'>


<!-- 검색관련 -->
<input type='hidden' name='f_year' value='<?=$f_year?>'>
<input type='hidden' name='f_userNum' value='<?=$f_userNum?>'>
<input type='hidden' name='f_name' value='<?=$f_name?>'>
<input type='hidden' name='f_mobile' value='<?=$f_mobile?>'>
<input type='hidden' name='f_addr01' value='<?=$f_addr01?>'>
<!-- /검색관련 -->

<div style='width:1000px;'>
	<div class='mCadeTit02' style='margin-bottom:3px;'>회원 정보</div>
	<table cellpadding='0' cellspacing='0' border='0' width='100%' class='zTable'>
		<tr>
			<th><?=$ico01?> 아이디</th>
			<td>
			<?
				if($userid){
					echo $userid;
				}else{
			?>
				<a href="javascript:makeUserID('<?=$uid?>');" class="small cbtn green">아이디 생성하기</a>
			<?
				}
			?>
			</td>
			<th><?=$ico01?> 가입연도</th>
			<td><?=$year?>년</td>
		</tr>
		<tr>
			<th width='17%'><?=$ico01?> 회원번호</th>
			<td width='33%'><?=$userNum?></td>
			<th width='17%'><?=$ico01?> 회원자명</th>
			<td width='33%'><?=$name?></td>
		</tr>

		<tr>
			<th><?=$ico01?> 연락처</th>
			<td><?=$mobile?></td>
			<th><?=$ico01?> 이메일</th>
			<td><?=$email?></td>
		</tr>

		<tr>
			<th><?=$ico01?> 생년월일</th>
			<td colspan='3'><?=$bDate?></td>
		</tr>

		<tr>
			<th><?=$ico01?> 주소</th>
			<td colspan='3'>[<?=$zipcode?>] <?=$addr01?></td>
		</tr>
	</table>


	<table cellpadding='0' cellspacing='0' border='0' width='100%'>
		<tr>
			<td width='20%'></td>
			<td width='40%' align='center' style='padding:30px 0;'>
				<a href="javascript:reg_list();" class='big cbtn black'>목록보기</a>
			</td>
			<td width='20%' align='right'></td>
		</tr>
	</table>
</div>


</form>
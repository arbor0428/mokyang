<script language='javascript'>
function selChk01(){
	season = $('#season').find('option:selected').val();

	$('#fpicker1').val('');
	$('#fpicker2').val('');
	$('#fpicker3').val('');
	$('#fpicker4').val('');
	$('#fpicker5').val('');
	$('#fpicker6').val('');
	$('#fpicker7').val('');

	//분류
	$.post('json.php',{'season':season}, function(c1){
		//분류 selectbox 초기화
		$('#cade01').empty();
		$('#cade01').append("<option value=''>:: 선택 ::</option>");

		//이름 selectbox 초기화
		$('#title').empty();
		$('#title').append("<option value=''>:: 선택 ::</option>");

		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		//분류 selectbox 옵션설정	
		for(i=0; i<parData.length; i++){	
			txt = parData[i];
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#cade01').append(option);
		}

		//이름 selectbox 옵션설정
		if(season == '상시')	txt = '상시프로그램';
		else						txt = season+'학기프로그램';

		option = $("<option value='"+txt+"'>"+txt+"</option>");
		$('#title').append(option);

		for(i=1; i<=12; i++){	
			txt = i+'월프로그램';
			option = $("<option value='"+txt+"'>"+txt+"</option>");
			$('#title').append(option);
		}
	});
}

function chkTitle(){
	year = $('#year').find('option:selected').val();
	title = $('#title').find('option:selected').val();

	$('#fpicker1').val('');
	$('#fpicker2').val('');
	$('#fpicker3').val('');
	$('#fpicker4').val('');
	$('#fpicker5').val('');
	$('#fpicker6').val('');
	$('#fpicker7').val('');

	$.post('jsonTitle.php',{'year':year,'title':title}, function(c1){
		c1 = urldecode(c1);
		parData = JSON.parse(c1);

		aDate01 = parData[0];
		aDate02 = parData[1];
		oDate01 = parData[2];
		oDate02 = parData[3];
		eDate01 = parData[4];
		eDate02 = parData[5];
		cDate01 = parData[6];

		$('#fpicker1').val(aDate01);
		$('#fpicker2').val(aDate02);
		$('#fpicker3').val(oDate01);
		$('#fpicker4').val(oDate02);
		$('#fpicker5').val(eDate01);
		$('#fpicker6').val(eDate02);
		$('#fpicker7').val(cDate01);
	});
}

function reg_list(){
	form = document.FRM;
	form.type.value = 'list';
	form.target = '';
	form.action = 'up_index.php';
	form.submit();
}
</script>



<?
	if($type == 'write'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.year,"연도를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.season,"학기를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"이름을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.aDate01,"접수기간(기존회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.aDate02,"접수기간(기존회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.oDate01,"접수기간(신규회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.oDate02,"접수기간(신규회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.eDate01,"교육기간을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.eDate02,"교육기간을 입력해 주십시오."))	return;

	form.type.value = 'write';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function addContinue(){
	document.getElementById("confirmTxt").innerText = "기간정보가 등록되었습니다.\n계속해서 기간정보를 등록하시겠습니까?";

	document.getElementById("confirmCancelBtn").innerHTML = "<input type='button' class='btn_notice_reg_cancel' value='아니오' onclick='reg_list();'>";
	document.getElementById("confirmBtn").innerHTML = "<input type='button' class='btn_notice_reg_add' value='네' onclick='addContinueOk();'>";

	$(".conFirm_open").click();
	return;
}

function addContinueOk(){
	form = document.FRM;
	form.type.value = 'write';
	form.target = '';
	form.action = '<?=$PHP_SELF?>';
	form.submit();
}
</script>






<?
	}elseif($type == 'edit'){
?>
<script language='javascript'>
function check_form(){
	form = document.FRM;

	if(isFrmEmptyModal(form.year,"연도를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.season,"학기를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.cade01,"분류를 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.title,"이름을 선택해 주십시오."))	return;
	if(isFrmEmptyModal(form.aDate01,"접수기간(기존회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.aDate02,"접수기간(기존회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.oDate01,"접수기간(신규회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.oDate02,"접수기간(신규회원)을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.eDate01,"교육기간을 입력해 주십시오."))	return;
	if(isFrmEmptyModal(form.eDate02,"교육기간을 입력해 주십시오."))	return;

	form.type.value = 'edit';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}

function checkDel(){
	GblMsgConfirmBox("해당 정보를 삭제하시겠습니까?\n삭제후에는 복구가 불가능합니다.","checkDelOk()");
}

function checkDelOk(){
	form = document.FRM;
	form.type.value = 'del';
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>





<?
	}
?>
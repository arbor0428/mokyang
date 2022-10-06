<footer>
    <div class="gray_bg"><!--gray bg--></div>
	<div class="upward f38">
		<a href="#" title="상단으로">
			<span class="lnr lnr-arrow-up"></span>
		</a>
	</div>
    <div class="ft-cont">
		<div class="center flexwrap">
			<!--<h1 class="ft-logo"><img src="/images/common/logo_footer.png"></h1> 202201 로고 삭제요청으로 임시 삭제-->
			<div class="ft-text">
				<ul class="ft-menu clearfix">
					<li class="bold"><a href="/member/policy.php" title="개인정보보호방침">개인정보처리방침</a></li>
					<li><a href="/member/use.php" title="이용약관">이용약관</a></li>
					<li><a href="/member/emailCollectionRefuse.php" title="이메일무단수집거부">이메일무단수집거부</a></li>
				</ul>
				<div class="address f15 clearfix">
					<div class="info01">
						<span>사단법인 함께 꿈을그리다 목양비젼지역아동센터</span>    
						<span>경상남도 김해시 진영읍 진영산복로 201, 2층</span>
					</div>
					<div class="info02">
						<span>대표자:김태현</span>
						<span>고유번호: 499-82-00341</span>
					</div>
				</div>
				<div class="numbers f15">
					<span>전화: 055-343-0391</span>
					<span>팩스: 055-343-0392</span>
				</div>
				<p class="copyright f14">Copyright © 사단법인 함께 꿈을 그리다 목양비젼지역아동센터 All Rights Reserved.</p>
			</div>
		</div>
    </div>
</footer>





<!-- 알림 메세지 -->
<a id="GblNotice_open" class="GblNotice_open"></a>

<div id="GblNotice" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali" id="alertCloseBtn"><button class="GblNotice_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif" alt="알림"></div><div class="pop_ttl0">알림</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="alertTxt" ></span></div>
		<div class="btn_ali_pop2" id="alertBtn"><input type ="button" class="btn_notice_reg GblNotice_close" value="확인" /></div>
	</div>
</div>

<!-- confirm창 -->
<a id="conFirm_open" class="conFirm_open"></a>
<div id="conFirm" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali"><button class="conFirm_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="clearfix"><div class="img_clear"><img src="/module/popupoverlay/ico_notice.gif" alt="확인"></div><div class="pop_ttl0">확인</div></div>
		<div class="pop_div_dotted"></div>
		<div class="write_it"><span id="confirmTxt" ></span></div>
		<a class="conFirm_close" href="#">
			<div class="btn2_wrap">
				<div class="btn_ali_pop3" id="confirmCancelBtn"><input type="button" class="btn_notice_reg_cancel" value="취소" /></div>
				<div class="btn_ali_pop3" id="confirmBtn"><input type="button" class="btn_notice_reg_add" value="확인"></div>
			</div>
		</a>
	</div>
</div>


<a id="multiBox_open" class="multiBox_open"></a>
<div id="multiBox" class="popup_background" style="min-width:250px;display:none;">
	<div class="cls_buttonali"><button class="multiBox_close close_button_pop"></button></div>
	<div class="popup_notice">
		<div class="write_it">
			<div id='multiFrame' style="margin:30px 0 0 0;background:#fff;overflow:hidden;position:relative;"></div>
		</div>
	</div>
</div>


<!-- 팝업 스크립트 -->
<script>
$(document).ready(function () {
	$('#GblNotice,#conFirm,#multiBox').popup({
		transition: 'all 0.3s',
		blur: false,
		escape:false,
		scrolllock: false
	});

	//숫자만 입력받기
	$('.numberOnly').keydown(function(e){
		fn_Number($(this),e);
	}).keyup(function(e){
		fn_Number($(this),e);
	}).css('imeMode','disabled');


	//input필드 자동완성기능
	jQuery('input').attr("autocomplete","off");
});
</script>
<!-- 팝업 스크립트 -->


<iframe name='ifra_gbl' src='about:blank' width='0' height='0' frameborder='0' scrolling='no' style='display:none;'></iframe>

</body>
</html>

<?
if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
	if($table_id){
?>
<div style='position:fixed;bottom:0;left:0;background:#fff;color:#666;padding:10px;'>
<?
	echo $table_id.'<br>';
	echo $write_file.'<br>';
	echo $list_file.'<br>';
	echo $view_file.'<br>';
?>
</div>
<?
	}
}
?>
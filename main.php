<?
	include './header.php';
	include './ks_popset.php';
	include './visit.php';
?>

<section>
    <div class="visual">
        <div class="s-view s1">
            <div class="center">
                <h2 class="f48 c_bk regular">
                    <span class="first f62 light">사람을 잇고 가치를 잇는</span>
                    <span class="second c1 bold">'잇고 잇다'</span>
                    공유 플랫폼
                </h2>
                <p class="v-detail c_bk f18">
                    2021년 
                    <span><img src="images/common/logo_samsung.png" alt="삼성중공업"></span>
                    거제조선소 지정기탁사업 코로나19등의 감염질병에 대비한 지역아동센터 이용 아동의 교육공백 해소를 위한 온라인 플랫폼 모델 구축사업 "랜선 클래스룸"<br> 이 홈페이지는
                    <span><img src="images/common/logo_love.png" alt="사랑의 열매"></span>
                    가 지원합니다.
                </p>
                <div class="pplWrap">
                    <img class="ppl ppl01" src="images/common/people01.png" alt="people01">
                    <img class="ppl ppl02" src="images/common/people02.png" alt="people02">
                    <img class="ppl ppl03" src="images/common/people03.png" alt="people03">
                    <img class="ppl ppl04" src="images/common/people04.png" alt="people04">
                    <img class="ppl ppl05" src="images/common/people05.png" alt="people05">
                    <img class="ppl balloon" src="images/common/balloon.png" alt="balloon">
                </div>
                <div class="mpplWrap" data-aos="zoom-in" data-aos-easing="linear" data-aos-duration="500">
                    <img class="m-ppl ppl03" src="images/common/people03.png" alt="people03">
                    <img class="m-ppl ppl04" src="images/common/people04.png" alt="people04">
                    <img class="m-ppl ppl05" src="images/common/people05.png" alt="people05">
                    <img class="m-ppl balloon" src="images/common/balloon.png" alt="balloon">
                </div>
            </div>
        </div>
        <img class="flower01" src="images/common/flower01.png" alt="flower01">
        <img class="flower02" src="images/common/flower02.png" alt="flower02">
        <img class="bird01" src="images/common/bird01.png" alt="bird01">
        <img class="bird02" src="images/common/bird02.png" alt="bird02">
        <img class="v-cloud" src="images/common/cloud.png" alt="cloud">
    </div>
    <div class="cont1">
        <div class="center">
            <img class="starppl" data-aos="fade-left" data-aos-offset="500" data-aos-duration="800" src="images/common/illust_bg01.png" alt="starppl">
            <div class="ct1-left" data-aos="fade-right" data-aos-offset="500" data-aos-duration="800" >
                <h3 class="f32 c1 bolder">공유 교육 플랫폼 소개</h3>
                <h4 class="f48 bolder">잇고ㅡ잇다</h4>
                <p class="ct1-detail f18 c_bk bold">지역사회 모든 아동 청소년이 행복한 사회<br>
                    모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.
                </p>
                <a class="moreBtn" href="/sub01/sub01.php">자세히보기</a>
            </div>
        </div>
        <img class="ct1-cloud" src="images/common/cloud.png" alt="cloud">
    </div>
    <div class="cont2">
        <div class="center">
            <h3 class="f42">공유 정보 플랫폼</h3>
            <div class="boardWrap">
                <div id="tabmenu1" class="tab" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <ul id="btn1" class="tabbtn clearfix f19 bolder">
                        <li class="on" data-page='/sub04/sub01.php'><a href="#" title="센터뉴스">센터뉴스</a></li>
                        <li class="" data-page='/sub04/sub02.php'><a href="#" title="정책/법령">정책/법령</a></li>
                        <li class="" data-page='/sub04/sub03.php'><a href="#" title="사회복지 지원사업">사회복지 지원사업</a></li>
                    </ul>
                    <a class="plusBtn" href="javascript://"><span class="lnr lnr-plus-circle"></span></a>
                    <div id="cont1" class="tabcont">
                        <ul class="cont-list">
						<?
							$item = sqlArray("select * from tb_board_list where table_id='table_1639985596' order by uid desc limit 5");
							if($item){
								foreach($item as $k => $v){
						?>
                            <li>
                                <a href="/sub04/sub01.php?type=view&uid=<?=$v['uid']?>" title="title"><?=$v['title']?></a>
                                <span class="date"><?=date('Y.m.d',$v['reg_date'])?></span>
                            </li>
						<?
								}
							}else{
						?>
							<li style='text-align:center;'>등록된 게시물이 없습니다.</li>
						<?
							}
						?>
                        </ul>
                        <ul class="cont-list">
						<?
							$item = sqlArray("select * from tb_board_list where table_id='table_1639985605' order by uid desc limit 5");
							if($item){
								foreach($item as $k => $v){
						?>
                            <li>
                                <a href="/sub04/sub02.php?type=view&uid=<?=$v['uid']?>" title="title"><?=$v['title']?></a>
                                <span class="date"><?=date('Y.m.d',$v['reg_date'])?></span>
                            </li>
						<?
								}
							}else{
						?>
							<li style='text-align:center;'>등록된 게시물이 없습니다.</li>
						<?
							}
						?>
                        </ul>
                        <ul class="cont-list">
						<?
							$item = sqlArray("select * from tb_board_list where table_id='table_1639985696' order by uid desc limit 5");
							if($item){
								foreach($item as $k => $v){
						?>
                            <li>
                                <a href="/sub04/sub03.php?type=view&uid=<?=$v['uid']?>" title="title"><?=$v['title']?></a>
                                <span class="date"><?=date('Y.m.d',$v['reg_date'])?></span>
                            </li>
						<?
								}
							}else{
						?>
							<li style='text-align:center;'>등록된 게시물이 없습니다.</li>
						<?
							}
						?>
                        </ul>
                    </div>
                </div>
                <div id="tabmenu2" class="tab" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <ul id="btn2" class="tabbtn clearfix f19 bolder">
                        <li class="on"><a href="/sub06/sub04.php" title="육아정보나눔게시판">공유 업무 플랫폼<!--육아정보나눔게시판--></a></li>
                    </ul>
                    <a class="plusBtn" href="/sub06/sub04.php"><span class="lnr lnr-plus-circle"></span></a>
                    <div id="cont2" class="tabcont">
                        <ul class="cont-list">
						<?
							$item = sqlArray("select * from tb_board_list where table_id='table_1639985002' order by uid desc limit 5");
							if($item){
								foreach($item as $k => $v){
						?>
                            <li>
                                <a href="/sub06/sub04.php?type=view&uid=<?=$v['uid']?>" title="title"><?=$v['title']?></a>
                                <span class="date"><?=date('Y.m.d',$v['reg_date'])?></span>
                            </li>
						<?
								}
							}else{
						?>
							<li style='text-align:center;'>등록된 게시물이 없습니다.</li>
						<?
							}
						?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <img class="ct2-cloud" src="images/common/cloud.png" alt="cloud">
        <img class="mother" src="images/common/illust_bg02.png" alt="mother">
    </div>
    <div class="cont3">
        <div class="center">
            <h3 class="f42">교육 공유 플랫폼</h3>
            <div class="serviceWrap">
                <div class="service" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <a href="/sub02/sub01.php">
                        <div class="imgWrap">
                            <img src="images/common/bnr_thumb04.jpg" alt="서비스1">
                        </div>
                        <h5 class="f26">교육정보플랫폼</h5>
                    </a>
                </div>
                <div class="service" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <a href="/sub02/sub02.php">
                        <div class="imgWrap">
                            <img src="images/common/bnr_thumb02.jpg" alt="서비스2">
                        </div>
                        <h5 class="f26">문화정보플랫폼</h5>
                    </a>
                </div>
                <div class="service" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <a href="/sub02/sub03.php">
                        <div class="imgWrap">
                            <img src="images/common/bnr_thumb03.jpg" alt="서비스3">
                        </div>
                        <h5 class="f26">정서지원플랫폼</h5>
                    </a>
                </div>
				<div class="service" data-aos="fade-up" data-aos-easing="ease" data-aos-duration="1000">
                    <a href="/sub02/sub04.php">
                        <div class="imgWrap">
                            <img src="images/common/bnr_thumb05.jpg" alt="서비스4">
                        </div>
                        <h5 class="f26">보호정보플랫폼</h5>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
$(function(){
	$('#tabmenu1 > .plusBtn').click(function(){
		$('#btn1 > li').each(function(){
			c = $(this).attr('class');
			if(c == 'on'){
				page = $(this).data('page');
				location.href = page;
				return false;
			}
		});
	});	
});
</script>

<?
	include './footer.php';
?>
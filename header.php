


<style>
.form {
  position:fixed;
  top: 131px;
  left: 0;
  /*display: table;*/
  width: 100%;
  height: 100px;
  background: #fff;
  z-index: 9999999;
  text-align: center;
  -webkit-box-shadow: 0 10px 10px 0 rgba(0,0,0,.05);
  box-shadow: 0 10px 10px 0 rgba(0,0,0,.05);
   display: none;
}


.form .inner {
  position: relative;
  width:1100px;
  margin:0 auto;
  top:20px;
}

.form .totalSearch {
  width: 800px;
  height: 50px;
  padding-left: 20px;
  background: 0 0;
  border:none;
  border-bottom: 1px solid rgba(122,175,136,.5);
  color: #373737;
  font-family: 'NanumSquare', sans-serif;
}

.form .totalSearch:focus {outline:none;}

input::-webkit-input-placeholder {
  color: #373737;
  font-size:1.125rem;
  transform:skew(-0.03deg);
  font-family: 'NanumSquare', sans-serif;
}
input:-ms-input-placeholder {
  color: #373737;
   font-size:1.125rem;
   transform:skew(-0.03deg);
   font-family: 'NanumSquare', sans-serif;
}

.form .search {
  display: inline-block;
  width: 32px;
  height: 32px;
  background: url("/images/searchBtn2.png")no-repeat center center;
  text-indent: -9999px;
  margin-left: -60px;
  cursor:pointer;
  border:none;
}
.form .close {
  position: absolute;
  right: 0;
  width: 32px;
  height: 32px;
  top: 58%;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  background: url("/images/closeBtn.png")no-repeat center center;
  text-indent: -9999px;
  cursor:pointer;
  border:none;
}
</style>
<header>
    <div class="ht-top">
        <div class="center clearfix">
            <div class="loginWrap">
                <ul class="clearfix">
					<li><a class="loginBtn f14" href="/" title="첫 화면으로">HOME</a></li>
				<?
					if($GBL_USERID){
				?>
					<li><a class="loginBtn f14" href="/module/login/logout_proc.php" title="로그아웃">로그아웃</a></li>
					<?if($GBL_MTYPE == 'A'){?>
					<li><a class="regiBtn f14" href="/admin/" title="관리자페이지">관리자페이지</a></li>
					<?}else{?>
					<li><a class="regiBtn f14" href="/member/join2.php" title="정보수정">정보수정</a></li>
					<?}?>
				<?
					}else{
				?>
					
					<li><a class="loginBtn f14" href="/member/login.php" title="로그인">로그인</a></li>
					<li><a class="regiBtn f14" href="/member/join1.php" title="회원가입">회원가입</a></li>
				<?
					}
				?>
					<li><a class="sitemap f14" href="/member/sitemap.php" title="사이트 맵">사이트 맵</a></li>
					<li><a class="search searchBtn" href="#" title="검색"><span class="lnr lnr-magnifier"></span></a></li><!--검색-->
                </ul>
            </div>

			<!-- 검색 폼 -->
			<form name='frm_search' id='frm_search' method='post' action="/search/search.php">
			<label><input type='text' style='display:none;'></label>
				<div class="form">
					<div class="cell_box">
						<div class="inner">
							<label for="f_word">
								<input type="text" name="f_word" title="통합검색 입력" placeholder="검색어를 입력해주세요." class="totalSearch" value="" onkeypress="if(event.keyCode==13){$('#frm_search').submit();}">
							</label>
							<button type="submit" class="search" onclick="" title="검색">통합검색</button>
							<button type="button" class="close" title="닫기">닫기</button>
						</div>
					</div>
				</div>
			</form>

			<script>
				$(function(){
					$(".searchBtn").click(function(){
						$(".form").css("display","table");
					});

					$(".close").click(function(){
						$(".form").css("display","none");
					});
					

					$(".form .search").click(function(){
						$('#frm_search').submit();
						return;
					});

					//sticky
					var stickyOffset = $('.form').offset().top;
					$(window).scroll(function(){
						var sticky = $('.form'),
							scroll = $(window).scrollTop();
						
						if (scroll > stickyOffset){
							$('.form').css("top","0");
						}else{
							if($(window).width() > 1024)	$('.form').css("top","131px");
							else									$('.form').css("top","0px");
						}
					});
					
				});
			</script>
			<!--// 검색 폼 -->
        </div>
    </div>
    <div class="navWrap">
        <div class="greenbg"><!--greenbg--></div>
        <div class="navcont">
            <div class="center clearfix">
                <h1 class="logo"><a href="/" title="로고"><img src="/images/common/logo_my1.png" alt="로고"></a></h1>
                <ul class="nav f18">
                    <li>
                        <a href="/sub01/sub01.php" title="공유 플랫폼 소개">공유 플랫폼 소개</a>
                    </li>
                    <li>
                        <a href="/sub02/sub01.php" title="공유 교육 플랫폼">공유 교육 플랫폼</a>
                    </li>
                    <li>
                        <a href="/sub03/sub01.php" title="공유 업무 플랫폼">공유 업무 플랫폼</a>
                    </li>
                    <li>
                        <a href="/sub04/sub01.php" title="공유 정보 플랫폼">공유 정보 플랫폼</a>
                    </li>
                    <li>
                        <a href="/sub05/sub01.php" title="공유 자원 플랫폼">공유 자원 플랫폼</a>
                    </li>
                    <li>
                        <a href="/sub06/sub01.php" title="커뮤니티">커뮤니티</a>
                    </li>
                </ul>
            </div>
            <div class="depthWrap">
                <div class="depthbg"><!--depthbg--></div>
                <div class="boxWrap">
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">공유 플랫폼 소개</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub01/sub01.php" title="플랫폼 소개">플랫폼 소개</a></li>
                                <li><a href="/sub01/sub02.php" title="컨소시엄 기관들">컨소시엄 기관들</a></li>
                                <li><a href="/sub01/sub03.php" title="사단법인 함께 꿈을 그리다">사단법인 함께 꿈을 그리다</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">공유 교육 플랫폼</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub02/sub01.php" title="교육정보플랫폼">교육정보플랫폼</a></li>
                                <li><a href="/sub02/sub02.php" title="문화정보플랫폼">문화정보플랫폼</a></li>
                                <li><a href="/sub02/sub03.php" title="정서지원플랫폼">정서지원플랫폼</a></li>
                                <li><a href="/sub02/sub04.php" title="보호정보플랫폼">보호정보플랫폼</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">공유 업무 플랫폼</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub03/sub01.php" title="업무 정보 공유">업무 정보 공유</a></li>
                                <li><a href="/sub03/sub02.php" title="공유 자료실">공유 자료실</a></li>
                                <li><a href="/sub03/sub03.php" title="업무 Q&A">업무 Q&A</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">공유 정보 플랫폼</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub04/sub01.php" title="뉴스">뉴스</a></li>
                                <li><a href="/sub04/sub02.php" title="정책/법령">정책/법령</a></li>
                                <li><a href="/sub04/sub03.php" title="사회복지 지원사업">사회복지 지원사업</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">공유 자원 플랫폼</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub05/sub01.php" title="인적자원">인적자원</a></li>
                                <li><a href="/sub05/sub02.php" title="물적자원">물적자원</a></li>
                                <li><a href="/sub05/sub03.php" title="물품구매사이트">물품구매사이트</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="depthbox">
                        <img class="greencl" src="/images/common/pc_menu_back.png" alt="greencl">
                        <div class="center clearfix top50">
                            <div class="depth-left">
                                <h3 class="f34">커뮤니티</h3>
                                <p class="detail">지역사회 모든 아동 청소년이 행복한 사회<br>
                                모든 아이들이 자기의 꿈을 그릴 수 있는 희망있는 사회를 구현합니다.</p>
                            </div>
                            <ul class="depth2">
                                <li><a href="/sub06/sub01.php" title="공지사항">공지사항</a></li>
                                <li><a href="/sub06/sub02.php" title="자유게시판">자유게시판</a></li>
                                <li><a href="/sub06/sub03.php" title="사업후원게시판">사업후원게시판</a></li>
                                <li><a href="/sub06/sub04.php" title="육아정보나눔게시판">육아정보나눔게시판</a></li>
                                <li><a href="/sub06/sub05.php" title="아동게시판 위톡">아동게시판"위톡"</a></li>
                                <li><a href="/sub06/sub06.php" title="복지지원서비스">복지지원서비스</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-navcont">
            <div class="center clearfix">
                <h1 class="logo"><a href="/" title="로고"><img src="/images/common/logo_my1.png" alt="로고"></a></h1>
                <div class="m-btn">
                    <a href="#" title="m-menu">
                        <div class="btnline">
                            <div><!--bar1--></div>
                            <div><!--bar2--></div>
                            <div><!--bar3--></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="m-navWrap">
        <div class="m-navbox">
            <div class="mn-top">
                <ul class="m-loginwrap clearfix">
				<?
					if($GBL_USERID){
				?>
					<li><a class="loginBtn f16" href="/module/login/logout_proc.php" title="로그아웃">로그아웃</a></li>
					<?if($GBL_MTYPE == 'A'){?>
					<li><a class="regiBtn f16" href="/admin/" title="관리자페이지">관리자페이지</a></li>
					<?}else{?>
					<li><a class="regiBtn f16" href="/member/join2.php" title="정보수정">정보수정</a></li>
					<?}?>
				<?
					}else{
				?>
					<li><a class="loginBtn f16" href="/member/login.php" title="로그인">로그인</a></li>
					<li><a class="regiBtn f16" href="/member/join1.php" title="회원가입">회원가입</a></li>
				<?
					}
				?>
                </ul>
                <div class="closeBtn">
                    <a href="#" title="close">
                        <span class="lnr lnr-cross"></span>
                    </a>
                </div>
            </div>
            <ul class="m-nav">
                <li>
                    <a href="" title="공유 플랫폼 소개">공유 플랫폼 소개</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                        <li><a href="/sub01/sub01.php" title="플랫폼 소개">플랫폼 소개</a></li>
						<li><a href="/sub01/sub02.php" title="컨소시엄 기관들">컨소시엄 기관들</a></li>
						<li><a href="/sub01/sub03.php" title="사단법인 함께 꿈을 그리다">사단법인 함께 꿈을 그리다</a></li>
                    </ul>
                </li>
                <li>
                    <a href="" title="공유 교육 플랫폼">공유 교육 플랫폼</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                        <li><a href="/sub02/sub01.php" title="교육정보플랫폼">교육정보플랫폼</a></li>
						<li><a href="/sub02/sub02.php" title="문화정보플랫폼">문화정보플랫폼</a></li>
						<li><a href="/sub02/sub03.php" title="정서지원플랫폼">정서지원플랫폼</a></li>
						<li><a href="/sub02/sub04.php" title="보호정보플랫폼">보호정보플랫폼</a></li>
                    </ul>
                </li>
                <li>
                    <a href="" title="공유 업무 플랫폼">공유 업무 플랫폼</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                        <li><a href="/sub03/sub01.php" title="업무 정보 공유">업무 정보 공유</a></li>
						<li><a href="/sub03/sub02.php" title="공유 자료실">공유 자료실</a></li>
						<li><a href="/sub03/sub03.php" title="업무 Q&A">업무 Q&A</a></li>
                    </ul>
                </li>
                <li>
                    <a href="" title="공유 정보 플랫폼">공유 정보 플랫폼</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                        <li><a href="/sub04/sub01.php" title="뉴스">뉴스</a></li>
						<li><a href="/sub04/sub02.php" title="정책/법령">정책/법령</a></li>
						<li><a href="/sub04/sub03.php" title="사회복지 지원사업">사회복지 지원사업</a>
                    </ul>
                </li>
                <li>
                    <a href="" title="공유 자원 플랫폼">공유 자원 플랫폼</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                         <li><a href="/sub05/sub01.php" title="인적자원">인적자원</a></li>
						<li><a href="/sub05/sub02.php" title="물적자원">물적자원</a></li>
						<li><a href="/sub05/sub03.php" title="물품구매사이트">물품구매사이트</a></li>
                    </ul>
                </li>
                <li>
                    <a href="" title="커뮤니티">커뮤니티</a>
                    <span class="lnr lnr-chevron-down"></span>
                    <span class="lnr lnr-chevron-up"></span>
                    <ul class="m-depth2">
                        <li><a href="/sub06/sub01.php" title="공지사항">공지사항</a></li>
						<li><a href="/sub06/sub02.php" title="자유게시판">자유게시판</a></li>
						<li><a href="/sub06/sub03.php" title="사업후원게시판">사업후원게시판</a></li>
						<li><a href="/sub06/sub04.php" title="육아정보나눔게시판">육아정보나눔게시판</a></li>
						<li><a href="/sub06/sub05.php" title="아동게시판 위톡">아동게시판"위톡"</a></li>
						<li><a href="/sub06/sub06.php" title="복지지원서비스">복지지원서비스</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</header>



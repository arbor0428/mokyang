<?
	include "../header.php";
?>


<style>
.sitemap-bg1 {background:#8dcfeb;}
.sitemap-bg2 {background:#fec16b;}
.sitemap-bg3 {background:#de95b1;}
.sitemap-bg4 {background:#7aaf88;}

.sitemap-wrap {display:flex; flex-wrap:wrap;}
.sitemap-wrap .sitemap-box {width:calc(33.33% - 40px); margin:40px 20px; box-sizing:border-box;}
.sitemap-wrap .sitemap-box li {padding:10px 0;  text-align:center;}
.sitemap-wrap .sitemap-box li:not(:last-child){border-bottom:1px dotted #e1e1e1; }
.sitemap-wrap .sitemap-box li:first-child {color:#fff; padding:14px 0; border-radius:12px 12px 0 0; font-size:1.125rem; border-bottom:none;}
.sitemap-wrap .sitemap-box li a {display:inline-block; width:100%;}


@media screen and (max-width:1024px){
.sitemap-wrap .sitemap-box {width:calc(50% - 40px);}
}

@media screen and (max-width:768px){
.sitemap-wrap .sitemap-box {width:calc(100% - 40px);}
}

</style>

<div class="center sub">
	<div class="member-area wrap">
		<h2>사이트맵</h2>
		

		<div class="sitemap-wrap">
			<ul class="sitemap-box">
				<li class="sitemap-bg4">공유 플랫폼 소개</li>
				<li><a href="/sub01/sub01.php" title="플랫폼 소개">플랫폼 소개</a></li>
				<li><a href="/sub01/sub02.php" title="컨소시엄 기관들">컨소시엄 기관들</a></li>
				<li><a href="/sub01/sub03.php" title="사단법인 함께 꿈을 그리다">사단법인 함께 꿈을 그리다</a></li>
			</ul>

			<ul class="sitemap-box">
				<li class="sitemap-bg1">공유 교육 플랫폼</li>
				 <li><a href="/sub02/sub01.php" title="교육정보플랫폼">교육정보플랫폼</a></li>
				<li><a href="/sub02/sub02.php" title="문화정보플랫폼">문화정보플랫폼</a></li>
				<li><a href="/sub02/sub03.php" title="정서지원플랫폼">정서지원플랫폼</a></li>
				<li><a href="/sub02/sub04.php" title="보호정보플랫폼">보호정보플랫폼</a></li>
			</ul>

			<ul class="sitemap-box">
				<li class="sitemap-bg2">공유 업무 플랫폼</li>
				<li><a href="/sub03/sub01.php" title="업무 정보 공유">업무 정보 공유</a></li>
				<li><a href="/sub03/sub02.php" title="공유 자료실">공유 자료실</a></li>
				<li><a href="/sub03/sub03.php" title="업무 Q&A">업무 Q&A</a></li>
			</ul>

			<ul class="sitemap-box">
				<li class="sitemap-bg3">공유 정보 플랫폼</li>
				<li><a href="/sub04/sub01.php" title="뉴스">뉴스</a></li>
				<li><a href="/sub04/sub02.php" title="정책/법령">정책/법령</a></li>
				<li><a href="/sub04/sub03.php" title="사회복지 지원사업">사회복지 지원사업</a></li>
			</ul>

			<ul class="sitemap-box">
				<li class="sitemap-bg2">공유 자원 플랫폼</li>
				<li><a href="/sub05/sub01.php" title="인적자원">인적자원</a></li>
				<li><a href="/sub05/sub02.php" title="물적자원">물적자원</a></li>
				<li><a href="/sub05/sub03.php" title="물품구매사이트">물품구매사이트</a></li>
			</ul>

			<ul class="sitemap-box">
				<li class="sitemap-bg4">커뮤니티</li>
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
<?
	include "../footer.php";
?>
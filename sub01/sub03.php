<?
	include "../header.php";

	$on03 = 'on';
	include "./subtop.php";
?>

<style>
.box-2 {display:flex; align-items:center; margin:30px 0 60px 0;}
.box-2 div.imgs, .box-2 div.txt {width:50%;}
.box-2 div.txt {padding:80px 40px; box-sizing:border-box; line-height:1.5; word-break:keep-all;}

.bus-list {margin:30px 0 60px 0;}
.bus-list div.row {display:flex; position:relative; width:100%; padding:10px; box-sizing:border-box;}
.bus-list div.row2 {display:flex; flex-wrap:wrap; position:relative; width:100%;}
.bus-list div.row2 > div.col {width:50%; position:relative; padding:10px; box-sizing:border-box;}

.bus-list div.inner {width:100%; background:#f3f3f3; padding:20px 0;}
.bus-list span.num {position:absolute; top:0; left:0; padding:10px; background:#7aaf88; color:#fff; font-size:1.250rem;}
.bus-list p {padding:0 60px; box-sizing:border-box; line-height:1.5; font-size:1.125rem; letter-spacing:-0.03em; word-break:keep-all;}

@media screen and (max-width:1480px) {
	/*.bus-list p {font-size:1rem;}*/
	.bus-list div.row2 > div.col {width:100%;}
}

@media screen and (max-width:1240px) {
	.box-2 {flex-direction:column;}
	.box-2 div.imgs {text-align:center;}
	.box-2 div.imgs, .box-2 div.txt {width:100%;}
}

@media screen and (max-width:1024px) {
	.box-2 div.txt {padding:40px 40px;}
}

@media screen and (max-width:768px) {
	 .box-2 div.txt {text-align:center;}
}

</style>

<div class="center sub">
	<h4>법인설립개요</h4>

	<div class="box-2">
		<div class="imgs">
			<img src="/images/common/illust_bg01.png" alt="이미지">
		</div>

		<div class="txt f18">
			사단법인 함께 꿈을 그리다는 지역사회 안에서 사회적 도움을 필요로 하는
			아동 청소년 장애인 등의 취약 계층의 성장을 지원하고
			모든 아동 청소년이 살기 좋은 세상을 만들기 위해 지역사회 공동체 망을 형성하고 
			네트워크 구성을 통한 아동 청소년의 통합적인 지원을 구축합니다.<br><br>
			이를 통해 지역과 가정환경 부모의 사회적, 경제적 지위와 상관없이 
			모든 아동 청소년이 행복한 사회, 모든 아이들이 자기의 꿈을 그릴 수 있는 
			희망 있는 사회를 구현을 위하여 법인을 설립 운영합니다.
		</div>
	</div>

	<h4>법인 주요 목적사업</h4>

	<div class="bus-list">
		<div class="row">
			<div class="inner">
				<span class="num">01</span>
				<p>
					지역사회 취약계층 아동을 대상으로 보호(안전한 보호, 급식 등), 교육 기능(일상생활 지도, 학습능력 제고 등), 정서적 지원(상담·가족지원), 문화서비스(체험활동, 공연) 등으로 지역 사회 내 사전 예방적 기능 및 사후 연계 사업을 진행
				</p>
			</div>
		</div>
		
		<div class="row2">
			<div class="col-1 col">
				<div class="inner">
					<span class="num">02</span>
					<p>
						지역사회 취약계층 아동의 돌봄과 건강한 성장을 위한 복지시설 운영
					</p>
				</div>
			</div>
			<div class="col-2 col">
				<div class="inner">
					<span class="num">03</span>
					<p>
						지역사회 아동복지기관 종사자 교육 및 자문 사업을 운영합니다.
					</p>
				</div>
			</div>

			<div class="col-2 col">
				<div class="inner">
					<span class="num">04</span>
					<p>
						지역사회 아동복지 프로그램 개발 및 지원 사업
					</p>
				</div>
			</div>

			<div class="col-2 col">
				<div class="inner">
					<span class="num">05</span>
					<p>
						지역사회 아동돌봄 운영 연구사업 및 관련 조사 사업 
					</p>
				</div>
			</div>

			<div class="col-2 col">
				<div class="inner">
					<span class="num">06</span>
					<p>
						지역사회 위기아동 긴급 지원 사업
					</p>
				</div>
			</div>

			<div class="col-2 col">
				<div class="inner">
					<span class="num">07</span>
					<p>
						기타 법인의 목적달성에 필요한 사업
					</p>
				</div>
			</div>
		</div>
	</div>

	<h4>비젼 및 전략</h4>

	<div class="txt_c m36 m_66">
		<img src="/images/sub/vision_img.png" alt="목양비젼지역아동센터 비젼">
	</div>
</div>
<?
	include "../footer.php";
?>
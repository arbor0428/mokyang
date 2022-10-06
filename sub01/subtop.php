<?
	if($on01)		$subTitle = "플랫폼 소개";
	elseif($on02)	$subTitle = "컨소시엄 기관들";
	elseif($on03)	$subTitle = "사단법인 함께 꿈을 그리다";
?>

<div class="area-subtop">
  <div class="inr">
  	<ul class="location">
      <li><img src="/images/sub/home_icon_gry.png" alt="홈"></li>
      <li>공유 플랫폼 소개</li>
      <li><?=$subTitle?></li>
    </ul>
    <div class="title">
      <h2>공유 플랫폼 소개</h2>
      <p>Shared platform.</p>
    </div>
  </div>

  <div class="inner">
    <div class="lnb pc">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <ul>
        <li><a href="/sub01/sub01.php" class="sub01 <?=$on01?>">플랫폼 소개</a></li>
        <li><a href="/sub01/sub02.php" class="sub02 <?=$on02?>">컨소시엄 기관들</a></li>
        <li><a href="/sub01/sub03.php" class="sub03 <?=$on03?>">사단법인 함께 꿈을 그리다</a></li>
      </ul>
    </div>
    <div class="lnb mobile">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <div class="large">공유 플랫폼 소개</div>
      <div class="small">
        <span><?=$subTitle?></span>
        <ul>
		<?
			if($on01){
		?>
			<li><a href="/sub01/sub02.php" class="sub02">컨소시엄 기관들</a></li>
			<li><a href="/sub01/sub03.php" class="sub03">사단법인 함께 꿈을 그리다</a></li>
		<?
			  }elseif($on02){
		?>
			<li><a href="/sub01/sub01.php" class="sub01">플랫폼 소개</a></li>
			<li><a href="/sub01/sub03.php" class="sub03">사단법인 함께 꿈을 그리다</a></li>
		<?
			  }elseif($on03){
		?>
			<li><a href="/sub01/sub01.php" class="sub01">플랫폼 소개</a></li>
			<li><a href="/sub01/sub02.php" class="sub02">컨소시엄 기관들</a></li>
		<?
			}
		?>
        </ul>
      </div>
    </div>
  </div>
</div>

<script>
$(function(){
	$('.area-subtop .lnb.mobile .small').click(function(){
		$(this).children('ul').slideToggle(300,'linear');
		$(this).toggleClass('active');
	});

});
</script>
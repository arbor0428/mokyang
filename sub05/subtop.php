<?
	if($on01)		$subTitle = "인적자원";
	elseif($on02)	$subTitle = "물적자원";
	elseif($on03)	$subTitle = "물품구매사이트";
?>

<div class="area-subtop">
  <div class="inr">
  	<ul class="location">
      <li><img src="/images/sub/home_icon_gry.png" alt="홈"></li>
      <li>공유 자원 플랫폼</li>
      <li><?=$subTitle?></li>
    </ul>
    <div class="title">
      <h2>공유 자원 플랫폼</h2>
      <p>Shared resource platform.</p>
    </div>
  </div>

  <div class="inner">
    <div class="lnb pc">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <ul>
        <li><a href="/sub05/sub01.php" class="sub01 <?=$on01?>">인적자원</a></li>
        <li><a href="/sub05/sub02.php" class="sub02 <?=$on02?>">물적자원</a></li>
        <li><a href="/sub05/sub03.php" class="sub03 <?=$on03?>">물품구매사이트</a></li>
      </ul>
    </div>
    <div class="lnb mobile">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <div class="large">공유 자원 플랫폼</div>
      <div class="small">
        <span><?=$subTitle?></span>
        <ul>
		<?
			if($on01){
		?>
			<li><a href="/sub05/sub02.php" class="sub02">물적자원</a></li>
			<li><a href="/sub05/sub03.php" class="sub03">물품구매사이트</a></li>
		<?
			  }elseif($on02){
		?>
			<li><a href="/sub05/sub01.php" class="sub01">인적자원</a></li>
			<li><a href="/sub05/sub03.php" class="sub03">물품구매사이트</a></li>
		<?
			  }elseif($on03){
		?>
			<li><a href="/sub05/sub01.php" class="sub01">인적자원</a></li>
			<li><a href="/sub05/sub02.php" class="sub02">물적자원</a></li>
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
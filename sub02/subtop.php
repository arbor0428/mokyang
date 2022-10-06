<?
	if($on01)		$subTitle = "교육정보플랫폼";
	elseif($on02)	$subTitle = "문화정보플랫폼";
	elseif($on03)	$subTitle = "정서지원플랫폼";
	elseif($on04)	$subTitle = "보호정보플랫폼";
?>

<div class="area-subtop">
  <div class="inr">
  	<ul class="location">
      <li><img src="/images/sub/home_icon_gry.png" alt="홈"></li>
      <li>공유 교육 플랫폼</li>
      <li><?=$subTitle?></li>
    </ul>
    <div class="title">
      <h2>공유 교육 플랫폼</h2>
      <p>Shared education platform.</p>
    </div>
  </div>

  <div class="inner">
    <div class="lnb pc">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <ul>
        <li><a href="/sub02/sub01.php" class="sub01 <?=$on01?>">교육정보플랫폼</a></li>
        <li><a href="/sub02/sub02.php" class="sub02 <?=$on02?>">문화정보플랫폼</a></li>
        <li><a href="/sub02/sub03.php" class="sub03 <?=$on03?>">정서지원플랫폼</a></li>
		<li><a href="/sub02/sub04.php" class="sub04 <?=$on04?>">보호정보플랫폼</a></li>
      </ul>
    </div>
    <div class="lnb mobile">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <div class="large">공유 교육 플랫폼</div>
      <div class="small">
        <span><?=$subTitle?></span>
        <ul>
		<?
			if($on01){
		?>
			<li><a href="/sub02/sub02.php" class="sub02">문화정보플랫폼</a></li>
			<li><a href="/sub02/sub03.php" class="sub03">정서지원플랫폼</a></li>
			<li><a href="/sub02/sub04.php" class="sub04">보호정보플랫폼</a></li>
		<?
			  }elseif($on02){
		?>
			<li><a href="/sub02/sub01.php" class="sub01">교육정보플랫폼</a></li>
			<li><a href="/sub02/sub03.php" class="sub03">정서지원플랫폼</a></li>
			<li><a href="/sub02/sub04.php" class="sub04">보호정보플랫폼</a></li>
		<?
			  }elseif($on03){
		?>
			<li><a href="/sub02/sub02.php" class="sub02">문화정보플랫폼</a></li>
			<li><a href="/sub02/sub03.php" class="sub03">정서지원플랫폼</a></li>
			<li><a href="/sub02/sub04.php" class="sub04">보호정보플랫폼</a></li>
		<?
			  }elseif($on04){
		?>
			<li><a href="/sub02/sub01.php" class="sub01">교육정보플랫폼</a></li>
			<li><a href="/sub02/sub02.php" class="sub02">문화정보플랫폼</a></li>
			<li><a href="/sub02/sub03.php" class="sub03">정서지원플랫폼</a></li>
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
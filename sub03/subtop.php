<?
	if($on01)		$subTitle = "업무 정보 공유";
	elseif($on02)	$subTitle = "공유 자료실";
	elseif($on03)	$subTitle = "업무 Q&A";
?>

<div class="area-subtop">
  <div class="inr">
  	<ul class="location">
      <li><img src="/images/sub/home_icon_gry.png" alt="홈"></li>
      <li>공유 업무 플랫폼</li>
      <li><?=$subTitle?></li>
    </ul>
    <div class="title">
      <h2>공유 업무 플랫폼</h2>
      <p>Shared work platform.</p>
    </div>
  </div>

  <div class="inner">
    <div class="lnb pc">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <ul>
        <li><a href="/sub03/sub01.php" class="sub01 <?=$on01?>">업무 정보 공유</a></li>
        <li><a href="/sub03/sub02.php" class="sub02 <?=$on02?>">공유 자료실</a></li>
        <li><a href="/sub03/sub03.php" class="sub03 <?=$on03?>">업무 Q&A</a></li>
      </ul>
    </div>
    <div class="lnb mobile">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <div class="large">공유 업무 플랫폼</div>
      <div class="small">
        <span><?=$subTitle?></span>
        <ul>
		<?
			if($on01){
		?>
			<li><a href="/sub03/sub02.php" class="sub02">공유 자료실</a></li>
			<li><a href="/sub03/sub03.php" class="sub03">업무 Q&A</a></li>
		<?
			  }elseif($on02){
		?>
			<li><a href="/sub03/sub01.php" class="sub01">업무 정보 공유</a></li>
			<li><a href="/sub03/sub03.php" class="sub03">업무 Q&A</a></li>
		<?
			  }elseif($on03){
		?>
			<li><a href="/sub03/sub01.php" class="sub01">업무 정보 공유</a></li>
			<li><a href="/sub03/sub02.php" class="sub02">공유 자료실</a></li>
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
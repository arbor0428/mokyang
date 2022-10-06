<?
	if($on01)		$subTitle = '공지사항';
	elseif($on02)	$subTitle = '자유게시판';
	elseif($on03)	$subTitle = '사업후원게시판';
	elseif($on04)	$subTitle = '육아정보나눔게시판';
	elseif($on05)	$subTitle = '아동게시판"위톡"';
	elseif($on06)	$subTitle = '복지지원서비스';
?>

<div class="area-subtop">
  <div class="inr">
  	<ul class="location">
      <li><img src="/images/sub/home_icon_gry.png" alt="홈"></li>
      <li>커뮤니티</li>
      <li><?=$subTitle?></li>
    </ul>
    <div class="title">
      <h2>커뮤니티</h2>
      <p>Community.</p>
    </div>
  </div>

  <div class="inner">
    <div class="lnb pc">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <ul>
        <li><a href="/sub06/sub01.php" class="sub01 <?=$on01?>">공지사항</a></li>
        <li><a href="/sub06/sub02.php" class="sub02 <?=$on02?>">자유게시판</a></li>
        <li><a href="/sub06/sub03.php" class="sub03 <?=$on03?>">사업후원게시판</a></li>
		 <li><a href="/sub06/sub04.php" class="sub04 <?=$on04?>">육아정보나눔게시판</a></li>
		  <li><a href="/sub06/sub05.php" class="sub05 <?=$on05?>">아동게시판"위톡"</a></li>
		   <li><a href="/sub06/sub06.php" class="sub06 <?=$on06?>">복지지원서비스</a></li>
      </ul>
    </div>
    <div class="lnb mobile">
      <div class="home"><a href="/"><img src="/images/sub/home_icon.png" alt="홈"></a></div>
      <div class="large">커뮤니티</div>
      <div class="small">
        <span><?=$subTitle?></span>
        <ul>
		<?
			if($on01){
		?>
			<li><a href="/sub06/sub02.php" class="sub02">자유게시판</a></li>
			<li><a href="/sub06/sub03.php" class="sub03">사업후원게시판</a></li>
			<li><a href="/sub06/sub04.php" class="sub04">육아정보나눔게시판</a></li>
			<li><a href="/sub06/sub05.php" class="sub05">아동게시판"위톡"</a></li>
			<li><a href="/sub06/sub06.php" class="sub06">복지지원서비스</a></li>
		<?
			  }elseif($on02){
		?>
			<li><a href="/sub06/sub01.php" class="sub01">공지사항</a></li>
			<li><a href="/sub06/sub03.php" class="sub03">사업후원게시판</a></li>
			<li><a href="/sub06/sub04.php" class="sub04">육아정보나눔게시판</a></li>
			<li><a href="/sub06/sub05.php" class="sub05">아동게시판"위톡"</a></li>
			<li><a href="/sub06/sub06.php" class="sub06">복지지원서비스</a></li>
		<?
			  }elseif($on03){
		?>
			<li><a href="/sub06/sub01.php" class="sub01">공지사항</a></li>
			<li><a href="/sub06/sub02.php" class="sub02">자유게시판</a></li>
			<li><a href="/sub06/sub04.php" class="sub04">육아정보나눔게시판</a></li>
			<li><a href="/sub06/sub05.php" class="sub05">아동게시판"위톡"</a></li>
			<li><a href="/sub06/sub06.php" class="sub06">복지지원서비스</a></li>
		<?
			  }elseif($on04){
		?>
			<li><a href="/sub06/sub01.php" class="sub01">공지사항</a></li>
			<li><a href="/sub06/sub02.php" class="sub02">자유게시판</a></li>
			<li><a href="/sub06/sub03.php" class="sub03">사업후원게시판</a></li>
			<li><a href="/sub06/sub05.php" class="sub05">아동게시판"위톡"</a></li>
			<li><a href="/sub06/sub06.php" class="sub06">복지지원서비스</a></li>
		<?
			  }elseif($on05){
		?>
			<li><a href="/sub06/sub01.php" class="sub01">공지사항</a></li>
			<li><a href="/sub06/sub02.php" class="sub02">자유게시판</a></li>
			<li><a href="/sub06/sub03.php" class="sub03">사업후원게시판</a></li>
			<li><a href="/sub06/sub04.php" class="sub04">육아정보나눔게시판</a></li>
			<li><a href="/sub06/sub06.php" class="sub06">복지지원서비스</a></li>
		<?
			  }elseif($on06){
		?>
			<li><a href="/sub06/sub01.php" class="sub01">공지사항</a></li>
			<li><a href="/sub06/sub02.php" class="sub02">자유게시판</a></li>
			<li><a href="/sub06/sub03.php" class="sub03">사업후원게시판</a></li>
			<li><a href="/sub06/sub04.php" class="sub04">육아정보나눔게시판</a></li>
			<li><a href="/sub06/sub05.php" class="sub05">아동게시판"위톡"</a></li>
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
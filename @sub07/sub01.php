<?
	include '../header.php';

	$table_id = 'table_1628232234';	

	if(!$table_id){
		Msg::backMsg('접근오류입니다.');
	}
	
	
	if($GBL_MTYPE=='A'){
		if(!$type)	$type='list';
	}

	if(!$type)	$type = 'write';

	//게시판 환경설정
	include $boardRoot."config.php";

?>

<div class="cs-top">
	<div class="top-content">
		<div class="con">
			
			<div class="tit f42 c_bk bold2 txt-c"  data-aos="fade-up" data-aos-duration="1000">
				온라인 상담
			</div>

		</div>
	</div>
	<div class="cs-bg"></div>
</div>

<nav class="csnav">
  <ul>
    <li><a href="/sub07/sub02.php">공지사항</a></li>
    <li><a href="/sub07/sub01.php" class="active">온라인상담</a></li>
  </ul>
</nav>

<article class="cs01 sub-section">
	<div class="con">
		
		<?
					if($_SERVER['REMOTE_ADDR'] == '106.246.92.237'){
					
						echo$write_file.'<br>';
						echo$list_file.'<br>';
						echo$view_file.'<br>';
					
					}

			  switch($type){
			  case 'write' :
			  case 'edit' :
			  include $boardRoot.$write_file;
			  break;

			  case 'list' :
			  include $boardRoot.'query.php'; //게시판 내용 쿼리
			  include $boardRoot.$list_file;  //게시판 리스트
			  include $boardRoot.'pageNum.php'; //게시판 페이지번호
			  break;

			  case 'view' :
			  include $boardRoot.$view_file;

			  break;

			  case 're_write' :
			  case 're_edit' :
			  include $boardRoot.'re_write.php';
			  break;

			  case 're_view' :
			  include $boardRoot.'re_view.php';
			  break;
			}
		  ?>

	</div>
</article>


<script>


	AOS.init();


</script>

<?
	//include '../counsel.php';
	include '../footer.php';
?>
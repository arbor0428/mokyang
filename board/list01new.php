<script>
function reg_register(){
	form = document.frm01;
	form.type.value = 'write';
	form.action = "<?=$_SERVER['PHP_SELF']?>"
	form.submit();
}

function reg_modify(uid){
	form = document.frm01;
	form.type.value = 'edit';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>"
	form.submit();
}

function reg_view(uid){
	form = document.frm01;
	form.type.value = 'view';
	form.uid.value = uid;
	form.action = "<?=$_SERVER['PHP_SELF']?>"
	form.submit();
}
</script>

<style>
.board1{font-size:14px;}
.b-text{word-break:keep-all;}

.list-img {position:relative;}
.list-img img {position:absolute; top:-20%; left:0; width:100%; height:140%;}
/* 모바일 */
@media screen and (max-width:768px) {
	.board1{font-size:13px;}
}
</style>

<form name='frm01' method='post' action='<?=$PHP_SELF?>'>
<label><input type="text" style="display: none;"></label>  <!-- 텍스트박스 1개이상 처리.. 자동전송방지 -->
<input type='hidden' name='type' value=''>
<input type='hidden' name='uid' value=''>
<input type='hidden' name='record_start' value='<?=$record_start?>'>
<input type='hidden' name='table_id' value='<?=$table_id?>'>
<input type='hidden' name='next_url' value='<?=$PHP_SELF?>'>
<input type='hidden' name='strRoot' value='<?=$strRoot?>'>
<input type='hidden' name='boardRoot' value='<?=$boardRoot?>'>

<h2 class="titles"><?=$table_title?> <span class="case_number">(<?=number_format($total_record)?>건)</span></h2>

<?
//글쓰기 권한 설정
include $boardRoot.'chk_write.php';

?>

<!-- 등록버튼 -->
<div style="margin:20px 0;"><?=$btn_write?></div>

<?
if($total_record != '0'){
	$i = $total_record - ($current_page - 1) * $record_count;

	while($row = mysql_fetch_array($result)){

		$uid = $row["uid"];
		$title = $row["title"];
		$name = $row["name"];
		$ment = strip_tags($row["ment"]);
		$rDate = date('Y.m.d H:i',$row["reg_date"]);

		//입력한 내용의 첫번째 이미지
		$thumbImg = Util::getFirstImage($row["ment"]);

		//시민뉴스 > 영상제보
		if($row["sDataUrl"]){
			$tmpArr = explode('/',$row["sDataUrl"]);
			$videoCode = $tmpArr[count($tmpArr)-1];
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/default.jpg";			//120×90
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/mqdefault.jpg";		//320×180
			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/hqdefault.jpg";		//480×360
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/sddefault.jpg";		//640×480
//			$thumbImg = "https://i1.ytimg.com/vi/".$videoCode."/maxresdefault.jpg";	//1920×1080
		}
?>
			<div class="list-block clearfix">
			<?
				if($thumbImg){
			?>
				<div class="list-img">
					<img src="<?=$thumbImg?>">
				</div>
			<?
				}
			?>
				<div class="list-titles"><a href="javascript:reg_view('<?=$uid?>');"><?=$title?></strong></div>
				<p class="list-summary">
					<a href="javascript:reg_view('<?=$uid?>');">
						<?=$ment?>
					</a>
				</p>
				<div class="list-dated">
					<span class="name"><?=$name?></span>
					<span class="date"><?=$rDate?></span>
				</div>
			</div>

<?
		$i--;
	}
}else{
?>

			<div class="list-block clearfix" style="text-align:center;">등록된 게시물이 없습니다.</div>

<?
}
?>






</form>
<style>
.search-tit {text-align:center;}
.search-tit h2 {font-size:2rem; font-weight:400; letter-spacing:0.03em; color:#01010d;}
.search-tit p {margin:10px 0; font-size:1rem; letter-spacing:0.01em; color:#666;}
.search-tit span {color:#e25656; font-weight:600;}

.search-con {margin:50px 0;}
.search-con p {position:relative; font-size:1.125rem; padding:0 0 10px 10px; border-bottom:1px solid #e1e1e1; color:#01010d;}
.search-con p:before {content:""; position:absolute; left:-4px; top:7px; width:5px; height:14px; background:#ffc000;}

.search-con .goBtns {display:inline-block; padding:5px 15px; background:#a2a2a2; color:#fff; font-size:0.875rem; margin-left:20px;}
.search-con .goBtns:hover {background:#ccc; transition:.2s;}

.search-con ul {margin:20px 0;}
.search-con ul li {float:left; font-size:1rem; letter-spacing:0.01em; color:#333;}
.search-con ul li.number {width:10%;}
.search-con ul li.title {width:70%; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;}
.search-con ul li.date {float:right;}

.search-con .ment {margin-left:10%; width:90%; padding:15px 0; letter-spacing:0.01em; color:#666; }


.no-resualt {text-align:center;}
.no-resualt .msg {font-size:24px; margin:10px 0; color:#01010d; letter-spacing:0.01em;}
.no-resualt .msg span {color:#e25656; font-weight:600;}
.no-resualt .msg p {margin-top:20px; font-size:1rem; color:#666;}
</style>

<div class="search-tit">
	<h2>검색결과</h2>
	<p>
		<span>"<?=$f_word?>"</span>에 대하여 <span id="totalCnt">0</span>개의 게시물이 검색 되었습니다.
	</p>
</div>

<?
$totalCnt = 0;

if($f_word){
	foreach($tableArr as $k => $tableList){
		$table_id = $tableArr[$k]['table_id'];
		$queryMent = "where table_id='$table_id' and (title like '%$f_word%' or ment like '%$f_word%')";

		$total = sqlRowOne("select count(*) from tb_board_list $queryMent");
		if($total){
			$itemList = sqlArray("select * from tb_board_list $queryMent order by uid desc limit 5");
?>
<div class="search-con">
	<p>
		<!--<span class="icons"></span>--><?=$tableArr[$k]['title']?>에서 검색한 결과 [총 <?=number_format($total)?>건]<a class="goBtns" href="<?=$tableArr[$k]['page']?>?field=total&word=<?=$f_word?>" target="_blank">바로가기</a>
	</p>
	<?
		$cno = 1;
		foreach($itemList as $item){
			$itemTitle = str_replace($f_word,"<span style='color:#f89800;'>$f_word</span>",$item['title']);
			$itemMent = str_replace($f_word,"<span style='color:#f89800;'>$f_word</span>",strip_tags($item['ment']));

	?>
	<ul class="clearfix">
		<li class="number"><?=$cno?></li>
		<li class="title"><a href="<?=$tableArr[$k]['page']?>?type=view&uid=<?=$item['uid']?>" target="_blank"><?=$itemTitle?></a></li>
		<li class="date">[<?=date('Y-m-d',$item['reg_date'])?>]</li>
	</ul>

	<div class="ment"><?=$itemMent?></div>
	<?
			$cno++;
		}
	?>
</div>
<?
			$totalCnt += $total;
		}
	}
}
?>



<?
	if($totalCnt == 0){
?>
<!-- 검색결과 박스(없을때) -->
<div class="no-resualt">
	<div><img src="/images/no-resualt.png" style="max-width:100%;" alt=""/></div>

	<div class="msg">
		<span>"<?=$f_word?>"</span>에 대한 검색결과가 없습니다.

		<p>
			단어의 철자가 정확한지 확인해 주시기 바랍니다.<br>
			검색어의 단어 수를 줄이거나, 다른 검색어(유사어)로 검색해 보시기 바랍니다.<br>
			일반적으로 많이 사용하는 검색어로 다시 검색해 주시기 바랍니다.
		</p>
	</div>
</div>
<!--// 검색결과 박스(없을때) -->
<?
	}
?>

<script>
$(document).ready(function(){
	$('#totalCnt').text('<?=$totalCnt?>');
});
</script>
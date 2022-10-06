<?
	include '../header.php';
?>
<?
	$tableArr = Array();

	$tableArr[0]['table_id'] = 'table_1639984813';
	$tableArr[0]['title'] = '교육정보플랫폼';
	$tableArr[0]['page'] = '/sub02/sub01.php';

	$tableArr[1]['table_id'] = 'table_1639984828';
	$tableArr[1]['title'] = '문화정보플랫폼';
	$tableArr[1]['page'] = '/sub02/sub02.php';

	$tableArr[2]['table_id'] = 'table_1639984837';
	$tableArr[2]['title'] = '정서지원플랫폼';
	$tableArr[2]['page'] = '/sub02/sub03.php';

	$tableArr[3]['table_id'] = 'table_1639984846';
	$tableArr[3]['title'] = '보호정보플랫폼';
	$tableArr[3]['page'] = '/sub02/sub04.php';

	$tableArr[4]['table_id'] = 'table_1639985002';
	$tableArr[4]['title'] = '업무정보공유';
	$tableArr[4]['page'] = '/sub03/sub01.php';

	$tableArr[5]['table_id'] = 'table_1639985025';
	$tableArr[5]['title'] = '공유자료실';
	$tableArr[5]['page'] = '/sub03/sub02.php';

	$tableArr[6]['table_id'] = 'table_1639985040';
	$tableArr[6]['title'] = '업무QnA';
	$tableArr[6]['page'] = '/sub03/sub03.php';

	$tableArr[7]['table_id'] = 'table_1639985596';
	$tableArr[7]['title'] = '뉴스';
	$tableArr[7]['page'] = '/sub04/sub01.php';

	$tableArr[8]['table_id'] = 'table_1639985605';
	$tableArr[8]['title'] = '정책/법령';
	$tableArr[8]['page'] = '/sub04/sub02.php';

	$tableArr[9]['table_id'] = 'table_1639985696';
	$tableArr[9]['title'] = '사회복지지원사업';
	$tableArr[9]['page'] = '/sub04/sub03.php';

	$tableArr[10]['table_id'] = 'table_1639985724';
	$tableArr[10]['title'] = '인적자원';
	$tableArr[10]['page'] = '/sub05/sub01.php';

	$tableArr[11]['table_id'] = 'table_1639985732';
	$tableArr[11]['title'] = '믈적자원';
	$tableArr[11]['page'] = '/sub05/sub02.php';

	$tableArr[12]['table_id'] = 'table_1639985738';
	$tableArr[12]['title'] = '물품구매사이트';
	$tableArr[12]['page'] = '/sub05/sub03.php';

	$tableArr[13]['table_id'] = 'table_1640048601';
	$tableArr[13]['title'] = '공지사항';
	$tableArr[13]['page'] = '/sub06/sub01.php';

	$tableArr[14]['table_id'] = 'table_1640048615';
	$tableArr[14]['title'] = '자유게시판';
	$tableArr[14]['page'] = '/sub06/sub02.php';

	$tableArr[15]['table_id'] = 'table_1640048634';
	$tableArr[15]['title'] = '사업후원게시판';
	$tableArr[15]['page'] = '/sub06/sub03.php';

	$tableArr[16]['table_id'] = 'table_1640048648';
	$tableArr[16]['title'] = '육아정보나눔게시판';
	$tableArr[16]['page'] = '/sub06/sub04.php';

	$tableArr[17]['table_id'] = 'table_1640048661';
	$tableArr[17]['title'] = '아동게시판';
	$tableArr[17]['page'] = '/sub06/sub05.php';

	$tableArr[18]['table_id'] = 'table_1640048675';
	$tableArr[18]['title'] = '복지지원서비스';
	$tableArr[18]['page'] = '/sub06/sub06.php';
?>

<style>
.search-box {text-align:center; padding:20px 0; background:#f8f8f8; border:1px solid #e1e1e1; box-sizing:border-box;}
.search-box .btns {display:inline-block; padding:7px 25px; background:#333; color:#fff; vertical-align:middle;}
.search-box .btns:hover {background:#a2a2a2; transtion:.2s;}
.selectBox {
    border: 1px solid #d1d1d1;
	background: url('/images/inputArrow.gif') no-repeat 90% 50% #fff;
	/*border-radius: 5px;*/
	-webkit-appearance: none;
	-moz-appearance: none;
	appearance: none;
	height:34px !important;
	padding:5px;
	font-size:0.875rem;
	vertical-align:middle;
}

.selectBox::-ms-expand {
    display: none;
}

.selectBox:disabled{background:#eee;}

.textBox01 {
    height: 34px !important;
    color: #777;
    /* border-radius: 5px; */
    border: 1px solid #d1d1d1;
	border-radius:0;
    padding: 0 0 0 3px;
    font-size: 1rem;
    box-sizing: border-box;
    vertical-align: middle;
}

.con-box {margin-top:50px;}


@media screen and (max-width:768px){
	.sForm {padding:20px;}
	.sForm .selectBox {width:100% !important;}
	.sForm input.textBox01 {width:100% !important; margin:10px 0;}

	.con-box {padding:0 20px;}
}
</style>



<script>
	function goSearch(){
		$('#frm_search').submit();
	}
</script>



<div class="center sub">
	<div class="member-area wrap">
		<h2>통합검색</h2>
		<div class="sForm search-box">
			<form name='frm_search' id='frm_search' method='post' action="<?=$_SERVER['PHP_SELF']?>">
			<input type='text' style='display:none;'>
				<select name="f_table" class="selectBox" style='padding:0 35px 0 10px;background-position:95% 50%;'>
					<option value=''>:: 통합검색 ::</option>
						<?
							for($i=0; $i<count($tableArr); $i++){
								$sArr = $tableArr[$i];

								$t1 = $sArr['table_id'];
								$t2 = $sArr['title'];
						?>
							<option value='<?=$t1?>' <?if($f_table == $t1) echo 'selected';?>><?=$t2?></option>
						<?
							}
						?>
				</select>
				<input type="text"  name="f_word" class="textBox01" style='width:400px;padding:5px;' value="<?=$f_word?>" onkeypress="if(event.keyCode==13){goSearch();}">
				<a href="javascript:goSearch();" class="btns">검색</a>
			</form>
		</div>

		<div class="con-box">
			<?
				include 'searchList.php';
			?>
		</div>
	</div>
</div>

<?
	include'../footer.php';
?>
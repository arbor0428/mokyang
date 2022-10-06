<?
//권한종류
$sel_chk01 = Array('전체','관리자','실무담당자','실무자','일반');



//해당 게시판의 환경설정을 가져온다.

$sql = "select * from tb_board_set where table_id='$table_id'";
$result = mysql_query($sql);

$row = mysql_fetch_array($result);

$table_id = $row["table_id"];
$table_title = $row["title"];
$board_title = $row["board_title"];
$write_chk = $row["write_chk"];	//쓰기권한
$read_chk = $row["read_chk"];	//읽기권한
$reply_chk = $row["reply_chk"];	//답글권한
$coment_chk = $row["coment_chk"];	//한줄의견권한
$upload_chk = $row["upload_chk"];	 //첨부파일수
$download_chk = $row["download_chk"];	 //다운로드허용
$list_mod = $row["list_mod"];	//리스트방식
$list_new = $row["list_new"];	//신규 리스트




if($list_mod == '리스트형'){

	$record_count = 10;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list01a.php';
	$view_file = 'view01a.php';
	$write_file = 'write01a.php';

	if($list_new)		$list_file = 'list01new.php';





}elseif($list_mod == '갤러리형'){

	$record_count = 20;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'gallery01.php';
	$view_file = 'view01a.php';
	$write_file = 'write01a.php';

	$img_w = '250';	//이미지크기
	$img_h = '335';	//이미지크기
	$one_line = '4';	//한줄에 출력되는 이미지수




}elseif($list_mod == '미리보기형'){

	$record_count = 21;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list03.php';
	$view_file = 'view01a.php';
	$write_file = 'write01a.php';

	$img_w = '250';	//이미지크기
	$img_h = '250';	//이미지크기
	$one_line = '3';	//한줄에 출력되는 이미지수



}elseif($list_mod == '블로그형'){

	$record_count = 8;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list04.php';
	$view_file = 'view01a.php';
	$write_file = 'write03.php';

	$img_w = '250';	//이미지크기
	$img_h = '345';	//이미지크기



}elseif($list_mod == '질문과답변형'){

	$record_count = 100;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list05.php';
	$view_file = 'view02.php';
	$write_file = 'write02.php';



}elseif($list_mod == '스케쥴러형'){

	$list_file = 'schedule_list01.php';
	$view_file = 'schedule_view01.php';
	$write_file = 'schedule_write01.php';


	$calendarRoot = $boardRoot.'calendar/';	//달력폴더경로
	$calendarFile = 'calendar01.php';	//달력스킨파일(/skins/board/calendar/calendar01.php)
	$cellh = '80';	// date cell height
	$tablew = '100%';	// table width


}elseif($list_mod == '지도형'){

	$record_count = 10;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list_map01.php';
	$view_file = 'view_map01.php';
	$write_file = 'write_map01.php';


}



//버튼이미지 경로
$ImgPath = 'png02';



//게시판 버튼이미지 설정
$BTN_aimg = $boardRoot.'img/'.$ImgPath.'/a_img.png';	 //답변아이콘
$BTN_alldell = $boardRoot.'img/'.$ImgPath.'/alldelete.png';	 //선택삭제
$BTN_allsel = $boardRoot.'img/'.$ImgPath.'/allselect.png';	//전체선택
$BTN_cancel = $boardRoot.'img/'.$ImgPath.'/cancel.png';	//취소
$BTN_del01 = $boardRoot.'img/'.$ImgPath.'/delete1.png';	//큰삭제
$BTN_del02 = $boardRoot.'img/'.$ImgPath.'/delete.png';	//작은삭제
$BTN_list = $boardRoot.'img/'.$ImgPath.'/list01.png';	//목록보기
$BTN_lock = $boardRoot.'img/'.$ImgPath.'/lock01.png';	//비밀글
$BTN_modify01 = $boardRoot.'img/'.$ImgPath.'/modify2.png';	//큰수정
$BTN_modify02 = $boardRoot.'img/'.$ImgPath.'/modify.png';	//작은수정
$BTN_next01 = $boardRoot.'img/'.$ImgPath.'/next1.png';	//다음
$BTN_next02 = $boardRoot.'img/'.$ImgPath.'/next2.png';	//마지막
$BTN_prev1 = $boardRoot.'img/'.$ImgPath.'/prev1.png';	//이전
$BTN_prev2 = $boardRoot.'img/'.$ImgPath.'/prev2.png';	//처음
$BTN_register = $boardRoot.'img/'.$ImgPath.'/register.png';	//등록
$BTN_reply = $boardRoot.'img/'.$ImgPath.'/reply.png';	//답글
$BTN_search = $boardRoot.'img/'.$ImgPath.'/search.png';	//검색
?>

<script language='javascript' src='/board/layer.js'></script>



<style>

.tbl-st {border-top:1px solid #ddd;}
.tbl-st-row {display:table; width:100%; min-height:50px; border-bottom:1px solid #ddd; background:#fff;}
.tbl-st-row .tbl-st-col {display:table-cell; vertical-align:middle;}

.tbl-st-row .tbl-st-col input[type="text"], .tbl-st-row .tbl-st-col input[type="password"] {
    width: 100%;
    min-width: inherit;
    height: 2.53333em;
    background-color: #fff;
    padding: 0 1.4em;
    border: 1px solid #e1e1e1;
    border-radius: 0.35rem;
	box-sizing:border-box;
	-webkit-appearance: none;
}

select#data01:focus, .tbl-st-row .tbl-st-col input[type="text"]:focus, .tbl-st-row .tbl-st-col input[type="password"]:focus {
	background-color: #fff;
	outline: 0;
	box-shadow: 0 0 0 0.125rem rgba(0,0,0, .1);
}

.tbl-st-row .col-1 {width:18%; padding-left:2%; box-sizing:border-box; color:#070b09; font-size:0.875rem; background:#f5f5f5; }
.tbl-st-row .col-2 {padding-left:2%; box-sizing:border-box;}

.tbl-st-row-wrap .tbl-st-row {float:left; width:50%}
.tbl-st-row-wrap .tbl-st-row .col-1 {width:36%; padding-left:4%; box-sizing:border-box;}
.tbl-st-row-wrap .tbl-st-row .col-2 {width:64%;padding-left:4%; box-sizing:border-box;}

.tbl-st-row .tbl-st-col input[type="text"], .tbl-st-row .tbl-st-col input[type="password"] {
    width: 100%;
    min-width: inherit;
    height: 2.53333em;
    background-color: #fff;
    padding: 0 1.4em;
    border: 1px solid #e1e1e1;
    border-radius: 0.35rem;
	box-sizing:border-box;
	-webkit-appearance: none;
}

select#data01:focus, .tbl-st-row .tbl-st-col input[type="text"]:focus, .tbl-st-row .tbl-st-col input[type="password"]:focus {
	background-color: #fff;
	outline: 0;
	box-shadow: 0 0 0 0.125rem rgba(0,0,0, .1);
}

.tbl-st .select1 {min-width:150px; height:30px;border:1px solid #dddddd;border-radius:3px;padding:5px; margin-right:4px;}


/*버튼*/
.btn {display:inline-block; padding:6px 24px; font-size:0.875rem; color:#fff; border-radius:3px; vertical-align:middle;}
.btn2 {display:inline-block; padding:6px 12px; font-size:0.875rem; color:#fff; border-radius:3px; vertical-align:middle;}
.btn.blk {background:#333; color:#fff;}
.btn.blk:hover {background:#222; transition:.2s;}

.btn.wht {border:1px solid #333; color:#333;}
.btn.wht:hover {background:#333; color:#fff; transition:.2s;}

.btn.gry {background:#878787;}
.btn.gry:hover {background:#777; transition:.2s;}
.btn.grn {background:#4caf50;}
.btn.grn:hover {background:#3d8c40; transition:.2s;}
.btn.red {background:#d32f2f;}
.btn.red:hover {background:#a92626; transition:.2s; color:#fff;}


@media screen and (max-width:768px){

.tbl-st-row-wrap .tbl-st-row {width:100%;}
.tbl-st-row-wrap .tbl-st-row .col-1 {width:18%; padding-left:2%;}
.tbl-st-row-wrap .tbl-st-row .col-2 {width:82%; padding-left:2%;}


.tbl-st-row select {/*-webkit-appearance: none; -moz-appearance: none;*/ padding:0 4px; margin:4px 0;}

.tbl-st-row {display:block; width:100%;background:#fff;}
.tbl-st-row .tbl-st-col {display:inline-block; width:100%; padding:4% 2%;}
.tbl-st-row .col-1 {font-size:1rem;}
.tbl-st .select1 {min-width:48%;}
}

@media screen and (max-width:640px){
#smart_editor2 {min-width:100% !important; outline:1px solid red;}
}
</style>



<script language='javascript'>
function file_down(fName,n){
	form01 = document[fName];

	file_name = form01['dbfile'+n].value;
	file_rename = form01['realfile'+n].value;

	form02 = document.frm_down;
	form02.file_rename.value = file_rename;
	form02.file_name.value = file_name;
	form02.submit();
}

function file_down_m(f1,f2){
	location.href = '/board/download_mobile.php?UserOS=mobile&file_name='+f2+'&file_rename='+f1;
}
</script>

<form name='frm_down' method='post' action='/board/download.php'><!-- 다운로드 폼 -->
<input type='hidden' name='file_name' value="">
<input type='hidden' name='file_rename' value="">
</form>





<?
	//글등록 또는 수정시 작성일 및 조회수 수정기능 적용
	if(($type == 'write' || $type == 'edit' || $type == 're_write' || $type == 're_edit') && $GBL_MTYPE == 'A'){
		$set_ry = date('Y');
		$set_rm = date('m');
		$set_rd = date('d');
		$set_rh = date('H');
		$set_ri = date('i');
		$set_rs = date('s');

		$hit = 0;
?>
<script language='javascript'>
function setToDate(f){
	now = new Date();

	years = now.getFullYear();
	months = now.getMonth() + 1;
	days = now.getDate();
	hours = now.getHours();
	minutes = now.getMinutes();
	seconds = now.getSeconds();

	f.set_ry.value = years;
	f.set_rm.value = months;
	f.set_rd.value = days;
	f.set_rh.value = hours;
	f.set_ri.value = minutes;
	f.set_rs.value = seconds;
}
</script>
<?
	}
?>
<?
//권한종류
$sel_chk01 = Array('전체','관리자','권리자','일반');



//해당 게시판의 환경설정을 가져온다.

$sql = "select * from tb_board_set where table_id='$table_id'";
$result = mysqli_query($dbc,$sql);

$row = mysqli_fetch_array($result);

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



if($list_mod == '리스트형'){

	$record_count = 20;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list01a.php';
	$view_file = 'view01a.php';
	$write_file = 'write01a.php';



}elseif($list_mod == '갤러리형'){

	$record_count = 28;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'gallery01.php';
	$view_file = 'view01a.php';
	$write_file = 'write01a.php';


	$img_w = '250';	//이미지크기
	$img_h = '250';	//이미지크기
	$one_line = '3';	//한줄에 출력되는 이미지수


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

	$record_count = 4;  //한 페이지에 출력되는 레코드수
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


}elseif($list_mod == '링크형'){


	$record_count = 20;  //한 페이지에 출력되는 레코드수
	$link_count = 10; //한 페이지에 출력되는 페이지 링크수

	$list_file = 'list01Link.php';
	$write_file = 'write01Link.php';

 
}






//버튼이미지 경로
$ImgPath = 'png02';



//게시판 버튼이미지 설정
$BTN_qimg = $boardRoot.'img/'.$ImgPath.'/q_img.png';	 //답변아이콘
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



<script language='javascript'>
function file_down(fName,n,s){
	form01 = document[fName];

	file_name = form01['dbfile'+n].value;
	file_rename = form01['realfile'+n].value;

	form02 = document.frm_down;
	form02.file_rename.value = file_rename;
	form02.file_name.value = file_name;
	form02.site.value = s;
	form02.submit();
}

function file_down_m(f1,f2,s){
	location.href = '/board/download_mobile.php?UserOS=mobile&file_name='+f1+'&file_rename='+f2+'&site='+s;
}
</script>

<form name='frm_down' method='post' action='/board/download.php'><!-- 다운로드 폼 -->
<input type='hidden' name='file_name' value="">
<input type='hidden' name='file_rename' value="">
<input type='hidden' name='site' value="">
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
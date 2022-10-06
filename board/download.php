<?
ob_start();

// 파일이 있는 디렉토리
$downfiledir = './upfile/';


//파일명
$downfile  = $_POST['file_name'];		//실제저장된 파일명
$filename = $_POST['file_rename'];		//원본 파일명


// 파일 존재 유/무 체크

if( file_exists($downfiledir.$downfile)){
	header("Content-Type: application/octet-stream");

	Header("Content-Disposition: attachment;; filename=$filename ");

	header("Content-Transfer-Encoding: binary"); 

	Header("Content-Length: ".(string)(filesize($downfiledir.$downfile ))); 

	Header("Cache-Control: cache, must-revalidate"); 

	header("Pragma: no-cache"); 

	header("Expires: 0");
	
	$fp = fopen($downfiledir.$downfile , "rb"); //rb 읽기전용 바이러니 타입
	
	while(!feof($fp)){
		echo fread($fp, 100*1024); //echo는 전송을 뜻함.
	}
	
	fclose ($fp);
	flush(); //출력 버퍼비우기 함수.. 

}else{
?>

<script>alert("존재하지 않는 파일입니다.");history.back()</script>

<?
}
?>
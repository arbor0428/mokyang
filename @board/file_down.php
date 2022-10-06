<? 

set_time_limit(0);


$file = './upfile/'.$rfile; # 서버에 저장된 파일 전체 경로

$dnfile=$sname; # 사용자가 받을 파일명

$dn = "1"; // 1 이면 다운 0 이면 브라우져가 인식하면 화면에 출력 
$dn_yn = ($dn) ? "attachment" : "inline"; 
$bin_txt = "1";
$bin_txt = ($bin_txt) ? "r" : "rb"; 

if(eregi("(MSIE 5.0|MSIE 5.1|MSIE 5.5|MSIE 6.0)", $HTTP_USER_AGENT))
{ 
  if(strstr($HTTP_USER_AGENT, "MSIE 5.5")) 
  { 
    header("Content-Type: doesn/matter"); 
    Header("Content-Length: ".(string)(filesize("$file"))); 
    Header("Content-Disposition: filename=$dnfile");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   

  } 

  if(strstr($HTTP_USER_AGENT, "MSIE 5.0")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$dnfile"); 
    Header("Content-Description: PHP3 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 

  if(strstr($HTTP_USER_AGENT, "MSIE 5.1")) 
  { 
    Header("Content-type: file/unknown"); 
    header("Content-Disposition: attachment; filename=$dnfile"); 
    Header("Content-Description: PHP3 Generated Data"); 
    header("Pragma: no-cache"); 
    header("Expires: 0"); 
  } 
  
  if(strstr($HTTP_USER_AGENT, "MSIE 6.0"))
  {
    Header("Content-type: application/x-msdownload"); 
    Header("Content-Length: ".(string)(filesize("$file")));   // 이부부을 넣어 주어야지 다운로드 진행 상태가 표시
    Header("Content-Disposition: attachment; filename=$dnfile");   
    Header("Content-Transfer-Encoding: binary");   
    Header("Pragma: no-cache");   
    Header("Expires: 0");   
  }
} else { 
  Header("Content-type: file/unknown");     
  Header("Content-Length: ".(string)(filesize("$file"))); 
  Header("Content-Disposition: $dn_yn; filename=$dnfile"); 
  Header("Content-Description: PHP3 Generated Data"); 
  Header("Pragma: no-cache"); 
  Header("Expires: 0"); 
} 

if (is_file("$file")) { 
  $fp = fopen("$file", "rb"); 

  if (!fpassthru($fp)) {
    fclose($fp); 
	echo "<script> self.close();</script>";
  }	
} else { 
  echo "해당 파일이나 경로가 존재하지 않습니다."; 
} 
?>








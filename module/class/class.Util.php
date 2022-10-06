<?
class Util
{
	//콤보 박스를 생성한다. Y-년, M-월, D-일 
	function getCboCalender($verYear, $verMonth, $verDay, $selYear="", $selMonth="", $selDay="", $mtype="D", $is_print="1", $class=''){
		$msg = "";

		//if($selYear == "")	$selYear	= date('Y');
		//if($selMonth == "")	$selMonth	= date('n');
		//if($selDay == "")	$selDay		= date('j');

		if($class!='')	$class = 'class='.$class;

		if($mtype == "Y" || $mtype == "M" || $mtype == "D"){		
			$msg = '<select name="'.$verYear.'" '.$class.'>';
			$msg .= '<option value="">====</option>';
			for($i=1997; $i<=2007; $i++){
				if($i == $selYear)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>년&nbsp;&nbsp;&nbsp;";
		}

		if($mtype == "M" || $mtype == "D"){		
			$msg .= '<select name="'.$verMonth.'" '.$class.'>';
			$msg .= '<option value="">==</option>';
			for($i=1; $i<=12; $i++){
				if($i == $selMonth)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>월&nbsp;&nbsp;&nbsp;";
		}

		if($mtype == "D"){		
			$msg .= '<select name="'.$verDay.'" '.$class.'>';
			$msg .= '<option value="">==</option>';
			for($i=1; $i<=31; $i++){
				if($i == $selDay)
					$msg .= '<option value="'.$i.'" selected>'.$i.'</option>';
				else
					$msg .= '<option value="'.$i.'">'.$i.'</option>';
			}
			$msg .= "</select>일&nbsp;&nbsp;&nbsp;";
		}

		if($is_print)
			echo $msg;
		else
			return $msg;
	}

	function getSelectBox($name, $arr_value, $arr_caption, $selected_value='', $class='', $function='', $print=true){
		$select_box = '<select name="'.$name.'" ';

		if($class!='')		$select_box .= ' class="'.$class.'" ';
		if($function!='')	$select_box .= ' onChange="javascript:'.$function.'"';

		$select_box .= '>';
		$select_box .= '<option value="">==</option>';

		//if($selected_value=="")	$selected_value = $arr_value[0];

		for($i=0; $i<count($arr_value); $i++){
			if($arr_value[$i]==$selected_value)	$selected='selected';	else $selected = '';
			$select_box .= '<option value="'.$arr_value[$i].'" '.$selected.'>'.$arr_caption[$i].'</option>';
		}
		$select_box .= '</select>';

		if($print)
			echo $select_box;
		else
			return $select_box;
	}

	/* 확장명 추출 하는 메소드 */
	function getExt($file_name){
		$_file_name = explode(".",$file_name);
		$ext = strtolower($_file_name[count($_file_name)-1]); 

		return $ext;
	}

	//특정 확장자의 아이콘을 링크테그형태로 만들어 주는 메소드 //
	function getLinkFileIcon($img_dir, $file_dir, $file_name){
		$_file_name = explode(".",$file_name);
		$ext = strtolower($_file_name[count($_file_name)-1]); 

		switch ($ext){
			case 'hwp':
				$img_name = "hwp.gif";
				break;

			case 'doc':
				$img_name = "doc.gif";
				break;

			case 'ppt':
				$img_name = "ppt.gif";
				break;

			case 'xls':
				$img_name = "xls.gif";
				break;

			case 'zip':
				$img_name = "zip.gif";
				break;

			case 'exe':
				$img_name = "exe.gif";
				break;

			case 'gif':
				$img_name = "gif.gif";
				break;

			case 'jpg':
				$img_name = "jpg.gif";
				break;

			case 'pdf':
				$img_name = "pdf.gif";
				break;

			default:
				$img_name = "txt.gif";
		}

		$linkImg = "<a href=javascript:downFile('".$file_dir."','".$file_name."')><img src='".$img_dir."/".$img_name."' border=0></a>";
		return $linkImg;
	}

	/* 파일의 확장자 추출 메소드 */
	function getFileExtension($file_name){
		$_file_name = explode(".",$file_name);
		$ext = strtolower($_file_name[count($_file_name)-1]);

		return $ext;
	}

	// 한글용 ksubstr //
	function ksubstr($string,$start,$length){
		if($length>=strlen($string)) return $string;
		$klen=$length-1;
		while(ord($string[$klen]) & 0x80) $klen--;
		return $add.substr($string,$start,$length-(($length+$klen+1)%2));
	}

	function delFile($dir, $file_name){
		if(file_exists($dir.'/'.$file_name)){
			unlink($dir.'/'.$file_name);
			return true;
		}
		else
			return false;
	}

	/* 금일 기준으로 남은일수를 날짜로 반환하는 메소드 */
	function dateDay($date){
		$_date = explode("-",$date);

		$tm1 = mktime(0,0,0,$_date[1],$_date[2],$_date[0]);
		$tm2 = mktime(0,0,0,date('m'),date('d'),date('Y'));

		return ($tm1 - $tm2) / 86400;
	}

	/* date1 과 date2의 차이를 날짜로 반환하는 메소드 */
	function dateDiff($date1, $date2){
		$_date1 = explode("-",$date1);
		$_date2 = explode("-",$date2);

		$tm1 = mktime(0,0,0,$_date1[1],$_date1[2],$_date1[0]);
		$tm2 = mktime(0,0,0,$_date2[1],$_date2[2],$_date2[0]);

		return ($tm1 - $tm2) / 86400;
	}

	/* date1 과 date2의 차이를 날짜로 반환하는 메소드 */
	function dateDiffTime($date){
		$date1 = date('Y-m-d');
		$date2 = date('Y-m-d',$date);

		$_date1 = explode("-",$date1);
		$_date2 = explode("-",$date2);

		$tm1 = mktime(0,0,0,$_date1[1],$_date1[2],$_date1[0]);
		$tm2 = mktime(0,0,0,$_date2[1],$_date2[2],$_date2[0]);

		return ($tm1 - $tm2) / 86400;
	}

	/* 코드를 리턴하는 메소드 */
	function getCode($db, $strTable, $strKey, $intLen, $strC){
		$intCLen = strlen($strC);
		$intLen -= $intCLen;

		$strZero = "";
		for($i=1; $i<=$intLen; $i++){
			$strZero .= "0";
		}

		
		$intCLen += 1;
		$strSql = "select right(concat('".$strZero."',(max(cast(substring(".$strKey.",".$intCLen.",".$intLen.") as SIGNED))+1)),".$intLen.") from ".$strTable;
		$result = mysql_query($strSql, $db);
		if($result){
			$db_code = mysql_result($result,0,0);
			if($db_code==0){

				$db_code = substr($strZero."1",-1*$intLen);
			}
		}
		else{
			$db_code = "";
		}

		if($db_code!=""){
			return $strC.$db_code;
		}
		else{
			return $strC.substr($strZero."1",-1*$intLen);
		}
	}



	function Shorten_String($str, $len, $tail='..'){
		//태그제거
		$noTag = strip_tags($str);

		$strlen = mb_strlen($noTag, 'UTF-8');

		$len = ceil($len/2);

		if($strlen > $len){
			$strTxt = iconv_substr($noTag, 0, $len, 'UTF-8').$tail;
			$cutTxt = str_replace($noTag, $strTxt, $str);
		}else{
			$cutTxt = $str;
		}

		return $cutTxt;
	}



	
	function cutStringWithTags($String, $MaxLen, $ShortenStr){ 
		
		$StringLen = strlen($String); // 원래 문자열의 길이를 구함 

			for ($i = 0, $count = 0, $tag = 0; $i <= $StringLen && $count < $MaxLen; $i++ ) { 
		$LastStr = substr($String, $i, 1); 
				if ($LastStr == '<') $tag = 1; // 태그 시작 
				if ($tag && $LastStr == '>') { $tag = 0; continue; } // 태그 끝 
				if ($tag) continue; 
		if ( ord($LastStr) > 127 ) { $count++; $i++; } 
				$count++; 
		// 2바이트문자라고 생각되면 $i를 1을 더 증가시켜 
		// 결국은 2가 증가하게 된다. 
		// 다음에 오는 1바이트는 당연 지금 바이트의 문자에 귀속되는 문자이다. 

			} 

		$RetStr = substr($String, 0, $i); 
		// 위에서 구한 문자열의 길이만큼으로 자른다. 
			if ($count<$MaxLen) 
				return $RetStr; 
			else 
				return $RetStr .= $ShortenStr; 
		// 여기에 말줄임문자를 붙여서 리턴해준다. 
	}



	function AutoImgSize($url, $w, $h){ 

		$size = getimagesize($url);

		if($size[0] > $w)	$width = $w; //임의로 정하는 넓이
		else	$width = $size[0];

		$height = $width*$size[1]/$size[0]; //원본 이미지의 넓이값 대비 높이와 같은 비율로 줄어든 높이값
		if($height > $h){$height = $h;}
		if($size[0] < $size[1]){$width = $height*$size[0]/$size[1];}

		$width = intval($width);
		$height = intval($height);

		$ReSize = "width='$width' height='$height'";

		return $ReSize;

	}






	function ImageSizeGet($image, $wantWidth, $wantHeight){
		$src = $image;	
		$size = GetImageSize($src);
		
		$imgwidth = $size[0];
		$imgheight = $size[1];
		
		if($imgwidth > $wantWidth){
			$imgwidth2 = $wantWidth;
			$percent = ($size[0]/ $imgwidth2);
			$imgheight2 = ($size[1] / $percent);
			
			if($imgheight2 > $wantHeight){
				$imgheight = $wantHeight;
				$percent = ($imgheight2 / $imgheight);
				$imgwidth = ($imgwidth2 / $percent);
			}else{
				$imgwidth = $imgwidth2;
				$imgheight = $imgheight2;
			}
			
		}elseif($imgheight > $wantHeight){
			$imgheight2 = $wantHeight;
			$percent = ($size[1] / $imgheight2);
			$imgwidth2 = ($size[0] / $percent);
			
			if($imgwidth2 > $wantWidth){
				$imgwidth = $wantWidth;
				$percent = ($imgwidth2 / $imgwidth);
				$imgwidth = ($imgwidth2 / $percent);
			}else{
				$imgwidth = $imgwidth2;
				$imgheight = $imgheight2;
			}
		}

		$imgwidth = intval($imgwidth);
		$imgheight = intval($imgheight);
		
		$ReSize = "width='$imgwidth' height='$imgheight'";
		
		return $ReSize;
	}


	function GetImgSize($url){ 

		if(is_file($url)){
			$size = getimagesize($url);

			$width = intval($size[0]);

			return $width;
		}

	}


	//기준일로부터 한달기준(입력방식 : 0000-00-00)
	function getEdate($sdate){
		$sdate_txt = explode('-',$sdate);

		$sy = $sdate_txt[0];
		$sm = $sdate_txt[1] + 1;
		$sd = $sdate_txt[2];

		$maxdate = date(t, mktime(0, 0, 0, $sm, 1, $sy));	 //종료되는 달의 마지막일

		//원래 종료일이 종료되는 달의 마지막일보다 클 경우 종료일을 재설정한다
		if($sd > $maxdate)	$sd = $maxdate;
		else						$sd -= 1;

		$etime = mktime(23,59,59,$sm,$sd,$sy);

		return $etime;
	}






	//검색어인코딩
	function KeyWordStr($String){
		$StringLen = strlen($String);

		$str = '';

		for($i=0; $i<$StringLen; $i++){
			$LastStr = ord(substr($String, $i, 1));

			if($LastStr > 127)		$count = 2;
			else						$count = 1;

			$strTxt = substr($String, $i, $count);

			//2바이트문자라고 생각되면 $i를 1을 더 증가시켜 
			if($LastStr > 127)		$i++;

			if($str)	$str .= '%';
			$str .= $strTxt;
		}

		return $String;
	}






	//상태별 색상설정
	function setStxt01($String){
		if($String == '접수')				$cname = 'estxt01';
		elseif($String == '검토중')		$cname = 'estxt02';
		elseif($String == '보류')			$cname = 'estxt03';
		elseif($String == '승인거부')	$cname = 'estxt04';
		elseif($String == '승인')			$cname = 'estxt05';
		else									$cname = '';

		if($cname){
			$str = "<p class='$cname'>$String</p>";
		}else{
			$str = "<p>$String</p>";
		}

		return $str;
	}




	//비밀번호 초기화용
	function MakeRandomNumber(){
		$str = "1234567890abcdefghijklmnopqrstuvwxyz";
		$code = substr(str_shuffle($str),0,10);

		return $code;
	}



	//textarea 인코딩
	function textareaEncodeing($String){
		$String = eregi_replace("<", "&lt;", $String);
		$String = eregi_replace(">", "&gt;", $String);
		$String = eregi_replace("\"", "&quot;", $String);
		$String = eregi_replace("\|", "&#124;", $String);
		$String = eregi_replace("\r\n\r\n", "<P>", $String);
		$String = eregi_replace("\r\n", "<BR>", $String);

		return $String;
	}

	//textarea 디코딩
	function textareaDecodeing($String){
		$String = eregi_replace("&lt;", "<", $String);
		$String = eregi_replace("&gt;", ">", $String);
		$String = eregi_replace("&quot;", "\"", $String);
		$String = eregi_replace("&#124;", "\|", $String);
		$String = eregi_replace("<P>", "\r\n\r\n", $String);
		$String = eregi_replace("<BR>", "\r\n", $String);

		return $String;
	}


	function NameCutStr($str, $skip, $suffix){ 
		preg_match_all( "/[\x80-\xff].|./", $str, $matches );

		for( ;$skip --; ) $h .= array_shift( $matches[0] ); 
		$b = str_repeat($suffix,  count( $matches[0] ) ); 
		return $h . $b; 
	}



	//처음과 마지막 문자를 제외한 모든문자 *표시
	function NameCutStr2($str){
		$nameTxt = '';

		mb_internal_encoding(mb_detect_encoding($str,'UTF-8,EUC-KR')); 
		$nameTxt = ($len=mb_strlen($str))>2 ? mb_substr($str,0,1).str_repeat('*',$len-2).mb_substr($str,-1,1) : $str;

		return $nameTxt;
	}



	//해당기간에 해당요일이 몇번인지...
	function yoilChk($date01,$date02,$yoil){
		$ylist = explode(',',$yoil);
		$day = 0;

		for($i=$date01; $i<=$date02; $i+=86400){
			$wTxt = date('w',$i);

			if(in_array($wTxt,$ylist))	$day++;
		}

		return $day;
	}

	//수강신청일을 기준으로 지난 교육을 제외한 남은 교육횟수
	function classOrderChk($date01,$date02,$yoil,$gTime){
		$ylist = explode(',',$yoil);
		$day = 0;

		for($i=$date01; $i<=$date02; $i+=86400){
			$wTxt = date('w',$i);

			if(in_array($wTxt,$ylist)){
				if($gTime < $i)		$day++;
			}
		}

		return $day;
	}


	//비밀번호 초기화
	function rePassWord(){
		$str01 = "1234567890abcdefghijklmnopqrstuvwxyz";
		$str02 = "!@#$";

		$code = substr(str_shuffle($str01),0,5);
		$code .= substr(str_shuffle($str02),0,2);

		return $code;
	}


	//휘트니스 종료일 구하기
	function lastDate($date,$p){
		$dateArr = explode('-',$date);
		$ey = $dateArr[0];
		$em = $dateArr[1];
		$ed = $dateArr[2];

		if($p == '1day'){
			$mk = mktime(0,0,0,$em,$ed,$ey);

		}else{
			if($p == '1month')		$m = 1;
			elseif($p == '3month')	$m = 3;
			elseif($p == '6month')	$m = 6;

			$em = $em + $m;		//서비스 종료달에 신청한 개월수를 더한다

			$maxdate = date(t, mktime(0, 0, 0, $em, 1, $ey));	 //종료되는 달의 마지막일

			//원래 종료일이 종료되는 달의 마지막일보다 클 경우 종료일을 재설정한다
			if($ed > $maxdate)	$ed = $maxdate;

			$mk = mktime(0,0,0,$em,$ed,$ey) - 86400;
		}

		return date('Y-m-d',$mk);
	}



	//인증번호 생성용
	function MakeOkNumber(){
		$str = "1234567890";
		$code = substr(str_shuffle($str),0,6);

		return $code;
	}


	//서브관리자 권한확인
	function ManagerType($mtype){
		$Arr = Array();
		for($i=0; $i<strlen($mtype); $i++){
			$txt = substr($mtype,$i,1);
			$Arr[$i] = $txt;
		}

		return $Arr;
	}


	//year년 month월의 no째주 yoil의 타임값
	function yoilDate($year,$month,$yoil,$no){
		$resTime = 0;

		$lastDay = date("t",mktime(0,0,0,$month,1,$year));
		$cNo = 0;

		for($dd=1; $dd<=$lastDay; $dd++){
			$tm = mktime(0,0,0,$month,$dd,$year);
			$w = date("w",$tm);
			if($w == $yoil){
				$cNo++;
				if($cNo == $no){
					$resTime = $tm;
					break;
				}
			}
		}

		return $resTime;
	}



	//첫번째 이미지 추출
	function getFirstImage($contents){
		if(preg_match_all('/src=\"(.[^"]+)"/i', $contents, $value) != 0){
			return $value[1][0];
		}
	}

	//첫번째 이미지 추출(없으면 로고표시)
	function getMentImage($contents){
		if(preg_match_all('/src=\"(.[^"]+)"/i', $contents, $value) != 0){
			return $value[1][0];
		}else{
			return "/images/main_cont_sample04.jpg";
		}
	}

}



?>
<?php
	include "../../class.FileUpload.php";

 	$sFileInfo = '';
	$headers = array();
	 
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$file = new stdClass;
	$file->name = str_replace("\0", "", rawurldecode($headers['file_name']));
	$file->size = $headers['file_size'];
	$file->content = file_get_contents("php://input");
	
	$filename_ext = strtolower(array_pop(explode('.',$file->name)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$file->name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		//이미지명변환
		$fileUpload = new FileUpload($uploadDir,$file->name,'N');
		$fileName = $fileUpload->getValidFileNameEditor($filename_ext);
		
		$newPath = $uploadDir.$fileName;


        function file_put_contentsN($filename, $data) 
        { 
                if (!file_exists($filename) || is_writable($filename)) 
                { 
                        if (!$handle = @fopen($filename, 'w')) 
                        { 
                                return false; 
                        } 
                        if (@fwrite($handle, $data) === false) 
                        { 
                                return false; 
                        } 
                        @fclose($handle); 
                        return true; 
                } 
                return false; 
        }

		file_put_contentsN($newPath, $file->content);

		$fileSize = @getimagesize($newPath);

		$sFileInfo .= "&bNewLine=true";
		$sFileInfo .= "&sFileName=".$fileName;
		$sFileInfo .= "&sFileURL=/smarteditor/upload/".$fileName;
		$sFileInfo .= "&sFileWidth=".$fileSize[0];
		
		echo $sFileInfo;
	}
?>

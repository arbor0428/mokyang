<?php

include "../../class.FileUpload.php";

// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$uploadDir = '../../upload/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}

		$fileUpload = new FileUpload($uploadDir,$name,'N');
		$fileName = $fileUpload->getValidFileNameEditor($filename_ext);
		
		$newPath = $uploadDir.$fileName;
		
		@move_uploaded_file($tmp_name, $newPath);

		$fileSize = @getimagesize($newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".$fileName;
		$url .= "&sFileURL=/smarteditor/upload/".$fileName;
		$url .= "&sFileWidth=".$fileSize[0];
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>

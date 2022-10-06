<script language='javascript'>
function fileChk(no){
	upFile = $("#upfile"+no).val();

	if( upFile != "" ){
		var ext = $('#upfile'+no).val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['jpg','gif','png']) == -1) {
			GblMsgBox('jpg, gif, png\n파일만 등록이 가능합니다.','');
			$("#upfile"+no).val('');
			$("#file_route"+no).val('');
			return;

		}else{
			var fileSize = 0;

			// 브라우저 확인
			var browser=navigator.appName;

			file = document.FRM['upfile'+no];
			
			// 익스플로러일 경우
			if(browser=="Microsoft Internet Explorer"){
				var oas = new ActiveXObject("Scripting.FileSystemObject");
				fileSize = oas.getFile(file.value).size;

			// 익스플로러가 아닐경우			
			}else{
				fileSize = file.files[0].size;
			}

			fS = Math.round(fileSize / 1024);

			if(fS > 5120){
				GblMsgBox('5M이상의 파일은 등록할 수 없습니다.','');
				$("#upfile"+no).val('');
				$("#file_route"+no).val('');
				return;
			}
		}
	}

	$("#file_route"+no).val(upFile);
}
function go_sort(num,dir){
	form = document.FRM;
	form.dir.value = dir;
	form.num.value = num;
	form.type.value = 'sort';
//	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
function check_form(){
	form = document.FRM;
	form.target = 'ifra_gbl';
	form.action = 'proc.php';
	form.submit();
}
</script>
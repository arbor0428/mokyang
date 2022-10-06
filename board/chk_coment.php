<?

//한줄의견쓰기 권한설정

if(!$coment_chk)	$coment_chk = '전체';

for($c=0; $c<count($sel_chk01); $c++){
	if($coment_chk == $sel_chk01[$c])	 $coment_chk_num = $c;
}



if($GBL_MTYPE == 'A'){	 //관리자 로그인 상태라면 무조건...
	$chk_type = 'ok';

}else{


	if($coment_chk == '전체'){
		$chk_type = 'ok';

	}elseif($coment_chk == '관리자' || $GBL_MTYPE == ''){		//한줄의견쓰기 권한이 전체가 아니면 비회원은 한줄의견쓰기 권한이 없다.
		$chk_type = 'no';

	}else{
		if($GBL_MCODE <= $coment_chk_num){	 //로그인한 회원그룹레벨이 한줄의견쓰기 권한보다 작거나 같은 경우
			$chk_type = 'ok';

		}else{
			$chk_type = 'no';

		}
	}
	
}



if($chk_type == 'ok'){
	$btn_cowrite = "<a href='javascript:chk_ment();'><img src='".$boardRoot."img/ok_btn.jpg'></a>";
	$mmsg = '';
	$read = '';

}else{
	$btn_cowrite = "<a href=javascript:error_msg('w')><img src='".$boardRoot."img/ok_btn.jpg'></a>";
	$mmsg = '한줄의견쓰기 권한이 없습니다.';
	$read = 'readonly';

}


?>
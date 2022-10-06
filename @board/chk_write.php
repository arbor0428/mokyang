<?

//글쓰기 권한설정

if(!$write_chk)	$write_chk = '전체';


for($c=0; $c<count($sel_chk01); $c++){
	if($write_chk == $sel_chk01[$c])	 $write_chk_num = $c;
}




if($GBL_MTYPE == 'A'){	 //관리자 로그인 상태라면 무조건...
	$chk_type = 'ok';

}else{

	if($write_chk == '전체'){
		$chk_type = 'ok';

	}elseif($write_chk == '관리자' || $GBL_MTYPE == ''){		//글쓰기 권한이 전체가 아니면 비회원은 글쓰기 권한이 없다.
		$chk_type = 'no';

	}else{
		if($GBL_MCODE <= $write_chk_num){	 //로그인한 회원레벨이 글쓰기 권한보다 작거나 같은 경우
			$chk_type = 'ok';

		}else{
			$chk_type = 'no';

		}
	}



}




	if($chk_type == 'ok'){
		$btn_write = "<a href='javascript:reg_register();' class='btn blk'>등록</a>";

	}else{
//		$btn_write = "<a href=javascript:error_msg('w')><img src='".$BTN_register."' alt='등록'></a>";
		$btn_write = "";


	}





?>
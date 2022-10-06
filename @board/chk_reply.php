<?

//글쓰기 권한설정

if($reply_chk){


	for($c=0; $c<count($sel_chk01); $c++){
		if($reply_chk == $sel_chk01[$c])	 $reply_chk_num = $c;
	}


	if($GBL_MTYPE == 'A'){	 //관리자 로그인 상태라면 무조건...
		$chk_type = 'ok';

	}else{


		if($reply_chk == '전체'){
			$chk_type = 'ok';

		}elseif($reply_chk == '총관리자' || $GBL_MTYPE == ''){		//답글쓰기 권한이 전체가 아니면 비회원은 답글쓰기 권한이 없다.
			$chk_type = 'no';

		}else{
			if($GBL_MCODE <= $reply_chk_num){	 //로그인한 회원그룹레벨이 답글쓰기 권한보다 작거나 같은 경우
				$chk_type = 'ok';

			}else{
				$chk_type = 'no';

			}
		}
		
	}




	if($chk_type == 'ok'){
		$btn_re_write = "<a href='javascript:reg_reply();' class='big cbtn blue'>답글</a>&nbsp;";

	}else{
		$btn_re_write = "<a href='javascript:error_msg('r');' class='big cbtn blue'>답글</a>&nbsp;";

	}


}else{
	$btn_re_write = '';
}

?>
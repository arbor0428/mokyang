<?


//글읽기 권한설정

if(!$read_chk)	$read_chk = '전체';

for($c=0; $c<count($sel_chk01); $c++){
	if($read_chk == $sel_chk01[$c])	 $read_chk_num = $c;
}



if($GBL_MTYPE == 'A'){	 //관리자 로그인 상태라면 무조건...
	$chk_type = 'ok';

}else{


	if($read_chk == '전체'){

		if($pwd_chk){	//비밀글일 경우
			if($GBL_USERID == $userid)	$chk_type = 'ok';
			else	$chk_type = 'pwd';

		}else{
			$chk_type = 'ok';

		}


	}elseif($read_chk == '관리자' || $GBL_MTYPE == ''){		//글읽기 권한이 전체가 아니면 비회원은 글읽기 권한이 없다.

		$chk_type = 'no';


	}else{
		if($GBL_MCODE <= $read_chk_num){	 //로그인한 회원그룹레벨이 글쓰기 권한보다 작거나 같은 경우
			if($pwd_chk){	//비밀글일 경우
				if($GBL_USERID == $userid)	$chk_type = 'ok';
				else	$chk_type = 'pwd';

			}else{
				$chk_type = 'ok';

			}

		}else{
			$chk_type = 'no';

		}


	}
	
}



if($list_mod == '리스트형'){

	if($chk_type == 'ok'){
		$btn_review = "<a href=javascript:reg_review('$uid');><span class='board1'>$title</span></a>";

	}elseif($chk_type == 'pwd'){
		$btn_review = "<a onclick=passwordCHK('$uid','re_view','-5','-5') style='cursor:hand'><span class='board1'>$title</span></a>";

	}else{
		$btn_review = "<a href=javascript:error_msg('r')><span class='board1'>$title</span></a>";

	}

}elseif($list_mod == '질문과답변형'){

	if($chk_type == 'ok'){
		$btn_review = "<a href=javascript:reg_review('$uid');><span class='board1'>$title</span></a>";

	}elseif($chk_type == 'pwd'){
		$btn_review = "<a onclick=passwordCHK('$uid','re_view','-5','-5') style='cursor:hand'><span class='board1'>$title</span></a>";

	}else{
		$btn_review = "<a href=javascript:error_msg('r')><span class='board1'>$title</span></a>";

	}

}


?>
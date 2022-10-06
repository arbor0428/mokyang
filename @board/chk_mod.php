<?
/*
//글읽기 권한설정

if(!$read_chk)	$read_chk = '전체';




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


	}elseif($read_chk == '관리자'){

		$chk_type = 'no';


	}else{

		if($GBL_MTYPE){	//회원

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
		$btn_view = "<a href=javascript:reg_view('$uid')><span class='board1'>$title</span></a>";

	}elseif($chk_type == 'pwd'){
		$btn_view = "<a href=javascript:passwordCHK('$uid','$line_num','view')><span class='board1'>$title</span></a>";

	}else{
		$btn_view = "<a href=javascript:error_msg('r')><span class='board1'>$title</span></a>";

	}

}

*/

?>
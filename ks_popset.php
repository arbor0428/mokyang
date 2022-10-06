<SCRIPT language="JavaScript"> 
// 쿠키를 만듭니다. 아래 closeWin() 함수에서 호출됩니다

function setCookie( name, value, expiredays ){ 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 

// 체크후 닫기버튼을 눌렀을때 쿠키를 만들고 창을 닫습니다

function closeWin(day,no,reg){
	form = document['pop'+no];

	id = reg;

	if(form.event1.checked){
		setCookie( "Coo"+id, "done" , day); // 오른쪽 숫자는 쿠키를 유지할 기간을 설정합니다		
	}

	var	LayerClose = document.getElementById('divpop'+no);
	LayerClose.style.visibility = "hidden";
} 

function getCookie(name){
	var nameOfCookie = name + "=";
	var x = 0;
	while ( x <= document.cookie.length ){
		var y = (x+nameOfCookie.length);
		if ( document.cookie.substring( x, y ) == nameOfCookie ) {
			if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
				endOfCookie = document.cookie.length;
			return unescape( document.cookie.substring( y, endOfCookie ) );
		}
		x = document.cookie.indexOf( " ", x ) + 1;
		if ( x == 0 )
		break;
	}
	return "";
}

</SCRIPT>


<script language='javascript'>
function Layer_Loading(left,top,layer){
	var	LayerNotice = document.getElementById(layer);

	LayerNotice.style.left = left;
	LayerNotice.style.top = top;
	
	LayerNotice.style.visibility = "visible";


}
</script>









<?
$SYSTEM_TIME = time();

$sql = "select * from tb_popup where chk_enable='1' order by uid desc";
$result = mysql_query($sql);
$pop_num = mysql_num_rows($result);

for($i=0; $i<$pop_num; $i++){
	$info = mysql_fetch_array($result);

	$ptype = $info['ptype'];
	$pos_mod=$info["pos_mod"];	 //위치

	if($ptype == 'layer'){	 //레이어팝업

		$set_width = $info['pop_width'];	//가로크기
		$set_height = $info['pop_height'];	//세로크기

		$set_left = $info['pop_left'];	//x좌표
		$set_top = $info['pop_top'];	//y좌표		

		$reg_date = $info['reg_date'];

		$scroll=$info["scrolling"];

		$D_date = $info['pop_day'];
		if(!$D_date)	$D_date = '1';

		$ment = $info[ment];
		$ment = str_replace('autostart="true"', 'autostart=false', $ment);

		//$set_height += 20;
	
?>

<div id='divpop<?=$i?>' style="position:absolute; visibility:hidden; z-index:9999;top:<?=$set_top?>px;left:<?=$set_left?>px">
<table cellpadding='0' cellspacing='0' border='0' valign='top' bgcolor='#FFFFFF'>
<form name='pop<?=$i?>'>
	<tr>
		<td align='center' style="word-break:break-all; border :1 solid #cccccc;">
			<table cellpadding='0' cellspacing='0' border='0' width='<?=$set_width?>' style='height:<?=$set_height?>px'>
				<tr>
					<td align='center'><?=$ment?></td>
				</tr>
				<tr>
					<td height='20'>
						<table cellpadding='0' cellspacing='0' border='0' width='<?=$set_width?>' bgcolor='#161817' height='20'>
							<tr>
								<td width='30' style='padding-left:5px;'><input type='checkbox' name='event1' value='' onclick="closeWin('<?=$D_date?>','<?=$i?>','<?=$reg_date?>');" style='border:0px;'></td>
								<td style='padding-top:1px;color:#ffffff'>하루동안 열지않기</td>
								<td align='right'><a href="javascript:closeWin('','<?=$i?>','<?=$reg_date?>')"><font color='#ffffff'>[닫기]</font></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</form>
</table>
</div> 


	<script language='javascript'>
	id = '<?=$reg_date?>';
	if ( getCookie( "Coo"+id ) != "done" ) {
		var w = '<?=$set_width?>';
		var h = parseFloat('<?=$set_height?>') + 20;

		var mod = '<?=$pos_mod?>';

		if(mod == 'left'){	//왼쪽상단
			pos01 = 10;
			pos02 = 10;

		}else if(mod == 'center'){	//가운데
			pos01 = (screen.width)?(screen.width-w)/2:100;
			pos02 = (screen.height)?(screen.height-h)/2:100;

		}else if(mod == 'right'){	//오른쪽상단
			pos01 = screen.width-20-w;
			pos02 = 10;

		}else if(mod == 'user'){	//사용자 지정
			pos01 = '<?=$set_left?>';
			pos02 = '<?=$set_top?>';
		}


		var left = pos01;
		var top = pos02;


		Layer_Loading(left,top,'divpop<?=$i?>');	



	}
	</script>



<?
	}else{	//윈도우팝업
		$scroll=$info["scrolling"];
		if($scroll == 'yes')	$info[pop_width] = $info[pop_width] + 20;
?>

	<script language='javascript'>
	id = '<?=$info[reg_date]?>';
	if ( getCookie( "Coo"+id ) != "done" ) {
		var w = '<?=$info[pop_width]?>';
		var h = parseFloat('<?=$info[pop_height]?>') + 20;
		var pos01 = '';
		var pos02 = '';

		var mod = '<?=$pos_mod?>';


		if(mod == 'left'){	//왼쪽상단
			pos01 = 10;
			pos02 = 10;

		}else if(mod == 'center'){	//가운데

			Ground_Width = document.body.clientWidth;
			Ground_Hiehgt = document.body.clientHeight;
//			pos01 = (screen.width)?(screen.width-w)/2:100;
//			pos02 = (screen.height)?(screen.height-h)/2:100;
			pos01 = (Ground_Width)?(Ground_Width-w)/2:100;
			pos02 = (Ground_Hiehgt)?(Ground_Hiehgt-h)/2:100;

		}else if(mod == 'right'){	//오른쪽상단
			pos01 = screen.width-20-w;
			pos02 = 10;

		}else if(mod == 'user'){	//사용자 지정
			pos01 = '<?=$info[pop_left]?>';
			pos02 = '<?=$info[pop_top]?>';
		}


		var left = pos01;
		var top = pos02;

		

		var noticeWindow = window.open("ks_winpop.php?uid=<?=$info[uid]?>","<?=$info[reg_date]?>","width="+w+", height="+h+", left="+left+", top="+top+",scrollbars=<?=$scroll?>,toolbar=no,status=no");

		if('<?=$i?>' == '0'){

			if(noticeWindow == null ){
				alert("팝업 차단기능 혹은 팝업차단 프로그램이 동작중입니다. 팝업 차단 기능을 해제한 후 다시 시도하세요.");
			} 

		}

	}
	</script>

<?
	}
}
?>




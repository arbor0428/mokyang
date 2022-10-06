<?
include "../../module/class/class.DbCon.php";

$sql = "select * from tb_popup where uid=$uid";
$result = mysql_query($sql);
$info = mysql_fetch_array($result);

?>
<title><?=$info[title]?></title>
<link type='text/css' rel='stylesheet' href='/css/style.css'>
<SCRIPT language="JavaScript"> 
// 쿠키를 만듭니다. 아래 closeWin() 함수에서 호출됩니다

function setCookie( name, value, expiredays ){ 
	var todayDate = new Date(); 
	todayDate.setDate( todayDate.getDate() + expiredays ); 
	document.cookie = name + "=" + escape( value ) + "; path=/; expires=" + todayDate.toGMTString() + ";" 
} 

// 체크후 닫기버튼을 눌렀을때 쿠키를 만들고 창을 닫습니다

function closeWin(){
	form = document.pop;

	id = '<?=$info[reg_date]?>';

	if(form.event1.checked){
//		setCookie( "Coo"+id, "done" , "<?=$info[pop_day]?>"); // 오른쪽 숫자는 쿠키를 유지할 기간을 설정합니다		
	}

	self.close();
} 
</SCRIPT>
<form name=pop>
<table cellpadding=0 cellspacing=0 border=0 width='<?=$info[pop_width]?>' height='<?=$info[pop_height]?>' style="TABLE-LAYOUT: fixed">
	<tr>
		<td align=center style="word-break:break-all;"><?=$info[ment]?></td>
	</tr>
</table>


<table cellpadding=0 cellspacing=0 border=0 width=100% bgcolor='#161817' height=20>
	<tr height=30>
		<td width=10><input type='checkbox' name='event1' value='' onclick='closeWin();'></td>
		<td style='padding-top:4px;'><span style="color:'#FFFFFF';"><?=$info[pop_day]?>일 동안 열지않기</span></td>
		<td width=45><a href="javascript:closeWin()"><font color='#ffffff'>[닫기]</font></a></td>
	</tr>
</table>

</form>

<div class="select-free" id='pop_form' style="position:absolute;display:none;z-index:1">
	<div class="bd">

<style type='text/css'>
td{font-size:12px; color: #505050;}
.select-free
{
	position:absolute;
	z-index:10;
	cursor:move;

	overflow:hidden;/*must have*/
	width:55em;/*must have for any value*/;
	
}
.select-free iframe
{
	display:none;/*sorry for IE5*/
	display/**/:block;/*sorry for IE5*/
	position:absolute;/*must have*/
	top:0;/*must have*/
	left:0;/*must have*/
	z-index:-1;/*must have*/
	filter:mask();/*must have*/
	width:3000px;/*must have for any big value*/
	height:3000px/*must have for any big value*/;
}

/*.select-free .bd{border:solid 1px #aaaaaa;padding:12px;}*/


/*select{display:block;}*/



</style>


<script language='javascript'>
function isEnter2(){
	if(event.keyCode==13){
		check_pwd_pop();
		return;
	}
}



function Off_Pop_Form(){
	var	reg_layer = document.getElementById("pop_form");
	reg_layer.style.display = "none";

	form = document.frm01;
	form.chk_pwd.value = '';
}

function check_pwd_pop(){
	var form = document.frm01;
	if(isFrmEmpty(form.chk_pwd,"비밀번호를 입력해 주십시오."))	return;
	form.action = '<?=$boardRoot?>pwd_proc.php';
	form.submit();
}


</script>


<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td bgcolor="777777" style="padding:3px;">
			<table width="400" border="0" cellpadding="0" cellspacing="0" style="border:4px solid #ffffff;" bgcolor="#FFFFFF">
				<tr>
					<td>
						<table cellpadding=0 cellspacing=0 border=0 width=100%>
							<tr height='35'>
								<td width='80' align="right" style='padding-right:10px;'>비밀번호 : </td>
								<td><input type="password" name="chk_pwd" value="" style="width:200px;" onKeyPress="javascript:isEnter2()"></td>
								<td align="center"><a href='javascript:check_pwd_pop();'><img src="<?=$boardRoot?>img/pwd_ok.gif" alt="확인"></a>&nbsp;<a href='javascript:Off_Pop_Form();'><img src="<?=$boardRoot?>img/pwd_close.gif" alt="닫기"></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
	</div>
	<!--[if lte IE 6.5]><iframe></iframe><![endif]-->
</div>





<!--
Drag and Drop FX
These Drag and Drop effects is just for fun and have nothing to do with the <SELECT> z-index bug 
-->
<script type="text/javascript" src="<?=$strRoot?>module/js/utils/event_1.0.0.js" ></script>
<script type="text/javascript" src="<?=$strRoot?>module/js/utils/position_1.1.0.js" ></script>
<script type="text/javascript" src="<?=$strRoot?>module/js/utils/dragdrop_1.2.1.js" ></script>
<script>
var z = 100;
var zTop = function(){z+=1;this.getEl().style.zIndex=z;};
var dd1 = new ygDD("pop_form");


dd1.onDrag = zTop;

</script>
<!--//Drag and Drop FX-->
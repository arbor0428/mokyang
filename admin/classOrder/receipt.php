<?
	include '../../module/class/class.DbCon.php';

	$sql = "select * from ks_userClass where uid='$uid'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);

	$name = $row['name'];
	$userNum = $row['userNum'];
	$title = $row['title'];
	$eDate01 = $row["eDate01"];
	$eDate02 = $row["eDate02"];
	$payAmt = $row["payAmt"];
	$payTime = $row["payTime"];
	$billName = $row["billName"];
	$season = $row["season"];
	$cade01 = $row["cade01"];

	if($season == '상시' && $cade01 == '휘트니스센터'){
		$eDate = '이용기간 : '.$row["fitnessDate01"].' ~ '.$row["fitnessDate02"];

	}elseif($season == '상시'){
		$eDate = '';

	}else{
		$eDate = '교육기간 : '.$eDate01.' ~ '.$eDate02;
	}

	$payAmtTxt = number_format($payAmt).'원';
	$payDate = date('Y-m-d',$payTime);



	$sql = "select * from ks_userlist where name='$name' and userNum='$userNum'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	$userType = $row['userType'];
	$carNum = $row['carNum'];
?>

<style type="text/css">

html,body{
height:389px !important;
max-height:389px !important;
overflow:hidden;
}
 
*{margin:0;padding:0;}
#rcwrap{font-family:'malgun gothic';font-size:11pt;}
.clearfix{*zoom:1}
.clearfix:after{clear:both;display:block;content:''}
li{list-style:none;}


.receipt{
width:230px;
padding:15px 15px;
border-top:1px solid #000;
border-bottom:1px solid #000;

}
.dashed_line_rc{
width:100%;
border-bottom:1px dashed #888;
margin:10px 0;
}

.rcttl{
font-size:18px;
font-weight:600;
text-align:center;
}
.rcttls{
font-size:13px;
text-align:center;
margin-top:8px;
}

.rc_info li{
line-height:20px;
font-size:12px;
color:#000;
font-weight:600;
}

.pkttl{
font-size:15px;
font-weight:600;
text-align:center;
}
.pkttl2{
font-size:17px;
text-align:center;
margin-top:6px;
}


.rc_date{
text-align:center;
font-size:12px;
margin-bottom:8px;

}

.rc_logo img{
width:120px;
margin:5px auto;
display:block;
}

.rc_w_info{
text-align:center;
font-size:10px;
color:#000;
}  


</style>

<script language='javascript'>
function printPage(){
	window.print();
}
</script>

<body onload='printPage();'>

<div id="rcwrap">
	<div class="receipt">
		<div class="rcttl">프로그램 영수증</div>
<!--관리자가 인쇄할때는 필요없는 정보
		<div class="rcttls">(회원용)</div>
-->

		<div class="dashed_line_rc"></div>
		
		<ul class="rc_info">
		<?
			if($billName){
		?>
			<li>회원명: <?=$name?></li> <!--기본적으로 나오지 않으며 관리자가 이름이 나오게 체크하여 인쇄했을 때만 표시-->
		<?
			}
		?>
			<li>회원번호: <?=$userNum?></li>
			<li>프로그램: <?=$title?></li>
			<li><?=$eDate?></li>
			<li>영수금액: <?=$payAmtTxt?></li>
		</ul>
<?
	if($carNum){
?>
		<div class="dashed_line_rc"></div>

		<div class="pkttl">차량번호</div>
		<div class="pkttl2"><?=$carNum?></div>
<?
	}
?>
		<div class="dashed_line_rc"></div>

		<div class="rc_date"><?=$payDate?></div>

		<div class="rc_logo"><img src="/images/logo3_foot.jpg" alt="" /></div>

		<div class="rc_w_info">
			서울 은평구 녹번로 16<br>
            T. 02-351-3736
		</div>
	</div>	
</div>
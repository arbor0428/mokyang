<?
exit;
	include "../../module/class/class.DbCon.php";
	include "../../module/class/class.Msg.php";

	$excelFile = '../Excel/efile/re.xls';


	require_once '../Excel/reader.php';
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('euc-kr'); // 이부분만 바꿨습니다.
	$data->read($excelFile);


	error_reporting(E_ALL ^ E_NOTICE);


	$totCnt = $data->sheets[0]['numRows'];

	$chkYear = '';

	for($i=3; $i<=$totCnt; $i++){
		$no = trim($data->sheets[0]['cells'][$i][1]);				//번호
		$userNum = trim($data->sheets[0]['cells'][$i][2]);		//회원번호
		$name = trim($data->sheets[0]['cells'][$i][3]);			//회원명
		$bDate = trim($data->sheets[0]['cells'][$i][4]);			//생년월일
		$sex = trim($data->sheets[0]['cells'][$i][5]);				//성별
		$cokTxt = trim($data->sheets[0]['cells'][$i][18]);		//대상자자료제공(제공안함 / 제공)
		$phone01 = trim($data->sheets[0]['cells'][$i][19]);		//연락처1
		$phone02 = trim($data->sheets[0]['cells'][$i][20]);		//연락처2
		$email = trim($data->sheets[0]['cells'][$i][21]);			//이메일
		$addr01 = trim($data->sheets[0]['cells'][$i][22]);		//주소
		$getDate = trim($data->sheets[0]['cells'][$i][23]);		//등록일
		$carNum = trim($data->sheets[0]['cells'][$i][24]);		//차량번호
		

		//생년월일
		$bArr = explode('/',$bDate);
		$bTime = mktime(0,0,0,$bArr[1],$bArr[0],$bArr[2]) - 86400;
		$bDate = date('Y-m-d',$bTime);

		$userType = '일반';

		//대상자자료제공
		if($cokTxt == '제공안함')	$cok = '';
		else								$cok = '1';

		//이메일
		if(strpos($email, '@') !== false){
			$eTxt = explode('@',$email);
			$email01 = $eTxt[0];
			$email02 = $eTxt[1];

		}else{
			$email01 = $email;
			$email02 = '';
		}

		if($carNum)	$car = '예';
		else			$car = '';

		//접수일
		$gArr = explode('/',$getDate);
		$getTime = mktime(0,0,0,$gArr[1],$gArr[0],$gArr[2]) - 86400;
		$getDate = date('Y-m-d',$getTime);
		$getYear = date('Y',$getTime);


		if($getYear != $chkYear){
			$chkYear = $getYear;
			$userOrder = 1;

		}else{
			$userOrder += 1;
		}

		$getTime += $userOrder;

		$status = '1';	//승인
		$upfile01 = '';
		$realfile01 = '';
		$rDate = $getDate;
		$rTime = $getTime;

		echo $getDate.'<br>';

		$sql = "insert into ks_userlist (status,name,userNum,userOrder,sex,bDate,bTime,userType,car,carNum,zipcode,addr01,addr02,email01,email02,phone01,phone01Txt,phone02,phone02Txt,memo,reduction,upfile01,realfile01,cok,cokPost,cokSms,cokEmail,cokPhone,health,healthBaby,healthEtc,joinType,getDate,getTime,rDate,rTime) values ";
		$sql .= "('$status','$name','$userNum','$userOrder','$sex','$bDate','$bTime','$userType','$car','$carNum','$zipcode','$addr01','$addr02','$email01','$email02','$phone01','$phone01Txt','$phone02','$phone02Txt','$memo','$reduction','$upfile01','$realfile01','$cok','$cokPost','$cokSms','$cokEmail','$cokPhone','$health','$healthBaby','$healthEtc','$joinType','$getDate','$getTime','$rDate','$rTime')";
		$result = mysql_query($sql);
	}
?>
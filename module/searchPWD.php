<?
	include "/home/g3651/www/module/class/class.DbCon.php";
	include "/home/g3651/www/module/class/class.Util.php";

	$name = $_POST['name'];
	$email = $_POST['email'];


	$emailTxt = explode('@',$email);
	$email01=$emailTxt[0];
	$email02=$emailTxt[1];

	$sql = "select * from tb_member where email01='$email01' and email02='$email02' and name='$name'";
	$result = mysql_query($sql);
	$num = mysql_num_rows($result);

	if($num){
		$row = mysql_fetch_array($result);
		$apwd = $row['pwd'];
		$userid = $row['userid'];
		$email01 = $row['email01'];
		$email02 = $row['email02'];
		$email = $email01.'@'.$email02;
		//비밀번호 초기화
		$pwd = Util::rePassWord();
		$sql = "update tb_member set pwd='$pwd' where userid='$userid'";
		$result = mysql_query($sql);

	
		//메일발송
		include 'passEmail.php';

		echo 'ok';

	}else{
		echo '';
	}
?>
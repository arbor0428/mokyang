<?
class DbCon
{
	var	$DB_SERVER		= "localhost";
	var	$DB_LOGIN		= "mokyang";
	var $DB_PASSWORD	= "i-mokyang1025";
	var $DB				= "mokyang";

	function getConnection(){
		$dbconn = mysql_connect($this->DB_SERVER, $this->DB_LOGIN, $this->DB_PASSWORD) 
				  or die("데이타베이스 연결에 실패했습니다.");
		$status = mysql_select_db($this->DB, $dbconn);

//		mysql_query('set names euckr');

		if($status)
			return $dbconn;
		else
			return $status;
	}
}

$db = new DbCon();
$dbconn = $db->getConnection();

//해당 항수가 없으면 선언
if(!function_exists('mysqli_result')){
	function mysqli_result($res,$row=0,$col=0){ 
		$nums=mysqli_num_rows($res);
		if($nums && $row<=($nums-1) && $row>=0){
			mysqli_data_seek($res,$row);
			$resrow=(is_numeric($col))?mysqli_fetch_row($res):mysqli_fetch_assoc($res);
			if(isset($resrow[$col])){
				return $resrow[$col];
			}
		}
		return false;
	}

	@extract($_GET); 
	@extract($_POST); 
	@extract($_SERVER);
}

//쿼리함수
include '/home/mokyang/www/module/query_func.php';
?>
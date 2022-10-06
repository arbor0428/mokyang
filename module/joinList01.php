<?
	include './class/class.DbCon.php';	
?>

<!doctype html>
<html lang="ko">
<head>
<link rel="stylesheet" type="text/css" href="/css/style.css?v=1">
<link rel="stylesheet" type="text/css" href="/css/sub.css?v=2">
<link rel="stylesheet" type="text/css" href="/css/button.css?v=4">
</head>
<body>

<table cellpadding='0' cellspacing='0' border='0' width='100%' class='listTable'>
	<tr>
		<th>아이디</th>
		<th>회원명</th>
		<th>접수일시</th>
	</tr>
<?
	$item = sqlArray("select b.*, m.name from ks_bongsa01_join as b left join tb_member as m on b.userid=m.userid where b.pid='$uid' order by b.uid desc");
	foreach($item as $k => $v){
?>
	<tr align='center'>
		<td><?=$v['userid']?></td>
		<td><?=$v['name']?></td>
		<td><?=$v['rDate']?></td>
	</tr>
<?
	}
?>
</table>

</body>
</html>
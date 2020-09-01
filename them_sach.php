<?php session_start();
require_once './connect.php';
$err = [];
$msg = [];
$sql = '';
if(!isset($_SESSION['auth']['username'])){
	
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Them sach</title>
	<style type="text/css">
		input{
			border: 0px;
		}
	</style>
</head>
<body>
	<h2>Them sach vao CSDL</h2>
	<form method="post" enctype="multipart/form-data">
		<table border="1" cellspacing="0">
			<tr>
				<td>Ten sach</td>
				<td>Price</td>
				<td>Tac gia</td>
				<td>The loai</td>
				<td>Link anh sach</td>
			</tr>
			<tr>
				<td><input type="text" name="tensach"></td>
				<td><input type="number" name="giasach"></td>
				<td><input type="text" name="tacgia"></td>
				<td><input type="text" name="theloai"></td>
				<td><input type="text" name="linksach"></td>
			</tr>
		</table>
		<button type="submit" name="sub">Nhap sach</button>
	</form>
</body>
</html>
<?php
echo $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Detail sản phẩm</title>
</head>
<body>
	<form method="post">
		<table>
			<tr>
				<td>Tên sản phẩm</td>
				<td><input type="text" name="ten"></td>
			</tr>
			<tr>
				<td>Mã sản phẩm</td>
				<td><input type="number" name="masp"></td>
			</tr>
			<tr>
				<td>Giá sản phẩm</td>
				<td><input type="price" name="gia"></td>
			</tr>
			<tr>
				<td>Số lượng sản phẩm</td>
				<td><input type="number" name="soluong"></td>
			</tr>
			<tr>
				<td>Tổng tiền</td>
				<td><input type="number" name="tongtien"></td>
			</tr>
		</table>
		<input type="submit" name="sub">
	</form>
</body>
</html>
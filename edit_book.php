<?php
require_once "./connect.php";
echo "<h2>Sửa sách có id = {$_GET['id']}</h2><br>";



if (isset($_GET['id'])) {
	echo $id = $_GET['id'];
	if(isset($_POST['sub'])){
	

	$name = $_POST['name'];
	$price = $_POST['price'];
	$author = $_POST['author'];
	$cat_id = $_POST['cat_id'];
	$linkanh = $_POST['linkanh'];
	if(!isset($name) && strlen($name)==0){
		$err[] = 'Tên sách không hợp lệ!';
	}
	if(!isset($price) && strlen($price)==0){
		$err[] = 'Giá sách không hợp lệ!';
	}
	if(!isset($author) && strlen($author)==0){
		$err[] = 'Tên tác giả sách không hợp lệ!';
	}
	if(!isset($cat_id) && strlen($cat_id)==0){
		$err[] = 'Mã sách không hợp lệ!';
	}
	if(!isset($linkanh) && strlen($linkanh)==0){
		$err[] = 'Link ảnh sách không hợp lệ!';
	}

	if(empty($err)){
		$sql = " UPDATE tb_book SET name = '{$name}', price = {$price}, author = '{$author}', cat_id = {$cat_id}, image = '{$linkanh}' WHERE id = ".$id;
		$res = mysqli_query($conn, $sql);
		if(mysqli_errno($conn)){
			$err[] = 'Loi truy van CSDL: '.mysqli_error($conn);
		}else{
			$msg[] = "Bạn đã cập nhập CSDL thành công!";
		}
	}
}


$sql02 = " SELECT * FROM tb_book WHERE id = $id " ;

$res02 = mysql_query($conn, $sql02);
if(mysqli_errno($conn)){
	$err[] = "Loi truy van CSDL: ".mysqli_error($conn);
	die();
}else{
	while($row = mysqli_fetch_assoc($res02)){
		$list02[] = $row;
	}
}
echo "<pre>";
print_r($list02);
echo "<pre>";
	
}
	


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sửa thông tin sách</title>
	<style type="text/css">
		.err{
			color: red;
			background-color: black;
		}
		.msg{
			color: green;
			background-color: cyan;
		}
		body{
			text-align: center;
		}
	</style>
</head>
<body>
<?php
if(!empty($err)){
	echo "<p class='err'>".implode('<br>', $err)."</p>";
}
if(!empty($msg)){
	echo "<p class='msg'>".implode('<br>', $msg)."</p>";
}
?>
	<form method="post" >
		<table>
			<tr>
				<td>Tên sách</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr>
				<td>Giá sách</td>
				<td><input type="number" name="price"></td>
			</tr>
			<tr>
				<td>Tác giả</td>
				<td><input type="text" name="author"></td>
			</tr>
			<tr>
				<td>Mã thể loại</td>
				<td><input type="number" name="cat_id"></td>
			</tr>
			<tr>
				<td>Link ảnh sách</td>
				<td><input type="file" name="linkanh"></td>
			</tr>
		</table>
		<input type="submit" name="sub" value="Update">
	</form>
</body>
</html>
<?php session_start();
require_once './connect.php';
$err = [];
$msg = [];
$sql = '';
if(!isset($_SESSION['auth']['username'])){
	header("Location: dang_nhap.php");
}
if(isset($_POST['tensach']) && !empty($_POST['tensach'])){
	$tensach 	= $_POST['tensach'];
	$giasach 	= $_POST['giasach'];
	$tacgia 	= $_POST['tacgia'];
	$theloai 	= $_POST['theloai'];
	$linksach 	= $_POST['linksach'];

	if(!isset($_POST['tensach']) || strlen($_POST['tensach'])==00){
		$err[] = 'Ten sach khong hop le!';
	}
	if(!isset($_POST['giasach']) || strlen($_POST['giasach'])==00){
		echo "ABC";
		$err[] = 'Gia sach khong hop le!';
	}
	if(!isset($_POST['tacgia']) || strlen($_POST['tacgia'])==0){
		$err[] = 'Tac gia khong hop le!';
	}
	if(!isset($_POST['theloai']) || strlen($_POST['theloai'])==0){
		$err[] = 'The loai khong hop le!';
	}
	if(!isset($_POST['linksach']) || strlen($_POST['linksach'])==0){
		$err[] = 'Link sach khong hop le!';
	}
	if(empty($err)){
		$sql = " CALL them_sach('{$tensach}', {$giasach}, '{$tacgia}', {$theloai}, '{$linksach}') ";

		$res = mysqli_query($conn, $sql);
		if(mysqli_errno($conn)){
			$err[] = "Loi truy van CSDL: ".mysqli_error($conn);
		}else{
			$msg[] = "Them vao CSDL thanh cong!";
		}
	}



}
$sql1 = " SELECT * FROM tb_cat ";
$res1 = mysqli_query($conn, $sql1);
if(mysqli_errno($conn)){
	$err[] = "Loi truy van CSDL: ".mysqli_error($conn);
}else{
	while($row = mysqli_fetch_assoc($res1)){
		$list1[] = $row;
	}
}

foreach($list1 as $row){
	echo $row['cat_name']."<br>";
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
		.err{
			color: red;
			background-color: yellow;
		}
		.msg{
			color: cyan;
			background-color: green;
		}
	</style>
</head>
<body>
	<h2>Them sach vao CSDL</h2>
	<?php
	if(!empty($err)){
		echo "<p class = 'err'>".implode('<br>', $err)."</p>";
	}
	if(!empty($msg)){
		echo "<p class = 'msg'>".implode('<br>', $msg)."</p>";
	}
	?>
	<form method="post" enctype="multipart/form-data">
		<table border="1" cellspacing="0">
			<tr>
				<td>Tên sách</td>
				<td>Price</td>
				<td>Tác giả</td>
				<td>Thể loại</td>
				<td>Link ảnh sách</td>
				<td>Sửa</td>
			</tr>
			<tr>
				<td><input type="text"	 name="tensach" 	value="<?php echo @$_POST['tensach']; ?>"></td>
				<td><input type="number" name="giasach" 	value="<?php echo @$_POST['giasach']; ?>"></td>
				<td><input type="text" 	 name="tacgia" 		value="<?php echo @$_POST['tacgia']; ?>"></td>
				<td>
					<select name="theloai">
						<?php
						foreach($list1 as $row){
							echo "
							<option value="."{$row['id']}".">"."{$row['cat_name']}"."</option>
							";
						}
						?>
					</select>
				</td>
				<td><input type="text" name="linksach"></td>
				<td><a href="">Sửa</a></td>
			</tr>
		</table>
		<button type="submit" name="sub">Nhap sach</button>
	</form>
</body>
</html>
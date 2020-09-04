<?php
require './connect.php';
$err = [];
$msg = [];
$list = [];
$strWhere = '';
$sql = '';
if(isset($_POST['sub01'])){
	if(isset($_POST['id']) && strlen($_POST['id'])>0){
		$id = $_POST['id'];
		$sql = "CALL GetSach01({$id})";
	}else{
		$sql = "CALL GetSach()";
	}
}

if(isset($_POST['sub02'])){
	if(isset($_POST['book_name']) && strlen($_POST['book_name'])>0){
		$book_name = $_POST['book_name'];
		$sql = "CALL GetSach02('%{$book_name}%')";
	}else{
		$sql = "CALL GetSach()";
	}
}

$result = mysqli_query($conn, $sql);
if(mysqli_errno($conn)){
	die("Error");
}else{
	while($row = mysqli_fetch_assoc($result)){
		$list[] = $row;
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Show list book</title>
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
	<h1>List book</h1>
	<?php
	if(!empty($err)){
		echo "<p class = 'err'>".implode('<br>', $err)."</p>";
	}
	if(!empty($msg)){
		echo "<p class = 'msg'>".implode('<br>', $msg)."</p>";
	}
	?>




	<form method="post">
		<table>
			<tr>
				<td>Mã sách</td>
				<td><input type="number" name="id" value="<?php echo @$_POST['id']; ?>"></td>
				<td><input type="submit" name="sub01" value="Search01"></td>
			</tr>
		</form>




		<form method="post">
			<tr>
				<td>Tên sách</td>
				<td><input type="text" name="book_name" value="<?php echo @$_POST['book_name']; ?>"></td>
				<td><input type="submit" name="sub02" value="Search02"></td>
			</tr>
		</table>
	</form>




	<table border="1" cellspacing="0" cellpadding="2">
		<tr>
			<td>Mã sách</td>
			<td>Tên sách</td>
			<td>Giá sách</td>
			<td>Tác giả</td>
			<td>Mã thể loại sách</td>
			<td>Link ảnh sách</td>
			<td>Sửa</td>
			<td>Detail</td>
		</tr>
		<?php
		foreach ($list as $row){
			$edit = "<a href = 'edit_book.php?id={$row['id']}'>Sửa</a>";
			$detail = "<a href = 'detail.php?id={$row['id']}'>Detail</a>";
			echo "
			<tr>
				<td>{$row['id']}</td>
				<td>{$row['name']}</td>
				<td>{$row['price']}</td>
				<td>{$row['author']}</td>
				<td>{$row['cat_id']}</td>
				<td>{$row['image']}</td>
				<td>{$edit}</td>
				<td>{$detail}</td>
			</tr>
			";
		}
		?>
	</table>
</body>
</html>
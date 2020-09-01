<?php session_start();
require_once './connect.php';
$err = [];
if(isset($_SESSION['auth']) && !empty($_SESSION['auth']))
	header("Location: trangchu.php");

if(isset($_POST['sub'])){
	$username = $_POST['username'];
	$passwd = $_POST['passwd'];

	if(!preg_match("/^[_A-Za-z0-9]{5,20}$/", $username))
		$err[]='Ten dang nhap khong hop le';

	if(empty($err)){
		$sql = " CALL login('{$username}') ";
		$res = mysqli_query($conn, $sql);
		if(mysqli_errno($conn)){
			die("Loi truy van CSDL: ". mysqli_errno($conn));
		}
		if(mysqli_num_rows($res) == 1){
			$row = mysqli_fetch_assoc($res);
			if(md5($passwd) == $row['passwd']){
				unset($row['passwd']);
				$_SESSION['auth']['username']=$username;
				header("Location: ./trangchu.php");
			}
		}
		else echo "Loi";	
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dang nhap</title>
	<style type="text/css">
		.err{
			color: red;
			background-color: yellow
		}
	</style>
</head>
<body>
	<?php
	if(!empty($err)){
		echo "<p class='err'>".implode('<br>', $err)."</p>";
	}
	?>
	<h3>Hello, welcome to login page</h3>
	<form method="post">
		<table cellpadding="5px">
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" value="<?php echo @$_POST['username']; ?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="password" name="passwd"></td>
			</tr>
		</table>
		<button type="submit" name="sub">Dang nhap</button>
	</form>
</body>
</html>
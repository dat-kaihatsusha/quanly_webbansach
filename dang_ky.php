<?php session_start();
require_once './connect.php';
$err = [];
$msg = [];
$sql = '';
$username = '';
$email = '';
$passwd = '';

if(isset($_POST['regis'])){
	$username = $_POST['username'];
	$passwd = $_POST['passwd1'];
	$email = $_POST['email'];
}

if(@strlen($_POST['email']) == 0){
	$err[] = 'Email khong duoc de trong!';
}

if(@strlen($_POST['username']) == 0){
	$err[] = 'Username khong duoc de trong!';
}elseif(!preg_match('/^[A-Za-z0-9_]{5,20}$/', $username))
$err[] = 'Ten dang nhap khong hop le!';

if(strlen($passwd) == 0){
	$err[] = 'Password khong duoc de trong!';
}else{
	if($_POST['passwd2']==0)
		$err[] = 'Ban can xac nhan lai Password!';
	elseif($passwd != $_POST['passwd2'])
		$err[] = 'Password xac nhan chua dung!';
}




if(empty($err)){
	$passwd = md5($passwd);
	$sql = "INSERT INTO tb_user(username, passwd, email) 
	VALUES ('{$username}','{$passwd}','{$email}')
	";
	$res = mysqli_query($conn, $sql);
	if(mysqli_query($conn, $sql)){
		$err[] = 'Loi truy van CSDL'.mysqli_error($conn);
	}else{
		$msg[] = 'Ban da dang ky tai khoan thanh cong!';
		$_SESSION['auth']['username'] = $username;
		$_POST['auth']['passwd']=$passwd;
		header('Location: trangchu.php');
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dang ky</title>
	<style type="text/css">
		.err{
			color: red;
			background-color: yellow;
		}
		.msg{
			color: cyan;
			background-color: blue;
		}
	</style>
</head>
<body>
	<h2>Hello, welcome to register page</h2>
	<?php
	if(!empty($err)){
		echo "<p class='err'>".implode('<br>', $err)."<p>";
	}
	if(!empty($msg)){
		echo "<p class='msg'>".implode('<br>', $msg)."</p>";
	}
	?>
	<form method="post">
		<table cellpadding="5px">
			<tr>
				<td>Email:</td>
				<td><input type="email" name="email" value="<?php echo @$_POST['email']; ?>"></td>
			</tr>
			<tr>
				<td>Username:</td>
				<td><input type="text" name="username" value="<?php echo @$_POST['username']; ?>"></td>
			</tr>
			<tr>
				<td>Password:</td>
				<td><input type="password" name="passwd1" value="<?php echo @$_POST['passwd1']; ?>"></td>
			</tr>
			<tr>
				<td>Confirm Password:</td>
				<td><input type="password" name="passwd2"></td>
			</tr>
		</table>
		<button type="submit" name="regis">Dang ky</button>
	</form>
</body>
</html>
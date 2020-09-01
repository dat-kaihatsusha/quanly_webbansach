<?php session_start();
echo "<h3>Trang chu</h3>";
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
	header("Location: dang_nhap.php");
}
echo "Xin chao: <b>".$_SESSION['auth']['username']."</b> da dang ki thanh website cua chung toi<br>";
echo "<a href='./dang_xuat.php'>Dang xuat</a><br>";
echo "<a href='./them_sach.php'>Them sach</a>";
?>
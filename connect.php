<?php
$dbname = 'sach';
$host = 'localhost';
$username = 'root';
$pass = '';

$conn = new mysqli($host, $username, $pass) or die('Loi');
mysqli_select_db($conn, $dbname) or die('Loi CSDL ').$dbname." Khong ton tai!";
mysqli_set_charset($conn, 'utf8');
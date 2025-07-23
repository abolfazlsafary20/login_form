<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "user_auth";

// ایجاد اتصال
$conn = new mysqli($host, $user, $pass, $dbname);

// بررسی اینکه آیا اتصال موفق است
if ($conn->connect_error) {
    die("خطا در اتصال به دیتابیس: " . $conn->connect_error);  // چاپ خطای دقیق
}
?>

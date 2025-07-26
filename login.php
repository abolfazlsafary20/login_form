<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // آماده کردن کوئری
    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    if (!$stmt) {
        die("Error preparing query: " . $conn->error);
    }

    // اجرای کوئری
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // بررسی نتیجه
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $emailFromDB, $hashedPassword);
        $stmt->fetch();

        // چک کردن رمز عبور
        if (password_verify($password, $hashedPassword)) {
            // ورود موفقیت‌آمیز
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: welcome.php");
            exit;
        } else {
            // رمز عبور اشتباه
            $_SESSION['error'] = ". رمز عبور اشتباه است";
            header("Location: index.php");
            exit;
        }
    } else {
        // ایمیل پیدا نشد
        $_SESSION['error'] = ". ایمیل پیدا نشد";
        header("Location: index.php");
        exit;
    }
}
?>

<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $emailFromDB, $hashedPassword);
        $stmt->fetch();

        if (password_verify($password, $hashedPassword)) {
            // ورود موفقیت‌آمیز
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            header("Location: dashboard.php");
            exit;
        } else {
            // رمز عبور اشتباه
            $_SESSION['error'] = "رمز عبور اشتباه است.";
            header("Location: index.php");
            exit;
        }
    } else {
        // ایمیل پیدا نشد
        $_SESSION['error'] = "ایمیل پیدا نشد.";
        header("Location: index.php");
        exit;
    }
}
?>

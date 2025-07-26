<?php
require 'config.php'; // اتصال به دیتابیس

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت داده‌های فرم
    $name = isset($_POST['name']) ? trim($_POST['name']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $raw_password = isset($_POST['password']) ? $_POST['password'] : null;

    // بررسی اینکه همه فیلدها پر شده‌اند
    if (!$name || !$email || !$raw_password) {
        echo "<div style='color: red; font-weight: bold;'>⚠️ . همه فیلد ها باید پر شوند</div>";
        exit;
    }

    // هش کردن رمز عبور
    $password = password_hash($raw_password, PASSWORD_DEFAULT);

    // ایجاد اتصال به دیتابیس
    $conn = new mysqli($host, $user, $pass, $dbname);

    // بررسی اتصال به دیتابیس
    if ($conn->connect_error) {
        die("خطا در اتصال به دیتابیس: " . $conn->connect_error); 
    }

    // بررسی اینکه ایمیل قبلاً ثبت نشده
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<div style='color: red; font-weight: bold;'>⚠️ . این ایمیل قبلا ثبت شده است</div>";
    } else {
        // ذخیره اطلاعات در دیتابیس
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        if ($stmt->execute()) {
            // هدایت به صفحه جدید پس از ثبت‌نام موفقیت‌آمیز
            header("Location: dashboard.php");
            exit;
        } else {
            echo "<div style='color: red; font-weight: bold;'>❌ خطا در ثبت اطلاعات. لطفاً دوباره تلاش کنید.</div>";
        }
    }
}
?>

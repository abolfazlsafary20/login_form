<?php
require 'config.php';

$email = $_POST['email'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $token = bin2hex(random_bytes(16));
    $update = $conn->prepare("UPDATE users SET reset_token = ? WHERE email = ?");
    $update->bind_param("ss", $token, $email);
    $update->execute();

    echo "✅ لینک بازیابی رمز عبور (فقط برای تست): <br>";
    echo "<a href='#'>https://example.com/reset.php?token=$token</a>";
} else {
    echo "❌ ایمیلی با این مشخصات پیدا نشد.";
}
?>

<?php session_start(); ?>
<?php
if (isset($_SESSION['error'])) {
    echo '<div id="phpErrorMessage" data-message="' . $_SESSION['error'] . '"></div>';
    unset($_SESSION['error']);
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <title>ورود</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      margin: 0;
      font-family: 'Vazirmatn', sans-serif;
      height: 100vh;
      background-image: url('https://storage.archfly.ir/DL1/TEXTUTES/Backgroud/(archfly.ir)_Background.080.jpg');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.9);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 15px 25px rgba(0, 0, 0, 0.2);
      width: 100%;
      max-width: 400px;
      box-sizing: border-box;
      position: relative;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #333;
    }

    form input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      background: #f4f4f4;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 14px;
      box-sizing: border-box;
    }

    .input-group {
      position: relative;
    }

    .input-group input {
      padding-right: 40px;
    }

    .input-group .toggle-password {
      position: absolute;
      top: 50%;
      right: 12px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 18px;
      color: #666;
      user-select: none;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      margin-top: 10px;
      transition: 0.3s;
    }

    button:hover {
      background: #2980b9;
    }

    .links {
      text-align: center;
      margin-top: 16px;
    }

    .links a {
      text-decoration: none;
      color: #2c3e50;
      font-size: 14px;
      margin: 0 5px;
      cursor: pointer;
    }

    .alert-box {
      position: absolute;
      top: 20px;
      right: 20px;
      color: #e74c3c;
      background: rgba(255, 255, 255, 0.8);
      padding: 10px 20px;
      border-radius: 8px;
      font-size: 14px;
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
      z-index: 9999;
    }

    .alert-box.show {
      opacity: 1;
    }

  </style>
</head>
<body>

  <!-- جعبه هشدار خطا -->
  <div id="alertBox" class="alert-box" style="display:flex ;"></div>

  <div class="login-box">
    
    <div id="loginForm">
      <h2>مشخصات خود را وارد کنید</h2>
      <form action="login.php" method="POST" onsubmit="return validateForm()">
        <input type="email" name="email" placeholder="ایمیل" required id="email">
        <div class="input-group">
          <input type="password" id="password" name="password" placeholder="رمز عبور" required>
          <span id="togglePassword" class="toggle-password" style="text-decoration: line-through;">👁️</span>
        </div>
        <button type="submit">ورود</button>
      </form>
      <div class="links">
        <a onclick="showForm('forgot')">فراموشی رمز عبور؟</a> |
        <a onclick="showForm('register')">ثبت نام</a>
       </div>
    </div>

    <!-- فرم فراموشی رمز -->
    <div id="forgotForm" style="display: none;">
      <h2>بازیابی رمز</h2>
      <form action="forgot.php" method="POST">
        <input type="email" name="email" placeholder="ایمیل خود را وارد کنید" required>
        <button type="submit">ارسال لینک بازیابی</button>
      </form>
      <div class="links">
        <a onclick="showForm('login')">بازگشت به ورود</a>
      </div>
    </div>

    <!-- فرم ثبت‌نام -->
    <div id="registerForm" style="display: none;">
      <h2>ثبت‌نام</h2>
      <form action="register.php" method="POST">
        <input type="text" name="name" placeholder="نام کاربری" required>
        <input type="email" name="email" placeholder="ایمیل" required>
        <input type="password" name="password" placeholder="رمز عبور" required>
        <button type="submit">ثبت نام</button>
      </form>
      <div class="links">
        <a onclick="showForm('login')">بازگشت به ورود</a>
  
  </div>

  <!-- دریافت خطای پی‌اچ‌پی از داده‌های سشن -->
  <?php if (isset($_SESSION['error'])): ?>
    <div id="phpErrorMessage" data-message="<?= $_SESSION['error'] ?>"></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <script src="script.js"></script>
</body>
</html>

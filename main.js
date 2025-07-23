// نمایش هشدار با انیمیشن
function showAlert(message) {
  const alertBox = document.getElementById("alertBox");
  alertBox.innerHTML = "❌ " + message;

  // ریست انیمیشن
  alertBox.classList.remove("show");
  void alertBox.offsetWidth;  // force reflow
  alertBox.classList.add("show");

  // حذف هشدار بعد از 3 ثانیه
  setTimeout(() => {
    alertBox.classList.remove("show");
  }, 3000);
}

// اعتبارسنجی فرم ورود
function validateForm() {
  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    showAlert("لطفاً ایمیل و رمز عبور را وارد کنید!");
    return false;
  }

  return true;
}

// نمایش فرم‌ها
function showForm(formName) {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("forgotForm").style.display = "none";
  document.getElementById("registerForm").style.display = "none";

  const targetForm = document.getElementById(formName + "Form");
  if (targetForm) {
    targetForm.style.display = "block";
  }
}

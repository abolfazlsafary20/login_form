// نمایش هشدار با انیمیشن
function showAlert(message) {
  const alertBox = document.getElementById("alertBox");
  if (!alertBox) return;

  alertBox.innerHTML = "❌ " + message;

  // ریست انیمیشن
  alertBox.classList.remove("show");
  void alertBox.offsetWidth; // force reflow
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

// نمایش فرم‌ها (ورود / فراموشی رمز / ثبت‌نام)
function showForm(formName) {
  const forms = ["loginForm", "forgotForm", "registerForm"];
  forms.forEach(id => {
    const form = document.getElementById(id);
    if (form) form.style.display = "none";
  });

  const targetForm = document.getElementById(formName + "Form");
  if (targetForm) {
    targetForm.style.display = "block";
  }
}

// مدیریت اتفاقات بعد از بارگذاری صفحه
window.addEventListener("DOMContentLoaded", () => {
  const passwordInput = document.getElementById("password");
  const togglePassword = document.getElementById("togglePassword");

  if (passwordInput && togglePassword) {
    togglePassword.textContent = "👁️";
    togglePassword.style.textDecoration = "line-through";

    togglePassword.addEventListener("click", () => {
      const isHidden = passwordInput.getAttribute("type") === "password";
      passwordInput.setAttribute("type", isHidden ? "text" : "password");
      togglePassword.style.textDecoration = isHidden ? "none" : "line-through";
    });
  }

  // نمایش پیام از سمت PHP اگر وجود داشت
  const phpMessage = document.getElementById("phpErrorMessage");
  if (phpMessage) {
    const message = phpMessage.getAttribute("data-message");
    if (message) {
      showAlert(message);
    }
  }
});

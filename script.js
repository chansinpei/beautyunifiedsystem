// script.js

// Simulated login data (replace this with backend logic later)
const users = [
  {
    username: "admin",
    // AES encrypted password: "admin123" with key "secretkey"
    password: CryptoJS.AES.encrypt("admin123", "secretkey").toString()
  }
];

document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const usernameInput = document.getElementById("username").value;
  const passwordInput = document.getElementById("password").value;
  const status = document.getElementById("loginStatus");

  // Simulate password check
  const user = users.find((u) => u.username === usernameInput);
  if (user) {
    const decrypted = CryptoJS.AES.decrypt(user.password, "secretkey").toString(CryptoJS.enc.Utf8);
    if (decrypted === passwordInput) {
      status.classList.add("hidden");
      alert("Login successful!");
      window.location.href = "dashboard.html"; // redirect
      return;
    }
  }

  // If failed
  status.classList.remove("hidden");
});

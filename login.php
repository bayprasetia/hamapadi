<?php
session_start();
include "config.php";

$error = "";

if (isset($_POST['login'])) {
  $username = trim($_POST['username']);
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      $_SESSION['username'] = $user['username'];
      $_SESSION['role'] = $user['role'];
      header("Location: index.php");
      exit;
    } else {
      $error = "Password salah. Silakan coba lagi.";
    }
  } else {
    $error = "Username <strong>$username</strong> belum terdaftar.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    body {
      background: url('Assets/img/bg-padi.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }

    .overlay {
      background: rgba(255, 255, 255, 0.85);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      max-width: 400px;
      width: 100%;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      border: none;
    }

    .login-header {
      background-color: #1a73e8;
      color: white;
      border-radius: 16px 16px 0 0;
    }

    .form-icon {
      position: absolute;
      left: 15px;
      top: 10px;
      font-size: 1.1rem;
      color: #888;
    }

    .form-control {
      padding-left: 2.2rem;
      border-radius: 10px;
    }

    .btn-primary {
      border-radius: 30px;
    }

    .form-check-label {
      font-size: 0.9rem;
    }

    .link-small {
      font-size: 0.85rem;
    }
  </style>
</head>
<body>
<div class="overlay">
  <div class="card login-card">
    <div class="card-header text-center login-header">
      <h4 class="mb-0"><i class="bi bi-shield-lock-fill"></i> Login Sistem Pakar</h4>
    </div>
    <div class="card-body">
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <?= $error ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="form-group position-relative">
          <i class="bi bi-person form-icon"></i>
          <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="form-group position-relative">
          <i class="bi bi-lock form-icon"></i>
          <input type="password" name="password" class="form-control" id="passwordField" placeholder="Password" required>
          <div class="form-check mt-2">
            <input type="checkbox" class="form-check-input" onclick="togglePassword()" id="showPassword">
            <label class="form-check-label" for="showPassword">Lihat Password</label>
          </div>
        </div>
        <button name="login" class="btn btn-primary btn-block">Masuk</button>
        <div class="text-center mt-3 link-small">
          <a href="daftar.php">Belum punya akun?</a> |
          <a href="index.php">Kembali</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="Assets/js/jquery-3.7.0.min.js"></script>
<script src="Assets/js/bootstrap.min.js"></script>
<script>
function togglePassword() {
  var pass = document.getElementById("passwordField");
  pass.type = pass.type === "password" ? "text" : "password";
}
</script>
</body>
</html>

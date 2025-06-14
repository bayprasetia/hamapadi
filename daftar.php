<?php
include "config.php";
session_start();

if (isset($_POST['daftar'])) {
  $username = trim($_POST['username']);
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = 'user'; // Paksa role jadi 'user' untuk semua pendaftaran

  // Cek username sudah ada atau belum
  $cek = $conn->prepare("SELECT * FROM user WHERE username = ?");
  $cek->bind_param("s", $username);
  $cek->execute();
  $hasil = $cek->get_result();

  if ($hasil->num_rows > 0) {
    $error = "Username sudah digunakan.";
  } else {
    $stmt = $conn->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $role);
    if ($stmt->execute()) {
      echo "<script>alert('Akun berhasil dibuat!'); window.location='login.php';</script>";
      exit;
    } else {
      $error = "Gagal mendaftar: " . $conn->error;
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Akun</title>
  <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow">
        <div class="card-header bg-success text-white text-center">
          <h4>Daftar Akun</h4>
        </div>
        <div class="card-body">
          <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <form method="POST">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>

            <!-- Hidden role input -->
            <input type="hidden" name="role" value="user">

            <button name="daftar" class="btn btn-success btn-block">Daftar</button>
            <div class="text-center mt-2">
              <a href="login.php">Sudah punya akun? Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>

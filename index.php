<?php
include 'config.php';
session_start();

// Cek login
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
  exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : "";
$action = isset($_GET['action']) ? $_GET['action'] : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Pakar Hama dan Penyakit Padi</title>
  <link rel="stylesheet" href="Assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="Assets/css/datatables.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">Sistem Pakar Padi</a>
    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($page=='')?'active':'' ?>" href="index.php">Beranda</a>
        </li>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='gejala')?'active':'' ?>" href="index.php?page=gejala">Gejala</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='penyakit')?'active':'' ?>" href="index.php?page=penyakit">Penyakit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='basispengetahuan')?'active':'' ?>" href="index.php?page=basispengetahuan">Basis Pengetahuan</a>
        </li>
        <?php endif; ?>
        <li class="nav-item">
          <a class="nav-link <?= ($page=='diagnosa')?'active':'' ?>" href="index.php?page=diagnosa">Diagnosa</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="logout.php" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
<?php
switch ($page) {
  case "gejala":
    if ($_SESSION['role'] == 'admin') {
      if ($action == "tambah") include "tambah_gejala.php";
      elseif ($action == "edit") include "edit_gejala.php";
      elseif ($action == "hapus") include "hapus_gejala.php";
      else include "daftargejala.php";
    } else {
      include "notfound.php";
    }
    break;

  case "penyakit":
    if ($_SESSION['role'] == 'admin') {
      if ($action == "tambah") include "tambah_penyakit.php";
      elseif ($action == "edit") include "editpenyakit.php";
      elseif ($action == "hapus") include "hapuspenyakit.php"; 
      elseif ($action == "hapus") include "hapuspenyakit.php";
      elseif ($action == "detail") include "detailpenyakit.php";
      else include "daftarpenyakit.php";
    } else {
      include "notfound.php";
    }
    break;

  case "basispengetahuan":
    if ($_SESSION['role'] == 'admin') {
      if ($action == "tambah") include "tambah_basispengetahuan.php";
      elseif ($action == "edit") include "edit_basispengetahuan.php";
      elseif ($action == "hapus") include "hapus_basispengetahuan.php";
      else include "basispengetahuan.php";
    } else {
      include "notfound.php";
    }
    break;
    

  case "diagnosa":
    if ($action == "hasil") include "hasildiagnosa.php";
    else include "diagnosa.php";
    break;

  case "solusi":
    if ($_SESSION['role'] == 'admin') {
      if ($action == "tambah") include "tambah_solusi.php";
      elseif ($action == "edit") include "edit_solusi.php";
      else include "solusi.php";
    } else {
      include "notfound.php";
    }
    break;

  case "":
    include "beranda.php";
    break;

  default:
    include "notfound.php";
    break;
}
?>
</div>

<script src="Assets/js/jquery-3.7.0.min.js"></script>
<script src="Assets/js/popper.min.js"></script>
<script src="Assets/js/bootstrap.min.js"></script>
<script src="Assets/js/datatables.min.js"></script>
<script>
$(document).ready(function() {
  $('#myTable').DataTable();
});
</script>
</body>
</html>

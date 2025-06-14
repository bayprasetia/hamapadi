<?php
include "config.php";

$id = $_GET['id'] ?? '';
if (!$id) {
  echo "<div class='alert alert-warning'>ID tidak ditemukan.</div>";
  return;
}

// Hapus aturan basis pengetahuan terlebih dahulu (jika ada)
$conn->query("DELETE FROM basis_pengetahuan WHERE idpenyakit = '$id'");

// Hapus penyakit
$hapus = $conn->query("DELETE FROM penyakit WHERE idpenyakit = '$id'");

if ($hapus) {
  echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=penyakit';</script>";
} else {
  echo "<div class='alert alert-danger'>Gagal menghapus data: {$conn->error}</div>";
}


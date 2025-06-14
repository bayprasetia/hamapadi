<?php
include "config.php";

// Fungsi hitung total data untuk statistik
function totalData($tabel) {
  global $conn;
  $q = mysqli_query($conn, "SELECT COUNT(*) as total FROM $tabel");
  $d = mysqli_fetch_assoc($q);
  return $d['total'];
}
?>

<!-- ✅ Tambahkan CSS Hover -->
<style>
.card.hover-card {
  transition: all 0.3s ease;
  border-radius: 10px;
  border: 1px solid #ddd;
  color: inherit;
  text-decoration: none;
}
.card.hover-card:hover {
  background-color: #eaf2ff;
  box-shadow: 0 8px 24px rgba(0, 123, 255, 0.1);
  transform: translateY(-6px);
  cursor: pointer;
}
</style>

<!-- ✅ Selamat Datang -->
<div class="text-end text-muted mb-2">
  Selamat datang, <strong><?= $_SESSION['username'] ?></strong> (<?= $_SESSION['role'] ?>)
</div>

<!-- ✅ Judul -->
<div class="text-center mt-4 mb-4">
  <h2 class="text-primary font-weight-bold">
    <i class="bi bi-flower3"></i> Sistem Pakar Padi
  </h2>
  <p class="text-muted">Deteksi dini hama dan penyakit tanaman padi secara cepat dan akurat.</p>
</div>

<!-- ✅ Statistik Cepat -->
<?php if ($_SESSION['role'] === 'admin'): ?>
<div class="row mb-4 justify-content-center text-center">
  <div class="col-auto">
    <span class="badge bg-primary">Gejala: <?= totalData("gejala") ?></span>
  </div>
  <div class="col-auto">
    <span class="badge bg-success">Penyakit: <?= totalData("penyakit") ?></span>
  </div>
  <div class="col-auto">
    <span class="badge bg-warning text-dark">Aturan: <?= totalData("basis_pengetahuan") ?></span>
  </div>
</div>
<?php endif; ?>

<!-- ✅ Kartu Menu -->
<div class="row row-cols-1 row-cols-md-4 g-4 text-center justify-content-center">
  <?php if ($_SESSION['role'] === 'admin'): ?>
    <div class="col">
      <a href="index.php?page=gejala" class="card hover-card h-100 border-primary text-decoration-none text-dark">
        <div class="card-body">
          <i class="bi bi-clipboard-data text-primary display-4 mb-3"></i>
          <h5 class="card-title">Gejala</h5>
          <p class="card-text text-muted">Lihat dan kelola daftar gejala.</p>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="index.php?page=penyakit" class="card hover-card h-100 border-success text-decoration-none text-dark">
        <div class="card-body">
          <i class="bi bi-bug text-success display-4 mb-3"></i>
          <h5 class="card-title">Penyakit</h5>
          <p class="card-text text-muted">Informasi penyakit yang teridentifikasi.</p>
        </div>
      </a>
    </div>

    <div class="col">
      <a href="index.php?page=basispengetahuan" class="card hover-card h-100 border-warning text-decoration-none text-dark">
        <div class="card-body">
          <i class="bi bi-lightbulb text-warning display-4 mb-3"></i>
          <h5 class="card-title">Aturan</h5>
          <p class="card-text text-muted">Relasi gejala ke penyakit.</p>
        </div>
      </a>
    </div>
  <?php endif; ?>

  <!-- ✅ Diagnosa selalu muncul -->
  <div class="col">
  <a href="index.php?page=diagnosa" class="card hover-card h-100 border-danger text-decoration-none text-dark">
      <div class="card-body">
        <i class="bi bi-heart-pulse-fill text-danger display-4 mb-3"></i>
        <h5 class="card-title fw-bold">Diagnosa</h5>
        <p class="card-text text-muted">Klik untuk memulai deteksi otomatis.</p>
      </div>
    </a>
  </div>
</div>


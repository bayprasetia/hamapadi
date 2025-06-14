<?php
if (!isset($_POST['gejala'])) {
  echo "<div class='alert alert-warning'>Silakan pilih gejala terlebih dahulu.</div>";
  exit;
}

include "config.php";

$selected = $_POST['gejala'];
$ids = "'" . implode("','", $selected) . "'";

// Ambil 1 hasil diagnosa teratas
$sql = "SELECT bp.idpenyakit, p.nmpenyakit, p.solusi, SUM(bp.bobot) as total_bobot
        FROM basis_pengetahuan bp
        JOIN penyakit p ON bp.idpenyakit = p.idpenyakit
        WHERE bp.idgejala IN ($ids)
        GROUP BY bp.idpenyakit
        ORDER BY total_bobot DESC
        LIMIT 1";
$result = $conn->query($sql);
?>

<!-- ✅ STYLE -->
<style>
.card.equal-height {
  height: 100%;
  min-height: 260px;
  display: flex;
  flex-direction: column;
  border-radius: 12px;
  border: 1px solid #e3e3e3;
  transition: all 0.3s ease;
}
.card.equal-height:hover {
  background-color: #f1f7ff;
  box-shadow: 0 8px 24px rgba(0, 123, 255, 0.15);
  transform: translateY(-4px);
  cursor: pointer;
}
.card-title {
  font-weight: 600;
}
</style>

<!-- ✅ HEADER -->
<div class="text-center mb-4">
  <h3 class="text-primary font-weight-bold"><i class="bi bi-clipboard-pulse"></i> Hasil Diagnosa</h3>
  <p class="text-muted">Berdasarkan gejala yang Anda pilih, berikut kemungkinan penyakit yang paling sesuai:</p>
</div>

<!-- ✅ HASIL -->
<?php if ($result->num_rows > 0): 
  $row = $result->fetch_assoc();
?>
  <div class="row row-cols-1 row-cols-md-3 justify-content-center">
    <div class="col mb-4 d-flex">
      <div class="card equal-height w-100">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title text-primary">
            <?= htmlspecialchars($row['nmpenyakit']) ?>
            <span class="badge badge-primary ml-1">Kemungkinan Terbesar</span>
          </h5>
          <p class="text-muted mb-2">Bobot Total:
            <span class="badge badge-info"><?= $row['total_bobot'] ?></span>
          </p>
          <div class="flex-grow-1">
            <p class="mb-0"><strong>Solusi:</strong><br>
            <?= nl2br(htmlspecialchars($row['solusi'])) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php else: ?>
  <div class="alert alert-danger text-center">
    <i class="bi bi-exclamation-triangle-fill"></i> Tidak ditemukan penyakit yang cocok dengan gejala yang dipilih.
  </div>
<?php endif; ?>

<!-- ✅ TOMBOL ULANGI -->
<div class="text-center mt-4">
  <a href="index.php?page=diagnosa" class="btn btn-outline-primary px-4">
    <i class="bi bi-arrow-clockwise"></i> Ulangi Diagnosa
  </a>
</div>

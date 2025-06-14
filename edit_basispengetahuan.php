<?php
include "config.php";

// Ambil ID penyakit
$idpenyakit = $_GET['id'] ?? '';
if (!$idpenyakit) {
  echo "<div class='alert alert-warning'>ID penyakit tidak ditemukan.</div>";
  return;
}

// Ambil data penyakit
$penyakit = $conn->query("SELECT * FROM penyakit WHERE idpenyakit = '$idpenyakit'")->fetch_assoc();
if (!$penyakit) {
  echo "<div class='alert alert-danger'>Data penyakit tidak ditemukan.</div>";
  return;
}

// Update jika disubmit
if (isset($_POST['update'])) {
  $conn->query("DELETE FROM basis_pengetahuan WHERE idpenyakit = '$idpenyakit'");

  $idgejalas = $_POST['idgejala'];
  $bobots = $_POST['bobot'];

  foreach ($idgejalas as $i => $idgejala) {
    $bobot = $bobots[$i];
    $stmt = $conn->prepare("INSERT INTO basis_pengetahuan (idpenyakit, idgejala, bobot) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $idpenyakit, $idgejala, $bobot);
    $stmt->execute();
  }

  echo "<script>alert('Aturan berhasil diperbarui'); window.location='index.php?page=basispengetahuan';</script>";
  exit;
}

// Ambil semua gejala
$gejala = $conn->query("SELECT * FROM gejala ORDER BY nmgejala ASC");

// Ambil gejala yang sudah terhubung
$relasi = $conn->query("SELECT * FROM basis_pengetahuan WHERE idpenyakit = '$idpenyakit'");
$terpilih = [];
while ($r = $relasi->fetch_assoc()) {
  $terpilih[$r['idgejala']] = $r['bobot'];
}
?>

<h4 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Aturan: <?= htmlspecialchars($penyakit['nmpenyakit']) ?></h4>

<form method="POST">
  <div class="table-responsive">
    <table class="table table-bordered">
      <thead class="thead-light">
        <tr>
          <th width="5%">#</th>
          <th>Gejala</th>
          <th width="20%">Pilih</th>
          <th width="15%">Bobot</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($g = $gejala->fetch_assoc()): 
          $idg = $g['idgejala'];
          $selected = array_key_exists($idg, $terpilih);
        ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($g['nmgejala']) ?></td>
          <td class="text-center">
            <input type="checkbox" name="idgejala[]" value="<?= $idg ?>" <?= $selected ? "checked" : "" ?>>
          </td>
          <td>
            <input type="number" step="0.1" name="bobot[]" class="form-control"
                   value="<?= $selected ? $terpilih[$idg] : '1' ?>">
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <button type="submit" name="update" class="btn btn-primary">
    <i class="bi bi-save"></i> Simpan Perubahan
  </button>
  <a href="index.php?page=basispengetahuan" class="btn btn-secondary">
    <i class="bi bi-arrow-left"></i> Kembali
  </a>
</form>

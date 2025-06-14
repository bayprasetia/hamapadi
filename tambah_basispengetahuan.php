<?php
include "config.php";

if (isset($_POST['simpan'])) {
  $idpenyakit = $_POST['idpenyakit'];
  $gejalas = $_POST['idgejala'];
  $bobot = $_POST['bobot'];
  $duplikat = 0;
  $berhasil = 0;

  foreach ($gejalas as $idgejala) {
    // Cek apakah sudah ada
    $cek = $conn->query("SELECT * FROM basis_pengetahuan WHERE idpenyakit='$idpenyakit' AND idgejala='$idgejala'");
    if ($cek->num_rows > 0) {
      $duplikat++;
      continue;
    }

    $stmt = $conn->prepare("INSERT INTO basis_pengetahuan (idpenyakit, idgejala, bobot) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $idpenyakit, $idgejala, $bobot);
    if ($stmt->execute()) {
      $berhasil++;
    }
  }

  echo "<script>alert('Berhasil menambahkan $berhasil aturan." . ($duplikat ? " $duplikat data duplikat diabaikan." : "") . "'); window.location='index.php?page=basispengetahuan';</script>";
}
?>

<h4 class="mb-4"><i class="bi bi-plus-circle"></i> Tambah Aturan Basis Pengetahuan</h4>
<form method="POST" class="mb-5">
  <div class="form-group mb-3">
    <label for="idpenyakit">Penyakit</label>
    <select name="idpenyakit" id="idpenyakit" class="form-control" required>
      <option value="">-- Pilih Penyakit --</option>
      <?php
      $penyakit = $conn->query("SELECT * FROM penyakit ORDER BY nmpenyakit ASC");
      while ($p = $penyakit->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($p['idpenyakit']) . "'>" . htmlspecialchars($p['nmpenyakit']) . "</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group mb-3">
    <label for="idgejala">Pilih Beberapa Gejala</label>
    <select name="idgejala[]" id="idgejala" class="form-control" multiple size="6" required>
      <?php
      $gejala = $conn->query("SELECT * FROM gejala ORDER BY nmgejala ASC");
      while ($g = $gejala->fetch_assoc()) {
        echo "<option value='" . htmlspecialchars($g['idgejala']) . "'>" . htmlspecialchars($g['nmgejala']) . "</option>";
      }
      ?>
    </select>
    <small class="form-text text-muted">Tekan <kbd>Ctrl</kbd> atau <kbd>Shift</kbd> untuk memilih lebih dari satu.</small>
  </div>

  <div class="form-group mb-4">
    <label for="bobot">Bobot</label>
    <input type="number" name="bobot" id="bobot" class="form-control" step="0.1" value="1" min="0.1" required>
  </div>

  <button class="btn btn-primary" name="simpan" type="submit">
    <i class="bi bi-save"></i> Simpan
  </button>
  <a href="index.php?page=basispengetahuan" class="btn btn-secondary">
    <i class="bi bi-arrow-left"></i> Batal
  </a>
</form>

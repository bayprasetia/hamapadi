<?php
if (isset($_POST['simpan'])) {
  $id = trim($_POST['idpenyakit']);
  $nama = trim($_POST['nmpenyakit']);
  $solusi = trim($_POST['solusi']);

  $cek = $conn->query("SELECT * FROM penyakit WHERE idpenyakit='$id'");
  if ($cek->num_rows > 0) {
    echo "<div class='alert alert-danger'>ID Penyakit sudah ada.</div>";
  } else {
    $simpan = $conn->prepare("INSERT INTO penyakit (idpenyakit, nmpenyakit, solusi) VALUES (?, ?, ?)");
    $simpan->bind_param("sss", $id, $nama, $solusi);
    $simpan->execute();
    echo "<script>alert('Data berhasil disimpan'); window.location='index.php?page=penyakit';</script>";
  }
}
?>

<h4>Tambah Penyakit</h4>
<form method="POST">
  <div class="form-group">
    <label>ID Penyakit</label>
    <input type="text" name="idpenyakit" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Nama Penyakit</label>
    <input type="text" name="nmpenyakit" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Solusi</label>
    <textarea name="solusi" class="form-control" required></textarea>
  </div>
  <button class="btn btn-primary" type="submit" name="simpan">Simpan</button>
  <a href="index.php?page=penyakit" class="btn btn-secondary">Batal</a>
</form>

<?php
include "config.php";

// Ambil data awal berdasarkan ID lama
$id_lama = $_GET['id'];
$data = $conn->query("SELECT * FROM gejala WHERE idgejala='$id_lama'")->fetch_assoc();

if (isset($_POST['update'])) {
  $id_baru = trim($_POST['idgejala']);
  $nmgejala = trim($_POST['nmgejala']);

  // Cek apakah ID baru sudah digunakan oleh gejala lain
  $cek = $conn->prepare("SELECT idgejala FROM gejala WHERE idgejala = ? AND idgejala != ?");
  $cek->bind_param("ss", $id_baru, $id_lama);
  $cek->execute();
  $cek_result = $cek->get_result();

  if ($cek_result->num_rows > 0) {
    echo "<div class='alert alert-danger'>ID Gejala baru sudah digunakan. Silakan gunakan ID lain.</div>";
  } else {
    // Lakukan update
    $update = $conn->prepare("UPDATE gejala SET idgejala=?, nmgejala=? WHERE idgejala=?");
    $update->bind_param("sss", $id_baru, $nmgejala, $id_lama);
    if ($update->execute()) {
      echo "<script>alert('Data berhasil diperbarui'); window.location='index.php?page=gejala';</script>";
    } else {
      echo "<div class='alert alert-danger'>Gagal memperbarui data: {$conn->error}</div>";
    }
  }
}
?>

<h4>Edit Gejala</h4>
<form method="POST">
  <div class="form-group">
    <label>ID Gejala</label>
    <input type="text" name="idgejala" class="form-control" value="<?= $data['idgejala'] ?>" required>
  </div>
  <div class="form-group">
    <label>Nama Gejala</label>
    <input type="text" name="nmgejala" class="form-control" value="<?= $data['nmgejala'] ?>" required>
  </div>
  <button type="submit" name="update" class="btn btn-success">Update</button>
  <a href="index.php?page=gejala" class="btn btn-secondary">Batal</a>
</form>

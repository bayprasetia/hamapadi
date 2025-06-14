<?php
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM penyakit WHERE idpenyakit='$id'")->fetch_assoc();

if (isset($_POST['update'])) {
  $nama = trim($_POST['nmpenyakit']);
  $solusi = trim($_POST['solusi']);

  $update = $conn->prepare("UPDATE penyakit SET nmpenyakit=?, solusi=? WHERE idpenyakit=?");
  $update->bind_param("sss", $nama, $solusi, $id);
  $update->execute();
  echo "<script>alert('Data diperbarui'); window.location='index.php?page=penyakit';</script>";
}
?>

<h4>Edit Penyakit</h4>
<form method="POST">
  <div class="form-group">
    <label>ID Penyakit</label>
    <input type="text" class="form-control" value="<?= $data['idpenyakit'] ?>" readonly>
  </div>
  <div class="form-group">
    <label>Nama Penyakit</label>
    <input type="text" name="nmpenyakit" class="form-control" value="<?= $data['nmpenyakit'] ?>" required>
  </div>
  <div class="form-group">
    <label>Solusi</label>
    <textarea name="solusi" class="form-control" required><?= $data['solusi'] ?></textarea>
  </div>
  <button type="submit" name="update" class="btn btn-success">Update</button>
  <a href="index.php?page=penyakit" class="btn btn-secondary">Batal</a>
</form>

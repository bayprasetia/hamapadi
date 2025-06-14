<?php
include 'config.php';

if (isset($_POST['simpan'])) {
  $idgejala = trim($_POST['idgejala']);
  $nmgejala = trim($_POST['nmgejala']);

  // Cek apakah data sudah ada
  $stmt = $conn->prepare("SELECT * FROM gejala WHERE idgejala = ?");
  $stmt->bind_param("s", $idgejala);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    echo '
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Kode Gejala sudah ada.</strong> Silakan gunakan kode lain.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    ';
  } else {
    // Simpan data dengan prepared statement
    $stmt_insert = $conn->prepare("INSERT INTO gejala (idgejala, nmgejala) VALUES (?, ?)");
    $stmt_insert->bind_param("ss", $idgejala, $nmgejala);
    
    if ($stmt_insert->execute()) {
      echo "<script>alert('Data berhasil disimpan!'); window.location='?page=gejala';</script>";
    } else {
      echo "<div class='alert alert-danger'>Gagal menyimpan data: " . $conn->error . "</div>";
    }

    $stmt_insert->close();
  }

  $stmt->close();
}
?>

<div class="row">
  <div class="col-sm-12">
    <form action="" method="POST">
      <div class="card border-dark">
        <div class="card-header bg-primary text-white border-dark">
          <strong>Tambah Gejala</strong>
        </div>
        <div class="card-body">

          <div class="form-group">
            <label for="idgejala">Id Gejala</label>
            <input type="text" class="form-control" name="idgejala" maxlength="10" required placeholder="Contoh: G39">
          </div>

          <div class="form-group">
            <label for="nmgejala">Nama Gejala</label>
            <input type="text" class="form-control" name="nmgejala" maxlength="200" required placeholder="Contoh: Daun menguning dan kering">
          </div>

          <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
          <a class="btn btn-danger" href="?page=gejala">Batal</a>

        </div>
      </div>
    </form>
  </div>
</div>

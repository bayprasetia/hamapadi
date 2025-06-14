<?php
include "config.php";

// Ambil daftar basis pengetahuan yang sudah dikelompokkan per penyakit
$sql = "SELECT 
          p.idpenyakit,
          p.nmpenyakit,
          GROUP_CONCAT(g.nmgejala ORDER BY g.idgejala SEPARATOR ', ') AS daftar_gejala,
          SUM(bp.bobot) AS total_bobot
        FROM basis_pengetahuan bp
        JOIN penyakit p ON bp.idpenyakit = p.idpenyakit
        JOIN gejala g ON bp.idgejala = g.idgejala
        GROUP BY p.idpenyakit
        ORDER BY p.idpenyakit ASC";
$result = $conn->query($sql);
?>

<a href="index.php?page=basispengetahuan&action=tambah" class="btn btn-success mb-3">
  <i class="bi bi-plus-circle"></i> Tambah Aturan
</a>

<table class="table table-bordered table-striped" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th>No</th>
      <th>Penyakit</th>
      <th>Gejala Terkait</th>
      <th>Total Bobot</th>
      <th width="160px">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['nmpenyakit']) ?></td>
      <td><?= htmlspecialchars($row['daftar_gejala']) ?></td>
      <td><?= htmlspecialchars($row['total_bobot']) ?></td>
      <td>
        <!-- Aksi: Edit semua aturan untuk penyakit ini -->
        <a href="index.php?page=basispengetahuan&action=edit&id=<?= $row['idpenyakit'] ?>" 
           class="btn btn-warning btn-sm" title="Edit Aturan">
           <i class="bi bi-pencil-square"></i>
        </a>

        <!-- Aksi: Hapus semua aturan untuk penyakit ini -->
        <a href="index.php?page=basispengetahuan&action=hapus&id=<?= $row['idpenyakit'] ?>" 
           class="btn btn-danger btn-sm" title="Hapus Semua Aturan"
           onclick="return confirm('Yakin ingin menghapus semua aturan untuk penyakit ini?')">
           <i class="bi bi-trash"></i>
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

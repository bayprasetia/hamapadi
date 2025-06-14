<?php
include "config.php";
$data = $conn->query("SELECT * FROM penyakit ORDER BY idpenyakit ASC");
?>

<a href="index.php?page=penyakit&action=tambah" class="btn btn-success mb-3">
  <i class="bi bi-plus-circle"></i> Tambah Penyakit
</a>

<table class="table table-bordered table-striped" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th>No</th>
      <th>ID Penyakit</th>
      <th>Nama Penyakit</th>
      <th>Solusi</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; while ($row = $data->fetch_assoc()) : ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['idpenyakit']) ?></td>
      <td><?= htmlspecialchars($row['nmpenyakit']) ?></td>
      <td><?= nl2br(htmlspecialchars($row['solusi'])) ?></td>
      <td>
        <a href="index.php?page=penyakit&action=edit&id=<?= $row['idpenyakit'] ?>" 
           class="btn btn-warning btn-sm" title="Edit">
           <i class="bi bi-pencil-square"></i>
        </a>
        <a href="index.php?page=penyakit&action=hapus&id=<?= $row['idpenyakit'] ?>" 
           class="btn btn-danger btn-sm" title="Hapus"
           onclick="return confirm('Yakin ingin menghapus data ini?')">
           <i class="bi bi-trash"></i>
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

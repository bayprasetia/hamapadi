<?php
include "config.php";
$data = $conn->query("SELECT * FROM gejala ORDER BY idgejala ASC");
?>

<a href="index.php?page=gejala&action=tambah" class="btn btn-success mb-3">
  <i class="bi bi-plus-circle"></i> Tambah Gejala
</a>

<table class="table table-bordered table-striped" id="myTable">
  <thead class="thead-dark">
    <tr>
      <th>No</th>
      <th>ID Gejala</th>
      <th>Nama Gejala</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $no = 1; while ($row = $data->fetch_assoc()) : ?>
    <tr>
      <td><?= $no++ ?></td>
      <td><?= htmlspecialchars($row['idgejala']) ?></td>
      <td><?= htmlspecialchars($row['nmgejala']) ?></td>
      <td>
        <a href="index.php?page=gejala&action=edit&id=<?= $row['idgejala'] ?>" 
           class="btn btn-warning btn-sm" title="Edit">
           <i class="bi bi-pencil-square"></i>
        </a>
        <a href="index.php?page=gejala&action=hapus&id=<?= $row['idgejala'] ?>" 
           class="btn btn-danger btn-sm" title="Hapus"
           onclick="return confirm('Yakin ingin menghapus data ini?')">
           <i class="bi bi-trash"></i>
        </a>
      </td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

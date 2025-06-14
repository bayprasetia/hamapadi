<?php
$id = $_GET['id'];
$conn->query("DELETE FROM basis_pengetahuan WHERE id=$id");
echo "<script>alert('Aturan dihapus'); window.location='index.php?page=basispengetahuan';</script>";

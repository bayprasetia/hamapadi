<?php
include "config.php";
$id = $_GET['id'];
$conn->query("DELETE FROM gejala WHERE idgejala='$id'");
echo "<script>alert('Data berhasil dihapus'); window.location='index.php?page=gejala';</script>";
?>

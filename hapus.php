<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: index.php"); exit; }
include 'koneksi.php'; 

$id = mysqli_real_escape_string($koneksi, $_GET['id']); // [cite: 168]

mysqli_query($koneksi, "DELETE FROM perfumes WHERE id_perfume = '$id'"); // [cite: 169]

header("Location: index.php"); 
exit;
?>
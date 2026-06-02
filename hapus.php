<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: index.php"); exit; }
include 'koneksi.php'; 

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

$query = mysqli_query($koneksi, "SELECT image_url FROM perfumes WHERE id_perfume = '$id'");
$data = mysqli_fetch_array($query);

if ($data) {
    $image_path = $data['image_url'];
    if (file_exists($image_path) && strpos($image_path, 'http') === false) {
        unlink($image_path);
    }
}

mysqli_query($koneksi, "DELETE FROM perfumes WHERE id_perfume = '$id'");

header("Location: index.php"); 
exit;
?>

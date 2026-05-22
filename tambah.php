<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: index.php"); exit; }
include 'koneksi.php';

if (isset($_POST['submit'])) {
    $fragella_id = mysqli_real_escape_string($koneksi, $_POST['fragella_id']);
    $name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $brand = mysqli_real_escape_string($koneksi, $_POST['brand']);
    $id_category = mysqli_real_escape_string($koneksi, $_POST['id_category']);
    $price = mysqli_real_escape_string($koneksi, $_POST['price']);
    $main_notes = mysqli_real_escape_string($koneksi, $_POST['main_notes']);
    $image_url = mysqli_real_escape_string($koneksi, $_POST['image_url']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);

    $insert = "INSERT INTO perfumes (fragella_id, name, brand, id_category, price, main_notes, image_url, description) 
               VALUES ('$fragella_id', '$name', '$brand', '$id_category', '$price', '$main_notes', '$image_url', '$description')";
    
    if (mysqli_query($koneksi, $insert)) {
        echo "<script>alert('Masterpiece successfully catalogued!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Failed to catalogue data.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Add Masterpiece</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container my-5" style="max-width: 700px;">
        <div class="perfume-card p-4 p-md-5">
            <h2 class="text-gold text-center mb-4 font-serif">Catalogue New Fragrance</h2>
            <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Fragella API Reference ID</label>
                        <input type="text" name="fragella_id" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. frag-999">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Brand Name</label>
                        <input type="text" name="brand" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Creed, Tom Ford">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small">Fragrance Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Olfactory Category</label>
                        <select name="id_category" class="form-select bg-dark text-white border-secondary" required>
                            <?php 
                            $cats = mysqli_query($koneksi, "SELECT * FROM categories");
                            while($c = mysqli_fetch_array($cats)) { echo "<option value='".$c['id_category']."'>".$c['category_name']."</option>"; }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Price (IDR)</label>
                        <input type="number" name="price" class="form-control bg-dark text-white border-secondary" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small">Main Aromas / Notes</label>
                        <input type="text" name="main_notes" class="form-control bg-dark text-white border-secondary" placeholder="e.g. Oud, Leather, Raspberry" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small">Image URL Location</label>
                        <input type="url" name="image_url" class="form-control bg-dark text-white border-secondary" placeholder="https://example.com/image.jpg" required>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label text-muted small">Detailed Composition Summary</label>
                        <textarea name="description" rows="4" class="form-control bg-dark text-white border-secondary" required></textarea>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" name="submit" class="btn btn-gold w-100 py-2">Save to Database</button>
                    <a href="index.php" class="btn btn-outline-light w-100 py-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
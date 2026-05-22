<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') { header("Location: index.php"); exit; }
include 'koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']); 
$query = mysqli_query($koneksi, "SELECT * FROM perfumes WHERE id_perfume = '$id'"); 
$data = mysqli_fetch_array($query); 

if (isset($_POST['update'])) { 
    $name = mysqli_real_escape_string($koneksi, $_POST['name']); 
    $brand = mysqli_real_escape_string($koneksi, $_POST['brand']);
    $id_category = mysqli_real_escape_string($koneksi, $_POST['id_category']);
    $price = mysqli_real_escape_string($koneksi, $_POST['price']);
    $main_notes = mysqli_real_escape_string($koneksi, $_POST['main_notes']);
    $image_url = mysqli_real_escape_string($koneksi, $_POST['image_url']);
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);

    $update_query = "UPDATE perfumes SET 
                        name='$name', brand='$brand', id_category='$id_category', 
                        price='$price', main_notes='$main_notes', image_url='$image_url', description='$description' 
                     WHERE id_perfume='$id'"; 
                     
    if (mysqli_query($koneksi, $update_query)) {
        echo "<script>alert('Update success!'); window.location='index.php';</script>"; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Edit Scent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container my-5" style="max-width: 700px;">
        <div class="perfume-card p-4 p-md-5">
            <h2 class="text-gold text-center mb-4 font-serif">Modify Masterpiece Specifications</h2>
            <form action="" method="POST">
                <div class="row g-3">
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Brand Name</label>
                        <input type="text" name="brand" class="form-control bg-dark text-white border-secondary" value="<?= $data['brand']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Fragrance Name</label>
                        <input type="text" name="name" class="form-control bg-dark text-white border-secondary" value="<?= $data['name']; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Olfactory Category</label>
                        <select name="id_category" class="form-select bg-dark text-white border-secondary" required>
                            <?php 
                            $cats = mysqli_query($koneksi, "SELECT * FROM categories");
                            while($c = mysqli_fetch_array($cats)) {
                                $sel = ($c['id_category'] == $data['id_category']) ? "selected" : "";
                                echo "<option value='".$c['id_category']."' $sel>".$c['category_name']."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label text-muted small">Price (IDR)</label>
                        <input type="number" name="price" class="form-control bg-dark text-white border-secondary" value="<?= $data['price']; ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label text-muted small">Main Aromas / Notes</label>
                        <input type="text" name="main_notes" class="form-control bg-dark text-white border-secondary" value="<?= $data['main_notes']; ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label text-muted small">Image URL Location</label>
                        <input type="url" name="image_url" class="form-control bg-dark text-white border-secondary" value="<?= $data['image_url']; ?>" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label text-muted small">Detailed Composition Summary</label>
                        <textarea name="description" rows="4" class="form-control bg-dark text-white border-secondary" required><?= $data['description']; ?></textarea>
                    </div>
                </div>
                <div class="mt-4 d-flex gap-2">
                    <button type="submit" name="update" class="btn btn-gold w-100 py-2">Apply Modifications</button>
                    <a href="index.php" class="btn btn-outline-light w-100 py-2">Discard Changes</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
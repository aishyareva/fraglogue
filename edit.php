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
    $description = mysqli_real_escape_string($koneksi, $_POST['description']);
    $old_image = mysqli_real_escape_string($koneksi, $_POST['old_image']);
    
    $image_url = $old_image;
    $is_new_image_set = false;

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image_file']['tmp_name'];
        $file_name = $_FILES['image_file']['name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        $allowed_ext = ['jpg', 'jpeg', 'png'];
        if (in_array($file_ext, $allowed_ext)) {
            $new_file_name = uniqid('frag_') . '.' . $file_ext;
            $target_dir = "assets/img/";
            if (!is_dir($target_dir)) { mkdir($target_dir, 0777, true); }
            
            $image_url = $target_dir . $new_file_name;
            move_uploaded_file($file_tmp, $image_url);
            $is_new_image_set = true;
        } else {
            echo "<script>alert('Hanya file JPG/PNG yang diperbolehkan!'); window.history.back();</script>";
            exit;
        }
    } 
    elseif (!empty($_POST['image_url_link'])) {
        $image_url = mysqli_real_escape_string($koneksi, $_POST['image_url_link']);
        $is_new_image_set = true;
    }

    if ($is_new_image_set && file_exists($old_image) && strpos($old_image, 'http') === false) {
        unlink($old_image);
    }

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
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="old_image" value="<?= $data['image_url']; ?>">
                
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
                        <div class="p-3 border border-secondary rounded bg-dark">
                            <label class="form-label text-gold fw-bold small mb-3">Update Image Representation (Leave blank to keep current)</label>
                            
                            <div class="mb-3">
                                <label class="form-label text-muted small">Option A: Upload New Local Image</label>
                                <input type="file" name="image_file" class="form-control bg-dark text-white border-secondary" accept=".jpg,.jpeg,.png">
                            </div>
                            
                            <div class="text-center text-muted small mb-3 fw-bold">--- OR ---</div>
                            
                            <div class="mb-3">
                                <label class="form-label text-muted small">Option B: Use New External URL</label>
                                <input type="url" name="image_url_link" class="form-control bg-dark text-white border-secondary" placeholder="https://example.com/new-image.jpg">
                            </div>

                            <div class="mt-4 text-center bg-black rounded p-2 border border-secondary d-flex flex-column align-items-center">
                                <span class="text-secondary small mb-2">Current Image:</span>
                                <img src="<?= $data['image_url']; ?>" alt="Current Image" style="height: 120px; object-fit: contain;">
                            </div>
                        </div>
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

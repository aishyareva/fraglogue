<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

$id_user = $_SESSION['id_user'];

if (isset($_GET['remove'])) {
    $id_fav = mysqli_real_escape_string($koneksi, $_GET['remove']);
    mysqli_query($koneksi, "DELETE FROM favorites WHERE id_favorite = '$id_fav' AND id_user = '$id_user'");
    header("Location: favorit.php");
    exit;
}

$query = mysqli_query($koneksi, "SELECT f.id_favorite, p.*, c.category_name FROM favorites f 
          JOIN perfumes p ON f.id_perfume = p.id_perfume 
          JOIN categories c ON p.id_category = c.id_category 
          WHERE f.id_user = '$id_user'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - My Exquisite Favorites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-luxury py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE</a>
            <a href="index.php" class="btn btn-sm btn-outline-light">Back to Archive</a>
        </div>
    </nav>

    <div class="container my-5">
        <h1 class="text-gold mb-2 font-serif text-center">My Private Collection</h1>
        <p class="text-center text-muted small mb-5">Your carefully curated personal olfactory preferences.</p>

        <div class="row g-4">
            <?php if(mysqli_num_rows($query) == 0): ?>
                <div class="col-12 text-center text-muted my-5">Your private vault is empty. Browse the archive to add favorites.</div>
            <?php else: ?>
                <?php while($data = mysqli_fetch_array($query)): ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="perfume-card h-100 d-flex flex-column">
                            <div class="perfume-img-container">
                                <img src="<?= $data['image_url']; ?>" class="perfume-img">
                            </div>
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <span class="text-gold small text-uppercase tracking-wider fw-semibold"><?= $data['brand']; ?></span>
                                <h3 class="h6 my-1 text-white"><?= $data['name']; ?></h3>
                                <p class="text-gold fw-bold small mb-3">IDR <?= number_format($data['price'], 0, ',', '.'); ?></p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <a href="detail.php?id=<?= $data['id_perfume']; ?>" class="btn btn-sm btn-outline-gold btn-sm py-1">View</a>
                                    <a href="favorit.php?remove=<?= $data['id_favorite']; ?>" class="text-danger text-decoration-none small" onclick="return confirm('Remove from favorites?')">Remove</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
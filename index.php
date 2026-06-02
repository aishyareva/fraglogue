<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($koneksi, $_GET['search']) : "";
$category_filter = isset($_GET['category']) ? mysqli_real_escape_string($koneksi, $_GET['category']) : "";

$where_clauses = [];
if ($search != "") {
    $where_clauses[] = "(p.name LIKE '%$search%' OR p.brand LIKE '%$search%' OR p.main_notes LIKE '%$search%')";
}
if ($category_filter != "") {
    $where_clauses[] = "p.id_category = '$category_filter'";
}

$query_str = "SELECT p.*, c.category_name FROM perfumes p 
              LEFT JOIN categories c ON p.id_category = c.id_category";
if (count($where_clauses) > 0) {
    $query_str .= " WHERE " . implode(' AND ', $where_clauses);
}

$query = mysqli_query($koneksi, $query_str);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fraglogue - Luxury Perfume Archive</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE</a>
            <button class="navbar-toggler text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
    <li class="nav-item"><a class="nav-link px-3 fw-medium" href="index.php">Archive</a></li>
    <li class="nav-item"><a class="nav-link px-3 fw-medium" href="favorit.php">My Favorites</a></li>
    
    <li class="nav-item"><a class="nav-link px-3 fw-medium text-dark" href="keranjang.php">My Cart</a></li>
    
    <?php if ($_SESSION['role'] === 'admin'): ?>
        <li class="nav-item"><a class="nav-link px-3 fw-bold text-gold" href="dashboard_admin.php">Admin Dashboard</a></li>
    <?php endif; ?>
    
    <li class="nav-item text-muted px-3 small">Hi, <strong><?= htmlspecialchars($_SESSION['username']); ?></strong></li>
    <li class="nav-item"><a class="btn btn-sm btn-outline-gold ms-2" href="logout.php">Logout</a></li>
</ul>
            </div>
        </div>
    </nav>

    <div class="container my-5 text-center">
        <h1 class="display-4 text-gold mb-3 fw-bold">The Luxury Scent Archive</h1>
        <p class="text-muted mx-auto mb-4" style="max-width: 600px;">Explore high-end olfactory creations, track your ultimate favorites, and find your next signature masterpiece.</p>
        
        <form action="" method="GET" class="mx-auto" style="max-width: 650px;">
            <div class="input-group shadow-sm mb-3">
                <input type="text" name="search" class="form-control py-2" placeholder="Search brands, names, or notes..." value="<?= htmlspecialchars($search); ?>">
                <button class="btn btn-gold px-4" type="submit">Search</button>
            </div>
            
            <div class="d-flex align-items-center justify-content-center gap-2 bg-white p-2 rounded border border-light shadow-sm">
                <span class="small text-muted fw-medium me-2">Filter Category:</span>
                <a href="index.php?search=<?= urlencode($search); ?>" class="btn btn-sm <?= $category_filter == '' ? 'btn-gold' : 'btn-outline-gold' ?> py-1 px-3 rounded-pill small">All Scents</a>
                
                <?php 
                $cat_query = mysqli_query($koneksi, "SELECT * FROM categories");
                while($cat = mysqli_fetch_array($cat_query)):
                ?>
                    <a href="index.php?search=<?= urlencode($search); ?>&category=<?= $cat['id_category']; ?>" 
                       class="btn btn-sm <?= $category_filter == $cat['id_category'] ? 'btn-gold' : 'btn-outline-gold' ?> py-1 px-3 rounded-pill small">
                        <?= $cat['category_name']; ?>
                    </a>
                <?php endwhile; ?>
            </div>
        </form>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="text-end mt-4">
                <a href="tambah.php" class="btn btn-gold px-4 shadow-sm">+ Add New Masterpiece</a>
            </div>
        <?php endif; ?>
    </div>

    <div class="container mb-5">
        <div class="row g-4">
            <?php if (mysqli_num_rows($query) == 0): ?>
                <div class="col-12 text-center text-muted my-5 bg-white p-5 rounded border shadow-sm">
                    <p class="mb-0">No luxury fragrances found matching your archive filter criteria.</p>
                </div>
            <?php else: ?>
                <?php while($data = mysqli_fetch_array($query)): ?>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="perfume-card h-100 d-flex flex-column">
                            <div class="perfume-img-container">
                                <img src="<?= $data['image_url']; ?>" class="perfume-img" alt="<?= htmlspecialchars($data['name']); ?>">
                            </div>
                            <div class="p-3 d-flex flex-column flex-grow-1">
                                <span class="text-gold small text-uppercase tracking-wider fw-semibold"><?= htmlspecialchars($data['brand']); ?></span>
                                <h3 class="h6 my-1 fw-bold text-dark"><?= htmlspecialchars($data['name']); ?></h3>
                                <p class="text-muted small mb-2" style="font-size: 0.8rem;"><em>Category: <?= htmlspecialchars($data['category_name']); ?></em></p>
                                <p class="text-gold fw-bold mb-3">IDR <?= number_format($data['price'], 0, ',', '.'); ?></p>
                                
                                <div class="mt-auto d-flex justify-content-between align-items-center pt-2 border-top border-light">
                                    <a href="detail.php?id=<?= $data['id_perfume']; ?>" class="btn btn-sm btn-outline-gold px-3">Details</a>
                                    
                                    <?php if ($_SESSION['role'] === 'admin'): ?>
                                        <div>
                                            <a href="edit.php?id=<?= $data['id_perfume']; ?>" class="text-warning me-2 text-decoration-none small fw-medium">Edit</a>
                                            <a href="hapus.php?id=<?= $data['id_perfume']; ?>" class="text-danger text-decoration-none small fw-medium" onclick="return confirm('Archive data ini?')">Delete</a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

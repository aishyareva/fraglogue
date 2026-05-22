<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: index.php");
    exit;
}
include 'koneksi.php';

$stat_perfumes = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM perfumes"));
$stat_users    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM users"));
$stat_reviews  = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM reviews"));
$stat_avg_price = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT AVG(price) as rata_rata FROM perfumes"));

$user_query = mysqli_query($koneksi, "SELECT id_user, username, role, created_at FROM users ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Executive Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE <span class="small fw-light text-muted">| Admin Control</span></a>
            <a href="index.php" class="btn btn-sm btn-outline-gold">Back to Catalog</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="mb-5">
            <h1 class="text-dark fw-bold mb-1 font-serif">Executive Overview</h1>
            <p class="text-muted small">Real-time database insights and user credential archives.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="perfume-card p-4 text-center bg-white shadow-sm">
                    <h6 class="text-muted text-uppercase small tracking-wider mb-2">Total Masterpieces</h6>
                    <h2 class="display-5 fw-bold text-gold mb-0"><?= $stat_perfumes['total']; ?></h2>
                    <span class="small text-secondary">Fragrances Catalogued</span>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="perfume-card p-4 text-center bg-white shadow-sm">
                    <h6 class="text-muted text-uppercase small tracking-wider mb-2">Registered Accounts</h6>
                    <h2 class="display-5 fw-bold text-gold mb-0"><?= $stat_users['total']; ?></h2>
                    <span class="small text-secondary">Active Users & Admins</span>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="perfume-card p-4 text-center bg-white shadow-sm">
                    <h6 class="text-muted text-uppercase small tracking-wider mb-2">Total Evaluations</h6>
                    <h2 class="display-5 fw-bold text-gold mb-0"><?= $stat_reviews['total']; ?></h2>
                    <span class="small text-secondary">User Written Reviews</span>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="perfume-card p-4 text-center bg-white shadow-sm h-100 d-flex flex-column justify-content-between">
                    <h6 class="text-muted text-uppercase small tracking-wider mb-2">Average Valuation</h6>
                    <h2 class="fs-2 fw-bold text-gold mb-0 py-1">IDR <?= number_format($stat_avg_price['rata_rata'], 0, ',', '.'); ?></h2>
                    <span class="small text-secondary d-block mt-2">Scent Unit Retail Value</span>
                </div>
            </div>
        </div>

        <div class="perfume-card p-4 bg-white shadow-sm rounded-4">
            <h3 class="h4 text-dark fw-bold mb-3 font-serif">User Management Log</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-muted small">
                            <th class="py-3 px-4">User ID</th>
                            <th class="py-3">Username Account</th>
                            <th class="py-3">Access Level Privilege</th>
                            <th class="py-3 px-4 text-end">Creation Date Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php while($user = mysqli_fetch_array($user_query)): ?>
                            <tr>
                                <td class="py-3 px-4 text-secondary font-monospace">#USR-<?= sprintf("%03d", $user['id_user']); ?></td>
                                <td class="py-3 fw-bold text-dark"><?= htmlspecialchars($user['username']); ?></td>
                                <td class="py-3">
                                    <span class="badge px-3 py-1 rounded-pill <?= $user['role'] === 'admin' ? 'bg-danger-subtle text-danger' : 'bg-success-subtle text-success' ?>">
                                        <?= strtoupper($user['role']); ?>
                                    </span>
                                </td>
                                <td class="py-3 px-4 text-end text-muted"><?= date('d M Y, H:i', strtotime($user['created_at'])); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

$id_user = $_SESSION['id_user'];

$order_query = mysqli_query($koneksi, "SELECT o.*, GROUP_CONCAT(CONCAT(p.name, ' (', oi.quantity, 'x)') SEPARATOR ', ') as item_list 
                                      FROM orders o 
                                      JOIN order_items oi ON o.id_order = oi.id_order
                                      JOIN perfumes p ON oi.id_perfume = p.id_perfume
                                      WHERE o.id_user = '$id_user'
                                      GROUP BY o.id_order
                                      ORDER BY o.order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - My Luxury Orders</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE</a>
            <a href="index.php" class="btn btn-sm btn-outline-gold">Back to Vault</a>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 800px;">
        <h1 class="text-dark fw-bold mb-1 font-serif text-center">Purchase History</h1>
        <p class="text-center text-muted small mb-5">Track and review your exquisite collection procurement log.</p>

        <div class="perfume-card p-4 bg-white shadow-sm rounded-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr class="text-muted small">
                            <th class="py-3 px-3">Invoice ID</th>
                            <th class="py-3">Purchased Masterpieces</th>
                            <th class="py-3">Amount Statement</th>
                            <th class="py-3 text-end px-3">Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <?php if(mysqli_num_rows($order_query) == 0): ?>
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">You haven't initiated any secure purchases yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php while($ord = mysqli_fetch_array($order_query)): ?>
                                <tr>
                                    <td class="py-3 px-3 text-secondary font-monospace fw-bold">#INV-<?= sprintf("%04d", $ord['id_order']); ?></td>
                                    <td class="py-3 text-dark text-wrap" style="max-width: 300px;"><?= htmlspecialchars($ord['item_list']); ?></td>
                                    <td class="py-3 text-gold fw-bold">IDR <?= number_format($ord['total_price'], 0, ',', '.'); ?></td>
                                    <td class="py-3 text-end text-muted px-3"><?= date('d M Y, H:i', strtotime($ord['order_date'])); ?></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
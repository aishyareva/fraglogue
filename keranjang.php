<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'koneksi.php';

$id_user = $_SESSION['id_user'];

if (isset($_GET['remove'])) {
    $id_cart = mysqli_real_escape_string($koneksi, $_GET['remove']);
    mysqli_query($koneksi, "DELETE FROM cart WHERE id_cart = '$id_cart' AND id_user = '$id_user'");
    header("Location: keranjang.php");
    exit;
}

if (isset($_POST['checkout'])) {
    $total_price = $_POST['total_price'];
    
    if ($total_price > 0) {
        $cart_items = mysqli_query($koneksi, "SELECT c.*, p.price FROM cart c JOIN perfumes p ON c.id_perfume = p.id_perfume WHERE c.id_user = '$id_user'");
        
        if (mysqli_num_rows($cart_items) > 0) {
            mysqli_query($koneksi, "INSERT INTO orders (id_user, total_price) VALUES ('$id_user', '$total_price')");
            $id_order = mysqli_insert_id($koneksi); 
            
            while ($item = mysqli_fetch_array($cart_items)) {
                $id_perfume = $item['id_perfume'];
                $quantity = $item['quantity'];
                $price_at_purchase = $item['price'];
                
                mysqli_query($koneksi, "INSERT INTO order_items (id_order, id_perfume, quantity, price_at_purchase) 
                                       VALUES ('$id_order', '$id_perfume', '$quantity', '$price_at_purchase')");
            }
            
            mysqli_query($koneksi, "DELETE FROM cart WHERE id_user = '$id_user'");
            
            echo "<script>alert('Thank you for your exquisite purchase! Order confirmed.'); window.location='pesanan.php';</script>";
            exit;
        }
    }
}

$query = mysqli_query($koneksi, "SELECT c.id_cart, c.quantity, p.* FROM cart c 
                                JOIN perfumes p ON c.id_perfume = p.id_perfume 
                                WHERE c.id_user = '$id_user'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE</a>
            <div>
                <a href="index.php" class="btn btn-sm btn-outline-gold me-2">Continue Browsing</a>
                <a href="pesanan.php" class="btn btn-sm btn-outline-secondary">My Orders</a>
            </div>
        </div>
    </nav>

    <div class="container my-5" style="max-width: 900px;">
        <h1 class="text-dark fw-bold mb-1 font-serif text-center">Your Shopping Cart</h1>
        <p class="text-center text-muted small mb-5">Review your luxury choices before securing your order confirmation.</p>

        <div class="row g-4">
            <div class="col-12 col-lg-8">
                <?php 
                $grand_total = 0;
                if(mysqli_num_rows($query) == 0): 
                ?>
                    <div class="perfume-card p-5 text-center bg-white shadow-sm">
                        <p class="text-muted mb-0">Your shopping cart feels light. Let's add some masterpieces!</p>
                    </div>
                <?php else: ?>
                    <?php while($data = mysqli_fetch_array($query)): 
                        $subtotal = $data['price'] * $data['quantity'];
                        $grand_total += $subtotal;
                    ?>
                        <div class="perfume-card p-3 mb-3 bg-white shadow-sm d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="<?= $data['image_url']; ?>" style="width:70px; height:70px; object-fit:contain;" class="rounded me-3 p-1 border bg-light">
                                <div>
                                    <h6 class="mb-0 text-dark fw-bold"><?= htmlspecialchars($data['name']); ?></h6>
                                    <span class="text-gold small d-block"><?= htmlspecialchars($data['brand']); ?></span>
                                    <span class="text-secondary small">Qty: <?= $data['quantity']; ?> x IDR <?= number_format($data['price'], 0, ',', '.'); ?></span>
                                </div>
                            </div>
                            <div class="text-end">
                                <p class="text-dark fw-bold mb-1 small">IDR <?= number_format($subtotal, 0, ',', '.'); ?></p>
                                <a href="clear_cart_item_or_similar_logic_url=?" class="text-danger small text-decoration-none" 
                                   onclick="if(confirm('Remove item?')) { window.location='keranjang.php?remove=<?= $data['id_cart']; ?>'; }; return false;">Remove</a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>

            <div class="col-12 col-lg-4">
                <div class="perfume-card p-4 bg-white shadow-sm rounded-4">
                    <h4 class="text-dark h5 fw-bold mb-3 font-serif">Order Summary</h4>
                    <div class="d-flex justify-content-between mb-2 small text-secondary">
                        <span>Total Items Value:</span>
                        <span>IDR <?= number_format($grand_total, 0, ',', '.'); ?></span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 pb-2 border-bottom small text-secondary">
                        <span>Shipping Courier:</span>
                        <span class="text-success fw-medium">Free Boutique Delivery</span>
                    </div>
                    <div class="d-flex justify-content-between mb-4 align-items-center">
                        <strong class="text-dark">Grand Total:</strong>
                        <strong class="text-gold h5 mb-0">IDR <?= number_format($grand_total, 0, ',', '.'); ?></strong>
                    </div>
                    
                    <form action="" method="POST">
                        <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
                        <button type="submit" name="checkout" class="btn btn-gold w-100 py-2.5 shadow-sm" <?= $grand_total == 0 ? 'disabled' : ''; ?>>
                            Proceed to Secure Checkout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
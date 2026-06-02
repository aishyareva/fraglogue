<?php
session_start();
if (isset($_SESSION['login'])) {
    header("Location: hero.php");
    exit;
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fraglogue - Discover Luxury Scents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .section-padding {
            padding-top: 6rem;
            padding-bottom: 6rem;
        }
        .feature-icon {
            font-size: 2.5rem;
            color: var(--luxury-gold);
            margin-bottom: 1.2rem;
        }
    </style>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold fs-4" href="home.php">FRAGLOGUE</a>
            <button class="navbar-toggler text-dark border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavPublic">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavPublic">
                <div class="d-flex ms-auto gap-3 align-items-center mt-3 mt-lg-0">
                    <a href="login.php" class="text-dark text-decoration-none fw-medium small text-uppercase tracking-wider">Sign In</a>
                    <a href="register.php" class="btn btn-sm btn-gold px-4 py-2 fw-medium">Create Account</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="container text-center section-padding">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <span class="text-gold text-uppercase tracking-wider fw-bold small mb-3 d-block" style="letter-spacing: 3px;">Welcome to the Archive</span>
                <h1 class="display-3 text-dark fw-bold mb-4 font-serif" style="line-height: 1.2;">Discover Your Next <br><span class="text-gold">Signature Masterpiece</span></h1>
                <p class="text-muted mx-auto mb-5" style="max-width: 600px; font-size: 1.1rem;">
                    Jelajahi arsip eksklusif wewangian mewah dunia. Temukan, simpan, dan tuliskan impresi olfaktori Anda dalam satu arsip digital yang elegan.
                </p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="register.php" class="btn btn-gold px-5 py-3 rounded-pill shadow-sm fw-medium fs-5">Begin Your Journey</a>
                    <a href="login.php" class="btn btn-outline-gold px-5 py-3 rounded-pill shadow-sm fw-medium fs-5 bg-white">Access Vault</a>
                </div>
            </div>
        </div>
    </section>

    <section class="container mb-5">
        <div class="row g-4 text-center">
            <div class="col-12 col-md-4">
                <div class="perfume-card p-5 h-100 d-flex flex-column justify-content-center">
                    <h3 class="h5 text-dark fw-bold font-serif mb-3">Exclusive Catalog</h3>
                    <p class="text-muted small mb-0 lh-lg">Akses ratusan mahakarya parfum dari rumah mode desainer dan niche perfumery terbaik di seluruh dunia.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="perfume-card p-5 h-100 d-flex flex-column justify-content-center">
                    <h3 class="h5 text-dark fw-bold font-serif mb-3">Private Vault</h3>
                    <p class="text-muted small mb-0 lh-lg">Simpan wewangian favorit Anda dan bangun koleksi digital pribadi layaknya seorang kurator mahakarya.</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="perfume-card p-5 h-100 d-flex flex-column justify-content-center">
                    <h3 class="h5 text-dark fw-bold font-serif mb-3">Sensory Reviews</h3>
                    <p class="text-muted small mb-0 lh-lg">Tulis dan baca evaluasi mendalam mengenai transisi notes, sillage, dan longevity dari para penikmat aroma.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container section-padding border-top border-light">
        <div class="text-center mb-5">
            <h2 class="text-dark fw-bold font-serif">A Glimpse of the Archive</h2>
            <p class="text-muted small">Beberapa mahakarya pilihan dari koleksi eksklusif kami.</p>
        </div>
        
        <div class="row g-4 justify-content-center">
            <?php 
            $preview_query = mysqli_query($koneksi, "SELECT p.*, c.category_name FROM perfumes p LEFT JOIN categories c ON p.id_category = c.id_category ORDER BY RAND() LIMIT 3");
            
            if ($preview_query && mysqli_num_rows($preview_query) > 0):
                while($data = mysqli_fetch_array($preview_query)): 
            ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="perfume-card h-100 d-flex flex-column">
                        <div class="perfume-img-container" style="height: 220px;">
                            <img src="<?= htmlspecialchars($data['image_url']); ?>" class="perfume-img" alt="<?= htmlspecialchars($data['name']); ?>">
                        </div>
                        <div class="p-4 text-center d-flex flex-column flex-grow-1">
                            <span class="text-gold small text-uppercase tracking-wider fw-semibold mb-1"><?= htmlspecialchars($data['brand']); ?></span>
                            <h3 class="h5 mb-2 fw-bold text-dark font-serif"><?= htmlspecialchars($data['name']); ?></h3>
                            <p class="text-muted small mb-4" style="font-size: 0.8rem;"><?= htmlspecialchars($data['category_name']); ?></p>
                            
                            <div class="mt-auto">
                                <a href="login.php" class="btn btn-sm btn-outline-gold w-100 py-2">Sign In to View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-12 text-center text-muted">Katalog sedang disiapkan oleh kurator kami.</div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="register.php" class="text-gold text-decoration-none fw-bold text-uppercase tracking-wider small border-bottom border-warning pb-1">Unlock Full Access →</a>
        </div>
    </section>

    <footer class="mt-auto py-5 border-top border-light bg-white">
        <div class="container text-center">
            <h4 class="text-gold fw-bold font-serif mb-3">FRAGLOGUE</h4>
            <p class="text-muted small mb-4 mx-auto" style="max-width: 400px;">The definitive digital vault for haute parfumerie. Curated for the modern connoisseur.</p>
            <div class="d-flex justify-content-center gap-3 mb-4">
                <a href="#" class="text-muted text-decoration-none small">Terms of Service</a>
                <span class="text-light">|</span>
                <a href="#" class="text-muted text-decoration-none small">Privacy Policy</a>
                <span class="text-light">|</span>
                <a href="#" class="text-muted text-decoration-none small">Contact Curator</a>
            </div>
            <p class="text-muted mb-0" style="font-size: 0.75rem;">&copy; 2026 Fraglogue Archive. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

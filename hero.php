<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Fraglogue - The Genesis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .hero-full-tab {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .hero-img-vault {
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid rgba(184, 147, 33, 0.2) !important;
            box-shadow: 0 20px 45px rgba(184, 147, 33, 0.08);
            transition: transform 0.5s ease, box-shadow 0.5s ease;
        }
        .hero-img-vault:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 60px rgba(184, 147, 33, 0.15);
        }
        .hero-img-vault img {
            width: 100%;
            height: 500px;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .hero-img-vault:hover img {
            transform: scale(1.03);
        }
        .luxury-badge {
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 4px;
            color: var(--luxury-gold);
            text-transform: uppercase;
        }
        .divider-gold {
            width: 70px;
            height: 2px;
            background-color: var(--luxury-gold);
            margin: 25px 0;
        }
    </style>
</head>
<body>

    <div class="container hero-full-tab py-5">
        <div class="row align-items-center g-5">
            
            <div class="col-lg-6 order-2 order-lg-1">
                <div class="luxury-badge mb-2">Authenticated Access Logged</div>
                
                <h1 class="display-3 fw-bold mb-1" style="color: var(--luxury-text);">
                    The Sanctuary of <span class="text-gold">Scent Chronicles</span>
                </h1>
                
                <div class="divider-gold"></div>
                
                <p class="text-muted lh-lg mb-4" style="font-size: 1.05rem; text-align: justify;">
                    [cite_start]Fraglogue didirikan sebagai sebuah laboratorium kurasi dan arsip penciuman eksklusif (*Luxury Olfactory Archive*) untuk mengabadikan mahakarya wewangian paling berharga di dunia[cite: 24]. Berawal dari sebuah paviliun privat di sudut distrik bersejarah Grasse pada abad ke-20, Fraglogue kini berevolusi menjadi kubah digital modern tempat bertemunya tradisi luhur pembuat parfum (*perfumers*) dengan teknologi preservasi modern.
                </p>
                
                <p class="text-muted lh-lg mb-5" style="font-size: 1.05rem; text-align: justify;">
                    Di balik dinding galeri arsitektur kontemporer kami, setiap tetes esensi, transisi piramida aroma, dan catatan sejarah dari ramuan legendaris dikategorikan secara presisi. Selamat datang kembali, <strong><?= htmlspecialchars($_SESSION['username']); [cite_start]?></strong>[cite: 25]. Masuklah lebih dalam, dan temukan mahakarya aroma berikutnya yang akan mendefinisikan persona agung Anda.
                </p>
                
                <div>
                    <a href="index.php" class="btn btn-gold btn-lg px-5 py-3 rounded-pill text-uppercase tracking-wider fw-semibold shadow-sm" style="font-size: 0.85rem;">
                        Discover the Archive &rarr;
                    </a>
                </div>
            </div>
            
            <div class="col-lg-6 order-1 order-lg-2">
                <div class="hero-img-vault perfume-card p-2 bg-white">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80" 
                         alt="Fraglogue Contemporary Olfactory Vault Architecture">
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
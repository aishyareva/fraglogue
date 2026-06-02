<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fraglogue - Our Heritage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container d-flex justify-content-center">
            <span class="navbar-brand fw-bold text-gold mb-0 fs-4">FRAGLOGUE</span>
        </div>
    </nav>

    <div class="container flex-grow-1 d-flex align-items-center py-5">
        <div class="row align-items-center g-5 w-100">
            
            <div class="col-12 col-lg-6 order-2 order-lg-1">
                <div class="perfume-card p-2 rounded-4 shadow-sm" style="overflow: hidden;">
                    <img src="https://images.unsplash.com/photo-1543332143-4e8c27e3256f?q=80&w=1000&auto=format&fit=crop" 
                         alt="Fraglogue Heritage Building" 
                         class="img-fluid rounded-3 w-100" 
                         style="object-fit: cover; height: 600px; transition: transform 0.5s ease;">
                </div>
            </div>

            <div class="col-12 col-lg-6 order-1 order-lg-2 px-lg-5">
                <span class="text-gold text-uppercase tracking-wider fw-bold small mb-2 d-block" style="letter-spacing: 2px;">Est. 1967</span>
                <h1 class="display-4 text-dark fw-bold mb-4 font-serif" style="line-height: 1.2;">The Genesis of <br><span class="text-gold">Fraglogue</span></h1>
                
                <div class="text-secondary mb-5 lh-lg" style="font-size: 1.05rem;">
                    <p>
                        Berawal dari sebuah arsip pribadi di sudut kota, Fraglogue lahir dari dedikasi untuk mengkurasi mahakarya olfaktori terbaik dunia. Kami percaya bahwa setiap aroma membawa narasi, memori, dan identitas yang tak lekang oleh waktu.
                    </p>
                    <p>
                        Gedung utama kami yang tervisualisasi di samping bukan sekadar tempat penyimpanan, melainkan sebuah monumen penghormatan bagi para perfumer legendaris. Di sinilah seni meracik aroma dan presisi sains bertemu untuk menciptakan sejarah.
                    </p>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <a href="index.php" class="btn btn-gold px-5 py-3 rounded-pill shadow-sm fw-medium" style="font-size: 1.1rem;">
                        Enter The Archive
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

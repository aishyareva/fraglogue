<?php
session_start();
if (!isset($_SESSION['login'])) { 
    header("Location: login.php"); 
    exit; 
}
include 'koneksi.php';

$id = isset($_GET['id']) ? mysqli_real_escape_string($koneksi, $_GET['id']) : '';

$query_perfume = mysqli_query($koneksi, "SELECT p.*, c.category_name FROM perfumes p 
                                        LEFT JOIN categories c ON p.id_category = c.id_category 
                                        WHERE p.id_perfume = '$id'");
$data = mysqli_fetch_array($query_perfume);

if (!$data) { 
    echo "<script>alert('Masterpiece fragrance not found in our archive.'); window.location='index.php';</script>"; 
    exit; 
}

$seed = intval($id);
$v_eternal      = ($seed % 3 == 0) ? 24 : (($seed % 2 == 0) ? 16 : 5);
$v_longlasting  = ($seed % 3 == 0) ? 18 : (($seed % 2 == 0) ? 21 : 12);
$v_moderate_l   = ($seed % 3 == 0) ? 6 : (($seed % 2 == 0) ? 8 : 19);
$v_weak_l       = ($seed % 4 == 0) ? 4 : 2;
$v_veryweak_l   = ($seed % 5 == 0) ? 2 : 0;
$total_long_votes = $v_eternal + $v_longlasting + $v_moderate_l + $v_weak_l + $v_veryweak_l;

$v_enormous     = ($seed % 3 == 0) ? 19 : (($seed % 2 == 0) ? 15 : 3);
$v_strong       = ($seed % 3 == 0) ? 22 : (($seed % 2 == 0) ? 17 : 9);
$v_moderate_s   = ($seed % 3 == 0) ? 5 : (($seed % 2 == 0) ? 7 : 22);
$v_intimate     = ($seed % 4 == 0) ? 3 : 1;
$total_sill_votes = $v_enormous + $v_strong + $v_moderate_s + $v_intimate;


if (isset($_POST['add_to_cart'])) {
    $id_user = $_SESSION['id_user'];
    $cart_query = "INSERT INTO cart (id_user, id_perfume, quantity) VALUES ('$id_user', '$id', 1) 
                   ON DUPLICATE KEY UPDATE quantity = quantity + 1";
    if (mysqli_query($koneksi, $cart_query)) {
        echo "<script>alert('Successfully added to your luxury cart!'); window.location='keranjang.php';</script>";
        exit;
    }
}
    
if (isset($_POST['add_favorite'])) {
    $id_user = $_SESSION['id_user'];
    $fav_query = "INSERT IGNORE INTO favorites (id_user, id_perfume) VALUES ('$id_user', '$id')";
    if (mysqli_query($koneksi, $fav_query)) {
        echo "<script>alert('Added to your private exquisite collection!');</script>";
    }
}

if (isset($_POST['add_review'])) {
    $id_user = $_SESSION['id_user'];
    $rating = mysqli_real_escape_string($koneksi, $_POST['rating']);
    $comment = mysqli_real_escape_string($koneksi, $_POST['comment']);
    $review_query = "INSERT INTO reviews (id_user, id_perfume, rating, comment) VALUES ('$id_user', '$id', '$rating', '$comment')";
    if (mysqli_query($koneksi, $review_query)) {
        echo "<script>alert('Thank you for sharing your olfactory impression!'); window.location='detail.php?id=$id';</script>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fraglogue - <?= htmlspecialchars($data['name']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .metric-title {
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 1.5px;
            color: #1c1b18;
            text-transform: uppercase;
        }
        .metric-label {
            width: 110px;
            font-size: 0.8rem;
            color: #6e6b64;
            text-transform: capitalize;
        }
        .metric-count {
            width: 25px;
            font-size: 0.8rem;
            color: #1c1b18;
            font-weight: 500;
            text-align: right;
        }
        .progress-luxury {
            height: 8px;
            background-color: rgba(184, 147, 33, 0.08);
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-bar-gold {
            background-color: #b89321;
            border-radius: 4px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-luxury py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-gold" href="index.php">FRAGLOGUE</a>
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

    <div class="container my-5">
        <div class="perfume-card p-4 p-md-5 bg-white shadow-sm mb-5">
            <div class="row g-5">
                <div class="col-12 col-md-5">
                    <div class="p-3 rounded-4 bg-light border text-center d-flex align-items-center justify-content-center" style="min-height: 400px;">
                        <img src="<?= $data['image_url']; ?>" class="img-fluid rounded-3" alt="<?= htmlspecialchars($data['name']); ?>" style="max-height: 380px; object-fit: contain;">
                    </div>
                </div>
                
                <div class="col-12 col-md-7 d-flex flex-column justify-content-center">
                    <span class="text-gold text-uppercase tracking-wider fw-bold small"><?= htmlspecialchars($data['brand']); ?></span>
                    <h1 class="display-5 text-dark fw-bold mb-2 font-serif"><?= htmlspecialchars($data['name']); ?></h1>
                    <p class="text-muted small mb-4">Olfactory Family Category: <span class="text-dark fw-medium"><?= htmlspecialchars($data['category_name']); ?></span></p>
                    
                    <h2 class="text-gold fw-bold h3 mb-4">IDR <?= number_format($data['price'], 0, ',', '.'); ?></h2>
                    
                    <div class="mb-4">
                        <h5 class="text-dark fw-bold border-bottom pb-2 small text-uppercase tracking-wide">Composition Narrative</h5>
                        <p class="text-secondary small lh-lg"><?= htmlspecialchars($data['description']); ?></p>
                    </div>
                    
                    <div class="mb-5">
                        <h5 class="text-dark fw-bold border-bottom pb-2 small text-uppercase tracking-wide">Accords & Core Notes</h5>
                        <div class="mt-2">
                            <span class="badge bg-light text-gold p-2.5 border border-warning font-monospace fs-6 rounded-3 shadow-sm"><?= htmlspecialchars($data['main_notes']); ?></span>
                        </div>
                    </div>

                    <form method="POST" action="" class="d-flex flex-wrap gap-2">
                        <button type="submit" name="add_to_cart" class="btn btn-gold px-4 py-2.5 shadow-sm">🛒 Add to Basket</button>
                        <button type="submit" name="add_favorite" class="btn btn-outline-gold px-4 py-2.5 shadow-sm">❤ Add to Favorites</button>
                        <a href="index.php" class="btn btn-outline-secondary px-4 py-2.5">Back to Archive</a>
                    </form>
                </div>
            </div>
        </div>

        <div class="row g-4 my-5">
            <div class="col-12 col-md-6">
                <div class="perfume-card p-4 bg-white shadow-sm rounded-4 h-100">
                    <div class="d-flex align-items-center mb-4">
                        <span class="fs-4 me-2"></span>
                        <div class="metric-title">Longevity Accumulation</div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Very Weak</div>
                        <div class="metric-count me-2"><?= $v_veryweak_l; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_veryweak_l/$total_long_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Weak</div>
                        <div class="metric-count me-2"><?= $v_weak_l; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_weak_l/$total_long_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Moderate</div>
                        <div class="metric-count me-2"><?= $v_moderate_l; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_moderate_l/$total_long_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Long Lasting</div>
                        <div class="metric-count me-2"><?= $v_longlasting; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_longlasting/$total_long_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="metric-label">Eternal</div>
                        <div class="metric-count me-2"><?= $v_eternal; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_eternal/$total_long_votes)*100; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="perfume-card p-4 bg-white shadow-sm rounded-4 h-100">
                    <div class="d-flex align-items-center mb-4">
                        <span class="fs-4 me-2"></span>
                        <div class="metric-title">Sillage Projection</div>
                    </div>
                    
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Intimate</div>
                        <div class="metric-count me-2"><?= $v_intimate; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_intimate/$total_sill_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Moderate</div>
                        <div class="metric-count me-2"><?= $v_moderate_s; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_moderate_s/$total_sill_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2.5">
                        <div class="metric-label">Strong</div>
                        <div class="metric-count me-2"><?= $v_strong; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_strong/$total_sill_votes)*100; ?>%"></div>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="metric-label">Enormous</div>
                        <div class="metric-count me-2"><?= $v_enormous; ?></div>
                        <div class="progress progress-luxury flex-grow-1">
                            <div class="progress-bar progress-bar-gold" style="width: <?= ($v_enormous/$total_sill_votes)*100; ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="my-5 pt-4">
            <h3 class="text-dark fw-bold mb-1 font-serif">Similars & Recommendations</h3>
            <p class="text-muted small mb-4">Other luxury creations that share the same dominant olfactory accords.</p>
            <div class="row g-4">
                <?php
                $notes_array = explode(',', $data['main_notes']);
                $first_note = trim($notes_array[0]);
                $rec_query = mysqli_query($koneksi, "SELECT * FROM perfumes WHERE main_notes LIKE '%$first_note%' AND id_perfume != '$id' LIMIT 3");
                
                if(mysqli_num_rows($rec_query) == 0):
                    echo "<div class='col-12'><div class='p-4 bg-white border rounded text-center text-muted small shadow-sm'>No recommended fragrances sharing similar core notes found at the moment.</div></div>";
                else:
                    while($rec = mysqli_fetch_array($rec_query)):
                ?>
                    <div class="col-12 col-md-4">
                        <div class="perfume-card p-3 bg-white shadow-sm d-flex align-items-center">
                            <img src="<?= $rec['image_url']; ?>" style="width:65px; height:65px; object-fit:contain;" class="rounded border p-1 bg-light me-3">
                            <div class="overflow-hidden">
                                <h6 class="mb-0 text-dark fw-bold text-truncate"><?= htmlspecialchars($rec['name']); ?></h6>
                                <span class="text-gold small mb-2 d-block text-uppercase fw-semibold" style="font-size: 0.75rem;"><?= htmlspecialchars($rec['brand']); ?></span>
                                <a href="detail.php?id=<?= $rec['id_perfume']; ?>" class="btn btn-sm btn-outline-gold py-0.5 px-2 font-monospace" style="font-size: 0.75rem;">View Scent →</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; endif; ?>
            </div>
        </div>

        <div class="row mt-5 pt-5 border-top border-light">
            <div class="col-12 col-md-6 mb-4">
                <h4 class="text-dark fw-bold mb-1 font-serif">Connoisseur Reviews</h4>
                <p class="text-muted small mb-4">Verified olfactory evaluation analysis logs.</p>
                
                <?php
                $reviews = mysqli_query($koneksi, "SELECT r.*, u.username FROM reviews r 
                                                  JOIN users u ON r.id_user = u.id_user 
                                                  WHERE r.id_perfume = '$id' 
                                                  ORDER BY r.created_at DESC");
                if(mysqli_num_rows($reviews) == 0):
                    echo "<div class='p-4 bg-white border rounded text-center text-muted small shadow-sm'>No formal evaluations written for this masterpiece yet.</div>";
                else:
                    while($rev = mysqli_fetch_array($reviews)):
                ?>
                    <div class="bg-white p-3 rounded-4 mb-3 border shadow-sm">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong class="text-dark font-monospace" style="font-size: 0.85rem;">@<?= htmlspecialchars($rev['username']); ?></strong>
                            <span class="text-gold small font-monospace"><?= str_repeat('★', $rev['rating']); ?></span>
                        </div>
                        <p class="text-secondary small mb-0 mt-2 lh-base">"<?= htmlspecialchars($rev['comment']); ?>"</p>
                    </div>
                <?php endwhile; endif; ?>
            </div>
            
            <div class="col-12 col-md-6">
                <div class="perfume-card p-4 bg-white shadow-sm rounded-4">
                    <h4 class="text-dark fw-bold h5 mb-1 font-serif">Leave an Impression</h4>
                    <p class="text-muted small mb-3">Document your sensory feedback archive log below.</p>
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Aroma Longevity Valuation</label>
                            <select name="rating" class="form-select" required>
                                <option value="5">5 Stars ★★★★★ (Perfection Accord)</option>
                                <option value="4">4 Stars ★★★★☆ (Excellent Composition)</option>
                                <option value="3">3 Stars ★★★☆☆ (Moderate Formula)</option>
                                <option value="2">2 Stars ★★☆☆☆ (Mediocre Accord)</option>
                                <option value="1">1 Star ★☆☆☆☆ (Disappointing)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-medium text-muted">Detailed Olfactory Evaluation</label>
                            <textarea name="comment" rows="4" class="form-control" required placeholder="Describe notes transitions, sillage, projection..."></textarea>
                        </div>
                        <button type="submit" name="add_review" class="btn btn-gold w-100 py-2 shadow-sm fw-medium">Submit Impression Log</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
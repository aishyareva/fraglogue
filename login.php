<?php
session_start();
include 'koneksi.php'; 
$error = '';

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($koneksi, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            header("Location: index.php");
            exit;
        }
    }
    $error = "Username atau password salah!";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 420px;">
        <div class="perfume-card p-4 p-md-5">
            <h2 class="text-center text-gold mb-2">FRAGLOGUE</h2>
            <p class="text-center text-muted small mb-4">Sign in to your olfactory archive</p>
            
            <?php if($error): ?>
                <div class="alert alert-danger bg-dark text-danger border-danger small"><?= $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label text-muted small">Username</label>
                    <input type="text" name="username" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small">Password</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required>
                </div>
                <button type="submit" name="login" class="btn btn-gold w-100 py-2 mb-3">Sign In</button>
                <p class="text-center text-muted small mb-0">Don't have an account? <a href="register.php" class="text-gold text-decoration-none">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>
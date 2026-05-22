<?php
include 'koneksi.php'; 
$error = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = mysqli_real_escape_string($koneksi, $_POST['role']); 

    if ($password !== $confirm_password) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$hashed_password', '$role')";
        if (mysqli_query($koneksi, $query)) {
            echo "<script>alert('Registrasi akun sebagai " . ucfirst($role) . " berhasil! Silakan login.'); window.location='login.php';</script>";
        } else {
            $error = "Username sudah terdaftar!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fraglogue - Register Moderator Mode</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container" style="max-width: 450px;">
        <div class="perfume-card p-4 p-md-5">
            <h2 class="text-center text-gold mb-2">FRAGLOGUE</h2>
            <p class="text-center text-muted small mb-4">Moderator Control: Register New Account</p>
            
            <?php if($error): ?>
                <div class="alert alert-danger bg-dark text-danger border-danger small"><?= $error; ?></div>
            <?php endif; ?>

            <form action="" method="POST">
                <div class="mb-3">
                    <label class="form-label small">Username</label>
                    <input type="text" name="username" class="form-control bg-dark" required placeholder="Enter username...">
                </div>
                <div class="mb-3">
                    <label class="form-label small">Password</label>
                    <input type="password" name="password" class="form-control bg-dark" required placeholder="Enter password...">
                </div>
                <div class="mb-3">
                    <label class="form-label small">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control bg-dark" required placeholder="Re-type password...">
                </div>
                
                <div class="mb-4">
                    <label class="form-label small text-gold fw-bold">Account Role (Privilege Mode)</label>
                    <select name="role" class="form-select bg-dark text-white border-secondary" style="border: 1px solid rgba(214, 175, 55, 0.4) !important;" required>
                        <option value="user">Standard User (View, Favorites, Reviews)</option>
                        <option value="admin">Administrator (Full CRUD & Catalogue Management)</option>
                    </select>
                    <div class="form-text text-secondary" style="font-size: 0.75rem;">*As a moderator, you can dynamically assign administrative rights.</div>
                </div>

                <button type="submit" name="register" class="btn btn-gold w-100 py-2 mb-3">Create Account</button>
                <p class="text-center text-white small mb-0">Already have an account? <a href="login.php" class="text-gold text-decoration-none fw-medium">Sign In</a></p>
            </form>
        </div>
    </div>
</body>
</html>
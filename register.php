<?php
session_start();
include 'config.php';

$error = '';
$success = '';

if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    // Validasi dasar
    if ($password !== $confirm) {
        $error = "Password dan konfirmasi tidak sama!";
    } else {
        // Cek username sudah ada atau belum
        $check = $koneksi->query("SELECT id FROM users WHERE username='$username'");

        if ($check->num_rows > 0) {
            $error = "Username sudah digunakan!";
        } else {
            // Hash password (sementara pakai MD5)
            $hashedPassword = md5($password);

            $insert = $koneksi->query(
                "INSERT INTO users (username, password) 
                 VALUES ('$username', '$hashedPassword')"
            );

            if ($insert) {
                $success = "Akun berhasil dibuat! Silakan login.";
            } else {
                $error = "Gagal membuat akun!";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-body">

<div class="login-card">
    <h2>Buat Akun</h2>
    <p class="login-subtitle">Daftar untuk mengakses dashboard</p>

    <?php if ($error): ?>
        <div class="login-error"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="login-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm" placeholder="Konfirmasi Password" required>

        <button type="submit" name="register" class="btn-login">
            Daftar
        </button>
    </form>

    <p class="login-footer">
        Sudah punya akun? <a href="login.php">Login</a>
    </p>
</div>

</body>
</html>

<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if (!$username || !$password || !$confirm) {
        $error = "Semua field wajib diisi!";
    } elseif ($password !== $confirm) {
        $error = "Konfirmasi password tidak sama!";
    } else {

        // Cek username sudah ada atau belum
        $stmt = $koneksi->prepare(
            "SELECT id FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $error = "Username sudah digunakan!";
        } else {

            // Hash password (AMAN)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insert = $koneksi->prepare(
                "INSERT INTO users (username, password) VALUES (?, ?)"
            );
            $insert->bind_param("ss", $username, $hashedPassword);

            if ($insert->execute()) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Registrasi gagal, coba lagi.";
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
    <h2>Register</h2>
    <p class="login-subtitle">Buat akun baru</p>

    <?php if ($error): ?>
        <div class="login-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="login-success">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?page=register">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Ulangi Password" required>

        <button type="submit" class="btn-login">
            Daftar
        </button>
    </form>

    <p class="login-footer">
        Sudah punya akun?
        <a href="index.php?page=login">Login</a>
    </p>
</div>

</body>
</html>

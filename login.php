<?php
session_start();
include 'config.php';

$error = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // ⬅️ PENTING

    $query = $koneksi->query("SELECT * FROM users WHERE username='$username'");

    if ($query->num_rows === 1) {
        $user = $query->fetch_assoc();

        if ($password === $user['password']) {
            $_SESSION['login'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="login-body">

    <div class="login-card">
        <h2>Login</h2>
        <p class="login-subtitle">Silakan masuk ke dashboard</p>

        <?php if ($error): ?>
            <div class="login-error"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>

            <button type="submit" name="login" class="btn-login">
                Masuk
            </button>
        </form>
        <p class="login-footer">
            Belum punya akun? <a href="register.php">Buat akun</a>
        </p>

    </div>

</body>

</html>
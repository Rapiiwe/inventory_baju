<?php
// config & session sudah di-handle di index.php
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if ($username && $password) {

        $stmt = $koneksi->prepare(
            "SELECT id, username, password FROM users WHERE username = ? LIMIT 1"
        );
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            $user = $result->fetch_assoc();

            // PASSWORD VERIFY (AMAN)
            if (password_verify($password, $user['password'])) {

                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'username' => $user['username']
                ];

                header("Location: index.php?page=dashboard");
                exit;

            } else {
                $error = "Password salah!";
            }

        } else {
            $error = "Username tidak ditemukan!";
        }
    } else {
        $error = "Username dan password wajib diisi!";
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
        <div class="login-error">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="post" action="index.php?page=login">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" class="btn-login">
            Masuk
        </button>
    </form>

    <p class="login-footer">
        Belum punya akun?
        <a href="index.php?page=register">Buat akun</a>
    </p>
</div>

</body>
</html>

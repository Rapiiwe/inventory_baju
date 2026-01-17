<?php
session_start();
include 'config.php';

if (!isset($_POST['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query(
    $koneksi,
    "SELECT * FROM users WHERE username='$username' AND password='$password'"
);

if (mysqli_num_rows($query) > 0) {
    $data = mysqli_fetch_assoc($query);

    $_SESSION['login'] = true;
    $_SESSION['username'] = $username;

    header("Location: index.php");
    exit;
} else {
    echo "<script>
        alert('Username atau Password salah!');
        window.location='login.php';
    </script>";
}
?>

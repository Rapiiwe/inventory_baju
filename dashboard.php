<?php
session_start();
include 'config.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Contoh data ringkasan
$totalProduk = $koneksi->query("SELECT COUNT(*) as total FROM produk")->fetch_assoc()['total'];
$totalStok   = $koneksi->query("SELECT SUM(stok) as total FROM produk")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="top-bar">
        <span>Hi, <?= $_SESSION['username']; ?></span>
        <a href="logout.php" class="btn-logout">Logout</a>
    </div>

    <div class="container">
        <h1>Dashboard Inventori</h1>

        <div class="dashboard-box">
            <div class="card">
                <h3>Total Produk</h3>
                <p><?= $totalProduk ?></p>
            </div>

            <div class="card">
                <h3>Total Stok</h3>
                <p><?= $totalStok ?></p>
            </div>
        </div>

        <div class="dashboard-actions">
            <a href="index.php" class="btn-tambah">Kelola Produk</a>
        </div>
    </div>
</body>

</html>

<?php $koneksi->close(); ?>
<?php
session_start();
include 'config.php';

// Cek login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Data ringkasan
$totalProduk = $koneksi->query("SELECT COUNT(*) as total FROM produk")->fetch_assoc()['total'];
$totalStok   = $koneksi->query("SELECT SUM(stok) as total FROM produk")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Inventori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- CSS kamu -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#">STOK BARANG</a>

        <div class="d-flex align-items-center">
            <span class="text-dark me-3">
                <i class="fa fa-user"></i> <?= $_SESSION['username']; ?>
            </span>
            <a href="logout.php" class="btn btn-danger btn-sm">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <div class="col-md-2 bg-dark min-vh-100 p-0">
            <ul class="nav flex-column text-white pt-3">
                <li class="nav-item">
                    <a class="nav-link text-white active" href="dashboard.php">
                        <i class="fa fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="index.php">
                        <i class="fa fa-box me-2"></i> Data Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="barang_masuk.php">
                        <i class="fa fa-arrow-down"></i> Barang Masuk
                    </a>
                </li>

<li class="nav-item">
    <a class="nav-link text-white" href="barang_keluar.php">
        <i class="fa fa-arrow-up"></i> Barang Keluar
    </a>
</li>
            </ul>
        </div>

        <!-- CONTENT -->
        <div class="col-md-10 p-4">

            <h4 class="mb-4">Dashboard</h4>

            <!-- CARD STATISTIK -->
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3><?= $totalProduk ?></h3>
                                <p class="mb-0">Data Produk</p>
                            </div>
                            <i class="fa fa-box fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h3><?= $totalStok ?></h3>
                                <p class="mb-0">Total Stok</p>
                            </div>
                            <i class="fa fa-layer-group fa-3x opacity-50"></i>
                        </div>
                    </div>
                </div>

            </div>

            <!-- AKSI -->
            <div class="mt-5">
                <a href="index.php" class="btn btn-success">
                    <i class="fa fa-cogs"></i> Kelola Produk
                </a>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $koneksi->close(); ?>
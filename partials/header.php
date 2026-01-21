<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Inventori</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow">
    <div class="container-fluid">
        <span class="navbar-brand fw-bold">STOK BARANG</span>

        <div class="d-flex align-items-center">
            <span class="text-dark me-3">
                <i class="fa fa-user"></i>
                <?= htmlspecialchars($_SESSION['user']['username'] ?? 'User') ?>
            </span>

            <a href="index.php?page=logout"
               class="btn btn-danger btn-sm"
               onclick="return confirm('Yakin ingin logout?')">
                Logout
            </a>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

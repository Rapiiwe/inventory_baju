<?php
$currentPage = $_GET['page'] ?? '';
?>

<div class="col-md-2 bg-dark min-vh-100 p-0">
    <ul class="nav flex-column text-white pt-3">

        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'dashboard' ? 'active bg-secondary' : '' ?>"
               href="index.php?page=dashboard">
                <i class="fa fa-home me-2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'produk' ? 'active bg-secondary' : '' ?>"
               href="index.php?page=produk">
                <i class="fa fa-box me-2"></i>
                Data Produk
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'barang_masuk' ? 'active bg-secondary' : '' ?>"
               href="index.php?page=barang_masuk">
                <i class="fa fa-arrow-down me-2"></i>
                Barang Masuk
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-white <?= $currentPage === 'barang_keluar' ? 'active bg-secondary' : '' ?>"
               href="index.php?page=barang_keluar">
                <i class="fa fa-arrow-up me-2"></i>
                Barang Keluar
            </a>
        </li>

    </ul>
</div>

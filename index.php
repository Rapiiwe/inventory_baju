<?php
require_once 'config.php';

$page = $_GET['page'] ?? 'login';

switch ($page) {

    /* ======================
     | AUTH
     ====================== */
    case 'login':
        require 'auth/login.php';
        break;

    case 'register':
        require 'auth/register.php';
        break;

    case 'logout':
        require 'auth/logout.php';
        break;

    /* ======================
     | PROTECTED PAGES
     ====================== */
    case 'dashboard':
        require 'auth/auth_check.php';
        require 'pages/dashboard.php';
        break;

    case 'produk':
        require 'auth/auth_check.php';
        require 'pages/data_produk.php';
        break;

    case 'produk_create':
        require 'auth/auth_check.php';
        require 'pages/produk_create.php';
        break;

    case 'produk_edit':
        require 'auth/auth_check.php';
        require 'pages/produk_edit.php';
        break;

    case 'produk_delete':
        require 'auth/auth_check.php';
        require 'pages/produk_delete.php';
        break;

    /* ======================
    | BARANG MASUK
    ====================== */
    case 'barang_masuk':
        require 'auth/auth_check.php';
        require 'pages/barang_masuk.php';
        break;

    case 'barang_masuk_create':
        require 'auth/auth_check.php';
        require 'pages/barang_masuk_create.php';
        break;

    /* ======================
    | BARANG KELUAR
    ====================== */
    case 'barang_keluar':
        require 'auth/auth_check.php';
        require 'pages/barang_keluar.php';
        break;

    case 'barang_keluar_create':
        require 'auth/auth_check.php';
        require 'pages/barang_keluar_create.php';
        break;


    default:
        echo "<h2 style='text-align:center;margin-top:50px'>404 - Page tidak ditemukan</h2>";
        break;
}

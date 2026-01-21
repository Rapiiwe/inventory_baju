<?php
/**
 * =======================================
 * CONFIG & BOOTSTRAP
 * Inventory Baju
 * =======================================
 */

/* ---------------------------------------
 | BASE PATH
 |--------------------------------------- */
define('BASE_PATH', __DIR__);

/* ---------------------------------------
 | DATABASE CONFIG
 |--------------------------------------- */
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'inventory_baju');

/* ---------------------------------------
 | DATABASE CONNECTION (MySQLi OOP)
 |--------------------------------------- */
$koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

/* Connection Error Handling */
if ($koneksi->connect_errno) {
    die('Koneksi database gagal: ' . $koneksi->connect_error);
}

/* Charset (Best Practice) */
$koneksi->set_charset('utf8mb4');

/* ---------------------------------------
 | SESSION
 |--------------------------------------- */
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

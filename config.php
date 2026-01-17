<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_login";

$koneksi = mysqli_connect("localhost", "root", "", "inventory_baju");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

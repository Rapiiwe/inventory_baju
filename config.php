<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "inventory_baju";

$koneksi = mysqli_connect("localhost", "root", "", "inventory_baju");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

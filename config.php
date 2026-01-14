<?php
$host = 'localhost';
$user = 'root'; // Default XAMPP
$pass = ''; // Default kosong
$db = 'inventory_baju';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
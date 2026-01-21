<?php
// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?page=produk");
    exit;
}

// Hapus data produk
$stmt = $koneksi->prepare(
    "DELETE FROM produk WHERE id = ?"
);
$stmt->bind_param("i", $id);

$stmt->execute();

// Redirect kembali ke data produk
header("Location: index.php?page=produk");
exit;

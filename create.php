<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga']; // Dianggap sebagai string biasa
    $stok = $_POST['stok'];

    // Menyimpan produk baru ke database
    $sql = "INSERT INTO produk (nama, kategori, harga, stok) VALUES ('$nama', '$kategori', '$harga', '$stok')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Inventori Baju</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Tambah Produk Baru</h1>
        <form method="POST">
            <label for="nama">Nama Produk:</label>
            <input type="text" id="nama" name="nama" required placeholder="Nama Produk">

            <label for="kategori">Kategori:</label>
            <input type="text" id="kategori" name="kategori" required placeholder="Kategori Produk">

            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" required placeholder="Harga Produk">

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" required placeholder="Jumlah Stok">

            <input type="submit" value="Tambah Produk">
        </form>
        <a href="index.php" class="btn-back">Kembali ke Daftar Produk</a>
    </div>

    <!-- Elemen untuk menampilkan waktu di pojok kanan bawah -->
    <div id="clock"></div>
</body>
</html>

<?php $conn->close(); ?>

<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Item Inventory</h1>
    <form action="" method="post">
        <label>Nama:</label><input type="text" name="nama" required><br>
        <label>Ukuran:</label><input type="text" name="ukuran" required><br>
        <label>Jumlah:</label><input type="number" name="jumlah" required><br>
        <label>Harga:</label><input type="number" step="0.01" name="harga" required><br>
        <button type="submit" name="submit">Tambah</button>
    </form>
    <a href="index.php">Kembali</a>
    <?php
    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $ukuran = $_POST['ukuran'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $conn->query("INSERT INTO items (nama, ukuran, jumlah, harga) VALUES ('$nama', '$ukuran', '$jumlah', '$harga')");
        header("Location: index.php");
    }
    ?>
</body>
</html>
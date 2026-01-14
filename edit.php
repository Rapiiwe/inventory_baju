<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga']; // Dianggap sebagai string biasa
    $stok = $_POST['stok'];

    // Update produk di database
    $sql = "UPDATE produk SET nama='$nama', kategori='$kategori', harga='$harga', stok='$stok' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href = 'index.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id=$id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Inventori Baju</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Edit Produk</h1>
        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nama">Nama Produk:</label>
            <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required placeholder="Nama Produk">

            <label for="kategori">Kategori:</label>
            <input type="text" id="kategori" name="kategori" value="<?php echo $row['kategori']; ?>" required placeholder="Kategori Produk">

            <label for="harga">Harga:</label>
            <input type="text" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required placeholder="Harga Produk">

            <label for="stok">Stok:</label>
            <input type="number" id="stok" name="stok" value="<?php echo $row['stok']; ?>" required placeholder="Jumlah Stok">

            <input type="submit" value="Update Produk">
        </form>
        <a href="index.php" class="btn-back">Kembali ke Daftar Produk</a>
    </div>

    <!-- Elemen untuk menampilkan waktu di pojok kanan bawah -->
    <div id="clock"></div>
</body>
</html>

<?php $conn->close(); ?>

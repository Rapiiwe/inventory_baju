<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $sql = "INSERT INTO produk (nama, kategori, harga, stok)
            VALUES ('$nama', '$kategori', '$harga', '$stok')";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>
                alert('Produk berhasil ditambahkan!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Inventori Baju</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS custom kamu -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5" style="max-width: 700px;">

    <div class="card shadow-lg">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Produk Baru</h4>
        </div>

        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Produk" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" placeholder="Kategori Produk" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" name="harga" class="form-control" placeholder="Harga Produk" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" placeholder="Jumlah Stok" required>
                </div>

                <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-warning">
                        ⬅ Dashboard
                    </a>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">
                        ⬅ Kembali
                    </a>
                    <button type="submit" class="btn btn-success">
                        💾 Simpan Produk
                    </button>
                </div>

            </form>
        </div>
    </div>

</div>

<!-- JAM -->
<div id="clock"></div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $koneksi->close(); ?>
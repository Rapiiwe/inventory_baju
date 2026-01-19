<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // Update produk
    $sql = "UPDATE produk 
            SET nama='$nama', kategori='$kategori', harga='$harga', stok='$stok' 
            WHERE id=$id";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>
                alert('Produk berhasil diperbarui!');
                window.location.href = 'index.php';
              </script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}

// Ambil data lama
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM produk WHERE id=$id";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Produk tidak ditemukan.";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Inventori Baju</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS custom kamu -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5" style="max-width: 700px;">

    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Produk</h4>
        </div>

        <div class="card-body">
            <form method="POST">

                <input type="hidden" name="id" value="<?= $row['id']; ?>">

                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control"
                           value="<?= $row['nama']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control"
                           value="<?= $row['kategori']; ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text" name="harga" class="form-control"
                           value="<?= $row['harga']; ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control"
                           value="<?= $row['stok']; ?>" required>
                </div>

                <div class="d-flex justify-content-between">
                <a href="dashboard.php" class="btn btn-warning">
                        ⬅ Dashboard
                    </a>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">
                        ⬅ Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        💾 Update Produk
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
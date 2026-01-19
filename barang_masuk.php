<?php
session_start();
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Simpan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produk_id = $_POST['produk_id'];
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];

    // Simpan barang masuk
    $koneksi->query("INSERT INTO barang_masuk (produk_id, tanggal, jumlah)
                     VALUES ('$produk_id', '$tanggal', '$jumlah')");

    // Update stok
    $koneksi->query("UPDATE produk SET stok = stok + $jumlah WHERE id = $produk_id");

    header("Location: barang_masuk.php");
    exit;
}

$produk = $koneksi->query("SELECT * FROM produk");
$data   = $koneksi->query("
    SELECT bm.*, p.nama 
    FROM barang_masuk bm 
    JOIN produk p ON bm.produk_id = p.id 
    ORDER BY bm.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barang Masuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <a href="dashboard.php" class="btn btn-warning mb-3">⬅ Dashboard</a>

    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Barang Masuk</h5>
        </div>

        <div class="card-body">
            <form method="POST" class="row g-3 mb-4">

                <div class="col-md-4">
                    <label class="form-label">Produk</label>
                    <select name="produk_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php while ($p = $produk->fetch_assoc()): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" required>
                </div>

                <div class="col-12">
                    <button class="btn btn-success">Simpan</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="table-success">
                    <tr>
                        <th>#</th>
                        <th>Produk</th>
                        <th>Tanggal</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; while($d = $data->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nama'] ?></td>
                        <td><?= $d['tanggal'] ?></td>
                        <td><?= $d['jumlah'] ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>

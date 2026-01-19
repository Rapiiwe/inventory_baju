<?php
session_start();
include 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produk_id = $_POST['produk_id'];
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];

    // Cek stok
    $stok = $koneksi->query("SELECT stok FROM produk WHERE id=$produk_id")
                    ->fetch_assoc()['stok'];

    if ($jumlah > $stok) {
        echo "<script>alert('Stok tidak cukup!');</script>";
    } else {
        $koneksi->query("INSERT INTO barang_keluar (produk_id, tanggal, jumlah)
                         VALUES ('$produk_id', '$tanggal', '$jumlah')");

        $koneksi->query("UPDATE produk SET stok = stok - $jumlah WHERE id = $produk_id");
        header("Location: barang_keluar.php");
        exit;
    }
}

$produk = $koneksi->query("SELECT * FROM produk");
$data   = $koneksi->query("
    SELECT bk.*, p.nama 
    FROM barang_keluar bk 
    JOIN produk p ON bk.produk_id = p.id 
    ORDER BY bk.id DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Barang Keluar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-4">

    <a href="dashboard.php" class="btn btn-warning mb-3">⬅ Dashboard</a>

    <div class="card shadow">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Barang Keluar</h5>
        </div>

        <div class="card-body">
            <form method="POST" class="row g-3 mb-4">

                <div class="col-md-4">
                    <label class="form-label">Produk</label>
                    <select name="produk_id" class="form-control" required>
                        <option value="">-- Pilih Produk --</option>
                        <?php while ($p = $produk->fetch_assoc()): ?>
                            <option value="<?= $p['id'] ?>">
                                <?= $p['nama'] ?> (Stok: <?= $p['stok'] ?>)
                            </option>
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
                    <button class="btn btn-danger">Simpan</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="table-danger">
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

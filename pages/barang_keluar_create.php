<?php
$error = '';

// Ambil list produk
$produkResult = $koneksi->query(
    "SELECT id, nama, stok FROM produk ORDER BY nama ASC"
);

// Proses simpan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $produk_id = $_POST['produk_id'];
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];

    if (!$produk_id || !$tanggal || !$jumlah) {
        $error = "Semua field wajib diisi!";
    } elseif ($jumlah <= 0) {
        $error = "Jumlah harus lebih dari 0!";
    } else {

        // Ambil stok produk
        $cek = $koneksi->prepare(
            "SELECT stok FROM produk WHERE id = ? LIMIT 1"
        );
        $cek->bind_param("i", $produk_id);
        $cek->execute();
        $stokResult = $cek->get_result();
        $produk = $stokResult->fetch_assoc();

        if (!$produk) {
            $error = "Produk tidak ditemukan!";
        } elseif ($produk['stok'] < $jumlah) {
            $error = "Stok tidak mencukupi! Stok tersedia: " . $produk['stok'];
        } else {

            // TRANSACTION START
            $koneksi->begin_transaction();

            try {
                // Insert history barang keluar
                $insert = $koneksi->prepare(
                    "INSERT INTO barang_keluar (produk_id, tanggal, jumlah)
                     VALUES (?, ?, ?)"
                );
                $insert->bind_param("isi", $produk_id, $tanggal, $jumlah);
                $insert->execute();

                // Update stok produk (KURANGI)
                $update = $koneksi->prepare(
                    "UPDATE produk SET stok = stok - ? WHERE id = ?"
                );
                $update->bind_param("ii", $jumlah, $produk_id);
                $update->execute();

                // Commit jika sukses
                $koneksi->commit();

                header("Location: index.php?page=barang_keluar");
                exit;

            } catch (Exception $e) {

                // Rollback jika gagal
                $koneksi->rollback();
                $error = "Gagal menyimpan barang keluar.";
            }
        }
    }
}
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<!-- CONTENT AREA -->
<div class="col-md-10 p-4">

<h4 class="mb-4">Tambah Barang Keluar</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?page=barang_keluar_create">

            <div class="mb-3">
                <label class="form-label">Produk</label>
                <select name="produk_id" class="form-select" required>
                    <option value="">-- Pilih Produk --</option>
                    <?php while ($p = $produkResult->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>">
                            <?= htmlspecialchars($p['nama']) ?>
                            (Stok: <?= $p['stok'] ?>)
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="<?= date('Y-m-d') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Jumlah</label>
                <input type="number"
                       name="jumlah"
                       class="form-control"
                       min="1"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-danger">
                    <i class="fa fa-save"></i> Simpan
                </button>

                <a href="index.php?page=barang_keluar" class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>

</div>
<!-- END CONTENT -->

<?php require 'partials/footer.php'; ?>

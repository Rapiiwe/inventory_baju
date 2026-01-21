<?php
// Ambil history barang masuk + nama produk
$query = "
    SELECT 
        bm.id,
        bm.tanggal,
        bm.jumlah,
        p.nama
    FROM barang_masuk bm
    JOIN produk p ON bm.produk_id = p.id
    ORDER BY bm.tanggal DESC
";

$result = $koneksi->query($query);
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">

<h4 class="mb-3">Barang Masuk</h4>

<div class="d-flex justify-content-between align-items-center mb-3">
    <small class="text-muted">Riwayat barang masuk</small>

    <a href="index.php?page=barang_masuk_create" class="btn btn-success btn-sm">
        <i class="fa fa-plus"></i> Tambah Barang Masuk
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body table-responsive">

        <?php if ($result && $result->num_rows > 0): ?>
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="60">ID</th>
                        <th>Produk</th>
                        <th width="140">Tanggal</th>
                        <th width="100">Jumlah</th>
                    </tr>
                </thead>
                <tbody>

                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= $row['tanggal'] ?></td>
                        <td><?= $row['jumlah'] ?></td>
                    </tr>
                <?php endwhile; ?>

                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning mb-0 text-center">
                Belum ada data barang masuk.
            </div>
        <?php endif; ?>

    </div>
</div>

</div>

<?php require 'partials/footer.php'; ?>

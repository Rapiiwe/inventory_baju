<?php
// Ambil history barang keluar + nama produk
$query = "
    SELECT 
        bk.id,
        bk.tanggal,
        bk.jumlah,
        p.nama
    FROM barang_keluar bk
    JOIN produk p ON bk.produk_id = p.id
    ORDER BY bk.tanggal DESC
";

$result = $koneksi->query($query);
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<!-- CONTENT AREA -->
<div class="col-md-10 p-4">

<h4 class="mb-3">Barang Keluar</h4>

<div class="d-flex justify-content-between align-items-center mb-3">
    <small class="text-muted">Riwayat barang keluar</small>

    <a href="index.php?page=barang_keluar_create" class="btn btn-danger btn-sm">
        <i class="fa fa-minus"></i> Tambah Barang Keluar
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
                Belum ada data barang keluar.
            </div>
        <?php endif; ?>

    </div>
</div>

</div>
<!-- END CONTENT -->

<?php require 'partials/footer.php'; ?>

<?php
// DATA PRODUK
$result = $koneksi->query("SELECT * FROM produk ORDER BY id DESC");
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">

    <h4 class="mb-3">Data Produk</h4>
    
    <div class="d-flex justify-content-between align-items-center mb-3">
        <small class="text-muted">Kelola data produk inventori</small>
    
        <a href="index.php?page=produk_create" class="btn btn-success btn-sm">
            <i class="fa fa-plus"></i> Tambah Produk
        </a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body table-responsive">
    
            <?php if ($result && $result->num_rows > 0): ?>
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">ID</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th width="120">Harga</th>
                            <th width="80">Stok</th>
                            <th width="160">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['id'] ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= $row['stok'] ?></td>
                            <td>
                                <a href="index.php?page=produk_edit&id=<?= $row['id'] ?>"
                                   class="btn btn-outline-primary btn-sm">
                                    Edit
                                </a>
    
                                <a href="index.php?page=produk_delete&id=<?= $row['id'] ?>"
                                   class="btn btn-outline-danger btn-sm"
                                   onclick="return confirm('Yakin hapus data?')">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
    
                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning mb-0 text-center">
                    Tidak ada data produk.
                </div>
            <?php endif; ?>
    
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>

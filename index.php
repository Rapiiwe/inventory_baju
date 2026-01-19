<?php
include 'config.php';

$sql = "SELECT * FROM produk";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventori Baju</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS custom kamu -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container my-5">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

    <!-- TOP BAR -->
    <div class="d-flex justify-content-between align-items-center mb-4">

    <div>
        <h4 class="fw-semibold mb-1">Daftar Produk</h4>
        <small class="text-muted">Kelola data produk inventori</small>
    </div>

    <div class="d-flex gap-2">
        <a href="dashboard.php" class="btn btn-outline-warning btn-sm">
            Dashboard
        </a>
        <a href="create.php" class="btn btn-success btn-sm">
            + Tambah
        </a>
        <a href="logout.php" class="btn btn-outline-danger btn-sm">
            Logout
        </a>
    </div>

</div>
    <!-- TABLE -->
    <div class="table-responsive">
        <?php if ($result->num_rows > 0): ?>
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-uppercase small">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="160">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="edit.php?id=<?= $row['id']; ?>" 
                                        class="btn btn-outline-primary btn-sm">
                                        Edit
                                    </a>

                                    <a href="delete.php?id=<?= $row['id']; ?>" 
                                    class="btn btn-outline-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                    Hapus
                                </a>
                            </div>
                        </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-warning text-center">
                Tidak ada produk yang tersedia.
            </div>
        <?php endif; ?>
    </div>

</div>
    </div>
</div>

<!-- JAM -->
<div id="clock"></div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php $koneksi->close(); ?>
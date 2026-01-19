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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Daftar Produk</h1>
        <a href="create.php" class="btn-tambah">Tambah Produk Baru</a>
        <div class="table-container">
            <?php if ($result->num_rows > 0): ?>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row["id"]; ?></td>
                            <td><?php echo $row["nama"]; ?></td>
                            <td><?php echo $row["kategori"]; ?></td>
                            <td><?php echo $row["harga"]; ?></td>
                            <td><?php echo $row["stok"]; ?></td>
                            <td>
                                <!-- Tombol Edit -->
                                <a href="edit.php?id=<?php echo $row["id"]; ?>" class="btn-edit">Edit</a> |
                                <!-- Tombol Hapus yang akan memicu modal konfirmasi -->
                                <button class="btn-hapus delete-btn" data-id="<?php echo $row['id']; ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            <?php else: ?>
                <p>Tidak ada produk yang tersedia.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Elemen untuk menampilkan waktu di pojok kanan bawah -->
    <div id="clock"></div>
    <a href="logout.php" class="btn-logout">Logout</a>

    
</body>
</html>

<?php $koneksi->close(); ?>

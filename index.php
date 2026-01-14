<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Sistem Inventory Baju Sekolah</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Manajemen Inventory Baju Sekolah</h1>
    <a href="add.php">Tambah Item</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Ukuran</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM items");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nama']}</td>
                <td>{$row['ukuran']}</td>
                <td>{$row['jumlah']}</td>
                <td>Rp {$row['harga']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a> |
                    <a href='delete.php?id={$row['id']}' onclick='return confirm(\"Hapus item?\")'>Hapus</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>

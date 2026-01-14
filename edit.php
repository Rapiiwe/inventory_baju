<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Item Inventory</h1>
    <?php
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM items WHERE id=$id");
    $row = $result->fetch_assoc();
    ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label>Nama:</label><input type="text" name="nama" value="<?php echo $row['nama']; ?>" required><br>
        <label>Ukuran:</label><input type="text" name="ukuran" value="<?php echo $row['ukuran']; ?>" required><br>
        <label>Jumlah:</label><input type="number" name="jumlah" value="<?php echo $row['jumlah']; ?>" required><br>
        <label>Harga:</label><input type="number" step="0.01" name="harga" value="<?php echo $row['harga']; ?>" required><br>
        <button type="submit" name="submit">Update</button>
    </form>
    <a href="index.php">Kembali</a>
    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $nama = $_POST['nama'];
        $ukuran = $_POST['ukuran'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $conn->query("UPDATE items SET nama='$nama', ukuran='$ukuran', jumlah='$jumlah', harga='$harga' WHERE id=$id");
        header("Location: index.php");
    }
    ?>
</body>
</html>
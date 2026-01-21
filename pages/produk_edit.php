<?php
$error = '';

// Ambil ID dari URL
$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?page=produk");
    exit;
}

// Ambil data produk
$stmt = $koneksi->prepare(
    "SELECT * FROM produk WHERE id = ? LIMIT 1"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    header("Location: index.php?page=produk");
    exit;
}

$produk = $result->fetch_assoc();

// Proses update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $harga = (int) str_replace('.', '', $_POST['harga']);
    $stok     = $_POST['stok'];

    if (!$nama || !$kategori || $harga === '' || $stok === '') {
        $error = "Semua field wajib diisi!";
    } else {

        $update = $koneksi->prepare(
            "UPDATE produk
             SET nama = ?, kategori = ?, harga = ?, stok = ?
             WHERE id = ?"
        );
        $update->bind_param(
            "ssiii",
            $nama,
            $kategori,
            $harga,
            $stok,
            $id
        );

        if ($update->execute()) {
            header("Location: index.php?page=produk");
            exit;
        } else {
            $error = "Gagal memperbarui data produk.";
        }
    }
}
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<!-- CONTENT AREA -->
<div class="col-md-10 p-4">

<h4 class="mb-4">Edit Produk</h4>

<div class="card shadow-sm">
    <div class="card-body">

        <?php if ($error): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php?page=produk_edit&id=<?= $id ?>">

            <div class="mb-3">
                <label class="form-label">Nama Produk</label>
                <input type="text"
                       name="nama"
                       class="form-control"
                       value="<?= htmlspecialchars($produk['nama']) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <input type="text"
                       name="kategori"
                       class="form-control"
                       value="<?= htmlspecialchars($produk['kategori']) ?>"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga</label>
                <input type="text"
                    name="harga"
                    id="harga"
                    class="form-control"
                    value="<?= (int)$produk['harga'] ?>"
                    required>
            </div>



            <div class="mb-3">
                <label class="form-label">Stok</label>
                <input type="number"
                       name="stok"
                       class="form-control"
                       value="<?= $produk['stok'] ?>"
                       min="0"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Simpan Perubahan
                </button>

                <a href="index.php?page=produk" class="btn btn-secondary">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

</div>
<!-- END CONTENT -->

<?php require 'partials/footer.php'; ?>

<script>
const hargaInput = document.getElementById('harga');

// format saat user mengetik
hargaInput.addEventListener('input', function () {
    let value = this.value.replace(/[^0-9]/g, '');
    this.value = formatRupiah(value);
});

function formatRupiah(angka) {
    if (!angka) return '';
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>


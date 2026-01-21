<?php
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nama     = trim($_POST['nama']);
    $kategori = trim($_POST['kategori']);
    $harga = (int) str_replace('.', '', $_POST['harga']);
    $stok     = $_POST['stok'];

    if (!$nama || !$kategori || $harga === '' || $stok === '') {
        $error = "Semua field wajib diisi!";
    } else {

        $stmt = $koneksi->prepare(
            "INSERT INTO produk (nama, kategori, harga, stok)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssii", $nama, $kategori, $harga, $stok);

        if ($stmt->execute()) {
            header("Location: index.php?page=produk");
            exit;
        } else {
            $error = "Gagal menyimpan data produk.";
        }
    }
}
?>

<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">

    <h4 class="mb-4">Tambah Produk</h4>
    
    <div class="card shadow-sm">
        <div class="card-body">
    
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
    
            <form method="post" action="index.php?page=produk_create">
    
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           required>
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text"
                           name="kategori"
                           class="form-control"
                           required>
                </div>
    
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="text"
                        name="harga"
                        id="harga"
                        class="form-control"
                        placeholder="Contoh: 150000"
                        required>
                </div>

    
                <div class="mb-3">
                    <label class="form-label">Stok Awal</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           min="0"
                           required>
                </div>
    
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Simpan
                    </button>
    
                    <a href="index.php?page=produk" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>
    
            </form>
    
        </div>
    </div>
</div>

<?php require 'partials/footer.php'; ?>

<script>
const hargaInput = document.getElementById('harga');

hargaInput.addEventListener('keyup', function () {
    let value = this.value.replace(/[^0-9]/g, '');
    this.value = formatRupiah(value);
});

function formatRupiah(angka) {
    return angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

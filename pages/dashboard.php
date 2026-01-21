<?php
// DATA RINGKASAN
$totalProduk = 0;
$totalStok   = 0;

// Total Produk
$resultProduk = $koneksi->query(
    "SELECT COUNT(*) AS total FROM produk"
);
if ($resultProduk) {
    $totalProduk = $resultProduk->fetch_assoc()['total'] ?? 0;
}

// Total Stok
$resultStok = $koneksi->query(
    "SELECT SUM(stok) AS total FROM produk"
);
if ($resultStok) {
    $totalStok = $resultStok->fetch_assoc()['total'] ?? 0;
}
?>

<?php
// TOTAL PRODUK
$totalProduk = $koneksi
    ->query("SELECT COUNT(*) AS total FROM produk")
    ->fetch_assoc()['total'] ?? 0;

// TOTAL STOK
$totalStok = $koneksi
    ->query("SELECT SUM(stok) AS total FROM produk")
    ->fetch_assoc()['total'] ?? 0;

// TOTAL BARANG MASUK
$totalMasuk = $koneksi
    ->query("SELECT SUM(jumlah) AS total FROM barang_masuk")
    ->fetch_assoc()['total'] ?? 0;

// TOTAL BARANG KELUAR
$totalKeluar = $koneksi
    ->query("SELECT SUM(jumlah) AS total FROM barang_keluar")
    ->fetch_assoc()['total'] ?? 0;
?>


<?php require 'partials/header.php'; ?>
<?php require 'partials/sidebar.php'; ?>

<div class="col-md-10 p-4">

    <h4 class="mb-4">Dashboard</h4>

    <div class="row g-4">

        <!-- CARD TOTAL PRODUK -->
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3><?= $totalProduk ?></h3>
                        <p class="mb-0">Data Produk</p>
                    </div>
                    <i class="fa fa-box fa-3x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- CARD TOTAL STOK -->
        <div class="col-md-4">
            <div class="card text-white bg-success shadow">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3><?= $totalStok ?></h3>
                        <p class="mb-0">Total Stok</p>
                    </div>
                    <i class="fa fa-layer-group fa-3x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">

        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white fw-bold">
                    Grafik Barang Masuk & Keluar
                </div>
                <div class="card-body">
                    <canvas id="stokChart" height="120"></canvas>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5">
        <a href="index.php?page=produk" class="btn btn-success">
            <i class="fa fa-cogs"></i> Kelola Produk
        </a>
    </div>
</div>

<?php require 'partials/footer.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('stokChart').getContext('2d');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Barang Masuk', 'Barang Keluar'],
        datasets: [{
            label: 'Jumlah',
            data: [
                <?= (int)$totalMasuk ?>,
                <?= (int)$totalKeluar ?>
            ],
            backgroundColor: [
                'rgba(25, 135, 84, 0.7)',   // hijau
                'rgba(220, 53, 69, 0.7)'    // merah
            ],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

// Fungsi untuk memformat angka menjadi format Rupiah
function formatRupiah(angka, prefix = 'Rp. ') {
    var number_string = angka.replace(/[^,\d]/g, '').toString(); // Hapus semua selain angka dan koma
    var split = number_string.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return prefix + rupiah;
}

// Fungsi untuk membersihkan format Rupiah dan mengembalikan angka murni
function removeRupiahFormat(value) {
    return value.replace(/[^0-9]/g, ''); // Hapus simbol Rp dan pemisah ribuan
}

// Menambahkan event listener pada input harga untuk memformat otomatis
document.addEventListener('DOMContentLoaded', function() {
    var hargaElements = document.querySelectorAll('.harga');
    hargaElements.forEach(function(element) {
        // Format harga yang sudah ada ketika halaman dimuat
        var angka = element.value || element.innerText; // Bisa kosong atau diambil dari innerText
        element.value = formatRupiah(angka);

        // Menghapus format Rupiah saat input
        element.addEventListener('input', function(e) {
            var angka = e.target.value.replace(/[^0-9]/g, ''); // Mengambil angka murni
            e.target.value = formatRupiah(angka);
        });
    });

    // Sebelum form disubmit, pastikan harga yang dikirim adalah angka murni
    document.querySelectorAll('form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            var hargaInput = document.getElementById('harga');
            var hargaValue = hargaInput.value;
            
            // Hapus format Rupiah sebelum mengirim ke server
            hargaInput.value = removeRupiahFormat(hargaValue);
        });
    });
});

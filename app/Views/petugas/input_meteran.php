<?= $this->extend('petugas/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Hasil Survey</h6>
    </div>
    <div class="card-body">
    <form action="<?= base_url('/petugas/simpan-meteran/' . $pengguna['id_meteran']) ?>" method="post">
    <?= csrf_field() ?>
        <div class="mb-3">
            <label class="form-label"><strong>ID Meteran</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['id_meteran']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Nama</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['nama']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Alamat</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['alamat']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Meteran Awal</strong></label>
            <input type="text" class="form-control" name="meteran_awal" value="<?= esc($transaksiTerbaru['meteran_akhir'] ?? 0) ?>" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Meteran Akhir</strong></label>
            <input type="number" id="meteran_akhir" class="form-control" name="meteran_akhir" required>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Jumlah Pakai</strong></label>
            <input type="text" id="jumlah_pakai" class="form-control" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Tagihan</strong></label>
            <input type="text" id="tagihan" class="form-control" disabled>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Simpan Data</button>
        <a href="<?= base_url('/petugas/data-meteran') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
    </form>
</div>

<script>
document.getElementById('meteran_akhir').addEventListener('input', function() {
    let meteranAwal = <?= $transaksiTerbaru['meteran_akhir'] ?? 0 ?>;
    let meteranAkhir = parseInt(this.value) || 0;
    
    let jumlahPakai = Math.max(meteranAkhir - meteranAwal, 0);
    let tagihan = jumlahPakai * 100000;

    document.getElementById('jumlah_pakai').value = jumlahPakai;
    document.getElementById('tagihan').value = tagihan.toLocaleString('id-ID'); 
});
</script>
<?= $this->endSection() ?>

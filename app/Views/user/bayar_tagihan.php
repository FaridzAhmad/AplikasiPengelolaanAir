<?= $this->extend('user/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Pembayaran Tagihan</h6>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>
        <p><strong>Nomor Invoice:</strong> <?= esc($invoice['invoice']); ?></p>
        <p><strong>Jumlah Tagihan:</strong> Rp <?= number_format($invoice['jumlah_tagihan'], 0, ',', '.'); ?></p>
        <form action="<?= base_url('/user/proses_pembayaran'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="invoice" value="<?= esc($invoice['invoice']); ?>">

            <div class="mb-3">
                <label class="form-label">ID Meteran</label>
                <input type="text" class="form-control" value="<?= esc($pengguna['id_meteran']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="<?= esc($pengguna['nama']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" class="form-control" value="<?= esc($pengguna['alamat']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Bukti Pembayaran</label>
                <input type="file" name="bukti_bayar" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Bukti Pembayaran</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

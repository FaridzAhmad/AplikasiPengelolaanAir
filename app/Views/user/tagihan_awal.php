<?= $this->extend('user/dashboard') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Konfirmasi Registrasi Awal</h6>
    </div>
    <div class="card-body">
            <?php if (!$pengguna['survey']) : ?>
            <div class="alert alert-info text-center">
                <h5 class="font-weight-bold">Petugas belum dikirim, tunggu konfirmasi admin</h5>
                <p>Silakan tunggu, pembayaran Anda sedang dalam proses verifikasi oleh admin.</p>
                <i class="fas fa-clock fa-3x text-primary mt-3"></i>
            </div>
        <?php elseif ($pengguna['status_bayar'] === 'belum bayar') : ?>
            <form action="<?= base_url('/user/pembayaran-awal'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="id_meteran" value="<?= esc($pengguna['id_meteran']); ?>">

                <div class="mb-3">
                    <label class="form-label">ID Meteran</label>
                    <input type="text" class="form-control" value="<?= esc($pengguna['id_meteran']); ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">NIK</label>
                    <input type="text" class="form-control" value="<?= esc($pengguna['nik']); ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">RT</label>
                    <input type="text" class="form-control" value="<?= esc($pengguna['rt']); ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">RW</label>
                    <input type="text" class="form-control" value="<?= esc($pengguna['rw']); ?>" disabled>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea class="form-control" disabled><?= esc($pengguna['alamat']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Foto Bukti Transfer</label>
                    <input type="file" name="bukti_bayar" class="form-control" accept="image/*" required>
                </div>

                <button type="submit" class="btn btn-primary">Konfirmasi</button>
            </form>
        <?php else : ?>
            <div class="alert alert-info text-center">
                <h5 class="font-weight-bold">Bukti Pembayaran Sedang Ditinjau</h5>
                <p>Silakan tunggu, pembayaran Anda sedang dalam proses verifikasi oleh admin.</p>
                <i class="fas fa-clock fa-3x text-primary mt-3"></i>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection() ?>

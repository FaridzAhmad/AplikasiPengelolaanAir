
<?= $this->extend('user/dashboard') ?>


<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengajuan Pemutusan Sambungan</h6>
    </div>
    <div class="card-body">
        <?php if ($pengajuan): ?>
            <div class="alert alert-warning">
                <strong>Pengajuanmu Sedang Diproses.</strong>
            </div>
        <?php else: ?>
            <form action="<?= base_url('/user/ajukan-pemutusan'); ?>" method="post">
                <input type="hidden" name="id" value="<?= esc($pengguna['id']); ?>">

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
                    <label class="form-label">Alasan Pemutusan</label>
                    <textarea name="alasan" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-danger">Ajukan Pemutusan</button>
            </form>
        <?php endif; ?>
    </div>
</div>




<?= $this->endSection() ?>
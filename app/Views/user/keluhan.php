<?= $this->extend('user/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Form Pengaduan Keluhan</h6>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <form action="<?= base_url('/user/keluhan/simpan'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_meteran" value="<?= esc($pengguna['id_meteran']); ?>">

            <div class="mb-3">
                <label class="form-label">ID Meteran</label>
                <input type="text" class="form-control" value="<?= esc($pengguna['id_meteran']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="<?= esc($pengguna['nama']); ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label">Keluhan</label>
                <textarea name="keluhan" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Foto Bukti Keluhan (Wajib)</label>
                <input type="file" name="foto" class="form-control" accept="image/*" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Keluhan</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend('petugas/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Hasil Survey</h6>
    </div>
    <div class="card-body">
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
            <label class="form-label"><strong>Status Survey</strong></label>
            <input type="text" class="form-control" value="<?= esc($survey['status']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Tanggal Survey</strong></label>
            <input type="text" class="form-control" value="<?= esc($survey['tanggal_survey'] ?? 'Belum Ditentukan') ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Foto Survey</strong></label>
            <?php if (!empty($survey['foto'])): ?>
                <img src="<?= base_url($survey['foto']) ?>" class="img-fluid img-thumbnail" width="300">
            <?php else: ?>
                <p class="text-danger">Foto belum diunggah</p>
            <?php endif; ?>
        </div>

        <!-- Form Upload Foto -->
        <form action="<?= base_url('/petugas/hasil-survey/upload') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <input type="hidden" name="id_meteran" value="<?= esc($pengguna['id_meteran']) ?>">
            
            <div class="mb-3">
                <label class="form-label"><strong>Unggah Foto Survey</strong></label>
                <input type="file" class="form-control" name="foto_survey" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <a href="<?= base_url('/petugas/sambungan-baru') ?>" class="btn btn-secondary mt-3">Kembali</a>
    </div>
</div>

<?= $this->endSection() ?>

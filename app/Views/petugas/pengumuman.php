<?= $this->extend('petugas/dashboard') ?>

<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
    </div>
    <div class="card-body">
        <?php if (!empty($pengumuman)): ?>
            <?php foreach ($pengumuman as $p): ?>
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-info"><?= esc($p['judul']); ?></h6>
                    </div>
                    <div class="card-body">
                        <h4><?= esc($p['isi']); ?></h4>
                        <div class="d-flex justify-content-end">
                            <small class="text-muted">Tanggal: <?= esc($p['created_at']); ?></small>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning">Tidak ada pengumuman saat ini.</div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

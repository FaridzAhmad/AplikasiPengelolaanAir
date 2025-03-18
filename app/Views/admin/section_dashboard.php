<?= $this->extend('admin/dashboard') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Sambungan Baru</h5>
                <p class="card-text"><?= esc($total_sambungan_baru); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Total Pengguna</h5>
                <p class="card-text"><?= esc($total_pengguna); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Total Petugas</h5>
                <p class="card-text"><?= esc($total_petugas); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">Total Pengumuman</h5>
                <p class="card-text"><?= esc($total_pengumuman); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Tagihan Belum Lunas</h5>
                <p class="card-text"><?= esc($total_tagihan_belum_lunas); ?></p>
            </div>
        </div>
    </div>

    <div class="col-md-4 mt-3">
        <div class="card bg-secondary text-white">
            <div class="card-body">
                <h5 class="card-title">Tagihan Lunas</h5>
                <p class="card-text"><?= esc($total_tagihan_lunas); ?></p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
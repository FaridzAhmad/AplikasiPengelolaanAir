<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label"><strong>ID</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['id']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Nama</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['nama']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>NIK</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['nik']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>RW</strong></label>
            <div class="d-flex">
                <input type="text" class="form-control me-2" value="<?= esc($pengguna['rt']) ?>" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>RW</strong></label>
            <div class="d-flex">
                <input type="text" class="form-control" value="<?= esc($pengguna['rw']) ?>" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Alamat</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['alamat']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>No HP</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['no_hp']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Status Meteran</strong></label>
            <input type="text" class="form-control" value="<?= esc($pengguna['status_meteran']) ?>" disabled>
        </div>

        <a href="<?= base_url('/admin/customer') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>



<?= $this->endSection() ?>

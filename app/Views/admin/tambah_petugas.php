<?= $this->extend('admin/dashboard') ?>

<?= $this->section('content') ?>

<?= session()->getFlashdata('success'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tambah Petugas</h6>
    </div>
    <div class="card-body">
    <form action="<?= base_url('/admin/petugas/simpan') ?>" method="post" enctype="multipart/form-data">
    <h6 class="text-primary">Data Petugas</h6>

    <div class="mb-3">
        <label class="form-label">Nama Petugas</label>
        <input type="text" name="nama_petugas" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Alamat</label>
        <textarea name="alamat_petugas" class="form-control" rows="2" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">No HP</label>
        <input type="text" name="no_hp_petugas" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Foto</label>
        <input type="file" name="foto_petugas" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

</div>

</div>

<?= $this->endSection() ?>

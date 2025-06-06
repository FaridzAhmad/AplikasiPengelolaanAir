<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Teknisi</h6>
    </div>
    <div class="card-body">
        <div class="p-3 mb-4 text-center">
            <img src="<?= base_url('uploads/teknisi/' . esc($teknisi['foto'])) ?>" 
                alt="Foto teknisi" 
                class="img-thumbnail mx-auto d-block" 
                style="max-width: 150px; height: auto; border: 3px solid #007bff;">

            <h5 class="mt-3 text-primary"><?= esc($teknisi['nama']) ?></h5>
            <p class="text-muted"><?= esc($teknisi['users_id']) ?></p>
        </div>
        <div class="mb-3">
            <label class="form-label"><strong>ID</strong></label>
            <input type="text" class="form-control" value="<?= esc($teknisi['users_id']) ?>" disabled>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><strong>Nama</strong></label>
            <input type="text" class="form-control" value="<?= esc($teknisi['nama']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Alamat</strong></label>
            <input type="text" class="form-control" value="<?= esc($teknisi['alamat']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>No HP</strong></label>
            <input type="text" class="form-control" value="<?= esc($teknisi['no_hp']) ?>" disabled>
        </div>

        <a href="<?= base_url('/admin/petugas') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>



<?= $this->endSection() ?>

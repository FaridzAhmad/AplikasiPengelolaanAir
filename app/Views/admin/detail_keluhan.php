<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label"><strong>ID</strong></label>
            <input type="text" class="form-control" value="<?= esc($keluhan['id_meteran']) ?>" disabled>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><strong>Nama</strong></label>
            <input type="text" class="form-control" value="<?= esc($keluhan['nama_pengguna']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>Alamat</strong></label>
            <input type="text" class="form-control" value="<?= esc($keluhan['alamat']) ?>" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label"><strong>No HP</strong></label>
            <input type="text" class="form-control" value="<?= esc($keluhan['no_hp']) ?>" disabled>
        </div>
        
        <div class="mb-3">
            <label class="form-label"><strong>Pilih Petugas</strong></label>
            <select class="form-control" name="petugas">
                <option value="">-- Pilih Petugas --</option>
                <?php foreach ($petugas as $p) : ?>
                    <option value="<?= esc($p['users_id']) ?>">
                        <?= esc($p['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <a href="<?= base_url('/admin/petugas') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>



<?= $this->endSection() ?>

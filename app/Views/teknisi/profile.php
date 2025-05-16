<?= $this->extend('teknisi/dashboard') ?>

<?= $this->section('content') ?>
<?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Detail Pengguna</h6>
    </div>
    <div class="card-body">
        <form action="/teknisi/update-profil" method="post" enctype="multipart/form-data">
            <input type="hidden" name="users_id" value="<?= esc($profile['users_id']) ?>">

            <div class="mb-3">
                <label class="form-label"><strong>Foto Profil</strong></label><br>
                <img id="previewFoto" src="<?= base_url('uploads/teknisi/' . esc($profile['foto'])) ?>" alt="Foto Teknisi" class="img-thumbnail mb-2" style="max-width: 200px;">
                <input type="file" name="foto" class="form-control" accept="image/*" onchange="previewGambar(this)">
            </div>


            <div class="mb-3">
                <label class="form-label"><strong>ID TEKNISI</strong></label>
                <input type="text" class="form-control" value="<?= esc($profile['users_id']) ?>" disabled>
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Nama</strong></label>
                <input type="text" class="form-control" name="nama" value="<?= esc($profile['nama']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>Alamat</strong></label>
                <input type="text" class="form-control" name="alamat" value="<?= esc($profile['alamat']) ?>">
            </div>

            <div class="mb-3">
                <label class="form-label"><strong>No HP</strong></label>
                <input type="text" class="form-control" name="no_hp" value="<?= esc($profile['no_hp']) ?>">
            </div>

            <div class="d-flex justify-content-between">
                <a href="<?= base_url('/admin/customer') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<script>
    function previewGambar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewFoto').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<?= $this->endSection() ?>
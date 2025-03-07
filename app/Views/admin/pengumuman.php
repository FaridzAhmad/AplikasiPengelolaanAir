
<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
        <a href="<?= base_url('/admin/pengumuman/tambah') ?>" class="btn btn-primary">Tambah Pengumuman</a>
    </div>
    <div class="card-body">
    <table class="table table-bordered" id="dataCustomer" class="display" width="100%" cellspacing="0">
            <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Isi</th>
            <th>Target</th>
            <th>Mulai</th>
            <th>Berakhir</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($pengumumans as $pengumuman): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($pengumuman['judul']); ?></td>
            <td><?= esc($pengumuman['isi']); ?></td>
            <td><?= esc($pengumuman['target']); ?></td>
            <td><?= esc($pengumuman['awal_berlaku']); ?></td>
            <td><?= esc($pengumuman['akhir_berlaku']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
            </table>
    </div>
</div>
<?= $this->endSection() ?>
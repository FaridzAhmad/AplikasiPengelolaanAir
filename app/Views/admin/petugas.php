
<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Petugas</h6>
            <div>
                <a href="<?= base_url('/admin/petugas/tambah') ?>" class="btn btn-primary btn-sm">Tambah Petugas</a>
                <a href="<?= base_url('/admin/teknisi/tambah') ?>" class="btn btn-warning btn-sm">Tambah Teknisi</a>
            </div>
        </div>
    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>ID Petugas</th>
                        <th>Nama Petugas</th>
                        <th>Alamat</th>
                        <th>No Hp</th>
                        <th>Jobdesk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1; foreach ($petugas as $p) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td>
                            <img src="<?= base_url(($p['role'] === 'Teknisi' ? 'uploads/teknisi/' : 'uploads/petugas/') . esc($p['foto'])) ?>" 
                                alt="Foto <?= esc($p['nama']) ?>" width="100">
                            </td>
                            <td><?= esc($p['users_id']) ?></td>
                            <td><?= esc($p['nama']) ?></td>
                            <td><?= esc($p['alamat']) ?></td>
                            <td><?= esc($p['no_hp']) ?></td>
                            <td><?= esc($p['role']) ?></td>
                            <td>
                            <a href="<?= base_url('/admin/' . ($p['role'] === 'Teknisi' ? 'teknisi' : 'petugas') . '/' . esc($p['users_id'])) ?>" 
                            class="btn btn-info btn-sm">
                                <i class="fa fa-eye"></i> Lihat
                            </a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
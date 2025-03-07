
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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Keluhan Customer</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" class="display" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Meteran</th>
                        <th>Keluhan</th>
                        <th>Petugas</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($keluhan as $k) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($k['id_meteran']) ?></td>
                            <td><?= esc($k['keluhan']) ?></td>
                            <td><?= $k['petugas'] ? esc($k['petugas']) : '<span class="text-muted">Belum Ditugaskan</span>' ?></td>
                            <td>
                                <?php
                                $badge = 'secondary';
                                if ($k['status'] == 'review') {
                                    $badge = 'warning';
                                } elseif ($k['status'] == 'ditolak') {
                                    $badge = 'danger';
                                } elseif ($k['status'] == 'diterima') {
                                    $badge = 'success';
                                }
                                ?>
                                <span class="badge bg-<?= $badge ?>"><?= esc(ucwords($k['status'])) ?></span>
                            </td>
                            <td><?= date('d-m-Y H:i', strtotime($k['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('/admin/keluhan/' . esc($k['id'])) ?>" class="btn btn-info btn-sm">
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
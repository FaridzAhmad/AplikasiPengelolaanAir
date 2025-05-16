
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
        <h6 class="m-0 font-weight-bold text-primary">Data Pembayaran</h6>
    </div>
    <div class="card-body">
    <table class="table table-bordered" id="dataCustomer" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Meteran</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Status Pembayaran</th>
                <th>Bukti Bayar</th>
                <th>Nominal</th>
                <th>Tanggal Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($transaksi as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['id_meteran']); ?></td>
                    <td><?= esc($row['nama']); ?></td>
                    <td><?= esc($row['alamat']); ?></td>
                    <td><?= esc($row['no_hp']); ?></td>
                    <td>
                        <span class="badge <?= ($row['status_bayar'] == 'sudah bayar') ? 'bg-success' : 'bg-danger' ?>">
                            <?= esc($row['status_bayar']); ?>
                        </span>
                    </td>
                    <td>
                        <?php if (!empty($row['bukti_bayar'])): ?>
                            <a href="<?= base_url($row['bukti_bayar']); ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                            <span class="text-danger">Belum Ada Bukti</span>
                        <?php endif; ?>
                    </td>
                    <td>Rp<?= number_format($row['nominal'], 2, ',', '.'); ?></td>
                    <td>
                        <?php if (!empty($row['tanggal_pembayaran'])): ?>
                            <span class="text-success"><?= date('d-m-Y', strtotime($row['tanggal_pembayaran'])); ?></span>
                        <?php else: ?>
                            <span class="text-danger">Belum Ada Tanggal Pembayaran</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($row['status_bayar'] == 'sudah bayar' && empty($row['tanggal_pembayaran'])) : ?>
                            <form action="<?= base_url('/admin/konfirmasi-pembayaran/' . $row['id_meteran']); ?>" method="post" onsubmit="return confirm('Terima bukti pembayaran ini?');">
                                <?= csrf_field(); ?>
                                <button type="submit" class="btn btn-success btn-sm">✔ Terima Pembayaran</button>
                            </form>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
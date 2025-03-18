
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
                <th>Invoice</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Status Pembayaran</th>
                <th>Jumlah Tagihan</th>
                <th>Denda</th>
                <th>Bukti Bayar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($invoices as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= esc($row['invoice']); ?></td>
                    <td><?= esc($row['nama']); ?></td>
                    <td><?= esc($row['alamat']); ?></td>
                    <td><?= esc($row['status_bayar']); ?></td>
                    <td>Rp<?= number_format($row['jumlah_tagihan'], 2, ',', '.'); ?></td>
                    <td><?= esc($row['denda']); ?></td>
                    <td>
                        <?php if (!empty($row['bukti_bayar'])): ?>
                            <a href="<?= base_url($row['bukti_bayar']); ?>" target="_blank">Lihat Bukti</a>
                        <?php else: ?>
                            <span class="text-danger">Belum Ada Bukti</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <form action="<?= base_url('/admin/konfirmasi-bulanan/' . $row['invoice']); ?>" method="post" onsubmit="return confirm('Terima bukti pembayaran ini?');">
                            <?= csrf_field(); ?>
                            <button type="submit" class="btn btn-success btn-sm">✔ Terima Pembayaran</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->extend('user/dashboard') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Tagihan</h6>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>
        <?php 
        foreach ($tagihan as $t): 
            if (!empty($t['tanggal_pembayaran']) && $t['status_bayar'] === 'Belum Lunas'):
        ?>
            <div class="card mb-3">
                <div class="card-body bg-warning text-dark">
                    <h5 class="card-title">Pembayaran Invoice <b>#<?= esc($t['invoice']); ?></b> Sedang Dicek</h5>
                    <p class="card-text">Harap tunggu update dari admin terkait verifikasi pembayaran.</p>
                </div>
            </div>
        <?php endif; endforeach; ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Jumlah Tagihan</th>
                        <th>Batas Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Bukti Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($tagihan as $t): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($t['invoice']); ?></td>
                            <td><?= 'Rp ' . number_format($t['jumlah_tagihan'], 0, ',', '.'); ?></td>
                            <td><?= esc($t['batas_waktu_bayar']); ?></td>
                            <td><?= esc($t['status_bayar']); ?></td>
                            <td>
                                <?php if ($t['tanggal_pembayaran'] == null): ?>
                                    <span style="color: red;">Belum Bayar</span>
                                <?php else: ?>
                                    <span style="color: green;"><?= esc($t['tanggal_pembayaran']); ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                                <?php if ($t['bukti_bayar'] == null): ?>
                                    <span style="color: red;">Belum Upload Bukti</span>
                                <?php else: ?>
                                    <span style="color: green;"><?= esc($t['bukti_bayar']); ?></span>
                                <?php endif; ?>
                            </td>

                            <td>
                            <?php if (empty($t['tanggal_pembayaran'])): ?>
                                <a href="<?= site_url('user/bayar_tagihan/' . $t['invoice']); ?>" class="btn btn-success btn-sm">
                                    <i class="fa fa-money-bill"></i> Bayar Sekarang
                                </a>
                            <?php elseif (!empty($t['tanggal_pembayaran'])): ?>
                                <span class="badge bg-success text-white">Sudah Dibayar</span>
                            <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
</div>

<?= $this->endSection() ?>

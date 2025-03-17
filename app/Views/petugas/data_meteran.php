<?= $this->extend('petugas/dashboard') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Input Data Meteran</h6>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Meteran</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Status Meteran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $u): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($u['id_meteran']); ?></td>
                        <td><?= esc($u['nama']); ?></td>
                        <td><?= esc($u['alamat']); ?></td>
                        <td><?= esc($u['no_hp']); ?></td>
                        <td>
                            <span class="badge <?= ($u['status_meteran'] == 'aktif') ? 'bg-success' : 'bg-warning' ?>">
                                <?= esc($u['status_meteran']); ?>
                            </span>
                        </td>
                        <td>
                            <a href="<?= base_url('/petugas/input-meteran/' . esc($u['id_meteran'])); ?>" 
                            class="btn btn-primary btn-sm">
                                Input Data Meteran
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

<?= $this->extend('petugas/dashboard') ?>

<?= $this->section('content') ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Sambungan Baru</h6>
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
                    <th>Status Survey</th>
                    <th>Tanggal Survey</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($surveys as $survey): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($survey['id_meteran']); ?></td>
                        <td><?= esc($survey['nama']); ?></td>
                        <td><?= esc($survey['alamat']); ?></td>
                        <td><?= esc($survey['no_hp']); ?></td>
                        <td>
                            <span class="badge <?= ($survey['status'] == 'sudah disurvey') ? 'bg-success' : 'bg-warning' ?>">
                                <?= esc($survey['status']); ?>
                            </span>
                        </td>
                        <td><?= esc($survey['tanggal_survey'] ?? 'Belum Ditentukan'); ?></td>
                        <td>
                            <a href="<?= base_url('/petugas/hasil_survey/' . esc($survey['id_meteran'])); ?>" 
                            class="btn btn-primary btn-sm">
                                Isi Hasil Survey
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

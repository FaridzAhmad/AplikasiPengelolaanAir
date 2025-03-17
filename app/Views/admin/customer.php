<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Customer</h6>
    </div>
    <div class="card-body">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
    <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" class="display" width="100%" cellspacing="0">
            <thead>
        <tr>
            <th>No</th>
            <th>ID Meteran</th>
            <th>Nama</th>
            <th>RT</th>
            <th>RW</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Status  Meteran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($penggunas as $pengguna): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($pengguna['nama']); ?></td>
            <td><?= esc($pengguna['id_meteran']); ?></td>
            <td><?= esc($pengguna['rt']); ?></td>
            <td><?= esc($pengguna['rw']); ?></td>
            <td><?= esc($pengguna['alamat']); ?></td>
            <td><?= esc($pengguna['no_hp']); ?></td>
            <td>
            <?php
                $status = $pengguna['status_meteran'];
                $badgeColor = 'bg-secondary'; 
                $extraBadge = ''; 

                if ($status == 'aktif') {
                    $badgeColor = 'bg-success'; 
                } elseif ($status == 'putus') {
                    $badgeColor = 'bg-warning'; 

                    $pemutusanModel = new \App\Models\PemutusanModel();
                    $pemutusan = $pemutusanModel->where('id_meteran', $pengguna['id_meteran'])
                                                ->where('status', 'disetujui')
                                                ->first();

                    if ($pemutusan) {
                        $extraBadge = '<span class="badge bg-warning ms-2">Pengajuan Oleh Pengguna</span>'; 
                    }else{
                        $extraBadge = '<span class="badge bg-warning ms-2">Diputus Admin</span>'; 
                    }
                } elseif ($status == 'belum aktif') {
                    $badgeColor = 'bg-danger'; 
                }
                ?>

                <span class="badge <?= $badgeColor; ?>" style="color: white;">
                    <?= esc($status); ?>
                </span>
                <?= $extraBadge; ?>
            </td>

            <td>
                <input type="hidden" name="id" value="<?= esc($pengguna['id_meteran']); ?>">

                <a href="<?= base_url('/admin/detail/' . esc($pengguna['id_meteran'])); ?>" class="btn btn-info btn-sm">
                    <i class="fa fa-eye"></i>
                </a>

                <?php if ($pengguna['status_meteran'] == 'aktif') : ?>
                    <form action="<?= base_url('/admin/putus-sambungan'); ?>" method="post" class="d-inline">
                        <input type="hidden" name="id" value="<?= esc($pengguna['id']); ?>">
                        <input type="hidden" name="status_meteran" value="putus">
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin memutus sambungan ini?');">
                            <i class="fa fa-power-off"></i> Putus
                        </button>
                    </form>
                <?php endif; ?>

            </td>

        </tr>
        <?php endforeach; ?>
    </tbody>
            </table>
      </form>
    </div>
  </div>
</div>

        </div>
    </div>
</div>


<?= $this->endSection() ?>


    </body>
</html>

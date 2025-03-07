<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Customer Belum Aktif</h6>
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
            <th>Status Meteran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($users as $user): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($user['id_meteran']); ?></td>
            <td><?= esc($user['nama']); ?></td>
            <td><?= esc($user['rt']); ?></td>
            <td><?= esc($user['rw']); ?></td>
            <td><?= esc($user['alamat']); ?></td>
            <td><?= esc($user['no_hp']); ?></td>
            <td>
                <span class="badge bg-warning" style="color:white"><?= esc($user['status_meteran']); ?></span>
            </td>   
            <td>
            <form action="<?= base_url('/admin/update-status'); ?>" method="post">
                <input type="hidden" name="id" value="<?= esc($user['id']); ?>">
                <?php if ($user['status_meteran'] == 'belum aktif'): ?>
                    <button type="submit" name="status_meteran" value="aktif" class="btn btn-success btn-sm ms-2">
                        <i class="fa fa-check"></i>
                    </button>
                    <a href="<?= base_url('/admin/detail/' . esc($user['id_meteran'])); ?>" class="btn btn-info btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                <?php endif; ?>
            </form>       
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
<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Pengajuan Pemutusan Sambungan</h6>
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
            <th>Alasan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($pemutusans as $pemutusan): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= esc($pemutusan['id_meteran']); ?></td>
            <td><?= esc($pemutusan['nama']); ?></td>
            <td><?= esc($pemutusan['rt']); ?></td>
            <td><?= esc($pemutusan['rw']); ?></td>
            <td><?= esc($pemutusan['alamat']); ?></td>
            <td><?= esc($pemutusan['alasan']); ?></td>
            <td>
                <form action="<?= base_url('/admin/acc-pemutusan'); ?>" method="post" class="d-inline">
                    <input type="hidden" name="id" value="<?= esc($pemutusan['id']); ?>">
                    <input type="hidden" name="id_meteran" value="<?= esc($pemutusan['id_meteran']); ?>">
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin memutus sambungan ini?');">
                        <i class="fa fa-power-off"></i> Putus
                    </button>
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

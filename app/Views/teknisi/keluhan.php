<?= $this->extend('teknisi/dashboard') ?>

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
                    <th>Keluhan</th>
                    <th>Foto</th>
                    <th>Tanggal Dibuat</th>
                    <th>Tanggal Selesai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($keluhan as $k): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= esc($k['id_meteran']); ?></td>
                        <td><?= esc($k['nama']); ?></td>
                        <td><?= esc($k['alamat']); ?></td>
                        <td><?= esc($k['no_hp']); ?></td>
                        <td><?= esc($k['keluhan']); ?></td>
                        <td><?= esc($k['keluhan']); ?></td>
                        <td><?= esc($k['created_at']); ?></td>
                        <td>
                            <?= $k['tanggal_selesai'] ? esc($k['tanggal_selesai']) : '<span class="text-danger">Belum Selesai</span>'; ?>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm upload-foto-btn"
                                    data-id="<?= esc($k['id']); ?>"
                                    data-toggle="modal" 
                                    data-target="#uploadFotoModal">
                                Upload Foto
                            </button>
                        </td>

                    </tr>
                <?php endforeach; ?>
            </tbody>

            </table>
        </div>
    </div>
</div>

<!-- Modal Upload Foto -->
<div class="modal fade" id="uploadFotoModal" tabindex="-1" role="dialog" aria-labelledby="uploadFotoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadFotoLabel">Upload Foto Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/teknisi/upload-foto') ?>" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" id="keluhan_id" name="keluhan_id">

                    <div class="form-group">
                        <label for="foto">Pilih Foto</label>
                        <input type="file" class="form-control" id="foto" name="foto" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.upload-foto-btn').on('click', function () {
            var keluhanId = $(this).data('id');
            $('#keluhan_id').val(keluhanId);
            $('#uploadFotoModal').modal('show'); 
        });
    });
</script>

<?= $this->endSection() ?>

<?= $this->extend('admin/dashboard') ?>

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
                        <th>RT</th>
                        <th>RW</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Status Survey</th>
                        <th>Petugas</th>
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
                                <?php if ($user['status_survey'] == 'sudah disurvey'): ?>
                                    <span class="badge bg-success"><?= esc($user['status_survey']); ?></span>
                                <?php elseif ($user['status_survey'] == 'belum disurvey'): ?>
                                    <span class="badge bg-warning text-dark"><?= esc($user['status_survey']); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Status Tidak Diketahui</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($user['petugas'])): ?>
                                    <span class="badge bg-success"><?= esc($user['petugas']); ?></span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Petugas Belum Ditugaskan</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($user['petugas'])): ?>
                                    <button type="button" class="btn btn-primary btn-sm pilih-petugas"
                                            data-toggle="modal"
                                            data-target="#modalPilihPetugas"
                                            data-id="<?= esc($user['id_meteran']) ?>">
                                        Pilih Petugas
                                    </button>
                                <?php endif; ?>
                                
                                <a href="<?= base_url('/admin/detail/' . esc($user['id_meteran'])); ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPilihPetugas" tabindex="-1" aria-labelledby="modalPilihPetugasLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPilihPetugasLabel">Pilih Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/admin/kirimPetugas') ?>" method="post">
                <div class="modal-body">
                    <input type="hidden" name="id_meteran" id="id_meteran_modal">

                    <div class="mb-3">
                        <label class="form-label">Pilih Petugas</label>
                        <select name="petugas_id" class="form-control" required>
                            <option value="">-- Pilih Petugas --</option>
                            <?php foreach ($petugas as $p): ?>
                                <option value="<?= esc($p['users_id']) ?>"><?= esc($p['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Kirim Petugas</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.pilih-petugas').on('click', function () {
            var idMeteran = $(this).data('id'); 
            // console.log("ID Meteran yang dikirim ke modal:", idMeteran); 

            $('#id_meteran_modal').val(idMeteran); 
        });
    });
</script>

<?= $this->endSection() ?>

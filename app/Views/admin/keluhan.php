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
        <h6 class="m-0 font-weight-bold text-primary">Daftar Keluhan Customer</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataCustomer" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Meteran</th>
                        <th>Keluhan</th>
                        <th>Petugas</th>
                        <th>Status</th>
                        <th>Tanggal Dibuat</th>
                        <th>Tanggal Selesai</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($keluhan as $k) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= esc($k['id_meteran']) ?></td>
                            <td><?= esc($k['keluhan']) ?></td>
                            <td><?= $k['teknisi'] ? esc($k['teknisi']) : '<span class="text-muted">Belum Ditugaskan</span>' ?></td>
                            <td>
                                <?php if ($k['status'] == 'review') : ?>
                                    <span class="text-danger font-weight-bold">Belum Ditugaskan</span>
                                <?php else : ?>
                                    <?php
                                    $badge = 'secondary';
                                    if ($k['status'] == 'ditolak') {
                                        $badge = 'danger';
                                    } elseif ($k['status'] == 'proses') {
                                        $badge = 'warning';
                                    } elseif ($k['status'] == 'selesai') {
                                        $badge = 'success';
                                    }
                                    ?>
                                    <span class="badge badge-<?= $badge ?>"><?= esc(ucwords($k['status'])) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (empty($k['tanggal_selesai'])) : ?>
                                    <span class="text-danger font-weight-bold">Belum Selesai</span>
                                <?php else : ?>
                                    <?= date('d-m-Y H:i', strtotime($k['tanggal_selesai'])) ?>
                                <?php endif; ?>
                            </td>

                            <td><?= date('d-m-Y H:i', strtotime($k['created_at'])) ?></td>
                            <td>
                                <a href="<?= base_url('/admin/keluhan/' . esc($k['id'])) ?>" class="btn btn-info btn-sm">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>
                                <button class="btn btn-primary btn-sm assign-teknisi-btn" 
                                        data-id="<?= esc($k['id']) ?>" 
                                        data-toggle="modal" 
                                        data-target="#assignTeknisiModal">
                                    <i class="fa fa-user"></i> Kirim Teknisi
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Pilih Teknisi (Bootstrap 4) -->
<div class="modal fade" id="assignTeknisiModal" tabindex="-1" role="dialog" aria-labelledby="assignTeknisiLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="assignTeknisiLabel">Pilih Teknisi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('/admin/kirim-teknisi') ?>" method="POST">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <input type="hidden" id="keluhan_id" name="keluhan_id">
                    
                    <div class="form-group">
                        <label for="teknisi_id">Teknisi</label>
                        <select class="form-control" id="teknisi_id" name="teknisi_id" required>
                            <option value="">Pilih Teknisi</option>
                            <?php foreach ($teknisi as $t) : ?>
                                <option value="<?= esc($t['users_id']) ?>"><?= esc($t['nama']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tugaskan Teknisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const assignButtons = document.querySelectorAll('.assign-teknisi-btn');
        assignButtons.forEach(button => {
            button.addEventListener('click', function () {
                const keluhanId = this.getAttribute('data-id');
                document.getElementById('keluhan_id').value = keluhanId;
            });
        });
    });
</script>

<?= $this->endSection() ?>

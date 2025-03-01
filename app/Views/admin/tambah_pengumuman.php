
<?= $this->extend('admin/dashboard') ?>


<?= $this->section('content') ?>

<?= session()->getFlashdata('success'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengumuman</h6>
    </div>
    <div class="card-body">
    <form action="<?= base_url('/admin/pengumuman/simpan') ?>" method="post">
        <div class="mb-3">
            <label class="form-label">Judul Pengumuman</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Pengumuman</label>
            <textarea name="isi" class="form-control" rows="5" required></textarea>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Awal Berlaku</label>
                    <input type="date" name="awal_berlaku" class="form-control" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Akhir Berlaku</label>
                    <input type="date" name="akhir_berlaku" class="form-control" required>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Ditujukan Untuk</label>

            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="targetSemua" onchange="toggleCheckboxes(this)">
                <label class="form-check-label" for="targetSemua">Pilih Semua</label>
            </div>

            <div class="form-check">
                <input class="form-check-input target-option" type="checkbox" name="target[]" value="pengguna" id="targetPengguna">
                <label class="form-check-label" for="targetPengguna">Pengguna</label>
            </div>

            <div class="form-check">
                <input class="form-check-input target-option" type="checkbox" name="target[]" value="petugas" id="targetPetugas">
                <label class="form-check-label" for="targetPetugas">Petugas</label>
            </div>
        </div>


        <script>
            function toggleCheckboxes(semuaCheckbox) {
                let targetOptions = document.querySelectorAll('.target-option');
                targetOptions.forEach(checkbox => {
                    checkbox.checked = semuaCheckbox.checked;
                });
            }
        </script>

        <button type="submit" class="btn btn-primary">Kirim Pengumuman</button>
    </form>
</div>

</div>
<?= $this->endSection() ?>
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Selamat Datang!</h4>
                <p class="card-category">Dashboard dengan Material Design</p>
            </div>
            <div class="card-body">
                <p>Halo, <?= session()->get('username') ?>!</p>
                <p>Ini adalah dashboard dengan Material Design yang interaktif dan modern!</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?></title>

    <!-- Material Dashboard CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/material-dashboard.css') ?>">
</head>
<body>

<div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-color="purple">
        <div class="logo">
            <a href="#" class="simple-text">My Dashboard</a>
        </div>
        <ul class="nav">
            <li class="nav-item active">
                <a class="nav-link" href="/dashboard">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/auth/logout">
                    <i class="material-icons">logout</i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-panel">
        <div class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>
</div>

<!-- Material Dashboard JS -->
<script src="<?= base_url('assets/js/material-dashboard.js') ?>"></script>

</body>
</html>
    
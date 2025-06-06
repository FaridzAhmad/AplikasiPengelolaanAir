<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard Admin</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css')?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="<?= base_url('assets/img/logo_air.png')?>" rel="icon">
    <link href="<?= base_url('assets/img/logo_air.png')?>" rel="logo">
    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">


</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">PELAYANAN <sup>PDAM</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item <?= (current_url() == base_url('admin/pengumuman')) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/pengumuman') ?>">
                    <i class="fas fa-fw fa-bullhorn"></i>
                    <span>Pengumuman</span></a>
            </li>

            <!-- Nav Item - Galer -->
            <li class="nav-item ">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-fw fa-images"></i>
                    <span>Galeri</span></a>
            </li>

            <li class="nav-item <?= (current_url() == base_url('admin/petugas')) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/petugas') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Petugas</span></a>
            </li>

            <!-- Nav Item - Data Pelanggan -->
            <li class="nav-item <?= (current_url() == base_url('admin/customer')) ? 'active' : '' ?>">
                <a class="nav-link" href="<?= base_url('admin/customer') ?>">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Data Customer</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>Data Pengajuan</span>
                </a>
                <div id="collapseTwo" class="collapse <?= (in_array(uri_string(), ['admin/sambungan-baru', 'admin/pemutusan', 'admin/perbaikan', 'admin/keluhan', 'admin/pembayaran-registrasi','admin/pembayaran-bulanan'])) ? 'show' : '' ?>" 
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= (uri_string() == 'admin/sambungan-baru') ? 'active' : '' ?>" href="<?= base_url('admin/sambungan-baru') ?>">Sambungan Baru</a>
                        <a class="collapse-item <?= (uri_string() == 'admin/pemutusan') ? 'active' : '' ?>" href="<?= base_url('admin/pemutusan') ?>">Pemutusan Sambungan</a>
                        <!-- <a class="collapse-item <?= (uri_string() == 'admin/perbaikan') ? 'active' : '' ?>" href="<?= base_url('admin/perbaikan') ?>">Perbaikan Sambungan</a> -->
                        <a class="collapse-item <?= (uri_string() == 'admin/keluhan') ? 'active' : '' ?>" href="<?= base_url('admin/keluhan') ?>">Keluhan Pelanggan</a>
                        <a class="collapse-item <?= (uri_string() == 'admin/pembayaran-registrasi') ? 'active' : '' ?>" href="<?= base_url('admin/pembayaran-registrasi') ?>">Pembayaran Registrasi</a>
                        <a class="collapse-item <?= (uri_string() == 'admin/pembayaran-bulanan') ? 'active' : '' ?>" href="<?= base_url('admin/pembayaran-bulanan') ?>">Pembayaran Bulanan</a>
                    </div>
                </div>
            </li>


            <!-- <li class="nav-item">
                <a class="nav-link" href="tables.html">
                    <i class="fas fa-credit-card"></i>
                    <span>Data Pembayaran</span></a>
            </li> -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-file-signature"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseThree" class="collapse <?= (in_array(uri_string(), ['admin/laporan/sambungan-baru', 'admin/laporan/pemutusan-sambungan', 'admin/laporan/keluhan', 'admin/laporan/pembayaran'])) ? 'show' : '' ?>" 
                    aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?= (uri_string() == 'admin/laporan/sambungan-baru') ? 'active' : '' ?>" href="<?= base_url('admin/laporan/sambungan-baru') ?>">Laporan Sambungan Baru</a>
                        <a class="collapse-item text-wrap <?= (uri_string() == 'admin/laporan/pemutusan-sambungan') ? 'active' : '' ?>" href="<?= base_url('admin/laporan/pemutusan-sambungan') ?>">Laporan Pemutusan Sambungan</a>
                        <a class="collapse-item <?= (uri_string() == 'admin/laporan/pembayaran') ? 'active' : '' ?>" href="<?= base_url('admin/laporan/pembayaran') ?>">Laporan Pembayaran</a>
                        <a class="collapse-item <?= (uri_string() == 'admin/laporan/keluhan') ? 'active' : '' ?>" href="<?= base_url('admin/laporan/keluhan') ?>">Laporan Keluhan</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= esc(session()->get('nama')); ?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="<?=base_url('assets/img/undraw_profile.svg')?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url('/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?= $this->renderSection('content') ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?= base_url('/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery/jquery.min.js')?>"></script>
    <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url('assets/js/sb-admin-2.min.js')?>"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url('assets/vendor/chart.js/Chart.min.js')?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url('assets/js/demo/chart-area-demo.js')?>"></script>
    <script src="<?= base_url('assets/js/demo/chart-pie-demo.js')?>"></script>


    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
    $(document).ready(function () {

        if ($.fn.DataTable) {
            $('#dataCustomer').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true
            });
        } else {
            console.error("Error: DataTables tidak ditemukan.");
        }
    });
    </script>



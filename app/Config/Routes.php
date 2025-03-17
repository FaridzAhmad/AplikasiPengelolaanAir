<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/register', 'RegisterController::index');
$routes->post('/register/save', 'RegisterController::save');


$routes->get('/admin/dashboard', 'AdminController::index', ['filter' => 'auth']);
$routes->get('/admin/customer', 'AdminController::customer', ['filter' => 'auth']);
// $routes->post('/admin/update-status', 'AdminController::updateStatus');
$routes->get('/admin/sambungan-baru', 'AdminController::belumAktif');
$routes->get('/admin/pengumuman', 'AdminController::pengumuman');
$routes->get('/admin/pengumuman/tambah', 'AdminController::tambahPengumuman');
$routes->post('/admin/pengumuman/simpan', 'AdminController::simpanPengumuman');
$routes->get('admin/detail/(:num)', 'AdminController::detail/$1');
$routes->post('/admin/putus-sambungan', 'AdminController::putusSambungan');
$routes->get('/admin/pemutusan', 'AdminController::pemutusan');
$routes->post('/admin/acc-pemutusan', 'AdminController::accPemutusan', ['filter' => 'auth']);
$routes->get('/admin/keluhan', 'AdminController::listKeluhan', ['filter' => 'auth']);
$routes->get('/admin/keluhan/(:num)', 'AdminController::detailKeluhan/$1', ['filter' => 'auth']);
$routes->post('/admin/keluhan/update', 'AdminController::updateKeluhan', ['filter' => 'auth']);
$routes->get('/admin/petugas', 'AdminController::petugas');
$routes->post('/admin/petugas/simpan', 'AdminController::simpanPetugas');
$routes->get('/admin/petugas/tambah', 'AdminController::tambahPetugas');
$routes->get('/admin/petugas/(:segment)', 'AdminController::detailPetugas/$1');
$routes->post('/admin/teknisi/simpan', 'AdminController::simpanTeknisi');
$routes->get('/admin/teknisi/tambah', 'AdminController::tambahTeknisi');
$routes->get('/admin/teknisi/(:segment)', 'AdminController::detailTeknisi/$1');
$routes->post('/admin/kirimPetugas', 'AdminController::kirimPetugas');
$routes->get('/admin/pembayaran-registrasi', 'AdminController::pembayaranRegistrasi');
$routes->post('/admin/konfirmasi-pembayaran/(:segment)', 'AdminController::konfirmasiPembayaran/$1');






$routes->get('/user/dashboard', 'UserController::index', ['filter' => 'auth']);
$routes->get('/user/putus-sambungan', 'UserController::putusSambungan', ['filter' => 'auth']);
$routes->post('/user/ajukan-pemutusan', 'UserController::ajukanPemutusan', ['filter' => 'auth']);
$routes->get('/user/keluhan', 'UserController::formKeluhan', ['filter' => 'auth']);
$routes->post('/user/keluhan/simpan', 'UserController::simpanKeluhan', ['filter' => 'auth']);
$routes->post('/user/pembayaran-awal', 'UserController::konfirmasiPembayaranAwal');
$routes->get('/user/tagihan-awal', 'UserController::tagihanAwal');




$routes->get('/petugas/dashboard', 'PetugasController::index', ['filter' => 'auth']);
$routes->get('/petugas/sambungan-baru', 'PetugasController::sambunganBaru');
$routes->post('/petugas/hasil-survey/upload', 'PetugasController::uploadHasilSurvey');
$routes->get('/petugas/hasil_survey/(:num)', 'PetugasController::hasilSurvey/$1');
$routes->get('/petugas/data-meteran', 'PetugasController::dataMeteran');
$routes->get('/petugas/input-meteran/(:segment)', 'PetugasController::inputMeteran/$1');
$routes->post('/petugas/simpan-meteran/(:segment)', 'PetugasController::simpanMeteran/$1');


$routes->get('/teknisi/dashboard', 'TeknisiController::index', ['filter' => 'auth']);
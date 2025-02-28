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
$routes->post('/admin/update-status', 'AdminController::updateStatus');
$routes->get('/admin/sambungan-baru', 'AdminController::belumAktif');
$routes->get('/admin/pengumuman', 'AdminController::pengumuman');
$routes->get('/admin/pengumuman/tambah', 'AdminController::tambahPengumuman');
$routes->post('/admin/pengumuman/simpan', 'AdminController::simpanPengumuman');



$routes->get('/user/dashboard', 'UserController::index', ['filter' => 'auth']);
$routes->get('/petugas/dashboard', 'PetugasController::index', ['filter' => 'auth']);

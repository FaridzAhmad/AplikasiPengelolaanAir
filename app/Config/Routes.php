<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::attemptLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/admin/dashboard', 'AdminController::index', ['filter' => 'auth']);
$routes->get('/user/dashboard', 'UserController::index', ['filter' => 'auth']);
$routes->get('/petugas/dashboard', 'PetugasController::index', ['filter' => 'auth']);

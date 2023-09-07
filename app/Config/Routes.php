<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'AdminController::index');

// $routes->get('/admin/siswa', 'SiswaController::index');

//Kelas
// $routes->get('/admin/kelas', 'KelasController::index');
// $routes->get('/admin/addKelas', 'Admin::addKelas');
// $routes->get('/', 'Admin::index');

$routes->get('/admin/siswa', 'Admin::siswa');

$routes->get('/admin/kelas', 'KelasController::index');

$routes->post('/admin/addKelas', 'KelasController::addKelas');

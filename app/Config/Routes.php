<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'Admin\AdminController::index');


$routes->get('/admin/siswa', 'Admin\SiswaController::index');

//kelas
$routes->get('/admin/kelas', 'Admin\KelasController::index');
$routes->post('/admin/addKelas', 'Admin\KelasController::addKelas');
$routes->get('/admin/deleteKelas/(:num)', 'Admin\KelasController::deleteKelas/$1');
$routes->get('/admin/editKelas/(:num)', 'Admin\KelasController::editKelas/$1');


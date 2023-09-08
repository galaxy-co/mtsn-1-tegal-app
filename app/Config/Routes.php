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

// guru
$routes->get('/admin/guru', 'Admin\GuruController::index');
$routes->post('/admin/uploadGuru', 'Admin\GuruController::uploadGuru');
$routes->get('/admin/deleteGuru/(:num)', 'Admin\GuruController::deleteGuru/$1');
$routes->post('/admin/addGuru', 'Admin\GuruController::addGuru');


// mapel
$routes->get('/admin/mapel', 'Admin\MapelController::index');
$routes->get('/admin/deleteMapel/(:num)', 'Admin\MapelController::mapelController/$1');
$routes->post('/admin/addMapel', 'Admin\MapelController::addMapel');
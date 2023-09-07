<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'Admin::index');

$routes->get('/admin/siswa', 'Admin::siswa');

//Kelas
$routes->get('/admin/kelas', 'Admin::kelas');
$routes->get('/admin/addKelas', 'Admin::addKelas');

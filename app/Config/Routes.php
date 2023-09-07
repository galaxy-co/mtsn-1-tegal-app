<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'Admin::index');

$routes->get('/admin/siswa', 'Admin::siswa');

$routes->get('/admin/kelas', 'Admin::kelas');

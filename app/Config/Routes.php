<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/admin', 'Admin\AdminController::index');


$routes->get('/admin/siswa', 'Admin\SiswaController::index');

// //kelas
// $routes->get('/admin/kelas', 'Admin\KelasController::index');
// $routes->post('/admin/addKelas', 'Admin\KelasController::addKelas');
// $routes->get('/admin/deleteKelas/(:num)', 'Admin\KelasController::deleteKelas/$1');
// $routes->get('/admin/editKelas/(:num)', 'Admin\KelasController::editKelas/$1');

// guru
$routes->get('/admin/guru', 'Admin\GuruController::index');
$routes->post('/admin/uploadGuru', 'Admin\GuruController::uploadGuru');

$routes->group('admin', static function ($routes) {
    
    // user route
    $routes->group('user',static function ($routes){
        $routes->get('/','Admin\UserController::index');
        $routes->get('/1','Admin\UserController::index/$1');
        $routes->post('/add','Admin\UserController::index');
        $routes->post('/edit','Admin\UserController::index');
        $routes->get('/delete/1','Admin\UserController::index/$1');
    });

    $routes->group('mapel',static function ($routes){
        $routes->get('/','Admin\MapelController::index');
        $routes->get('/1','Admin\MapelController::index/$1');
        $routes->post('/add','Admin\MapelController::index');
        $routes->post('/edit','Admin\MapelController::index');
        $routes->get('/delete/1','Admin\MapelController::index/$1');
    });

    //kelas
    $routes->get('kelas', 'Admin\KelasController::index');
    $routes->post('addKelas', 'Admin\KelasController::addKelas');
    $routes->get('deleteKelas/(:num)', 'Admin\KelasController::deleteKelas/$1');
    $routes->get('editKelas/(:num)', 'Admin\KelasController::editKelas/$1');
});

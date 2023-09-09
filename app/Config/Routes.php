<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login','AuthController::login');
$routes->post('/login','AuthController::loginPost');

$routes->group('admin', ['filter'=> 'authGuard'],static function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
    // user route
    $routes->group('user',static function ($routes){
        $routes->get('/','Admin\UserController::index');
        $routes->get('/1','Admin\UserController::index/$1');
        $routes->post('/add','Admin\UserController::index');
        $routes->post('/edit','Admin\UserController::index');
        $routes->get('/delete/1','Admin\UserController::index/$1');
    });
    // Siswa
    $routes->group('siswa',static function ($routes){
        $routes->get('/', 'Admin\SiswaController::index');
        $routes->post('add','Admin\SiswaController::addSiswa');
    });

    // Mapel
    $routes->group('mapel',static function ($routes){
        $routes->get('/','Admin\MapelController::index');
        $routes->post('add','Admin\MapelController::addMapel');
        $routes->get('edit/(:num)','Admin\MapelController::edit/$1');
        $routes->get('delete/(:num)','Admin\MapelController::deleteMapel/$1');
    });
    
    //kelas
    $routes->group('kelas',static function ($routes){
        $routes->get('/', 'Admin\KelasController::index');
        $routes->post('add', 'Admin\KelasController::addKelas');
        // $routes->get('/edit/(:num)', 'Admin\KelasController::addKelas');
        $routes->get('delete/(:num)', 'Admin\KelasController::deleteKelas/$1');
        $routes->get('edit/(:num)', 'Admin\KelasController::editKelas/$1');
    });

    // Guru
    $routes->group('guru',static function ($routes){
        $routes->get('/', 'Admin\GuruController::index');
        $routes->post('add', 'Admin\GuruController::addGuru');
        $routes->get('delete/(:num)', 'Admin\GuruController::deleteGuru/$1');
        $routes->get('edit/(:num)', 'Admin\GuruController::edit/$1');
        $routes->post('upload', 'Admin\GuruController::uploadGuru');
    });

});







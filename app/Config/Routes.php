<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/','AuthController::login');
$routes->get('/signin','AuthController::login');
$routes->post('/signin','AuthController::loginPost');


$routes->get('/logout','LogoutController::index');

$routes->group('admin', ['filter'=> 'authGuard:1'],static function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
    // user route
    $routes->group('user',static function ($routes){
        $routes->get('/','Admin\UserController::index');
        $routes->get('/1','Admin\UserController::index/$1');
        $routes->post('/add','Admin\UserController::index');
        $routes->post('/edit','Admin\UserController::index');
        $routes->get('/delete/1','Admin\UserController::index/$1');
    });

    // Settings
    $routes->group('settings',static function ($routes){
        $routes->get('/', 'Admin\SettingsController::index');
        $routes->post('add','Admin\SettingsController::add');
        $routes->get('edit/(:num)','Admin\SettingsController::edit/$1');
        $routes->post('update/(:num)', 'Admin\SettingsController::update/$1');
    });

    // Siswa
    $routes->group('siswa',static function ($routes){
        $routes->get('/', 'Admin\SiswaController::index');
        $routes->post('add','Admin\SiswaController::addSiswa');
        $routes->get('delete/(:num)','Admin\SiswaController::delete/$1');
        $routes->post('upload', 'Admin\SiswaController::upload');
        $routes->get('edit/(:num)', 'Admin\SiswaController::edit/$1');
        $routes->post('update/(:num)', 'Admin\SiswaController::update/$1');
        $routes->get('historyNilai/(:num)', 'Admin\SiswaController::historyNilai/$1');
        $routes->get('nilaiPengetahuan/(:num)', 'Admin\SiswaController::nilaiPengetahuan/$1');
        $routes->get('nilaiKetrampilan/(:num)', 'Admin\SiswaController::nilaiKetrampilan/$1');
        $routes->get('nilaiPas/(:num)', 'Admin\SiswaController::nilaiPas/$1');
    });


    // Mapel
    $routes->group('mapel',static function ($routes){
        $routes->get('/','Admin\MapelController::index');
        $routes->post('add','Admin\MapelController::addMapel');
        $routes->get('edit/(:num)','Admin\MapelController::edit/$1');
        $routes->get('delete/(:num)','Admin\MapelController::deleteMapel/$1');
        $routes->post('update/(:num)', 'Admin\MapelController::update/$1');
    });
    
    //kelas
    $routes->group('kelas',static function ($routes){
        $routes->get('/', 'Admin\KelasController::index');
        $routes->post('add', 'Admin\KelasController::addKelas');
        // $routes->get('/edit/(:num)', 'Admin\KelasController::addKelas');
        $routes->get('delete/(:num)', 'Admin\KelasController::deleteKelas/$1');
        $routes->get('edit/(:num)', 'Admin\KelasController::editKelas/$1');
        $routes->post('update/(:num)', 'Admin\KelasController::update/$1');
        $routes->get('setMapel/(:num)', 'Admin\KelasController::setMapel/$1');
        $routes->post('addrfMapel', 'Admin\KelasController::addrfMapel');
        $routes->get('deleteRfMapel/(:num)', 'Admin\KelasController::deleteRfMapel/$1');
    });

    // Guru
    $routes->group('guru',static function ($routes){
        $routes->get('/', 'Admin\GuruController::index');
        $routes->post('add', 'Admin\GuruController::addGuru');
        $routes->get('delete/(:num)', 'Admin\GuruController::deleteGuru/$1');
        $routes->get('edit/(:num)', 'Admin\GuruController::edit/$1');
        $routes->post('upload', 'Admin\GuruController::uploadGuru');
        $routes->post('update/(:num)', 'Admin\GuruController::update/$1');
    });

    // Nilai
    $routes->group('nilai',static function ($routes){
        $routes->get('/', 'Admin\NilaiController::index');
        $routes->get('rfmapel/(:num)', 'Admin\NilaiController::rfmapel/$1');
        $routes->get('detail', 'Admin\NilaiController::detail');
        $routes->post('storenilai', 'Admin\NilaiController::store_nilai');
        $routes->post('storekdname', 'Admin\NilaiController::store_kd_name');
        $routes->post('delete', 'Admin\NilaiController::delete');
        $routes->get('edit/(:num)', 'Admin\NilaiController::edit/$1');
        $routes->post('upload', 'Admin\NilaiController::uploadGuru');
        $routes->post('export','Admin\NilaiController::export');
        $routes->post('regenerate','Admin\NilaiController::regenerate');
        $routes->post('pushSemestr', 'Admin\NilaiController::pushSemestr');
    });

    // Nilai
    $routes->group('nilaiKetrampilan',static function ($routes){
        $routes->get('/', 'Admin\NilaiKetrampilanController::index');
        $routes->get('rfmapel/(:num)', 'Admin\NilaiKetrampilanController::rfmapel/$1');
        $routes->get('detail', 'Admin\NilaiKetrampilanController::detail');
        $routes->post('storenilai', 'Admin\NilaiKetrampilanController::store_nilai');
        $routes->post('storekdname', 'Admin\NilaiKetrampilanController::store_kd_name');
        $routes->post('delete', 'Admin\NilaiKetrampilanController::delete');
        $routes->get('edit/(:num)', 'Admin\NilaiKetrampilanController::edit/$1');
        $routes->post('upload', 'Admin\NilaiKetrampilanController::uploadGuru');
        $routes->post('regenerate','Admin\NilaiKetrampilanController::regenerate');
        $routes->post('export','Admin\NilaiKetrampilanController::export');
    });

    // absen
    $routes->group('absen',static function ($routes){
        $routes->get('/', 'Admin\AbsenController::index');
        $routes->post('add', 'Admin\AbsenController::add');
        $routes->post('update/(:num)', 'Admin\AbsenController::update/$1');
        $routes->get('delete/(:num)', 'Admin\GuruController::deleteGuru/$1');
        $routes->get('edit/(:num)', 'Admin\AbsenController::edit/$1');
        $routes->post('upload', 'Admin\GuruController::uploadGuru');
        $routes->get('dataSiswa/(:num)', 'Admin\AbsenController::dataSiswa/$1');
        $routes->get('addAbsen/(:num)', 'Admin\AbsenController::addAbsen/$1');
        $routes->get('historyAbsen/(:num)', 'Admin\AbsenController::historyAbsen/$1');
    });

     // kenaikan
     $routes->group('kenaikan',static function ($routes){
        $routes->get('/', 'Admin\NaikKelasController::index');
        $routes->post('add', 'Admin\NaikKelasController::add');
        $routes->post('update/(:num)', 'Admin\NaikKelasController::update/$1');
        $routes->get('delete/(:num)', 'Admin\GuruController::deleteGuru/$1');
        $routes->get('edit/(:num)', 'Admin\NaikKelasController::edit/$1');
        $routes->post('upload', 'Admin\GuruController::uploadGuru');
        $routes->get('dataSiswa/(:num)', 'Admin\NaikKelasController::dataSiswa/$1');
        $routes->get('addAbsen/(:num)', 'Admin\NaikKelasController::addAbsen/$1');
    });

    // pas
    $routes->group('pas',static function ($routes){
        $routes->get('/', 'Admin\PASController::index');
        $routes->get('detail', 'Admin\PASController::detail');
        $routes->post('store', 'Admin\PASController::store');
        $routes->get('edit/(:num)', 'Admin\PASController::edit/$1');
        $routes->get('pasnilai/(:num)', 'Admin\PASController::pasnilai/$1');
        $routes->post('update', 'Admin\PASController::update');
        $routes->post('regenerate', 'Admin\PASController::regenerate');
        $routes->get('downloadrekap/(:num)', 'Admin\PASController::downloadrekap/$1');
    });

    $routes->group('p5',static function ($routes){
        $routes->get('/', 'Admin\Nilaip5Controller::index');
        $routes->get('view/penilaian/(:any)','Admin\Nilaip5Controller::penilaian/$1');
        $routes->post('penilaian','Admin\Nilaip5Controller::store_nilai');
        $routes->get('view/(:any)','Admin\Nilaip5Controller::index/$1');
        $routes->post('store/(:any)','Admin\Nilaip5Controller::store/$1');
        $routes->get('delete/(:any)/(:num)','Admin\Nilaip5Controller::delete/$1/$2');
    });

      // kenaikan
      $routes->group('raportp5',static function ($routes){
        $routes->get('/', 'Admin\RaportP5Controller::index');
        $routes->get('dataSiswa/(:num)', 'Admin\RaportP5Controller::dataSiswa/$1');
        $routes->get('cetakRaport/(:num)', 'Admin\RaportP5Controller::cetakRaport/$1');
    });

});




$routes->group('siswa', ['filter'=> 'authGuard:2'],static function ($routes) {
    $routes->get('/', 'Siswa\SiswaController::index');

    $routes->group('nilaiHarian',static function ($routes){
        $routes->get('/', 'Siswa\NilaiHarianController::index');
    });
    $routes->group('nilaiKetrampilan',static function ($routes){
        $routes->get('/', 'Siswa\NilaiKetrampilanController::index');
    });
    $routes->group('nilaiSemester',static function ($routes){
        $routes->get('/', 'Siswa\NilaiSemesterController::index');
    });
    
    $routes->group('absenSiswa',static function ($routes){
        $routes->get('/', 'Siswa\AbsenSiswaController::index');
    });
    $routes->group('siswap5',static function ($routes){
        $routes->get('/', 'Siswa\NilaiP5Controller::index');
    });


});

$routes->group('guru', ['filter'=> 'authGuard:3'],static function ($routes) {
    $routes->get('/', 'Admin\AdminController::index');
    $routes->group('nilai',static function ($routes){
        $routes->get('/', 'Admin\NilaiController::index');
        $routes->get('detail', 'Admin\NilaiController::detail');
        $routes->post('storenilai', 'Admin\NilaiController::store_nilai');
        $routes->post('storekdname', 'Admin\NilaiController::store_kd_name');
        $routes->post('delete', 'Admin\NilaiController::delete');
        $routes->get('edit/(:num)', 'Admin\NilaiController::edit/$1');
        $routes->post('upload', 'Admin\NilaiController::uploadGuru');
        $routes->get('pasnilai/(:num)', 'Admin\PASController::pasnilai/$1');
        $routes->get('rfmapel/(:num)', 'Admin\NilaiController::rfmapel/$1');
        $routes->post('export','Admin\NilaiController::export');
        $routes->post('regenerate','Admin\NilaiController::regenerate');
    });

    $routes->group('nilaiKetrampilan',static function ($routes){
        $routes->get('/', 'Admin\NilaiKetrampilanController::index');
        $routes->get('detail', 'Admin\NilaiKetrampilanController::detail');
        $routes->post('storenilai', 'Admin\NilaiKetrampilanController::store_nilai');
        $routes->post('storekdname', 'Admin\NilaiKetrampilanController::store_kd_name');
        $routes->post('delete', 'Admin\NilaiKetrampilanController::delete');
        $routes->get('edit/(:num)', 'Admin\NilaiKetrampilanController::edit/$1');
        $routes->post('upload', 'Admin\NilaiKetrampilanController::uploadGuru');
        $routes->get('pasnilai/(:num)', 'Admin\PASController::pasnilai/$1');
        $routes->get('rfmapel/(:num)', 'Admin\NilaiKetrampilanController::rfmapel/$1');
        $routes->post('export','Admin\NilaiKetrampilanController::export');
        $routes->post('regenerate','Admin\NilaiKetrampilanController::regenerate');
    });

    $routes->group('pas',static function ($routes){
        $routes->get('/', 'Admin\PASController::index');
        $routes->get('detail', 'Admin\PASController::detail');
        $routes->post('store', 'Admin\PASController::store');
        $routes->get('edit/(:num)', 'Admin\PASController::edit/$1');
        $routes->post('update', 'Admin\PASController::update');
        $routes->get('pasnilai/(:num)', 'Admin\PASController::pasnilai/$1');
    });

});


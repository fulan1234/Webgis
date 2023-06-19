<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers\admin');
$routes->setDefaultController('maps');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/siuu', 'Home::index2');

$routes->delete('/deleteCabang/(:any)', 'DataCabang::deleteCabang/$1');
$routes->get('/editCabang/(:any)', 'DataCabang::editCabang/$1');
$routes->post('/updateDataCabang/(:any)', 'DataCabang::updateCabang/$1');

// $routes->get('/hgu', 'dataHGU::index');
// $routes->get('/tampilDataHGU/(:any)', 'dataHGU::tampilData/$1');


$routes->get('/dataKebun', 'DataKebun::index');
$routes->get('/createDataKebun', 'DataKebun::create');
$routes->post('/storeDataKebun', 'DataKebun::store');
$routes->delete('/deleteKebun/(:num)', 'DataKebun::delete/$1');
$routes->get('/tampilDataKebun/(:any)', 'DataKebun::tampilDataKebun/$1');

$routes->get('/dataCabang', 'DataCabang::index');
$routes->get('/createDataCabang', 'DataCabang::create');
$routes->post('/storeDataCabang', 'DataCabang::store');
$routes->delete('/deleteCabang/(:num)', 'DataCabang::delete/$1');
$routes->get('/ambilDataKebun/(:any)/(:any)', 'DataKebun::ambilDataKebun/$1/$2');
$routes->get('/exportDataGeojson/(:any)', 'DataCabang::exportDataGeojson/$1');
$routes->get('/exportExcel', 'DataCabang::exportExcel');

$routes->get('/tampilDataCabang', 'Maps::tampilDataCabang/$1');
$routes->get('/maps', 'Maps::index');
$routes->post('/cariData', 'Maps::cariData');
$routes->post('/ambilData', 'Maps::ambilData');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

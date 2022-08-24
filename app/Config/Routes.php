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
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('maDMP');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'maDMP::index');
$routes->get('/index.php/maDMP', 'maDMP::index');

$routes->get('/dmp/(:any)', 'maDMP::index/$1');
$routes->get('/index.php/dmp', 'maDMP::index');

$routes->get('/maDMP/(:any)', 'maDMP::index/$1');
$routes->get('/maDMP/(:any)/(:any)', 'maDMP::index/$1/$2');
$routes->post('/maDMP/(:any)', 'maDMP::index/$1');
$routes->post('/admin/(:any)/(:any)', 'maDMP::index/admin/$1/$2');
$routes->get('/admin/(:any)/(:any)', 'maDMP::index/admin/$1/$2');
$routes->get('/admin/(:any)', 'maDMP::index/admin/$1');
$routes->get('/index.php/maDMP', 'maDMP::index');

$routes->get('/admin/(:any)/(:any)', 'maDMP::index/$1/$2');
$routes->get('/admin/', 'maDMP::index/admin');

//$routes->get('/popup/', 'popup::index');
$routes->get('/popup/(:any)', 'popup::index/$1');
$routes->post('/popup/(:any)', 'popup::index/$1');





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
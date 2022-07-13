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
$routes->setDefaultController('Main');
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

/********** DEFAULT */
$routes->get('/', 'Pgcd::index');
$routes->post('/', 'Pgcd::index');

/********* PGCD */
$routes->get('/pgdp/', 'Pgcd::index/');
$routes->get('/pgdp/(:any)', 'Pgcd::index/$1');
$routes->post('/pgdp/(:any)', 'Pgcd::index/$1');
$routes->get('/plans/(:any)', 'Pgcd::index/plans/$1');
$routes->post('/plans/(:any)', 'Pgcd::index/plans/$1');

/********* AJAX */
$routes->get('/ajax/(:any)', 'Ajax::index/$1');
$routes->post('/ajax/(:any)', 'Ajax::index/$1');

/********* SOCIAL */
$routes->get('/social', 'Social::index');
$routes->post('/social/ajax/(:any)', 'Social::ajax/$1');
$routes->get('/social/(:any)', 'Social::index/$1');
$routes->post('/social/(:any)', 'Social::index/$1');

/********* POPUP */
$routes->get('/popup/(:any)', 'Popup::index/$1');
$routes->post('/popup/(:any)', 'Popup::index/$1');

/********** Others */
//$routes->get('(:any)', 'MainPages::index/$1');
$routes->get('(:any)', 'Pgcd::index/$1');
$routes->get('(:any)/(:any)', 'MainPagesPgcd::index/$1/$2');
$routes->get('(:any)/(:any)/(:any)', 'MainPagesPgcd::index/$1/$2/$3');


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
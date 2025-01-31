<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Users');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Users::landingpage', ['filter' => 'noauth']);
$routes->get('login', 'Users::index');
$routes->get('logout', 'Users::logout');
$routes->match(['get', 'post'],'register', 'Users::register', ['filter' => 'noauth']);
$routes->match(['get', 'post'],'profile', 'Users::profile', ['filter' => 'auth']);
$routes->get('dashboard', 'Dashboard::index', ['filter' => 'auth']);

$routes->post('kirim/denda', 'KatalogBuku::kirimDenda',['filter' => 'auth']);

$routes->group('members', function($routes)
{
    $routes->get('list', 'Members::index',['filter' => 'auth']);
	$routes->add('add', 'Members::add',['filter' => 'auth']);
	$routes->add('add_admin', 'Members::add_admin',['filter' => 'auth']);
	$routes->add('denda', 'Members::denda',['filter' => 'auth']);
	$routes->get('delete/(:num)', 'Members::delete/$1',['filter' => 'auth']);
	$routes->get('delete_denda/(:num)', 'Members::delete_denda/$1',['filter' => 'auth']);
	$routes->match(['get', 'post'],'edit/(:num)', 'Members::edit/$1',['filter' => 'auth']);
	$routes->post('find', 'Members::findMember');
});
$routes->group('katalog', ['filter' => 'auth'], function($routes)
{
    $routes->get('list', 'KatalogBuku::index');
	$routes->add('add', 'KatalogBuku::add');
	$routes->add('pinjam_buku', 'KatalogBuku::pinjam');
	$routes->add('kembali_buku', 'KatalogBuku::kembali');
	$routes->add('daftar_pinjaman', 'KatalogBuku::list_pinjam');
	$routes->get('izinkan/(:num)', 'KatalogBuku::izinkan/$1');
	$routes->get('tolak/(:num)', 'KatalogBuku::tolak/$1');
	$routes->post('find', 'KatalogBuku::findBook');
	$routes->post('kirim/denda', 'KatalogBuku::kirimDenda');
	$routes->get('delete/(:num)', 'KatalogBuku::delete/$1');
	$routes->match(['get', 'post'],'edit/(:num)', 'KatalogBuku::edit/$1');
});

//perpusweb routes

//$routes->match(['get', 'post'], '(:any)', 'Home::redir');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

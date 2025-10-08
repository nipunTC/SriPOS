<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Auth routes
$routes->get('/signup', 'Auth::index');
$routes->get('/login', 'Auth::index'); // invalid user return with display form with errors 
$routes->post('/login', 'Auth::logins');
$routes->get('/logout', 'Auth::logout');

// Dashboard route
$routes->get('/dashboard', 'Dashboard::index');


// Products route
$routes->get('/products/view', 'Products::index');
$routes->get('products/create', 'Products::create');
$routes->get('/products/getByCode/(:any)', 'Products::getByCode/$1');
$routes->post('categories/store', 'Categories::store');
$routes->post('products/store', 'Products::store');
// category with filtering part
$routes->post('categorySearch', 'Products::index');

$routes->post('products/fetch', 'Products::fetch'); // AJAX fetch products
$routes->post('products/update', 'Products::update');
$routes->get('products/delete/(:num)', 'Products::delete/$1');
$routes->get('products/print', 'Products::printProducts');
$routes->get('products/get/(:num)', 'Products::get/$1');
$routes->get('categories/getlist', 'Products::getCategories');
$routes->get('brands/getlist', 'Products::getBrands');
// Json refresh table products
$routes->get('products/refreshTable', 'Products::JSONRefreshTable');
// delete product
$routes->post('products/delete', 'Products::delete');


// Settings route
$routes->get('/settings', 'Settings::index');
$routes->post('/settings/update', 'Settings::update');  


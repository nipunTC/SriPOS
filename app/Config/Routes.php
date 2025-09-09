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

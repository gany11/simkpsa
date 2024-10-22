<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Login
$routes->get('/login', 'Auth::index');
$routes->add('/login/in', 'Auth::in');

//Logout
// $routes->add('/logout', 'Auth::out', ['filter' => 'login']);

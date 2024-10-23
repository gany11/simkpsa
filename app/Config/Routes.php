<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin::index', ['filter' => 'login']);

//Login
$routes->get('/login', 'Auth::index');
$routes->add('/login/in', 'Auth::in');

//Logout
$routes->add('/logout', 'Auth::out', ['filter' => 'login']);

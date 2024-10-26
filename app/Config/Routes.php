<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Dashboard
$routes->get('/', 'Admin::index', ['filter' => 'login']);

// Login
$routes->get('/login', 'Auth::index');
$routes->add('/login/in', 'Auth::in');

// Logout
$routes->add('/logout', 'Auth::out', ['filter' => 'login']);

// Pemasukan
$routes->get('/pemasukan', 'Admin::pemasukanindex', ['filter' => 'login']);
$routes->get('/pemasukan/tambah', 'Admin::pemasukanaddindex', ['filter' => 'login']);

// Pengeluaran
$routes->get('/pengeluaran', 'Admin::pengeluaranindex', ['filter' => 'login']);
$routes->get('/pengeluaran/tambah', 'Admin::pengeluaranaddindex', ['filter' => 'login']);
$routes->add('/pengeluaran/save', 'Admin::pengeluaransave', ['filter' => 'login']);
$routes->add('/pengeluaran/edit/(:num)', 'Admin::pengeluaraneditindex/$1', ['filter' => 'login']);
$routes->add('/pengeluaran/delete/(:num)', 'Admin::pengeluarandelete/$1', ['filter' => 'login']);

// Pemasukan
$routes->get('/laporan', 'Admin::laporanindex', ['filter' => 'login']);

// Produk
$routes->get('/produk', 'Admin::produkindex', ['filter' => 'login']);
$routes->get('/produk/edit', 'Admin::produkedit', ['filter' => 'login']);
$routes->add('/produk/edit/save', 'Admin::produkeditsave', ['filter' => 'login']);

// Profil
$routes->get('/profil', 'Admin::profilindex', ['filter' => 'login']);
$routes->get('/profil/edit', 'Admin::profiledit', ['filter' => 'login']);
$routes->add('/profil/edit/save', 'Admin::profileditsave', ['filter' => 'login']);
$routes->get('/password/edit', 'Admin::passwordedit', ['filter' => 'login']);
$routes->add('/password/edit/save', 'Admin::passwordeditsave', ['filter' => 'login']);
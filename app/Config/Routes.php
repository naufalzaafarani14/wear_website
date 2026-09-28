<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==== Halaman utama (portal) ====
$routes->get('/', 'Home::index');

// ==== Auth Routes ====
$routes->get('register', 'Auth::register');
$routes->post('register/proses', 'Auth::prosesRegister');

$routes->get('login', 'Auth::login');
$routes->post('login/proses', 'Auth::prosesLogin');

$routes->get('logout', 'Auth::logout');

// Halaman yang butuh login dulu baru bisa diakses
$routes->get('dashboard', 'Auth::dashboard', ['filter' => 'auth']);

// ==== Admin Routes ====
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
    $routes->get('/', 'Admin\DashboardController::index');

    // Kategori Fashion
    $routes->get('kategori', 'Admin\KategoriController::index');
    $routes->get('kategori/create', 'Admin\KategoriController::create');
    $routes->post('kategori/store', 'Admin\KategoriController::store');
    $routes->get('kategori/edit/(:num)', 'Admin\KategoriController::edit/$1');
    $routes->post('kategori/update/(:num)', 'Admin\KategoriController::update/$1');
    $routes->get('kategori/delete/(:num)', 'Admin\KategoriController::delete/$1');

    // Subkategori Fashion
    $routes->get('subkategori-fashion', 'Admin\SubkategoriFashion::index');
    $routes->get('subkategori-fashion/create', 'Admin\SubkategoriFashion::create');
    $routes->post('subkategori-fashion/store', 'Admin\SubkategoriFashion::store');
    $routes->get('subkategori-fashion/edit/(:num)', 'Admin\SubkategoriFashion::edit/$1');
    $routes->post('subkategori-fashion/update/(:num)', 'Admin\SubkategoriFashion::update/$1');
    $routes->get('subkategori-fashion/delete/(:num)', 'Admin\SubkategoriFashion::delete/$1');

    // Warna
    $routes->get('warna', 'Admin\WarnaController::index');
    $routes->get('warna/create', 'Admin\WarnaController::create');
    $routes->post('warna/store', 'Admin\WarnaController::store');
    $routes->get('warna/edit/(:num)', 'Admin\WarnaController::edit/$1');
    $routes->post('warna/update/(:num)', 'Admin\WarnaController::update/$1');
    $routes->get('warna/delete/(:num)', 'Admin\WarnaController::delete/$1');

    // Bentuk Tubuh
    $routes->get('bentuk-tubuh', 'Admin\BentukTubuhController::index');
    $routes->get('bentuk-tubuh/create', 'Admin\BentukTubuhController::create');
    $routes->post('bentuk-tubuh/store', 'Admin\BentukTubuhController::store');
    $routes->get('bentuk-tubuh/edit/(:num)', 'Admin\BentukTubuhController::edit/$1');
    $routes->post('bentuk-tubuh/update/(:num)', 'Admin\BentukTubuhController::update/$1');
    $routes->get('bentuk-tubuh/delete/(:num)', 'Admin\BentukTubuhController::delete/$1');

    // Warna Kulit
    $routes->get('warna-kulit', 'Admin\WarnaKulitController::index');
    $routes->get('warna-kulit/create', 'Admin\WarnaKulitController::create');
    $routes->post('warna-kulit/store', 'Admin\WarnaKulitController::store');
    $routes->get('warna-kulit/edit/(:num)', 'Admin\WarnaKulitController::edit/$1');
    $routes->post('warna-kulit/update/(:num)', 'Admin\WarnaKulitController::update/$1');
    $routes->get('warna-kulit/delete/(:num)', 'Admin\WarnaKulitController::delete/$1');

    // Occasion
    $routes->get('occasion', 'Admin\OccasionController::index');
    $routes->get('occasion/create', 'Admin\OccasionController::create');
    $routes->post('occasion/store', 'Admin\OccasionController::store');
    $routes->get('occasion/edit/(:num)', 'Admin\OccasionController::edit/$1');
    $routes->post('occasion/update/(:num)', 'Admin\OccasionController::update/$1');
    $routes->get('occasion/delete/(:num)', 'Admin\OccasionController::delete/$1');

    // Brand
    $routes->get('brand', 'Admin\BrandController::index');
    $routes->get('brand/create', 'Admin\BrandController::create');
    $routes->post('brand/store', 'Admin\BrandController::store');
    $routes->get('brand/edit/(:num)', 'Admin\BrandController::edit/$1');
    $routes->post('brand/update/(:num)', 'Admin\BrandController::update/$1');
    $routes->get('brand/delete/(:num)', 'Admin\BrandController::delete/$1');

    // Item Fashion
    $routes->get('item-fashion', 'Admin\ItemFashionController::index');
    $routes->get('item-fashion/create', 'Admin\ItemFashionController::create');
    $routes->post('item-fashion/store', 'Admin\ItemFashionController::store');
    $routes->get('item-fashion/edit/(:num)', 'Admin\ItemFashionController::edit/$1');
    $routes->post('item-fashion/update/(:num)', 'Admin\ItemFashionController::update/$1');
    $routes->get('item-fashion/delete/(:num)', 'Admin\ItemFashionController::delete/$1');

    // Artikel / Majalah
    $routes->get('artikel', 'Admin\ArtikelController::index');
    $routes->get('artikel/create', 'Admin\ArtikelController::create');
    $routes->post('artikel/store', 'Admin\ArtikelController::store');
    $routes->get('artikel/edit/(:num)', 'Admin\ArtikelController::edit/$1');
    $routes->post('artikel/update/(:num)', 'Admin\ArtikelController::update/$1');
    $routes->get('artikel/preview/(:num)', 'Admin\ArtikelController::preview/$1');
    $routes->get('artikel/delete/(:num)', 'Admin\ArtikelController::delete/$1');


    // Moderasi Konten
    $routes->get('moderasi-konten', 'Admin\ModerasiKontenController::index');
    $routes->get('moderasi-konten/detail/(:num)', 'Admin\ModerasiKontenController::detail/$1');
    $routes->post('moderasi-konten/approve/(:num)', 'Admin\ModerasiKontenController::approve/$1');
    $routes->post('moderasi-konten/reject/(:num)', 'Admin\ModerasiKontenController::reject/$1');
    $routes->post('moderasi-konten/delete/(:num)', 'Admin\ModerasiKontenController::delete/$1');

        // Kelola Pengguna
    $routes->get('pengguna', 'Admin\PenggunaController::index');
    $routes->get('pengguna/detail/(:num)', 'Admin\PenggunaController::detail/$1');
    $routes->post('pengguna/update-role/(:num)', 'Admin\PenggunaController::updateRole/$1');
    $routes->post('pengguna/delete/(:num)', 'Admin\PenggunaController::delete/$1');

        // Outfit
    $routes->get('outfit', 'Admin\OutfitController::index');
    $routes->get('outfit/create', 'Admin\OutfitController::create');
    $routes->post('outfit/store', 'Admin\OutfitController::store');
    $routes->get('outfit/edit/(:num)', 'Admin\OutfitController::edit/$1');
    $routes->post('outfit/update/(:num)', 'Admin\OutfitController::update/$1');
    $routes->get('outfit/delete/(:num)', 'Admin\OutfitController::delete/$1');
});
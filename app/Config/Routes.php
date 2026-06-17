<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Home & Main Pages
$routes->get('/', 'Home::index');

// Products
$routes->get('produk', 'Pages::produk');
$routes->get('produk/sim-sawit', 'Pages::simSawit');
$routes->get('produk/sim-koperasi', 'Pages::simKoperasi');
$routes->get('produk/analytics', 'Pages::analytics');

// About & Company Info
$routes->get('tentang', 'Pages::tentang');
$routes->get('tentang/visi-misi', 'Pages::visiMisi');
$routes->get('tentang/tim', 'Pages::tim');

// News & Activities
$routes->get('berita', 'News::index');
$routes->get('berita/(:segment)', 'News::view/$1');
$routes->get('kegiatan', 'News::activities');
$routes->get('kegiatan/(:segment)', 'News::viewActivity/$1');

// Resources & Guides
$routes->get('panduan', 'Pages::panduan');
$routes->get('panduan/(:segment)', 'Pages::panduan/$1');

// Contact & Forms
$routes->get('kontak', 'Contact::index');
$routes->post('kontak/submit', 'Contact::submit');

// API Routes
$routes->post('api/subscribe', 'Api::subscribe');
$routes->post('api/contact', 'Api::submitContact');

// ── Payment / KlikQRIS ───────────────────────────────────────────────────────
$routes->get('payment/checkout',             'Payment::checkout');
$routes->post('payment/create',              'Payment::create');
$routes->get('payment/status/(:segment)',    'Payment::status/$1');
$routes->get('payment/check-status/(:segment)', 'Payment::checkStatus/$1');
$routes->post('payment/webhook',             'Payment::webhook');
$routes->get('payment/history',              'Payment::history');
// ─────────────────────────────────────────────────────────────────────────────


// Authentication & Dashboard
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/register', 'Auth::register');
$routes->get('auth/logout', 'Auth::logout');

// Dashboard
$routes->get('dashboard', 'Dashboard::index');

// Palm Oil Dashboard - API Routes
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    // Farms Management
    $routes->get('farms', 'FarmController::index');
    $routes->post('farms', 'FarmController::create');
    $routes->get('farms/(:num)', 'FarmController::show/$1');
    $routes->put('farms/(:num)', 'FarmController::update/$1');
    $routes->delete('farms/(:num)', 'FarmController::delete/$1');
    $routes->get('farms/(:num)/summary', 'FarmController::summary/$1');

    // Zones Management
    $routes->get('zones', 'ZoneController::index');
    $routes->post('zones', 'ZoneController::create');
    $routes->get('zones/(:num)', 'ZoneController::show/$1');
    $routes->put('zones/(:num)', 'ZoneController::update/$1');
    $routes->delete('zones/(:num)', 'ZoneController::delete/$1');

    // TBS Records Management
    $routes->get('tbs', 'TbsController::index');
    $routes->post('tbs', 'TbsController::create');
    $routes->get('tbs/farm/daily-summary', 'TbsController::dailySummary');
    $routes->get('tbs/(:num)', 'TbsController::show/$1');
    $routes->put('tbs/(:num)', 'TbsController::update/$1');
    $routes->delete('tbs/(:num)', 'TbsController::delete/$1');

    // Production Records Management
    $routes->get('production', 'ProductionController::index');
    $routes->post('production', 'ProductionController::create');
    $routes->get('production/(:num)', 'ProductionController::show/$1');
    $routes->put('production/(:num)', 'ProductionController::update/$1');
    $routes->delete('production/(:num)', 'ProductionController::delete/$1');

    // Harvesting Records Management
    $routes->get('harvesting', 'HarvestingController::index');
    $routes->post('harvesting', 'HarvestingController::create');
    $routes->get('harvesting/(:num)', 'HarvestingController::show/$1');
    $routes->put('harvesting/(:num)', 'HarvestingController::update/$1');
    $routes->delete('harvesting/(:num)', 'HarvestingController::delete/$1');

    // Farm Settings Management
    $routes->get('farm-settings', 'FarmSettingsController::index');
    $routes->post('farm-settings', 'FarmSettingsController::create');
    $routes->put('farm-settings/(:num)', 'FarmSettingsController::update/$1');

    // Dashboard Analytics
    $routes->get('dashboard/daily-summary', 'DashboardController::dailySummary');
    $routes->get('dashboard/monthly-stats', 'DashboardController::monthlySummary');
    $routes->get('dashboard/quality-distribution', 'DashboardController::qualityDistribution');
    $routes->get('dashboard/harvesting-stats', 'DashboardController::harvestingStats');
    $routes->get('dashboard/top-days', 'DashboardController::topPerformingDays');
    $routes->get('dashboard/kpi', 'DashboardController::getKPI');

    // Import/Export
    $routes->post('import/tbs', 'ImportExportController::importTbs');
    $routes->post('import/production', 'ImportExportController::importProduction');
    $routes->get('export/tbs', 'ImportExportController::exportTbs');
    $routes->get('export/production', 'ImportExportController::exportProduction');

    // Alerts & Notifications
    $routes->get('alerts/all', 'AlertsController::getAllAlerts');
    $routes->get('alerts/tbs-target', 'AlertsController::checkTbsTarget');
    $routes->get('alerts/extraction-rate', 'AlertsController::checkExtractionRate');
    $routes->get('alerts/inventory', 'AlertsController::checkInventory');
    $routes->get('alerts/quality', 'AlertsController::checkQuality');

    // System Status
    $routes->get('status/health', 'StatusController::health');
    $routes->get('status/system', 'StatusController::system');
    $routes->get('status/summary', 'StatusController::summary');

    // Documentation
    $routes->get('docs/schema', 'DocumentationController::schema');
    $routes->get('docs/endpoints', 'DocumentationController::endpoints');
    $routes->get('docs/models', 'DocumentationController::models');
});

// Palm Oil Dashboard - Web Pages
$routes->get('palm-dashboard', 'Dashboard::palmOilIndex');
$routes->get('palm-dashboard/tbs', 'Dashboard::tbsManagement');
$routes->get('palm-dashboard/production', 'Dashboard::productionRecords');
$routes->get('palm-dashboard/harvesting', 'Dashboard::harvestingRecords');
$routes->get('palm-dashboard/settings', 'Dashboard::farmSettings');
$routes->get('palm-dashboard/analytics', 'Dashboard::analytics');
$routes->get('palm-dashboard/api-reference', 'Dashboard::apiReference');
$routes->get('palm-dashboard/farm-settings', 'Dashboard::farmSettings');
// Fallback for other pages
$routes->get('pages/view/(:segment)', 'Pages::view/$1');

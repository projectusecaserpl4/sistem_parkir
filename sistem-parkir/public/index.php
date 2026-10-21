<?php

session_start();

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/core/Controller.php';
require_once __DIR__ . '/../app/core/Model.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/helpers/functions.php';

$router = new Router();

$router->get('/', ['HomeController', 'index']);
$router->get('/login', ['AuthController', 'login']);
$router->post('/login', ['AuthController', 'authenticate']);
$router->get('/logout', ['AuthController', 'logout']);
$router->get('/dashboard', ['DashboardController', 'index']);

$router->get('/customers', ['CustomerController', 'index']);
$router->get('/customers/create', ['CustomerController', 'create']);
$router->post('/customers/store', ['CustomerController', 'store']);
$router->get('/customers/edit', ['CustomerController', 'edit']);
$router->post('/customers/update', ['CustomerController', 'update']);
$router->get('/customers/delete', ['CustomerController', 'delete']);

$router->get('/vehicle-types', ['VehicleTypeController', 'index']);
$router->get('/vehicle-types/create', ['VehicleTypeController', 'create']);
$router->post('/vehicle-types/store', ['VehicleTypeController', 'store']);
$router->get('/vehicle-types/edit', ['VehicleTypeController', 'edit']);
$router->post('/vehicle-types/update', ['VehicleTypeController', 'update']);
$router->get('/vehicle-types/delete', ['VehicleTypeController', 'delete']);

$router->get('/vehicles', ['VehicleController', 'index']);
$router->get('/vehicles/create', ['VehicleController', 'create']);
$router->post('/vehicles/store', ['VehicleController', 'store']);
$router->get('/vehicles/edit', ['VehicleController', 'edit']);
$router->post('/vehicles/update', ['VehicleController', 'update']);
$router->get('/vehicles/delete', ['VehicleController', 'delete']);

$router->get('/parking-areas', ['ParkingAreaController', 'index']);
$router->get('/parking-areas/create', ['ParkingAreaController', 'create']);
$router->post('/parking-areas/store', ['ParkingAreaController', 'store']);
$router->get('/parking-areas/edit', ['ParkingAreaController', 'edit']);
$router->post('/parking-areas/update', ['ParkingAreaController', 'update']);
$router->get('/parking-areas/delete', ['ParkingAreaController', 'delete']);

$router->get('/parking-slots', ['ParkingSlotController', 'index']);
$router->get('/parking-slots/create', ['ParkingSlotController', 'create']);
$router->post('/parking-slots/store', ['ParkingSlotController', 'store']);
$router->get('/parking-slots/edit', ['ParkingSlotController', 'edit']);
$router->post('/parking-slots/update', ['ParkingSlotController', 'update']);
$router->get('/parking-slots/delete', ['ParkingSlotController', 'delete']);

$router->get('/parking-rates', ['ParkingRateController', 'index']);
$router->get('/parking-rates/create', ['ParkingRateController', 'create']);
$router->post('/parking-rates/store', ['ParkingRateController', 'store']);
$router->get('/parking-rates/edit', ['ParkingRateController', 'edit']);
$router->post('/parking-rates/update', ['ParkingRateController', 'update']);
$router->get('/parking-rates/delete', ['ParkingRateController', 'delete']);

$router->get('/users', ['UserController', 'index']);
$router->get('/users/create', ['UserController', 'create']);
$router->post('/users/store', ['UserController', 'store']);
$router->get('/users/edit', ['UserController', 'edit']);
$router->post('/users/update', ['UserController', 'update']);
$router->get('/users/delete', ['UserController', 'delete']);

$router->get('/parking-entries', ['ParkingEntryController', 'index']);
$router->get('/parking-entries/create', ['ParkingEntryController', 'create']);
$router->get('/parking-entries/slots', ['ParkingEntryController', 'slots']);
$router->post('/parking-entries/store', ['ParkingEntryController', 'store']);

$router->get('/parking-exits', ['ParkingExitController', 'index']);
$router->get('/parking-exits/create', ['ParkingExitController', 'create']);
$router->post('/parking-exits/store', ['ParkingExitController', 'store']);

$router->get('/parking-payments', ['ParkingPaymentController', 'index']);
$router->get('/parking-payments/create', ['ParkingPaymentController', 'create']);
$router->post('/parking-payments/store', ['ParkingPaymentController', 'store']);
$router->get('/parking-payments/receipt', ['ParkingPaymentController', 'receipt']);

$router->get('/parking-history', ['ParkingHistoryController', 'index']);
$router->get('/rekap-transaksi', ['TransactionReportController', 'index']);

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

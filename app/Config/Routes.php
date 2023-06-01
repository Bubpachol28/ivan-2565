<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('UserController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Admin
$routes->get('manage-allUsers', 'AdminController::manage_allUsers');
$routes->get('add-officer', 'AdminController::add_officer');
$routes->get('edit-officer/(:any)', 'AdminController::edit_officer/$1');
$routes->get('setting', 'SettingController::setting');

// Employee
$routes->get('dashboard', 'EmployeeController::dashboard');
$routes->get('manage-user', 'EmployeeController::manage_user');
$routes->get('manage-van', 'EmployeeController::manage_van');
$routes->get('manage-traffic', 'EmployeeController::manage_traffic');
$routes->get('check-payment', 'EmployeeController::check_payment');
$routes->get('add-user', 'EmployeeController::add_user');

// User
$routes->get('', 'UserController::index');
$routes->get('login', 'UserController::login');
$routes->get('logout', 'UserController::logout');
$routes->get('register', 'UserController::register');
$routes->get('profile', 'UserController::profile');
$routes->get('edit-form', 'UserController::editprofile');
$routes->get('change-password', 'UserController::change_pass');
$routes->get('privacy', 'UserController::privacy');
$routes->get('forgot-password', 'UserController::forgot_password');
$routes->get('confirm-otp', 'UserController::confirm_otp');
$routes->get('new-password', 'UserController::new_password');
$routes->get('facebook-connect', 'UserController::facebook_connect');

// SMS
$routes->get('check-credit', 'SMSController::check_credit');

// Reservation
$routes->get('reservation', 'ReservationController::reservation');
$routes->get('confirm-reservation', 'ReservationController::confirm_reservation');
$routes->get('checking', 'ReservationController::check_reservation');

// DockCar
$routes->get('table', 'DockCarController::table_reservation');
$routes->get('add-driving', 'DockCarController::add_driving');
$routes->get('edit-driving/(:any)', 'DockCarController::edit_driving/$1');

// Payment
$routes->get('payment', 'PaymentController::payment');
$routes->get('around', 'PaymentController::manage_around');

// Van
$routes->get('addvan', 'VanController::addvan');
$routes->get('edit-van/(:any)', 'VanController::edit_van/$1');

// Ticket
$routes->get('booking-details', 'TicketController::booking_details');
$routes->get('history', 'TicketController::his_reservation');
$routes->get('ticket/(:any)', 'TicketController::print_ticket/$1');

// Complaint
$routes->get('complaint', 'ComplaintController::complaint');
$routes->get('manage-complaint', 'ComplaintController::manage_complaint');

// PDF
$routes->get('create-pdf', 'PdfController::index');
$routes->get('ducument/view-pdf', 'PdfController::view_pdf');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

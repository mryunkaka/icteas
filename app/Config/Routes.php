<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('create-db', function () {
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('yuknikah')) {
        echo 'Database Created!';
    }
});

//$routes->setAutoRoute(true);
$routes->addRedirect('/', 'home');
$routes->get('tes', 'home::tes');
$routes->get('home', 'Auth::login');
$routes->get('login', 'Auth::login');
$routes->get('auth/login', 'Auth::login');
$routes->post('auth/logproses', 'Auth::loginProcess');
$routes->get('auth/logout', 'Auth::logout');
$routes->get('auth/register', 'Auth::register');
$routes->post('auth/proses', 'Auth::prosesRegis');

$routes->get('permintaan', 'Permintaan::index');
$routes->get('permintaan/new', 'Permintaan::new');
$routes->post('permintaan/addproses', 'Permintaan::prosesAdd');
$routes->get('permintaan/edit/(:any)', 'Permintaan::edit/$1');
$routes->post('permintaan/update/(:any)', 'Permintaan::update/$1');
$routes->delete('permintaan/del/(:segment)', 'Permintaan::delete/$1');
$routes->post('permintaan/setujui/(:any)', 'Permintaan::setujui/$1');
$routes->post('permintaan/approve/(:any)', 'Barang::approve/$1');
$routes->post('permintaan/ttd_stf/(:any)', 'Permintaan::ttd_stf/$1');
$routes->post('permintaan/ttd_fat/(:any)', 'Permintaan::ttd_fat/$1');
$routes->post('permintaan/ttd_gm/(:any)', 'Permintaan::ttd_gm/$1');
$routes->post('permintaan/head_it/(:any)', 'Permintaan::head_it/$1');

$routes->get('downtime', 'Downtime::index');
$routes->get('downtime/new', 'Downtime::new');
$routes->post('downtime/proses', 'Downtime::create');
$routes->get('downtime/edit/(:any)', 'Downtime::edit/$1');
$routes->post('downtime/(:any)', 'Downtime::update/$1');
$routes->delete('downtime/del/(:segment)', 'Downtime::delete/$1');
$routes->get('downtime/export-pdf', 'Downtime::exportPDF');
$routes->get('downtime/pdf', 'Downtime::pdf');
$routes->get('downtime/tcpdf', 'Downtime::tcpdfExport');

$routes->get('barang/home/(:any)', 'Barang::home/$1');
$routes->get('barang/add/(:any)', 'Barang::add/$1');
$routes->post('barang/prosesAdd/(:any)', 'Barang::prosesAdd/$1');
$routes->post('barang/prosesAdds/(:any)', 'Barang::prosesAdds/$1');
$routes->get('barang/edit/(:any)', 'Barang::edit/$1');
$routes->post('barang/proses/edit/(:any)', 'Barang::prosesEdit/$1');
$routes->delete('barang/delete/(:any)', 'Barang::delete/$1');
$routes->get('barang/export-pdf/(:any)', 'Barang::exportPdf/$1');

$routes->get('user/home', 'User::home');
$routes->get('user/add', 'User::add');
$routes->post('user/proses', 'User::prosesAdd');
$routes->get('user/edit/(:any)', 'User::editAja/$1');
$routes->post('user/edits/proses/(:any)', 'User::editP/$1');
$routes->post('user/verif/(:any)', 'User::verif/$1');
$routes->post('user/unverif/(:any)', 'User::unverif/$1');
$routes->delete('user/delete/(:any)', 'User::delete/$1');

$routes->get('email/home', 'Email::index');
$routes->get('email/new', 'Email::new');
$routes->post('email/creates', 'Email::create');
$routes->get('email/edit/(:any)', 'Email::edit/$1');
$routes->post('email/editP/(:any)', 'Email::editP/$1');
$routes->delete('email/del/(:any)', 'Email::delete/$1');

$routes->get('perbaikan/home', 'Perbaikan::index');
$routes->get('perbaikan/add', 'Perbaikan::add');
$routes->post('perbaikan/create', 'Perbaikan::create');
$routes->get('perbaikan/edit/(:any)', 'Perbaikan::edit/$1');
$routes->post('perbaikan/editP/(:any)', 'Perbaikan::editP/$1');
$routes->delete('perbaikan/del/(:any)', 'Perbaikan::delete/$1');

$routes->get('bak/home', 'Bak::index');
$routes->get('bak/add', 'Bak::add');
$routes->post('bak/create', 'Bak::create');
$routes->get('bak/edit/(:any)', 'Bak::edit/$1');
$routes->post('bak/editP/(:any)', 'Bak::editP/$1');
$routes->delete('bak/del/(:any)', 'Bak::delete/$1');

$routes->get('project/home', 'Project::index');
$routes->get('project/add', 'Project::add');
$routes->post('project/create', 'Project::create');
$routes->get('project/edit/(:any)', 'Project::edit/$1');
$routes->post('project/editP/(:any)', 'Project::editP/$1');
$routes->delete('project/del/(:any)', 'Project::delete/$1');
$routes->get('project/(:any)', 'Project::showPDF/$1');

$routes->get('aset/home', 'Aset::index');
$routes->get('aset/add', 'Aset::add');
$routes->post('aset/create', 'Aset::create');
$routes->get('aset/edit/(:any)', 'Aset::edit/$1');
$routes->post('aset/editP/(:any)', 'Aset::editP/$1');
$routes->delete('aset/del/(:any)', 'Aset::delete/$1');
$routes->get('aset/(:any)', 'Aset::showPDF/$1');

<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'Auth::index');
$routes->post('/login/process', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'Auth::dashboardDispatcher'); 
    $routes->get('/profile/edit', 'Profile::edit');
    $routes->post('/profile/update', 'Profile::update');
    $routes->get('/report/tracking', 'Profile::tracking');
});

$routes->group('admin', ['filter' => ['auth', 'role:ADMIN']], function ($routes) {
    $routes->get('dashboard', 'Admin::index');
    $routes->get('setting-company', 'Admin::settingCompany');
    $routes->post('setting-company/save', 'Admin::saveCompany');
    $routes->post('setting-company/update', 'Admin::saveCompany');
    $routes->get('users', 'Admin::crudUser');
    $routes->post('users/save', 'Admin::saveUser');
    $routes->post('users/import-excel', 'Admin::importExcel');
    $routes->get('hierarchy', 'Admin::settingHierarchy');
    $routes->post('hierarchy/store', 'Admin::saveHierarchy');
    $routes->post('hierarchy/save', 'Admin::saveHierarchy');
    $routes->get('monitor-reports', 'Admin::monitorReports');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
});

$routes->group('staff', ['filter' => ['auth', 'role:STAFF']], function ($routes) {
    $routes->get('dashboard', 'Staff::index');
    
    $routes->group('data-audit', function ($routes) {
        $routes->get('audit-bond', 'FormAudit::auditBond');
        $routes->post('audit-bond/save', 'FormAudit::saveAuditBond');
        $routes->get('compliance-bond', 'FormAudit::complianceBond');
        $routes->post('compliance-bond/save', 'FormAudit::saveComplianceBond');
        $routes->get('risk-bond', 'FormAudit::riskBond');
        $routes->post('risk-bond/save', 'FormAudit::saveRiskBond');
        $routes->get('incident-report', 'FormAudit::incidentReport');
        $routes->post('incident-report/save', 'FormAudit::saveIncidentReport');
    });

    $routes->group('audit-internal', function ($routes) {
        $routes->get('audit-bond', 'FormAuditInternal::auditBond');
        $routes->get('compliance-bond', 'FormAuditInternal::complianceBond');
        $routes->get('risk-bond', 'FormAuditInternal::riskBond');
        $routes->get('fraud-bond', 'FormAuditInternal::fraudBond');
        $routes->get('incident-bond', 'FormAuditInternal::incidentBond');
        $routes->get('cyber-bond', 'FormAuditInternal::cyberBond');
        $routes->get('third-party-bond', 'FormAuditInternal::thirdPartyBond');
        $routes->get('continuity-bond', 'FormAuditInternal::continuityBond');
        $routes->get('control-bond', 'FormAuditInternal::controlBond');
        
        $routes->post('(:segment)/save', 'FormAuditInternal::saveData/$1');
    });
});

$routes->group('kepala-unit', ['filter' => ['auth', 'role:KEPALA UNIT']], function ($routes) {
    $routes->get('dashboard', 'KepalaUnit::index');
    $routes->get('reports', 'KepalaUnit::reportList');
    $routes->get('reports/detail/(:num)', 'KepalaUnit::reportDetail/$1');
    $routes->post('reports/approve', 'KepalaUnit::approveReport');
    $routes->post('reports/reject', 'KepalaUnit::rejectReport');
});

$routes->group('supervisor', ['filter' => ['auth', 'role:SUPERVISOR']], function ($routes) {
    $routes->get('dashboard', 'Supervisor::index');
    $routes->get('reports', 'Supervisor::reportList');
    $routes->get('reports/detail/(:num)', 'Supervisor::reportDetail/$1');
    $routes->post('reports/approve', 'Supervisor::approveReport');
    $routes->post('reports/reject', 'Supervisor::rejectReport');
    $routes->get('reports/print/(:num)', 'Supervisor::printReport/$1');
    $routes->get('reports/print-recap', 'Supervisor::printRecap');
});

$routes->group('managerial', ['filter' => ['auth', 'role:MANAGERIAL']], function ($routes) {
    $routes->get('dashboard', 'Managerial::index');
    $routes->get('reports', 'Managerial::reportList');
    $routes->get('reports/detail/(:num)', 'Managerial::reportDetail/$1');
    $routes->post('reports/approve', 'Managerial::approveReport');
    $routes->post('reports/reject', 'Managerial::rejectReport');
    $routes->get('reports/print/(:num)', 'Managerial::printReport/$1');
    $routes->get('reports/print-recap', 'Managerial::printRecap');
});

$routes->group('pimpinan-tinggi', ['filter' => ['auth', 'role:PIMPINAN TINGGI']], function ($routes) {
    $routes->get('dashboard', 'PimpinanTinggi::index');
    $routes->get('reports', 'PimpinanTinggi::reportList');
    $routes->get('reports/detail/(:num)', 'PimpinanTinggi::reportDetail/$1');
    $routes->post('reports/approve', 'PimpinanTinggi::approveReport');
    $routes->post('reports/reject', 'PimpinanTinggi::rejectReport');
});
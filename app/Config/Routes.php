<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ==========================================
// RUTE AUTENTIKASI (PUBLIK)
// ==========================================
$routes->get('/', 'Auth::index'); // Halaman Login
$routes->post('/login/process', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// ==========================================
// RUTE GLOBAL (Semua yang sudah login bisa akses)
// ==========================================
$routes->group('', ['filter' => 'auth'], function ($routes) {
    // Dashboard dinamis (Controller akan me-redirect sesuai role)
    $routes->get('/dashboard', 'Auth::dashboardDispatcher'); 
    
    // Ganti Foto & Password (Ketentuan 1.d & 2.c)
    $routes->get('/profile/edit', 'Profile::edit');
    $routes->post('/profile/update', 'Profile::update');
    
    // Pemantauan progress laporan masing-masing user (Ketentuan lainnya 1.7)
    $routes->get('/report/tracking', 'Profile::tracking');
});

// ==========================================
// RUTE ADMIN
// ==========================================
$routes->group('admin', ['filter' => 'auth', 'filter' => 'role:ADMIN'], function ($routes) {
    $routes->get('dashboard', 'Admin::index');
    
    // Profil Perusahaan
    $routes->get('setting-company', 'Admin::settingCompany');
    $routes->post('setting-company/save', 'Admin::saveCompany');
    
    // CRUD User & Import Excel
    $routes->get('users', 'Admin::crudUser');
    $routes->post('users/save', 'Admin::saveUser');
    $routes->post('users/import-excel', 'Admin::importExcel');
    
    // Setting Hierarki
    $routes->get('hierarchy', 'Admin::settingHierarchy');
    $routes->post('hierarchy/save', 'Admin::saveHierarchy');
    
    // Pemantauan Semua Laporan
    $routes->get('monitor-reports', 'Admin::monitorReports');
});

// ==========================================
// RUTE STAFF
// ==========================================
$routes->group('staff', ['filter' => 'auth', 'filter' => 'role:STAFF'], function ($routes) {
    $routes->get('dashboard', 'Staff::index');

    // Sub Menu: Input Data Audit
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

    // Sub Menu: Input Data Audit Internal GRC (9 Form)
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
        
        // Simpan semua inputan form internal (bisa dibuat spesifik per nama form nantinya)
        $routes->post('(:segment)/save', 'FormAuditInternal::saveData/$1');
    });
});

// ==========================================
// RUTE KEPALA UNIT
// ==========================================
$routes->group('kepala-unit', ['filter' => 'auth', 'filter' => 'role:KEPALA UNIT'], function ($routes) {
    $routes->get('dashboard', 'KepalaUnit::index');
    $routes->get('reports', 'KepalaUnit::reportList'); // Lihat laporan staff
    $routes->get('reports/detail/(:num)', 'KepalaUnit::reportDetail/$1');
    $routes->post('reports/approve', 'KepalaUnit::approveReport');
    $routes->post('reports/reject', 'KepalaUnit::rejectReport'); // Form alasan tolak ada di sini
});

// ==========================================
// RUTE SUPERVISOR
// ==========================================
$routes->group('supervisor', ['filter' => 'auth', 'filter' => 'role:SUPERVISOR'], function ($routes) {
    $routes->get('dashboard', 'Supervisor::index');
    $routes->get('reports', 'Supervisor::reportList'); // Filter by Kepala Unit
    $routes->get('reports/detail/(:num)', 'Supervisor::reportDetail/$1');
    $routes->post('reports/approve', 'Supervisor::approveReport');
    $routes->post('reports/reject', 'Supervisor::rejectReport');
    
    // Fitur Cetak DomPDF (Ketentuan lainnya 1.4)
    $routes->get('reports/print/(:num)', 'Supervisor::printReport/$1');
    $routes->get('reports/print-recap', 'Supervisor::printRecap');
});

// ==========================================
// RUTE MANAGERIAL
// ==========================================
$routes->group('managerial', ['filter' => 'auth', 'filter' => 'role:MANAGERIAL'], function ($routes) {
    $routes->get('dashboard', 'Managerial::index');
    $routes->get('reports', 'Managerial::reportList'); // Filter by Supervisor -> Kepala Unit
    $routes->get('reports/detail/(:num)', 'Managerial::reportDetail/$1');
    $routes->post('reports/approve', 'Managerial::approveReport');
    $routes->post('reports/reject', 'Managerial::rejectReport');
    
    // Fitur Cetak DomPDF
    $routes->get('reports/print/(:num)', 'Managerial::printReport/$1');
    $routes->get('reports/print-recap', 'Managerial::printRecap');
});

// ==========================================
// RUTE PIMPINAN TINGGI
// ==========================================
$routes->group('pimpinan-tinggi', ['filter' => 'auth', 'filter' => 'role:PIMPINAN TINGGI'], function ($routes) {
    $routes->get('dashboard', 'PimpinanTinggi::index');
    $routes->get('reports', 'PimpinanTinggi::reportList'); // Filter by MGR -> SPV -> KU
    $routes->get('reports/detail/(:num)', 'PimpinanTinggi::reportDetail/$1');
    $routes->post('reports/approve', 'PimpinanTinggi::approveReport');
    $routes->post('reports/reject', 'PimpinanTinggi::rejectReport');
});
<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/process-login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('profile', 'ProfileController::index');
    $routes->post('profile/update', 'ProfileController::update');
    
    $routes->get('notifications', 'NotificationController::index');
    $routes->get('notifications/read/(:num)', 'NotificationController::markAsRead/$1');
});

$routes->group('admin', ['filter' => 'role:ADMIN'], static function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    
    $routes->get('company-profile', 'AdminController::companyProfile');
    $routes->post('company-profile/update', 'AdminController::updateCompanyProfile');
    
    $routes->get('users', 'AdminController::users');
    $routes->post('users/save', 'AdminController::saveUser');
    $routes->post('users/import', 'AdminController::importUsers');
    
    $routes->get('hierarchy', 'AdminController::hierarchy');
    $routes->get('reports', 'AdminController::reports');
});

$routes->group('staff', ['filter' => 'role:STAFF'], static function ($routes) {
    $routes->get('dashboard', 'AuthController::processLogin');
    
    $routes->get('audit/audit-bond', 'StaffDataAuditController::auditBond');
    $routes->post('audit/audit-bond/save', 'StaffDataAuditController::saveAuditBond');
    
    $routes->get('audit/compliance-bond', 'StaffDataAuditController::complianceBond');
    $routes->post('audit/compliance-bond/save', 'StaffDataAuditController::saveComplianceBond');
    
    $routes->get('audit/risk-bond', 'StaffDataAuditController::riskBond');
    $routes->post('audit/risk-bond/save', 'StaffDataAuditController::saveRiskBond');
    
    $routes->get('audit/incident-report', 'StaffDataAuditController::incidentReport');
    $routes->post('audit/incident-report/save', 'StaffDataAuditController::saveIncidentReport');
    
    $routes->get('internal/audit-bond', 'StaffInternalAuditController::auditBond');
    $routes->post('internal/audit-bond/save', 'StaffInternalAuditController::saveAuditBond');
    
    $routes->get('internal/compliance-bond', 'StaffInternalAuditController::complianceBond');
    $routes->post('internal/compliance-bond/save', 'StaffInternalAuditController::saveComplianceBond');
    
    $routes->get('internal/risk-bond', 'StaffInternalAuditController::riskBond');
    $routes->post('internal/risk-bond/save', 'StaffInternalAuditController::saveRiskBond');
    
    $routes->get('internal/fraud-bond', 'StaffInternalAuditController::fraudBond');
    $routes->post('internal/fraud-bond/save', 'StaffInternalAuditController::saveFraudBond');
    
    $routes->get('internal/incident-bond', 'StaffInternalAuditController::incidentBond');
    $routes->post('internal/incident-bond/save', 'StaffInternalAuditController::saveIncidentBond');
    
    $routes->get('internal/cyber-bond', 'StaffInternalAuditController::cyberBond');
    $routes->post('internal/cyber-bond/save', 'StaffInternalAuditController::saveCyberBond');
    
    $routes->get('internal/third-party-bond', 'StaffInternalAuditController::thirdPartyBond');
    $routes->post('internal/third-party-bond/save', 'StaffInternalAuditController::saveThirdPartyBond');
    
    $routes->get('internal/continuity-bond', 'StaffInternalAuditController::continuityBond');
    $routes->post('internal/continuity-bond/save', 'StaffInternalAuditController::saveContinuityBond');
    
    $routes->get('internal/control-bond', 'StaffInternalAuditController::controlBond');
    $routes->post('internal/control-bond/save', 'StaffInternalAuditController::saveControlBond');
    
    $routes->get('progress', 'StaffProgressController::index');
    $routes->get('progress/reject-detail/(:segment)/(:num)', 'StaffProgressController::detailReject/$1/$2');
});

$routes->group('leader', ['filter' => 'role:PIMPINAN TINGGI,MANAGERIAL,SUPERVISOR,KEPALA UNIT'], static function ($routes) {
    $routes->get('dashboard', 'LeaderController::dashboard');
    $routes->get('reports', 'LeaderController::reports');
    $routes->get('approve/(:num)/(:segment)', 'LeaderController::approve/$1/$2');
    $routes->post('reject', 'LeaderController::reject');
    $routes->get('print-pdf/(:num)', 'LeaderController::printPdf/$1');
});

<?php

function get_sidebar_gradient($level)
{
    $gradients = [
        'ADMIN'           => 'bg-gradient-to-r from-blue-500 to-blue-700',
        'PIMPINAN TINGGI' => 'bg-gradient-to-r from-purple-500 to-purple-700',
        'MANAGERIAL'      => 'bg-gradient-to-r from-red-500 to-red-700',
        'SUPERVISOR'      => 'bg-gradient-to-r from-orange-500 to-orange-700',
        'KEPALA UNIT'     => 'bg-gradient-to-r from-green-500 to-green-700',
        'STAFF'           => 'bg-gradient-to-r from-gray-500 to-gray-700'
    ];

    return $gradients[$level] ?? 'bg-gradient-to-r from-gray-200 to-gray-400';
}

function get_user_hierarchy($userId)
{
    $db = \Config\Database::connect();
    return $db->table('hierarchy')->where('parent_id', $userId)->get()->getResultArray();
}

function generate_sidebar_menu($level)
{
    $menu = [];

    if ($level === 'ADMIN') {
        $menu = [
            ['title' => 'Dashboard', 'url' => '/admin/dashboard', 'icon' => 'bi bi-grid-fill'],
            ['title' => 'Profil Perusahaan', 'url' => '/admin/company-profile', 'icon' => 'bi bi-building'],
            ['title' => 'Manajemen User', 'url' => '/admin/users', 'icon' => 'bi bi-people-fill'],
            ['title' => 'Setting Hirarki', 'url' => '/admin/hierarchy', 'icon' => 'bi bi-diagram-3-fill'],
            ['title' => 'Pantau Laporan', 'url' => '/admin/reports', 'icon' => 'bi bi-file-earmark-text-fill'],
        ];
    } elseif ($level === 'STAFF') {
        $menu = [
            ['title' => 'Dashboard', 'url' => '/staff/dashboard', 'icon' => 'bi bi-grid-fill'],
            ['title' => 'Input Data Audit', 'url' => '#', 'icon' => 'bi bi-pencil-square', 'submenu' => [
                ['title' => 'Audit Bond', 'url' => '/staff/audit/audit-bond'],
                ['title' => 'Compliance Bond', 'url' => '/staff/audit/compliance-bond'],
                ['title' => 'Risk Bond', 'url' => '/staff/audit/risk-bond'],
                ['title' => 'Incident Report', 'url' => '/staff/audit/incident-report'],
            ]],
            ['title' => 'Internal Audit GRC', 'url' => '#', 'icon' => 'bi bi-shield-check', 'submenu' => [
                ['title' => 'Audit Bond', 'url' => '/staff/internal/audit-bond'],
                ['title' => 'Compliance Bond', 'url' => '/staff/internal/compliance-bond'],
                ['title' => 'Risk Bond', 'url' => '/staff/internal/risk-bond'],
                ['title' => 'Fraud Bond', 'url' => '/staff/internal/fraud-bond'],
                ['title' => 'Incident Bond', 'url' => '/staff/internal/incident-bond'],
                ['title' => 'Cyber Bond', 'url' => '/staff/internal/cyber-bond'],
                ['title' => 'Third Party Bond', 'url' => '/staff/internal/third-party-bond'],
                ['title' => 'Continuity Bond', 'url' => '/staff/internal/continuity-bond'],
                ['title' => 'Control Bond', 'url' => '/staff/internal/control-bond'],
            ]],
            ['title' => 'Pantau Progres', 'url' => '/staff/progress', 'icon' => 'bi bi-bar-chart-fill'],
        ];
    } else {
        $menu = [
            ['title' => 'Dashboard', 'url' => '/leader/dashboard', 'icon' => 'bi bi-grid-fill'],
            ['title' => 'Daftar Laporan', 'url' => '/leader/reports', 'icon' => 'bi bi-card-checklist'],
        ];
    }

    return $menu;
}

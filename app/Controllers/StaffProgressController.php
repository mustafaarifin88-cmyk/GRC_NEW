<?php

namespace App\Controllers;

use App\Models\Audit\AuditBondModel;
use App\Models\Audit\ComplianceBondModel;
use App\Models\Audit\IncidentReportModel;
use App\Models\Audit\RiskBondModel;
use App\Models\InternalAudit\IntAuditBondModel;
use App\Models\InternalAudit\IntComplianceBondModel;
use App\Models\InternalAudit\IntContinuityBondModel;
use App\Models\InternalAudit\IntControlBondModel;
use App\Models\InternalAudit\IntCyberBondModel;
use App\Models\InternalAudit\IntFraudBondModel;
use App\Models\InternalAudit\IntIncidentBondModel;
use App\Models\InternalAudit\IntRiskBondModel;
use App\Models\InternalAudit\IntThirdPartyBondModel;
use App\Models\ApprovalLogModel;

class StaffProgressController extends BaseController
{
    public function index()
    {
        $userId = session()->get('id');
        $allReports = [];

        // Daftar Model dan Labelnya untuk mempermudah looping
        $reportTypes = [
            ['model' => new AuditBondModel(), 'label' => 'Audit Bond', 'table' => 'audit_bonds'],
            ['model' => new ComplianceBondModel(), 'label' => 'Compliance Bond', 'table' => 'compliance_bonds'],
            ['model' => new RiskBondModel(), 'label' => 'Risk Bond', 'table' => 'risk_bonds'],
            ['model' => new IncidentReportModel(), 'label' => 'Incident Report', 'table' => 'incident_reports'],
            
            ['model' => new IntAuditBondModel(), 'label' => 'Int. Audit Bond', 'table' => 'int_audit_bonds'],
            ['model' => new IntComplianceBondModel(), 'label' => 'Int. Compliance Bond', 'table' => 'int_compliance_bonds'],
            ['model' => new IntContinuityBondModel(), 'label' => 'Int. Continuity Bond', 'table' => 'int_continuity_bonds'],
            ['model' => new IntControlBondModel(), 'label' => 'Int. Control Bond', 'table' => 'int_control_bonds'],
            ['model' => new IntCyberBondModel(), 'label' => 'Int. Cyber Bond', 'table' => 'int_cyber_bonds'],
            ['model' => new IntFraudBondModel(), 'label' => 'Int. Fraud Bond', 'table' => 'int_fraud_bonds'],
            ['model' => new IntIncidentBondModel(), 'label' => 'Int. Incident Bond', 'table' => 'int_incident_bonds'],
            ['model' => new IntRiskBondModel(), 'label' => 'Int. Risk Bond', 'table' => 'int_risk_bonds'],
            ['model' => new IntThirdPartyBondModel(), 'label' => 'Int. Third Party Bond', 'table' => 'int_third_party_bonds'],
        ];

        // Ambil semua data milik user ini dari semua tabel
        foreach ($reportTypes as $type) {
            $data = $type['model']->where('user_id', $userId)->findAll();
            
            foreach ($data as $row) {
                // Cari field judul (sesuaikan dengan nama kolom di database Anda, misalnya 'title', 'nama_laporan', dll)
                $judulLaporan = $row['judul'] ?? ($row['title'] ?? ($row['nama_laporan'] ?? 'Dokumen ' . $type['label']));

                $allReports[] = [
                    'id'          => $row['id'],
                    'jenis'       => $type['label'],
                    'judul'       => $judulLaporan,
                    'status'      => $row['status'] ?? 'PROSES',
                    'tanggal'     => $row['created_at'] ?? date('Y-m-d H:i:s'),
                    'report_type' => $type['table'],
                    'level'       => $row['current_level'] ?? '-'
                ];
            }
        }

        // Urutkan berdasarkan tanggal terbaru (descending)
        usort($allReports, function($a, $b) {
            return strtotime($b['tanggal']) <=> strtotime($a['tanggal']);
        });
        
        $data = [
            'reports' => $allReports
        ];

        return view('staff/progress_monitoring', $data);
    }

    public function detailReject($reportType, $reportId)
    {
        $logModel = new ApprovalLogModel();
        $log = $logModel->where('report_type', $reportType)
                        ->where('report_id', $reportId)
                        ->where('status', 'REJECTED')
                        ->orderBy('created_at', 'DESC')
                        ->first();
                        
        if ($log) {
            return $this->response->setJSON(['success' => true, 'note' => $log['notes']]);
        }
        return $this->response->setJSON(['success' => false, 'message' => 'Detail tidak ditemukan']);
    }
}
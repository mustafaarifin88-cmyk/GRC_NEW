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
        
        $data = [
            'audit_bonds'           => (new AuditBondModel())->where('user_id', $userId)->findAll(),
            'compliance_bonds'      => (new ComplianceBondModel())->where('user_id', $userId)->findAll(),
            'risk_bonds'            => (new RiskBondModel())->where('user_id', $userId)->findAll(),
            'incident_reports'      => (new IncidentReportModel())->where('user_id', $userId)->findAll(),
            'int_audit_bonds'       => (new IntAuditBondModel())->where('user_id', $userId)->findAll(),
            'int_compliance_bonds'  => (new IntComplianceBondModel())->where('user_id', $userId)->findAll(),
            'int_continuity_bonds'  => (new IntContinuityBondModel())->where('user_id', $userId)->findAll(),
            'int_control_bonds'     => (new IntControlBondModel())->where('user_id', $userId)->findAll(),
            'int_cyber_bonds'       => (new IntCyberBondModel())->where('user_id', $userId)->findAll(),
            'int_fraud_bonds'       => (new IntFraudBondModel())->where('user_id', $userId)->findAll(),
            'int_incident_bonds'    => (new IntIncidentBondModel())->where('user_id', $userId)->findAll(),
            'int_risk_bonds'        => (new IntRiskBondModel())->where('user_id', $userId)->findAll(),
            'int_third_party_bonds' => (new IntThirdPartyBondModel())->where('user_id', $userId)->findAll(),
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
                        
        if ($this->request->isAJAX()) {
            return $this->response->setJSON($log);
        }
        
        return redirect()->back();
    }
}

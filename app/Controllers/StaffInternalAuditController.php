<?php

namespace App\Controllers;

use App\Models\InternalAudit\IntAuditBondModel;
use App\Models\InternalAudit\IntComplianceBondModel;
use App\Models\InternalAudit\IntContinuityBondModel;
use App\Models\InternalAudit\IntControlBondModel;
use App\Models\InternalAudit\IntCyberBondModel;
use App\Models\InternalAudit\IntFraudBondModel;
use App\Models\InternalAudit\IntIncidentBondModel;
use App\Models\InternalAudit\IntRiskBondModel;
use App\Models\InternalAudit\IntThirdPartyBondModel;
use App\Models\FileDataModel;

class StaffInternalAuditController extends BaseController
{
    private function processUploads($inputName, $tableName, $reportId)
    {
        if ($files = $this->request->getFiles()) {
            $fileModel = new FileDataModel();
            foreach ($files[$inputName] ?? [] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/evidences', $newName);
                    $fileModel->insert([
                        'related_table' => $tableName,
                        'related_id'    => $reportId,
                        'file_name'     => $file->getClientName(),
                        'file_path'     => $newName,
                        'file_type'     => $file->getClientExtension()
                    ]);
                }
            }
        }
    }

    private function saveGeneral($modelClass, $tableName, $redirectUrl)
    {
        $model = new $modelClass();
        $data = $this->request->getPost();
        $data['user_id'] = session()->get('id');
        $data['status'] = 'PROSES';
        $data['current_level'] = 'KEPALA UNIT';
        
        $model->insert($data);
        $reportId = $model->getInsertID();

        $this->processUploads('evidences', $tableName, $reportId);

        return redirect()->to($redirectUrl)->with('success', 'Data berhasil disubmit.');
    }

    public function auditBond() { return view('staff/internal_audit_grc/form_audit_bond'); }
    public function saveAuditBond() { return $this->saveGeneral(IntAuditBondModel::class, 'int_audit_bonds', '/staff/progress'); }

    public function complianceBond() { return view('staff/internal_audit_grc/form_compliance_bond'); }
    public function saveComplianceBond() { return $this->saveGeneral(IntComplianceBondModel::class, 'int_compliance_bonds', '/staff/progress'); }

    public function riskBond() { return view('staff/internal_audit_grc/form_risk_bond'); }
    public function saveRiskBond() { return $this->saveGeneral(IntRiskBondModel::class, 'int_risk_bonds', '/staff/progress'); }

    public function fraudBond() { return view('staff/internal_audit_grc/form_fraud_bond'); }
    public function saveFraudBond() { return $this->saveGeneral(IntFraudBondModel::class, 'int_fraud_bonds', '/staff/progress'); }

    public function incidentBond() { return view('staff/internal_audit_grc/form_incident_bond'); }
    public function saveIncidentBond() { return $this->saveGeneral(IntIncidentBondModel::class, 'int_incident_bonds', '/staff/progress'); }

    public function cyberBond() { return view('staff/internal_audit_grc/form_cyber_bond'); }
    public function saveCyberBond() { return $this->saveGeneral(IntCyberBondModel::class, 'int_cyber_bonds', '/staff/progress'); }

    public function thirdPartyBond() { return view('staff/internal_audit_grc/form_third_party_bond'); }
    public function saveThirdPartyBond() { return $this->saveGeneral(IntThirdPartyBondModel::class, 'int_third_party_bonds', '/staff/progress'); }

    public function continuityBond() { return view('staff/internal_audit_grc/form_continuity_bond'); }
    public function saveContinuityBond() { return $this->saveGeneral(IntContinuityBondModel::class, 'int_continuity_bonds', '/staff/progress'); }

    public function controlBond() { return view('staff/internal_audit_grc/form_control_bond'); }
    public function saveControlBond() { return $this->saveGeneral(IntControlBondModel::class, 'int_control_bonds', '/staff/progress'); }
}

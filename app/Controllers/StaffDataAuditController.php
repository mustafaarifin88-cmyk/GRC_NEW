<?php

namespace App\Controllers;

use App\Models\Audit\AuditBondModel;
use App\Models\Audit\ComplianceBondModel;
use App\Models\Audit\RiskBondModel;
use App\Models\Audit\IncidentReportModel;
use App\Models\FileDataModel;

class StaffDataAuditController extends BaseController
{
    public function auditBond()
    {
        return view('staff/data_audit/form_audit_bond');
    }

    public function saveAuditBond()
    {
        $model = new AuditBondModel();
        $data = $this->request->getPost();
        $data['user_id'] = session()->get('id');
        $data['status'] = 'PROSES';
        $data['current_level'] = 'KEPALA UNIT';
        
        $model->insert($data);
        $reportId = $model->getInsertID();

        $this->uploadMultipleFiles('evidences', 'audit_bonds', $reportId);

        return redirect()->to('/staff/progress')->with('success', 'Data Audit Bond berhasil disubmit.');
    }

    public function complianceBond()
    {
        return view('staff/data_audit/form_compliance_bond');
    }

    public function saveComplianceBond()
    {
        $model = new ComplianceBondModel();
        $data = $this->request->getPost();
        $data['user_id'] = session()->get('id');
        $data['status'] = 'PROSES';
        $data['current_level'] = 'KEPALA UNIT';
        
        $model->insert($data);
        $reportId = $model->getInsertID();

        $this->uploadMultipleFiles('evidences', 'compliance_bonds', $reportId);

        return redirect()->to('/staff/progress')->with('success', 'Data Compliance Bond berhasil disubmit.');
    }

    public function riskBond()
    {
        return view('staff/data_audit/form_risk_bond');
    }

    public function saveRiskBond()
    {
        $model = new RiskBondModel();
        $data = $this->request->getPost();
        $data['user_id'] = session()->get('id');
        $data['status'] = 'PROSES';
        $data['current_level'] = 'KEPALA UNIT';
        
        $model->insert($data);
        $reportId = $model->getInsertID();

        $this->uploadMultipleFiles('evidences', 'risk_bonds', $reportId);

        return redirect()->to('/staff/progress')->with('success', 'Data Risk Bond berhasil disubmit.');
    }

    public function incidentReport()
    {
        return view('staff/data_audit/form_incident_report');
    }

    public function saveIncidentReport()
    {
        $model = new IncidentReportModel();
        $data = $this->request->getPost();
        $data['user_id'] = session()->get('id');
        $data['status'] = 'PROSES';
        $data['current_level'] = 'KEPALA UNIT';
        
        $model->insert($data);
        $reportId = $model->getInsertID();

        $this->uploadMultipleFiles('evidences', 'incident_reports', $reportId);

        return redirect()->to('/staff/progress')->with('success', 'Data Incident Report berhasil disubmit.');
    }

    private function uploadMultipleFiles($inputName, $tableName, $reportId)
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
}

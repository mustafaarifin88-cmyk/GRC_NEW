<?php

namespace App\Controllers;

use App\Models\ReportMasterModel;

class FormAuditInternal extends BaseController
{
    public function auditBond() { return view('staff/audit_internal_grc/audit_bond'); }
    public function complianceBond() { return view('staff/audit_internal_grc/compliance_bond'); }
    public function riskBond() { return view('staff/audit_internal_grc/risk_bond'); }
    public function fraudBond() { return view('staff/audit_internal_grc/fraud_bond'); }
    public function incidentBond() { return view('staff/audit_internal_grc/incident_bond'); }
    public function cyberBond() { return view('staff/audit_internal_grc/cyber_bond'); }
    public function thirdPartyBond() { return view('staff/audit_internal_grc/third_party_bond'); }
    public function continuityBond() { return view('staff/audit_internal_grc/continuity_bond'); }
    public function controlBond() { return view('staff/audit_internal_grc/control_bond'); }

    public function saveData($form_type)
    {
        $reportMaster = new ReportMasterModel();
        $id_report = $reportMaster->insert([
            'id_user_staff'   => session()->get('id'),
            'jenis_form'      => 'internal_' . $form_type,
            'id_dokumen'      => 0, 
            'status_approval' => 'PROSES',
            'posisi_approval' => 'KEPALA UNIT'
        ]);

        $data = $this->request->getPost();
        $data['id_report'] = $id_report;

        $files = $this->request->getFileMultiple('lampiran');
        $fileNames = [];
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('uploads/audit_internal', $newName);
                    $fileNames[] = $newName;
                }
            }
        }
        $data['lampiran'] = json_encode($fileNames);

        $modelName = '\App\Models\\' . str_replace(' ', '', ucwords(str_replace('-', ' ', $form_type))) . 'Model';
        if (class_exists($modelName)) {
            $model = new $modelName();
            $id_dokumen = $model->insert($data);
            $reportMaster->update($id_report, ['id_dokumen' => $id_dokumen]);
        }

        return redirect()->to('/staff/dashboard')->with('success', 'Data Audit Internal berhasil disimpan');
    }
}
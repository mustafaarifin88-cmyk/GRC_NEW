<?php

namespace App\Controllers;

use App\Models\ReportMasterModel;
use App\Models\AuditBondModel;
use App\Models\ComplianceBondModel;
use App\Models\RiskBondModel;
use App\Models\IncidentBondModel;

class FormAudit extends BaseController
{
    private function handleUploads($inputName, $path)
    {
        $files = $this->request->getFileMultiple($inputName);
        $fileNames = [];
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move($path, $newName);
                    $fileNames[] = $newName;
                }
            }
        }
        return json_encode($fileNames);
    }

    private function createReportMaster($jenis_form)
    {
        $reportMaster = new ReportMasterModel();
        $reportMaster->insert([
            'id_user_staff'   => session()->get('id'),
            'jenis_form'      => $jenis_form,
            'id_dokumen'      => 0,
            'status_approval' => 'PROSES',
            'posisi_approval' => 'KEPALA UNIT'
        ]);
        return $reportMaster->getInsertID();
    }

    public function auditBond()
    {
        return view('staff/data_audit/audit_bond');
    }

    public function saveAuditBond()
    {
        $id_report = $this->createReportMaster('audit_bond_lapangan');
        $model = new AuditBondModel();
        
        $data = $this->request->getPost();
        $data['id_report'] = $id_report;
        $data['file_kebijakan'] = $this->handleUploads('file_kebijakan', 'uploads/bukti_audit');
        $data['file_akses'] = $this->handleUploads('file_akses', 'uploads/bukti_audit');
        $data['file_cctv'] = $this->handleUploads('file_cctv', 'uploads/bukti_audit');
        $data['bukti_lainnya'] = $this->handleUploads('bukti_lainnya', 'uploads/bukti_audit');
        
        $id_dokumen = $model->insert($data);
        (new ReportMasterModel())->update($id_report, ['id_dokumen' => $id_dokumen]);

        return redirect()->to('/staff/dashboard')->with('success', 'Form Audit Bond berhasil dikirim');
    }

    public function complianceBond()
    {
        return view('staff/data_audit/compliance_bond');
    }

    public function saveComplianceBond()
    {
        $id_report = $this->createReportMaster('compliance_bond_penilaian');
        $model = new ComplianceBondModel();
        
        $data = $this->request->getPost();
        $data['id_report'] = $id_report;
        $data['file_izin'] = $this->handleUploads('file_izin', 'uploads/bukti_kepatuhan');
        $data['file_keselamatan'] = $this->handleUploads('file_keselamatan', 'uploads/bukti_kepatuhan');
        $data['file_pajak'] = $this->handleUploads('file_pajak', 'uploads/bukti_kepatuhan');
        
        $id_dokumen = $model->insert($data);
        (new ReportMasterModel())->update($id_report, ['id_dokumen' => $id_dokumen]);

        return redirect()->to('/staff/dashboard')->with('success', 'Form Compliance Bond berhasil dikirim');
    }

    public function riskBond()
    {
        return view('staff/data_audit/risk_bond');
    }

    public function saveRiskBond()
    {
        $id_report = $this->createReportMaster('risk_bond_penilaian');
        $model = new RiskBondModel();
        
        $data = $this->request->getPost();
        $data['id_report'] = $id_report;
        $data['bukti'] = $this->handleUploads('bukti', 'uploads/bukti_risiko');
        
        $id_dokumen = $model->insert($data);
        (new ReportMasterModel())->update($id_report, ['id_dokumen' => $id_dokumen]);

        return redirect()->to('/staff/dashboard')->with('success', 'Form Risk Bond berhasil dikirim');
    }

    public function incidentReport()
    {
        return view('staff/data_audit/pelaporan_insiden');
    }

    public function saveIncidentReport()
    {
        $id_report = $this->createReportMaster('incident_bond_pelaporan');
        $model = new IncidentBondModel();
        
        $data = $this->request->getPost();
        $data['id_report'] = $id_report;
        $data['lampiran_bukti'] = $this->handleUploads('lampiran_bukti', 'uploads/bukti_insiden');
        
        $id_dokumen = $model->insert($data);
        (new ReportMasterModel())->update($id_report, ['id_dokumen' => $id_dokumen]);

        return redirect()->to('/staff/dashboard')->with('success', 'Form Insiden berhasil dikirim');
    }
}
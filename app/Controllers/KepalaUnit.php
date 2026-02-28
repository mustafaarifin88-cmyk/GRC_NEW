<?php

namespace App\Controllers;

use App\Models\ReportMasterModel;
use App\Models\HierarchyModel;
use App\Models\NotificationModel;

class KepalaUnit extends BaseController
{
    public function index()
    {
        return view('approver/dashboard');
    }

    public function reportList()
    {
        $hierarchyModel = new HierarchyModel();
        $reportModel = new ReportMasterModel();
        
        $bawahans = $hierarchyModel->where('id_atasan', session()->get('id'))->findAll();
        $id_bawahans = array_column($bawahans, 'id_bawahan');

        if (!empty($id_bawahans)) {
            $data['reports'] = $reportModel->whereIn('id_user_staff', $id_bawahans)
                                           ->where('posisi_approval', 'KEPALA UNIT')
                                           ->where('status_approval', 'PROSES')
                                           ->findAll();
        } else {
            $data['reports'] = [];
        }

        return view('approver/report_list', $data);
    }

    public function reportDetail($id)
    {
        $reportModel = new ReportMasterModel();
        $data['report'] = $reportModel->find($id);
        return view('approver/report_detail', $data);
    }

    public function approveReport()
    {
        $reportModel = new ReportMasterModel();
        $id = $this->request->getPost('id_report');
        
        $reportModel->update($id, [
            'posisi_approval' => 'SUPERVISOR',
            'status_approval' => 'PROSES'
        ]);

        return redirect()->to('/kepala-unit/reports')->with('success', 'Laporan berhasil di-approve dan diteruskan ke Supervisor');
    }

    public function rejectReport()
    {
        $reportModel = new ReportMasterModel();
        $notifModel = new NotificationModel();
        
        $id = $this->request->getPost('id_report');
        $alasan = $this->request->getPost('alasan_tolak');
        
        $report = $reportModel->find($id);

        $reportModel->update($id, [
            'status_approval' => 'REJECTED',
            'alasan_tolak'    => $alasan,
            'ditolak_oleh'    => session()->get('id')
        ]);

        $notifModel->insert([
            'id_user' => $report['id_user_staff'],
            'judul'   => 'Laporan Ditolak oleh Kepala Unit',
            'pesan'   => 'Laporan Anda ditolak. Alasan: ' . $alasan,
            'link'    => '/report/tracking'
        ]);

        return redirect()->to('/kepala-unit/reports')->with('success', 'Laporan berhasil ditolak');
    }
}
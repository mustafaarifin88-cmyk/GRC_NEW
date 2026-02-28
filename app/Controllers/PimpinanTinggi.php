<?php

namespace App\Controllers;

use App\Models\ReportMasterModel;
use App\Models\HierarchyModel;
use App\Models\NotificationModel;

class PimpinanTinggi extends BaseController
{
    private function getDescendantStaffIds($id_atasan)
    {
        $hierarchyModel = new HierarchyModel();
        $staffIds = [];
        $bawahans = $hierarchyModel->where('id_atasan', $id_atasan)->findAll();
        
        foreach ($bawahans as $b) {
            $subBawahans = $this->getDescendantStaffIds($b['id_bawahan']);
            if (empty($subBawahans)) {
                $staffIds[] = $b['id_bawahan'];
            } else {
                $staffIds = array_merge($staffIds, $subBawahans);
            }
        }
        return $staffIds;
    }

    public function index()
    {
        return view('approver/dashboard');
    }

    public function reportList()
    {
        $reportModel = new ReportMasterModel();
        $id_bawahans = $this->getDescendantStaffIds(session()->get('id'));

        if (!empty($id_bawahans)) {
            $data['reports'] = $reportModel->whereIn('id_user_staff', $id_bawahans)
                                           ->where('posisi_approval', 'PIMPINAN TINGGI')
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
        $notifModel = new NotificationModel();
        
        $id = $this->request->getPost('id_report');
        
        $reportModel->update($id, [
            'status_approval' => 'APPROVED'
        ]);

        $report = $reportModel->find($id);
        $notifModel->insert([
            'id_user' => $report['id_user_staff'],
            'judul'   => 'Laporan Telah Disetujui Sepenuhnya',
            'pesan'   => 'Selamat! Laporan Anda telah disetujui oleh Pimpinan Tinggi.',
            'link'    => '/report/tracking'
        ]);

        return redirect()->to('/pimpinan-tinggi/reports')->with('success', 'Laporan berhasil di-approve (Selesai)');
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
            'judul'   => 'Laporan Ditolak oleh Pimpinan Tinggi',
            'pesan'   => 'Laporan Anda ditolak. Alasan: ' . $alasan,
            'link'    => '/report/tracking'
        ]);

        return redirect()->to('/pimpinan-tinggi/reports')->with('success', 'Laporan berhasil ditolak');
    }
}
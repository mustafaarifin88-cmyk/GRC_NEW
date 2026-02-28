<?php

namespace App\Controllers;

use App\Models\ReportMasterModel;
use App\Models\HierarchyModel;
use App\Models\NotificationModel;
use Dompdf\Dompdf;

class Supervisor extends BaseController
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
                                           ->where('posisi_approval', 'SUPERVISOR')
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
            'posisi_approval' => 'MANAGERIAL',
            'status_approval' => 'PROSES'
        ]);

        return redirect()->to('/supervisor/reports')->with('success', 'Laporan berhasil di-approve dan diteruskan ke Managerial');
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
            'judul'   => 'Laporan Ditolak oleh Supervisor',
            'pesan'   => 'Laporan Anda ditolak. Alasan: ' . $alasan,
            'link'    => '/report/tracking'
        ]);

        return redirect()->to('/supervisor/reports')->with('success', 'Laporan berhasil ditolak');
    }

    public function printReport($id)
    {
        $reportModel = new ReportMasterModel();
        $data['report'] = $reportModel->find($id);
        
        $html = view('approver/print_report', $data);
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('Laporan_'.$id.'.pdf', ['Attachment' => false]);
    }

    public function printRecap()
    {
        $reportModel = new ReportMasterModel();
        $id_bawahans = $this->getDescendantStaffIds(session()->get('id'));

        if (!empty($id_bawahans)) {
            $data['reports'] = $reportModel->whereIn('id_user_staff', $id_bawahans)->findAll();
        } else {
            $data['reports'] = [];
        }

        $html = view('approver/print_recap', $data);
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream('Rekap_Laporan.pdf', ['Attachment' => false]);
    }
}
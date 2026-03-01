<?php

namespace App\Controllers;

use App\Models\ApprovalLogModel;
use App\Models\NotificationModel;
use Dompdf\Dompdf;

class LeaderController extends BaseController
{
    public function dashboard()
    {
        return view('leader/dashboard');
    }

    public function reports()
    {
        return view('leader/report_list');
    }

    public function approve($reportId, $type)
    {
        $logModel = new ApprovalLogModel();
        $logModel->insert([
            'report_id' => $reportId,
            'report_type' => $type,
            'user_id' => session()->get('id'),
            'status' => 'APPROVED'
        ]);
        
        return redirect()->back()->with('success', 'Laporan disetujui.');
    }

    public function reject()
    {
        $reportId = $this->request->getPost('report_id');
        $type = $this->request->getPost('report_type');
        $reason = $this->request->getPost('reason');

        $logModel = new ApprovalLogModel();
        $logModel->insert([
            'report_id' => $reportId,
            'report_type' => $type,
            'user_id' => session()->get('id'),
            'status' => 'REJECTED',
            'reason' => $reason
        ]);

        $notifModel = new NotificationModel();
        $notifModel->insert([
            'user_id' => $this->request->getPost('staff_id'),
            'sender_id' => session()->get('id'),
            'title' => 'Laporan Ditolak',
            'message' => 'Laporan Anda ditolak. Alasan: ' . $reason,
            'url' => '/staff/progress'
        ]);

        return redirect()->back()->with('error', 'Laporan ditolak.');
    }

    public function printPdf($reportId)
    {
        $dompdf = new Dompdf();
        $html = view('leader/report_pdf', ['id' => $reportId]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan_$reportId.pdf");
    }
}

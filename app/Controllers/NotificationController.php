<?php

namespace App\Controllers;

use App\Models\NotificationModel;

class NotificationController extends BaseController
{
    public function index()
    {
        $model = new NotificationModel();
        $data['notifications'] = $model->where('user_id', session()->get('id'))->orderBy('created_at', 'DESC')->findAll();
        return view('components/notification_list', $data);
    }

    public function markAsRead($id)
    {
        $model = new NotificationModel();
        $model->update($id, ['is_read' => 1]);
        return redirect()->back();
    }
}

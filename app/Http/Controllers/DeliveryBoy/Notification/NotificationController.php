<?php

namespace App\Http\Controllers\DeliveryBoy\Notification;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class NotificationController extends Controller
{
    public function maskAsRead($id)
    {
        $notification = auth()->user()->notifications()->where('data->request_id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
        }
        Session::put('delivery_request_id', $id);

        return redirect(route('delivery.boy.get.delivery.request.list'));
    }
}

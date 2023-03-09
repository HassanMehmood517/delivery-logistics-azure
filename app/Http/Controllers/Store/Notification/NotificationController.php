<?php

namespace App\Http\Controllers\Store\Notification;

use App\Events\AdminNotification;
use App\Http\Controllers\Controller;
use App\Models\DeliveryRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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

        return redirect(route('store.get.delivery.request.list'));
    }

    public function sendDeliveryRequest(Request $request)
    {
        $store = User::findOrFail(\auth()->user()->id);

        if (Auth::check() && Auth::user()->isStore()) {
            $admin = User::where('role_id', User::ADMIN_ROLE_ID)->first();

            $request->validate([
                'delivery_address' => 'required',
//                'price' => 'required',
            ]);

            $requestData = DeliveryRequest::create([
                'store_id' => $store->id,
                'delivery_address' => $request->delivery_address,
//                'price' => $request->price,
                'time' => Carbon::parse($request->time)
            ]);

            $requestData->save();

            $data = [
                'request_id' => $requestData->id,
                'store_id' => $store->id,
                'name' => $store->name,
                'message' => $store->name . ' has requested for a delivery boy',
            ];

            Notification::send($admin, new \App\Notifications\AdminNotification($data));
            event(new AdminNotification($admin, $data));

            return back()->with('success', 'Request send successfully');
        }
    }
}

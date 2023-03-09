<?php

namespace App\Http\Controllers\DeliveryBoy\DeliveryRequest;

use App\Http\Controllers\Controller;
use App\Models\DeliveryRequest;
use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\AdminNotification;
use App\Notifications\StoreNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class DeliveryRequestController extends Controller
{
    public function list(Request $request)
    {
        // Mark As Read Notification
        $notifications = UserNotification::where('notifiable_id', \auth()->user()->id)
            ->whereNull('read_at')
            ->where('type', 'App\Notifications\DeliveryBoyNotification')->get();

        foreach ($notifications as $notification) {
            $notification->update([
                'read_at' => Carbon::now()->toDateTimeString()
            ]);
        }

        //Filter status
        $query = DeliveryRequest::query();
        if ($request->filled('filterBy')) {
            $status = $request->filterBy == 'pending' ? 1 : ($request->filterBy == 'onTheWay' ? 2 : 3);
            $query->where('status', $status);
        }

        $deliveryRequests = $query->with('store')
            ->where('status', '!=', 0)
            ->where('delivery_boy_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('deliveryBoy.deliveryRequest.list', compact('deliveryRequests'));
    }

    public function changeStatus(Request $request, $id)
    {
        //Change Delivery Status
        $deliveryRequests = DeliveryRequest::findOrFail($id);
        $deliveryRequests->update([
            'status' => $request->order_status,
        ]);

        //Send status Notification to Admin
        $admin = User::where('role_id', User::ADMIN_ROLE_ID)->first();
        $deliveryRequest = DeliveryRequest::findOrFail($id);

        $store = User::findOrFail($deliveryRequest->store_id);

        $data = [
            'request_id' => $deliveryRequest->id,
            'store_id' => $deliveryRequest->store_id,
            'name' => $deliveryRequest->deliveryBoy->name,
            'message' => $request->order_status == 2 ? $deliveryRequest->store->name . ' Order is on the way' :
                $deliveryRequest->store->name . ' Order is delivered',
        ];

        Notification::send([$admin, $store], new AdminNotification($data));
        event(new \App\Events\AdminNotification($admin, $data));
//        Notification::send($store, new StoreNotification($data));
        event(new \App\Events\StoreNotification($store, $data));

        return redirect()->back()->with('success', 'Status Updated Successfully');
    }
}

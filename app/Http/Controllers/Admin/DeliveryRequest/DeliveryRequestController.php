<?php

namespace App\Http\Controllers\Admin\DeliveryRequest;

use App\Http\Controllers\Controller;
use App\Models\DeliveryRequest;
use App\Models\User;
use App\Models\UserNotification;
use App\Notifications\DeliveryBoyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;


class DeliveryRequestController extends Controller
{
    public function list(Request $request)
    {
        //Mark As Read Notification
        $notifications = UserNotification::where('notifiable_id', \auth()->user()->id)
            ->whereNull('read_at')
            ->where('type', 'App\Notifications\AdminNotification')->get();

        foreach ($notifications as $notification) {
            $notification->update([
                'read_at' => Carbon::now()->toDateTimeString()
            ]);
        }

        //Filter status
        $query = DeliveryRequest::query();
        if ($request->filled('filterBy')) {
            $status = $request->filterBy == 'notAssigned' ? 0 : ($request->filterBy == 'pending' ? 1 : ($request->filterBy == 'onTheWay' ? 2 : 3));
            $query->where('status', $status);
        }

        $deliveryRequests = $query->with('store')->orderBy('id', 'desc')->paginate(10);
        $deliveryBoys = User::where('role_id', User::DELIVERY_BOY_ROLE_ID)->get();

        return view('admin.deliveryRequest.list', compact('deliveryRequests', 'deliveryBoys'));
    }

    public function assignDeliveryBoy(Request $request)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($request->deliveryRequestId);
        if ($deliveryRequest && $deliveryRequest->status == 0) {
            $deliveryRequest->update([
                'delivery_boy_id' => $request->deliveryBoyId,
                'status' => 1
            ]);

            $deliveryBoy = User::findOrFail($request->deliveryBoyId);

            $data = [
                'request_id' => $deliveryRequest->id,
                'store_id' => $deliveryRequest->store_id,
                'delivery_boy_id' => $deliveryBoy->id,
                'message' => auth()->user()->name . ' assign you delivery for ' .
                    $deliveryRequest->store->name . ' Time ' . Carbon::parse($deliveryRequest->store->time),
            ];

            Notification::send($deliveryBoy, new DeliveryBoyNotification($data));
            event(new \App\Events\DeliveryBoyNotification($deliveryBoy, $data));

        } else {
            return redirect()->back()->with('error', 'Delivery Request Already Assigned To Delivery Boy');
        }

        return redirect()->back()->with('success', 'Delivery Request Assigned To Delivery Boy Successfully');
    }

}

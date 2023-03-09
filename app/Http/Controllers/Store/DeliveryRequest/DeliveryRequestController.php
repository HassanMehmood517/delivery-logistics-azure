<?php

namespace App\Http\Controllers\Store\DeliveryRequest;

use App\Http\Controllers\Controller;
use App\Models\DeliveryRequest;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryRequestController extends Controller
{
    public function list(Request $request)
    {
        // Mark As Read Notification
        $notifications = UserNotification::where('notifiable_id', \auth()->user()->id)
            ->whereNull('read_at')
            ->where('type', 'App\Notifications\StoreNotification')->get();

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

        $deliveryRequests = $query->with('deliveryBoy')
            ->where('status', '!=', 0)
            ->where('store_id', auth()->user()->id)
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('store.deliveryRequest.list', compact('deliveryRequests'));
    }
}

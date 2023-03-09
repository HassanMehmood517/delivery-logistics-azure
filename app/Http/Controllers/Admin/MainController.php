<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function dashboard()
    {
        $totalDeliveryBoys = User::where('role_id', User::DELIVERY_BOY_ROLE_ID)->count();
        $totalStores = User::where('role_id', User::STORE_ROLE_ID)->count();

        return view('admin.dashboard', compact('totalDeliveryBoys', 'totalStores'));
    }
}

<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function list()
    {
        $stores = User::where('role_id', User::STORE_ROLE_ID)->paginate(10);

        return view('admin.store.list', compact('stores'));
    }
}

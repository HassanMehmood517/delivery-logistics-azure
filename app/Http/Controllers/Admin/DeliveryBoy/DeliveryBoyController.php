<?php

namespace App\Http\Controllers\Admin\DeliveryBoy;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeliveryBoyController extends Controller
{
    public function list()
    {
        $deliveryBoys = User::where('role_id', User::DELIVERY_BOY_ROLE_ID)->paginate(10);

        return view('admin.deliveryBoy.list', compact('deliveryBoys'));
    }

    public function create()
    {
        return view('admin.deliveryBoy.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'image' => 'required',
        ]);

        User::create([
            'role_id' => User::DELIVERY_BOY_ROLE_ID,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $request->image->hashName()
        ]);
        $request->image->store('images', 'public');

        return redirect(route('admin.delivery.boy.list'))->with('success', 'Delivery Boy Created Successfully');
    }

    public function edit($id)
    {
        $deliveryBoy = User::findorFail($id);

        return view('admin.deliveryBoy.edit', compact('deliveryBoy'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'unique:users,email,' . $request->id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        $deliveryBoy = User::findorFail($id);
        if ($deliveryBoy) {
            $image_name = $deliveryBoy->image;
            if (($request->hasFile('image'))) {
                $file_path = public_path('storage/images/') . $deliveryBoy->image;
                unlink($file_path);
                $image = $request->file('image');
                $image_name = Str::random(3) . time() . $image->getClientOriginalName();
                $destinationPath = public_path('storage/images/');
                $image->move($destinationPath, $image_name);
            }
            $deliveryBoy->update([
                'role_id' => User::DELIVERY_BOY_ROLE_ID,
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $image_name
            ]);
        }

        return redirect(route('admin.delivery.boy.list'))->with('success', 'Delivery Boy Updated Successfully');
    }

    public function delete($id)
    {
        $deliveryBoy = User::findorFail($id);
        $deliveryBoy->deliveryboyRequests ? $deliveryBoy->deliveryboyRequests()->delete() : '';
        $deliveryBoy->delete();

        return redirect()->back()->with('success', 'Data Deleted Successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginView()
    {
        $authUser = Auth::user();
        if ($authUser) {
            if ($authUser->isAdmin()) {
                return redirect(route('admin.dashboard'));
            }
            if ($authUser->isDeliveryBoy()) {
                return redirect(route('deliveryBoy.dashboard'));
            }
            if ($authUser->isStore()) {
                return redirect(route('store.dashboard'));
            }
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $authUser = Auth::user();

            if ($authUser->isAdmin()) {
                return redirect(route('admin.dashboard'));
            }
            if ($authUser->isDeliveryBoy()) {
                return redirect(route('deliveryBoy.dashboard'));
            }
            if ($authUser->isStore()) {
                return redirect(route('store.dashboard'));
            } else {
                Auth::logout();
                return back()->with('error', 'Credential Not Found');
            }
        } else {
            Auth::logout();
            return back()->with('error', 'Record not found');
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect(route('login.view'));
    }

    public function registerView()
    {
        if (Auth::check() && Auth::user()->isStore()) {
            return redirect(route('admin.dashboard'));
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required',
            'address' => 'required',
            'logo' => 'required',
        ]);

        $user = User::create([
            'role_id' => User::STORE_ROLE_ID,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $request->logo->hashName(),
        ]);
        $request->logo->store('logo', 'public');

        if ($user) {
            Auth::login($user);

            return redirect(route('store.dashboard'));
        } else {
            return view('auth.register');
        }
    }

    public function confirmation()
    {
        return view('layouts.confirmation');
    }
}

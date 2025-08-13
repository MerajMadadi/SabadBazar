<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register_index()
    {
        return view('register-user');
    }

    public function login_index()
    {
        return view('login');
    }

    public function show_profile()
    {
        return view('profile');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_phone' => $request->store_phone,
            'store_address' => $request->store_address,
            'license_number' => $request->license_number,
        ]);
        /*is seller?*/
        if ($request->store_name) {
            $role = Role::where('name', 'فروشنده')->first();
            $user->roles()->attach($role->id);
        } else
            $role = Role::where('name', 'کاربر عادی')->first();
        $user->roles()->attach($role->id);

        auth()->login($user);

        $token = $user->createtoken('token')->plainTextToken;

        return redirect('/')->with(['token' => $token, 'user' => $user]);
    }


    function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect('/login')->withErrors(['ایمیل وارد شده وجود ندارد'])->withInput();
        }
        if (!Hash::check($request->password, $user->password)) {
            return redirect('/login')->withErrors(['رمز وارد شده اشتباه است'])->withInput();
        }

        auth()->login($user);

        $token = $user->createtoken('token')->plainTextToken;

        /*        اگرمدیر بود به پنل مدیریت بره*/
        if (\auth()->user()->roles()->first()->name == 'مدیر') {
            return redirect('/panel/dashboard')->with(['token' => $token, 'user' => $user]);
        } else
            return redirect('/')->with(['token' => $token, 'user' => $user]);
    }

    public function update(UpdateUserRequest $request)
    {
        $user = User::where('id', Auth::id())->first();

// تغییر پسورد
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'store_name' => $request->store_name,
            'store_phone' => $request->store_phone,
            'store_address' => $request->store_address,
            'license_number' => $request->license_number,
        ]);
        /*        اگرمدیر بود به پنل مدیریت بره*/
        if (\auth()->user()->roles()->first()->name == 'مدیر') {
            return redirect('/panel/dashboard')->with(['user' => $user]);
        } else

            return redirect('/')->with(['user' => $user]);

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function destroy(string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->delete();
        return redirect('/')->with('message', 'حساب کاربری تان حذف شد.');
    }
}

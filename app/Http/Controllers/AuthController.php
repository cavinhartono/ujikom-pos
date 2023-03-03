<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function settings()
    {
        $user = User::with('roles')->findOrFail(Auth::user()->id);
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        if (Auth::user()->roles->first()->name == 'admin') {
            return view('auth.settings', compact(['user', 'users']));
        }
        return view('cashier.settings', compact(['user']));
    }

    public function updateSettings(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Nama harus disesuaikan',
                'password.required' => 'Password harus disesuaikan',
            ]
        );

        $user = User::with('roles')->findOrFail(Auth::user()->id);

        $update = [
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
            ])
        ];

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->clearMediaColletion('avatar');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        $user->update($update);

        return redirect('/dashboard')->with('success', `$request->name telah dirubah.`);
    }

    public function login(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'Email harus disesuaikan',
                'password.required' => 'Password harus disesuaikan',
            ]
        );

        $get = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($get)) {
            $name = explode(' ', trim(Auth::user()->name))[0];
            if (Auth::user()->roles->first()->name == 'admin') {
                return redirect('/dashboard')->with('success', "Selamat kembali, $name.");
            }
            return redirect('/')->with('success', "Selamat kembali, $name.");
        } else {
            return redirect('/auth')->with('failed', 'Email dan Password harus disesuaikan');
        }
    }

    public function register(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required|min:8',
            ],
            [
                'name.required' => 'Nama harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah ada, mohon isi lagi',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password harus disesuaikan minimal 8 karakter',
            ]
        );

        $create = [
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'email' => $request->email,
        ];

        $user = User::create($create);
        $user->assignRole('user');

        $get = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($get)) {
            $name = explode(' ', trim(Auth::user()->name))[0];
            return view('guest.index')->with('success', "Selamat datang, $name.");
        } else {
            return redirect('/auth')->with('failed', 'Email dan Password harus disesuaikan');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth');
    }
}

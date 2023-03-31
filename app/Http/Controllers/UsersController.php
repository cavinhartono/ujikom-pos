<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:user')->only('view');
    }

    public function index()
    {
        $auth = User::with('roles')->whereNot('id', '=', Auth::user()->id)->get();
        return view('users.index', compact(['auth']));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('users.edit', compact(['user', 'roles']));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'updated_at' => Carbon::now()
        ];

        $user = User::find($id);

        $user->syncRoles($request->role);
        $user->update([$data]);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        Notification::create([
            'type' => 'success',
            'user_id' => $user->id,
            'title' => "Mengubah Roles",
            'content' => 'oleh ' . Auth::user()->name,
        ]);

        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Mengubah Pengguna",
            'content' => "$request->name sudah dirubah.",
        ]);

        return redirect('/users')->with('success', "$request->name telah diedit!");
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact(['roles']));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->syncRoles($request->role);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Menambah Pengguna",
            'content' => "$request->name sudah ditambah",
        ]);

        return redirect('/users')->with('success', "$request->name telah ditambahkan!");
    }

    public function delete($id)
    {
        $user = User::find($id);
        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Menghapus Pengguna",
            'content' => "$user->name sudah dihapus.",
        ]);
        $user->delete();
        return redirect('/users')->with('success', "$user->name telah dihapus!");
    }

    public function search(Request $request)
    {
        $users = User::with('roles')
            ->where('name', 'LIKE', '%' . $request->search . '%')->get();

        return json_encode($users);
    }
}

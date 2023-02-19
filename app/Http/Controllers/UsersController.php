<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $auth = User::with('roles')->get();
        return view('users.index', compact(['users', 'auth']));
    }

    public function edit($id)
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->get();
        $user = User::find($id);
        return view('users.edit', compact(['user', 'users']));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([$request->all()]);
        return redirect('/users')->with('success', `$request->name telah diedit!`);
    }

    public function create()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->get();
        return view('users.create', compact(['users']));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return redirect('/users')->with('success', `$request->name telah ditambahkan!`);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('success', `$user->name telah dihapus!`);
    }

    public function search(Request $request)
    {
        $users = User::with('roles')
            ->where('name', 'LIKE', '%' . $request->search . '%')->get();

        return json_encode($users);
    }
}

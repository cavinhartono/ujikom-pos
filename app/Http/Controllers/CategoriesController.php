<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    public function create()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        return view('categories.create', compact(['users']));
    }

    public function store(Request $request)
    {
        Categories::create($request->all());
        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Membuat Kategori",
            'content' => `$request->name sudah dibuat`,
        ]);
        return redirect('/products')->with('success', `$request->name telah ditambahkan`);
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        return view('categories.edit', compact(['category', 'users']));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->update($request->all());
        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Mengubah Kategori",
            'content' => `$request->name sudah dirubah`,
        ]);

        return redirect('/products')->with('success', `$request->name telah diedit`);
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Menghapus Kategori",
            'content' => `$category->name sudah dihapus`,
        ]);
        $category->delete();
        return redirect('/products')->with('primary', 'Sudah dihapus!');
    }
}

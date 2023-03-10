<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;

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
        return redirect('/products')->with('success', `$request->name telah ditambahkan`);
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        return view('categories.edit', compact(['category']));
    }

    public function update(Request $request, $id)
    {
        $category = Categories::find($id);
        $category->update($request->all());

        return redirect('/products')->with('success', `$request->name telah diedit`);
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        $category->delete();
        return redirect('/products')->with('primary', 'Sudah dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $products = Product::with('categories')->get();
        return view('products.index', compact(['products', 'users']));
    }

    public function create()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $categories = Categories::all();
        return view('products.create', compact(['categories', 'users']));
    }

    public function edit($id)
    {
        $categories = Categories::all();
        $product = Product::with('categories')->find($id);
        return view('products.index', compact(['categories', 'product']));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $product->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }
        return redirect('/products')->with('success', `$request->name telah ditambahkan`);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update([$request->all()]);
        return redirect('/products')->with('success', `$request->name telah diedit`);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('success', `$request->name telah dihapus`);
    }
}

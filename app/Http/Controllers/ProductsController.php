<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            'can:produk'
        )->only('view');
    }

    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $products = Product::with('categories')->get();
        $categories = Categories::orderBy('created_at', 'DESC')->get();
        return view('products.index', compact(['users', 'products', 'categories']));
    }

    public function create()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $categories = Categories::all();
        return view('products.create', compact(['categories', 'users']));
    }

    public function edit($id)
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $categories = Categories::all();
        $product = Product::with('categories')->find($id);
        return view('products.edit', compact(['categories', 'product', 'users']));
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
        $product->update($request->all());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $product->clearMediaCollection('avatar');
            $product->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        return redirect('/products')->with('success', `$request->name telah diedit`);
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('/products')->with('success', `$request->name telah dihapus`);
    }

    public function search(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->search . '%')
            ->orWhere('price', '=', $request->search)
            ->orWhere('barcode', '=', $request->search)
            ->get();

        return json_encode($products);
    }

    public function cetak()
    {
        $products = Product::all();
        return view('products.print', compact(['products']));
    }
}

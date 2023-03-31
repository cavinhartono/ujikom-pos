<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Notification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $products = Product::with('categories')->get();
        $categories = Categories::orderBy('created_at', 'DESC')->get();
        return view('products.index', compact(['products', 'categories']));
    }

    public function create()
    {
        $categories = Categories::all();
        return view('products.create', compact(['categories']));
    }

    public function edit($id)
    {
        $categories = Categories::all();
        $product = Product::with('categories')->find($id);
        return view('products.edit', compact(['categories', 'product']));
    }

    public function store(Request $request)
    {
        $product = Product::create($request->all());
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $product->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Membuat Produk",
            'content' => "$product->name sudah ditambah.",
        ]);

        return redirect('/products')->with('success', "$request->name telah ditambahkan");
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $product->addMediaFromRequest('avatar')->toMediaCollection('avatar');
        }

        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Mengubah Produk",
            'content' => "$product->name sudah dirubah.",
        ]);

        return redirect('/products')->with('success', "$request->name telah diedit");
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        Notification::create([
            'type' => 'success',
            'user_id' => Auth::user()->id,
            'title' => "Menghapus Pengguna",
            'content' => "$product->name sudah dihapus.",
        ]);
        $product->delete();
        return redirect('/products')->with('success', "$request->name telah dihapus");
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

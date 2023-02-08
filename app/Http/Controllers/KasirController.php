<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class KasirController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('cashier.dashboard', compact(['products']));
    }
}

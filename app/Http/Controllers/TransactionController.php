<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:transaksi')->only('view');
    }

    public function index()
    {
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();

        if (Auth::user()->roles->first()->name == 'admin') {
            return view('orders.index', compact(['orders']));
        }
        return view('cashier.transaction', compact(['orders']));
    }

    public function view($id)
    {
        $orderItem = Order::with('order_item', 'customer')->find($id);
        return view('orders.view', compact(['orderItem']));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $order = Order::with('customer', 'order_item')
            ->whereHas('customer', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%');
            })
            ->orWhereHas('order_item', function ($query) use ($search) {
                $query->where('accept', 'LIKE', '%' . $search . '%');
            })
            ->get();

        return json_encode($order);
    }
}

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
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();

        if (Auth::user()->roles->first()->name == 'admin') {
            return view('orders.index', compact(['users', 'orders']));
        }
        return view('cashier.transaction', compact(['orders']));
    }

    public function view($id)
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orderItem = Order::with('order_item', 'customer')->find($id);
        return view('orders.view', compact(['orderItem', 'users']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::with('customer')->get();
        return view('orders.index', compact(['users', 'orders']));
    }

    public function view($id)
    {
        $orderItem = OrderItem::with('order', 'product')->find($id);
        return view('orders.view', compact(['orderItem']));
    }
}

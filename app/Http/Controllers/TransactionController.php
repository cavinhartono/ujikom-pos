<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();
        $monthNow = Order::where(DB::raw('MONTHNAME(created_at)'), '=', 'MONTH(NOW())')->count();
        $current = Order::select(DB::raw('CAST(COUNT(id) AS INT) as total_sales'))
            ->groupBy(DB::raw('DAY(created_at)'))
            ->pluck('total_sales')
            ->count();

        if (Auth::user()->roles->first()->name == 'admin') {
            return view('orders.index', compact(['users', 'orders']));
        }
        return view('cashier.transaction', compact(['orders', 'monthNow', 'current']));
    }

    public function view($id)
    {
        $orderItem = OrderItem::with('order', 'product')->find($id);
        return view('orders.view', compact(['orderItem']));
    }
}

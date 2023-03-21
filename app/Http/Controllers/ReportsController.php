<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:laporan')->only('view');
    }

    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->paginate(5);
        // $totalRevenue = Order::where('created_at', Carbon::now()->subMonth($n))->sum('price')->union();
        // $totalRevenue = OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -1 DAY)'))
        //     ->select([DB::raw('"Today" as date'), DB::raw('sum(price) as total')])
        //     ->union(
        //         OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -7 DAY)'))
        //             ->select([DB::raw('"Last 7 days"'), DB::raw('sum(price) as total')])
        //     )
        //     ->union(
        //         OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -30 DAY)'))
        //             ->select([DB::raw('"Last 30 days"'), DB::raw('sum(price) as total')])
        //     )
        //     ->get();
        $totalRevenue = Order::whereMonth('created_at', '=', Carbon::now())
            ->select([DB::raw('"Saat ini" as date'), DB::raw('sum(price) as total')])
            ->union(
                OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -1 MONTH)'))
                    ->select([DB::raw('"Bulan lalu"'), DB::raw('sum(price) as total')])
            )
            ->union(
                OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -2 MONTH)'))
                    ->select([DB::raw('"3 Bulan terakhir"'), DB::raw('sum(price) as total')])
            )
            ->get();
        $topSellings = DB::table('products')
            ->select([
                'products.name',
                DB::raw('SUM(order_items.qty) AS total_sales'),
                DB::raw('SUM(products.price * order_items.qty) AS total_price'),
            ])
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('products.id')
            ->orderByDesc('total_sales')
            ->paginate(3);
        $monthNow = Order::whereMonth('created_at', '=', Carbon::now())->sum('price');
        $beforeMonth = Order::whereMonth('created_at', '=', Carbon::now()->startOfMonth()->subMonth(1))->sum('price');
        return view('reports.index', compact(['users', 'orders', 'monthNow', 'beforeMonth', 'topSellings', 'totalRevenue']));
    }

    public function document()
    {
        $user = User::find(Auth::user()->id);
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->paginate(5);
        $totalRevenue = Order::whereMonth('created_at', '=', Carbon::now())
            ->select([DB::raw('"Saat ini" as date'), DB::raw('sum(price) as total')])
            ->union(
                OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -1 MONTH)'))
                    ->select([DB::raw('"Bulan lalu"'), DB::raw('sum(price) as total')])
            )
            ->union(
                OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -2 MONTH)'))
                    ->select([DB::raw('"3 Bulan terakhir"'), DB::raw('sum(price) as total')])
            )
            ->get();
        $topSellings = DB::table('products')
            ->select([
                'products.name',
                DB::raw('SUM(order_items.qty) AS total_sales'),
                DB::raw('SUM(products.price * order_items.qty) AS total_price'),
            ])
            ->join('order_items', 'order_items.product_id', '=', 'products.id')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->groupBy('products.id')
            ->orderByDesc('total_sales')
            ->paginate(3);
        $monthNow = Order::whereMonth('created_at', '=', Carbon::now())->sum('price');
        $beforeMonth = Order::whereMonth('created_at', '=', Carbon::now()->startOfMonth()->subMonth(1))->sum('price');
        return view('reports.document', compact([
            'user',
            'orders',
            'totalRevenue',
            'topSellings',
            'monthNow',
            'beforeMonth'
        ]));
    }
}

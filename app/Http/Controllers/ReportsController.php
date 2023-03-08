<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $topSellings = DB::table('order_items')
            ->select('products.name', 'products.price', DB::raw('SUM(order_items.qty) AS total'))
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->whereMonth('created_at', '=', Carbon::now())
            ->limit(3);
        $monthNow = Order::whereMonth('created_at', '=', Carbon::now())->sum('price');
        $beforeMonth = Order::whereMonth('created_at', '=', Carbon::now()->startOfMonth()->subMonth(1))->sum('price');
        return view('reports.index', compact(['users', 'orders', 'monthNow', 'beforeMonth', 'topSellings']));
    }

    public function export_pdf()
    {
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();
        $fileName = 'report-' . new DateTime(Carbon::now()) . '-.pdf';
        $pdf = PDF::loadView('reports.document', compact(['orders']));

        return $pdf->download($fileName);
    }
}

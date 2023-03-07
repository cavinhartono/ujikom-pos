<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:laporan')->only('view');
    }

    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();
        $monthNow = Order::sum('price')->whereMonth('created_at', '=', Carbon::now());
        $beforeMonth = Order::sum('price')->whereMonth('created_at', '=', (Carbon::now() - 1));
        return view('reports.index', compact(['users', 'orders', 'monthNow', 'beforeMonth']));
    }

    public function export_pdf()
    {
        $orders = Order::with('order_item', 'customer')->orderBy('created_at', 'DESC')->get();
        $fileName = 'report-' . new DateTime(Carbon::now()) . '-.pdf';
        $pdf = PDF::loadView('reports.document', compact(['orders']));

        return $pdf->download($fileName);
    }
}

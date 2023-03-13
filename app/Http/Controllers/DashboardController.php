<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::all();
        $revenue = OrderItem::where('created_at', '>', DB::raw('DATE_ADD(CURDATE(), INTERVAL -1 YEAR)'))
            ->select([DB::raw('"Tahun lalu" as date'), DB::raw('sum(price) as total')])
            ->union(
                Order::whereYear('created_at', '=', Carbon::now())
                    ->select([DB::raw('"Tahun ini" as date'), DB::raw('sum(price) as total')])
            )->get();
        $categories = DB::table('products')
            ->select([
                'categories.name',
                DB::raw('COUNT(products.category_id) AS total_products'),
            ])
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->groupBy('products.id')
            ->get();
        $customers = Customer::all();
        $customerLast = Customer::orderBy('created_at', 'DESC')->paginate(5);

        if (Auth::user()->roles->first()->name == 'admin') {
            return view('dashboard.index', compact(['users', 'customers', 'customerLast', 'orders', 'revenue', 'categories']));
        } else if (Auth::user()->roles->first()->name == 'user') return view('dashboard.guest');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        $orders = Order::all();
        $foods = Categories::where('name', 'LIKE', "makanan")->count();
        $drinks = Categories::where('name', 'LIKE', "minunan")->count();
        $others = Categories::where('name', 'NOT LIKE', "makanan")->where('name', 'NOT LIKE', "minunan")->count();
        $customers = Customer::all();
        $customerLast = Customer::orderBy('created_at', 'DESC')->paginate(5);
        return view('dashboard.index', compact(['users', 'customers', 'customerLast', 'foods', 'drinks', 'others', 'orders']));
    }
}

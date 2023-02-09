<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->whereNotNull('last_seen')->orderBy('last_seen', "DESC")->paginate(5);
        return view('orders.index', compact(['users']));
    }
}

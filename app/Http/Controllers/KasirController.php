<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:kasir-mode')->only('view');
    }

    public function index()
    {
        $products = Product::all();

        if (Auth::user()->roles->first()->name == 'user') return "Maaf tidak dapat diakses";
        return view('cashier.dashboard', compact(['products']));
    }

    public function store(Request $request)
    {
        $customer = Customer::create($request->only(['name', 'phone']));

        $isOrder = Order::create([
            'customer_id' => $customer->id,
            'price' => $request->price,
            'return' => $request->return,
            'accept' => $request->accept,
        ]);

        $isTransaction = DB::transaction(function () use ($isOrder) {
            $carts = Cart::all();

            if ($isOrder and $carts) {
                foreach ($carts as $cart) {
                    $orderItem = [
                        'product_id' => $cart->product_id,
                        'order_id' => $isOrder->id,
                        'qty' => $cart->qty,
                        'price' => $cart->price,
                    ];

                    $isOrderItem = OrderItem::create($orderItem);

                    if ($isOrderItem) {
                        $product = Product::findOrFail($cart->product_id);
                        $product->qty -= $cart->qty;
                        $product->save();
                    }

                    $cart->delete();
                }
            }

            return $isOrder;
        });

        return redirect()->route('struck', $isTransaction->id);
    }

    public function print_struck($id)
    {
        $orderItem = Order::with('order_item', 'customer')->findOrFail($id);
        return view('cashier.struck', compact(['orderItem']));
    }
}

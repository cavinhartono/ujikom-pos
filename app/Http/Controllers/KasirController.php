<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KasirController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('cashier.dashboard', compact(['products']));
    }

    public function store(Request $request)
    {
        $getOrder = [
            'customer_id' => DB::getPdo()->lastInsertId(),
            'accept' => $request->accept,
            'price' => $request->price,
            'return' => $request->return
        ];

        $getCustomer = [
            'name' => $request->name,
            'phone' => $request->phone
        ];

        $isTransaction = DB::transaction(function () use ($getOrder, $getCustomer) {
            Customer::create($getCustomer);
            $isOrder = Order::create($getOrder);
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

        if ($isTransaction) {
            return dd($isTransaction);
        }
    }

    public function print_struck()
    {
        $orderItem = OrderItem::with('order', 'customer')->get();
        return view('cashier.stuck', compact(['orderItem']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return response()->json([
            'status' => 200,
            'carts' => $carts,
            'message' => 'success'
        ]);
    }

    public function store(Request $request)
    {
        $request->product_id ? $product = Product::findOrFail($request->productId) : $product = Product::where('barcode', $request->productCode)->first();

        if ($product === null) {
            return response()->json([
                'status' => 500,
                'message' => 'product not found!'
            ]);
        }

        $isExist = Cart::where('product_id', $product->id)->first();

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $itemQuantity = 0;
        if ($carts) {
            foreach ($carts as $cart) {
                if ($cart->name == $product->name) {
                    $itemQuantity = $cart->qty;
                    break;
                }
            }
        }

        if ($product->qty < $itemQuantity || $product->qty < 1) {
            return response()->json([
                'status' => 400,
                'message' => 'product is empty'
            ]);
        }

        if ($isExist) {
            return response()->json([
                'status' => 400,
                'message' => 'product is already added'
            ]);
        } else {
            $carts = Cart::updateOrCreate([
                'product_id' => $product->id,
                'user_id' => Auth::user()->id,
                'name' => $product->name,
                'price' => $product->price,
                'stock' => $product->qty,
                'qty' => 1,
            ]);

            return response()->json([
                'status' => 200,
                'carts' => $carts,
                'message' => 'success'
            ]);
        }
    }

    public function update(Request $request, Cart $cart)
    {
        $product = Product::findOrFail($cart->product_id);

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $itemQuantity = 0;
        if ($carts) {
            foreach ($carts as $cart) {
                if ($cart->name == $product->name) {
                    $itemQuantity = $cart->qty;
                    break;
                }
            }
        }

        if ($product->qty <= $itemQuantity && $request->qty > $product->qty) {
            return response()->json([
                'status' => 400,
                'message' => 'product is limit'
            ]);
        }

        $cart->update(['quantity' => $request->qty]);

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->json([
            'status' => 200,
            'message' => 'success'
        ]);
    }

    public function scan(Request $request)
    {
        $product = Product::where('barcode', $request->productCode)->first();
        dd($product);

        $isExist = Cart::where('product_id', $product->id)->first();

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        $itemQuantity = 0;
        if ($carts) {
            foreach ($carts as $cart) {
                if ($cart->name == $product->name) {
                    $itemQuantity = $cart->qty;
                    break;
                }
            }
        }

        if ($product->qty < $itemQuantity || $product->qty < 1) {
            return response()->json([
                'status' => 400,
                'message' => 'product is empty'
            ]);
        }

        if ($isExist) {
            return response()->json([
                'status' => 400,
                'message' => 'product is already added'
            ]);
        } else {
            $carts = Cart::updateOrCreate([
                'product_id' => $product->id,
                'price' => $product->price,
                'qty' => 1,
                'stock' => $product->qty,
                'name' => $product->name,
                'user_id' => Auth::user()->id,
            ]);

            return response()->json([
                'status' => 200,
                'carts' => $carts,
                'message' => 'success'
            ]);
        }
    }
}

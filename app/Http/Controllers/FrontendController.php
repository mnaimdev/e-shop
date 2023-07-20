<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Customer;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function index()
    {
        $products = Product::where('listed', 1)->take(4)->get();

        $randomProducts = Product::inRandomOrder()->get();

        return view('welcome', [
            'products'          => $products,
            'randomProducts'    => $randomProducts,
        ]);
    }

    function productDetails($product_id)
    {
        $product = Product::find($product_id);
        return view('product_details', [
            'product' => $product,
        ]);
    }

    function orderPlace()
    {
        return view('orderplaced');
    }

    function checkout()
    {
        return view('checkout');
    }

    function cartStore(Request $request)
    {


        $request->validate([
            'quantity'  => 'required',
        ]);

        $customerId = session()->getId();
        $productId = $request->product_id;

        $productQuantity = Product::find($productId)->quantity;

        // stock check
        if ($productQuantity < $request->quantity) {
            return redirect()->back()->with('stock', 'Out of Stock');
        } else {

            // if product exists
            if (Cart::where('product_id', $productId)->where('customer_id', $customerId)->exists()) {
                Cart::where('product_id', $productId)->where('customer_id', $customerId)->increment('quantity', $request->quantity);

                return back()->with('cart', 'Cart Added');
            } else {
                Cart::create([
                    'product_id'    => $productId,
                    'customer_id'   => $customerId,
                    'quantity'      => $request->quantity,
                ]);

                return back()->with('cart', 'Cart Added');
            }
        }
    }

    function order()
    {
        $districts = District::all();

        return view('order', [
            'districts'     => $districts,
        ]);
    }


    function orderStore(Request $request)
    {
        $orderId = '#E' . rand(111111, 99999999) . 'SHOP';

        if ($request->payment_method == 1) {

            // insert customer information
            Customer::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'address'       => $request->address,
                'district'      => $request->district,
                'zip_code'      => $request->zip_code,
                'name'          => $request->name,
                'created_at'    => Carbon::now(),
            ]);

            // insert order info
            Order::create([
                'order_id'          => $orderId,
                'customer_id'       => $request->customerId,
                'phone'             => $request->phone,
                'payment_method'    => $request->payment_method,
                'sub_total'         => $request->subTotal,
                'discount'          => $request->discount,
                'total'             => $request->total,
                'created_at'        => Carbon::now(),

            ]);

            // check cart
            $carts = Cart::where('customer_id', $request->customerId)->get();

            // order product details
            foreach ($carts as $cart) {
                OrderProduct::create([
                    'order_id'          => $orderId,
                    'customer_id'       => $request->customerId,
                    'phone'             => $request->phone,
                    'product_id'        => $cart->product->id,
                    'quantity'          => $cart->quantity,
                    'created_at'        => Carbon::now(),
                ]);

                // remove product quantity
                Product::where('id', $cart->product->id)->decrement('quantity', $cart->quantity);
            }
            // remove cart
            Cart::where('customer_id', $request->customerId)->delete();


            return redirect('/orderplaced');
        } else if ($request->payment_method == 2) {
            return 'ssl';
        } else {
            return 'stripe';
        }
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = session()->get('cart') ?? [];
        if (count($items) == 0) {
            return redirect()->route('shop')->with('error', 'You must add products to cart first');
        }
        return view('frontend.checkout', compact('items'));
    }


    public function store(Request $request)
    {
        $items = session()->get('cart') ?? [];
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'You must login first');
        }

        if (count($items) == 0) {
            return redirect()->route('shop')->with('error', 'You must add products to cart first');
        }

        DB::beginTransaction();
        try {
            $productsCount = 0;
            $total = 0;
            foreach ($items as $item) {
                $productsCount += $item['quantity'];
                $total += $item['quantity'] * $item['price'];
            }

            $data = $request->validate([
                'payment_method' => 'required|in:cash,paypal',
                'name' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',
                'postal_code' => 'nullable|string',
                'more_info' => 'nullable|string',
            ]);
            // --------- create order ---------
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'products_count' => $productsCount,
                'total' => $total,
                'payment_method' => $data['payment_method'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'city' => $data['city'],
                'address' => $data['address'],
                'postal_code' => $data['postal_code'],
                'more_info' => $data['more_info'],
            ]);

            // --------- create order items ---------



            foreach ($items as $item) {
                $order->items()->create([
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'total' => $item['quantity'] * $item['price'],
                ]);

                // OrderItem::create([
                //     'order_id' => $order->id,
                //     'product_id' => $item['id'],
                //     'quantity' => $item['quantity'],
                //     'unit_price' => $item['price'],
                //     'total' => $item['quantity'] * $item['price'],
                // ]);
            }


            // $order->items()->createMany(array_map(function ($item) {
            //     return [
            //         'product_id' => $item['id'],
            //         'quantity' => $item['quantity'],
            //         'unit_price' => $item['price'],
            //         'total' => $item['quantity'] * $item['price'],
            //     ];
            // }, $items));
            // --------- clear cart ---------   
            session()->forget('cart');
            DB::commit();
            return redirect()->route('home')->with('success', 'Order created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong');
        }
    }
}

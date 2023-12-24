<?php

namespace App\Http\Controllers\Front\Payments;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalHttp\HttpException;

class PaypalController extends Controller
{
    public function create($orderId)
    {
        // --------- get order details ---------
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        if ($order->payment_method != 'paypal') {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        // --------- get client from service container ---------
        $client = app('PaypalClient');


        // --------- create order request ---------
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => $order->total,
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => route('paypal.cancel', $order->id),
                "return_url" => route('paypal.rollback', $order->id)
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            if ($response->statusCode == 201) {
                foreach ($response->result->links as $link) {
                    if ($link->rel == 'approve') {
                        return redirect()->away($link->href);
                    }
                }
            }
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            print_r($ex->getMessage());
        }
    }



    public function rollback($orderId, Request $request)
    {
        // --------- get order details ---------
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        if ($order->payment_method != 'paypal') {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        // --------- get client from service container ---------
        $client = app('PaypalClient');
        $token = $request->query('token');

        $request = new OrdersCaptureRequest($token);
        $request->prefer('return=representation');
        try {
            // Call API with your client and get a response for your call
            $response = $client->execute($request);

            // If call returns body in response, you can get the deserialized version from the result attribute of the response
            if ($response->statusCode == 201 && $response->result->status == 'COMPLETED') {
                // --------- update order ---------
                $order->update([
                    'status' => 'accepted',
                    'payment_status' => 'paid',
                ]);
                // --------- clear cart ---------
                session()->forget('cart');
                return redirect()->route('shop')->with('success', 'Order created successfully');
            }
        } catch (HttpException $ex) {
            $order->update([
                'status' => 'rejected',
                'payment_status' => 'failed',
            ]);
            return redirect()->route('shop')->with('error', 'Payment failed');
        }
    }




    public function cancel($orderId)
    {
        // --------- get order details ---------
        $order = Order::find($orderId);
        if (!$order) {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        if ($order->payment_method != 'paypal') {
            return redirect()->route('shop')->with('error', 'Order not found');
        }
        // --------- update order ---------
        $order->update([
            'status' => 'rejected',
            'payment_status' => 'unpaid',
        ]);
        return redirect()->route('shop')->with('error', 'Payment failed');
    }
}

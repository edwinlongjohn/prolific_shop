<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Paystack;

class OrderController extends Controller
{
    public function submitOrder(Request $r)
    {
        // $r->validate([
        //     'sel_address' => ['required', 'integer', 'max:255'],
        //     'date' => ['required', 'string', 'max:255'],
        //     'time' => ['required', 'string', 'max:255'],
        //     'payment_method' => ['required', 'integer', 'max:255'],
        //     'reference' => ['required', 'string', 'max:255'],
        //     'callback_url' => ['required', 'string', 'max:255'],
        // ]);
        if (empty(session('cart'))) {
            return redirect()->back()->with(['error' => 'Cart is empty']);
        }


        /* Get Delivery fee for selected area and add delivery charges for specific items if any */
        $subTotal = 0;
        foreach(session('cart') as $product){
            $subTotal += $product['quantity'] * $product['price'];
        }
        $total_amount =$subTotal* 10000;
        $reference = Paystack::genTranxRef();

        $order = new Order();
        $order->order_code = \Str::random(5);
        $order->user_id = Auth::user()->id;
        $order->total = $total_amount;
        $order->address = $r->street . ' .' . $r->zip . ' .' . $r->state . ' .' . $r->town;
        $order->note = $r->note;
        $order->status = pending;
        $order->payment_method_id = $r->payment_method;
        $order->save();

        /* Add order items */
        $cart_items = session()->get('cart');
        foreach ($cart_items as $item) {
            $product = Product::find($item['identity']);
            $i = new OrderItem();
            $i->order_id = $order->id;
            $i->product_id = $item->identity;
            $i->price = $item['quantity'] * $item['price'];
            $i->qty = $item['quantity'];
            $i->save();
        }


        /* Card Payment */
        if ($r->payment_method == 'paystack') {
            $data = array(
                "amount" =>  $total_amount * 100,
                "reference" => $r->reference,
                "email" => Auth::user()->email,
                "currency" => "NGN",
                "orderID" => $order->order_code,
                'callback_url' =>
            );
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        }


    }


    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $order_id = $paymentDetails['data']['metadata']['order_id'];
        if ($paymentDetails['status']) {
            \Cart::clear();
            $order = Order::find($order_id);
            $order->status_id = 2;
            $order->paid = 1;
            $order->save();
            $subject = "Order made successfully";
            $message = "You have successfully placed and paid for your order. It is currently being attended to,
             you will recieve updates concerning the status of your order soon. Thanks.";
            return view('success', compact(['subject', 'message', 'order']));
        } else {
            $subject = "Oops!, an error occured";
            $message = "Sorry, your order was not successfull, please check the card details and try again";
            return view('success', compact(['subject', 'message', 'order']));
        }
    }
}

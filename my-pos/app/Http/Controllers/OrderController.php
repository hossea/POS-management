<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        $orders = Order::with('orderDetails')->get();

        $lastOrder = Order::latest()->first();
        $lastID = $lastOrder ? $lastOrder->id : null;

        $order_receipt = $lastID ? OrderDetail::where('order_id', $lastID)->get() : collect();

        return view('orders.index', [
        'products' => $products, 'orders' => $orders, 'order_receipt' => $order_receipt
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();

        DB::transaction(function () use ($request) {
            // Create the order
            $order = new Order();
            $order->name = $request->customer_name;
            $order->phone = $request->customer_phone;
            $order->save();

            $orderId = $order->id;

            // Create order details for each product
            foreach ($request->product_id as $index => $productId) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_id = $orderId;
                $orderDetail->product_id = $productId;
                $orderDetail->quantity = $request->quantity[$index];
                $orderDetail->unitprice = $request->price[$index];
                $orderDetail->discount = $request->discount[$index];
                $orderDetail->amount = $request->total_amount[$index];
                $orderDetail->save();
            }

            // Create the transaction record
            $transaction = new Transaction();
            $transaction->order_id = $orderId;
            $transaction->balance = $request->balance;
            $transaction->paid_amount = $request->paid_amount;
            $transaction->payment_method = $request->payment_method;
            $transaction->trans_amount = array_sum($request->total_amount);
            $transaction->trans_date = now()->format('Y-m-d H:i:s');
            $transaction->user_id = auth()->id();
            $transaction->save();
        });

        // Fetch updated data to display on index page
        $products = Product::all();
        $orders = Order::with('orderDetails')->get();

        return view('orders.index', [
            'products' => $products,
            'orders' => $orders,
        ])->with('success', 'Order created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->products()->detach();
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    public function showReceipt($orderId)
    {
        $order_receipt = OrderDetail::where('order_id', $orderId)
            ->with('product')->get();

        if ($order_receipt->isEmpty()) {
            return redirect()->back()->with('error', 'No items found for this order.');
        }
        return view('reports.receipt', compact('order_receipt'));
    }


}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = session()->get('cart', []);
        if (empty($cartItems)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty');
        }
        return view('orders.checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);
        $totalAmount = 0;

        // Calculate total amount
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = auth()->user()->orders()
            ->with(['items.product']) // Add this line to eager load products
            ->latest()
            ->get();
            
        // Add this temporary debug code
        foreach($orders as $order) {
            foreach($order->items as $item) {
                \Log::info('Product debug:', [
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'product' => $item->product,
                    'product_id' => $item->product_id
                ]);
            }
        }
        
        return view('orders.index', compact('orders'));
    }
}

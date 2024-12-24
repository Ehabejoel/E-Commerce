@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout</h1>
        
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Shipping Information -->
            <div class="flex-grow lg:w-2/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900">Shipping Information</h2>
                    </div>
                    
                    <div class="p-6">
                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <div class="space-y-6">
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700">Delivery Address</label>
                                    <input type="text" 
                                           id="address" 
                                           name="address" 
                                           required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Enter your full address">
                                </div>
                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="tel" 
                                           id="phone" 
                                           name="phone" 
                                           required
                                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                                           placeholder="Enter your phone number">
                                </div>
                                
                                <div class="pt-4">
                                    <button type="submit" 
                                            class="w-full bg-blue-600 text-white px-6 py-3 rounded-md font-medium hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                        Place Order
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Order Summary -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden sticky top-4">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                        <h2 class="text-xl font-semibold text-gray-900">Order Summary</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="space-y-4">
                            @php $total = 0 @endphp
                            @foreach($cartItems as $item)
                                @php $total += $item['price'] * $item['quantity'] @endphp
                                <div class="flex justify-between items-center">
                                    <div class="flex-1">
                                        <h3 class="text-sm font-medium text-gray-900">{{ $item['name'] }}</h3>
                                        <p class="text-sm text-gray-500">Qty: {{ $item['quantity'] }}</p>
                                    </div>
                                    <span class="text-sm font-medium text-gray-900">
                                        ${{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-semibold text-gray-900">Total</span>
                                <span class="text-lg font-bold text-gray-900">${{ number_format($total, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

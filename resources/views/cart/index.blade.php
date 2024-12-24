@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<div class="container mx-auto py-12 px-4">
    <h2 class="text-3xl font-bold mb-8 text-gray-800">Your Shopping Cart</h2>

    @if(count($cartItems) > 0)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Product</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $total = 0 @endphp
                    @foreach($cartItems as $id => $item)
                        @php $total += $item['price'] * $item['quantity'] @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <img class="h-16 w-16 object-cover rounded" src="{{ asset($item['image'] ?? 'images/default.jpg') }}" alt="{{ $item['name'] }}">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item['name'] }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item['price'], 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" onclick="decrementQuantity('quantity-{{ $id }}')" 
                                            class="bg-gray-200 px-2 py-1 rounded hover:bg-gray-300">-</button>
                                    <input type="number" name="quantity" id="quantity-{{ $id }}" 
                                           value="{{ $item['quantity'] }}" min="1" 
                                           class="w-16 text-center border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                           onchange="this.form.submit()">
                                    <button type="button" onclick="incrementQuantity('quantity-{{ $id }}')"
                                            class="bg-gray-200 px-2 py-1 rounded hover:bg-gray-300">+</button>
                                </form>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-gray-50">
                        <td colspan="3" class="px-6 py-4 text-right font-medium">Total:</td>
                        <td colspan="2" class="px-6 py-4 font-bold text-lg text-blue-600">${{ number_format($total, 2) }}</td>
                    </tr>
                </tfoot>
            </table>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                <div class="flex justify-between items-center">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md transition duration-150">
                        <i class="fas fa-arrow-left mr-2"></i> Continue Shopping
                    </a>
                    <a href="{{ route('checkout') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-150">
                        Proceed to Checkout <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-16 bg-white rounded-lg shadow-md">
            <i class="fas fa-shopping-cart fa-4x text-gray-400 mb-4"></i>
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Your cart is empty</h3>
            <p class="text-gray-600 mb-8">Looks like you haven't added any items to your cart yet.</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition duration-150">
                <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
function incrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    input.value = parseInt(input.value) + 1;
    input.form.submit();
}

function decrementQuantity(inputId) {
    const input = document.getElementById(inputId);
    if (parseInt(input.value) > 1) {
        input.value = parseInt(input.value) - 1;
        input.form.submit();
    }
}
</script>
@endpush
@endsection

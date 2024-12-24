@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section relative bg-[url('https://images.pexels.com/photos/135620/pexels-photo-135620.jpeg')] bg-cover bg-center">
    <div class="absolute inset-0 bg-black bg-opacity-50"></div>
    <div class="container mx-auto px-4 relative">
        <div class="flex items-center min-h-[60vh]">
            <div class="w-full lg:w-1/2 text-white">
                <h1 class="text-5xl font-bold mb-4">Welcome to Our Fashion-Shop</h1>
                <p class="text-xl mb-8">Discover amazing products at unbeatable prices!</p>
                <div>
                    <a href="{{ route('products.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Shop Now</a>
                    @guest
                        <a href="{{ route('register') }}" class="bg-transparent border border-white text-white hover:bg-white hover:text-black font-bold py-2 px-4 rounded">Sign Up</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Featured Products Section -->
<div class="container mx-auto py-8 px-4">
    <h2 class="text-3xl font-bold text-center mb-8">Featured Products</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
        @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300 cursor-pointer group">
            @if($product->image)
                <div class="h-40 overflow-hidden">
                    <img src="{{ asset($product->image) }}" 
                         alt="{{ $product->product_name }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
            @endif
            <div class="p-4">
                <h5 class="font-semibold text-gray-800 mb-2 truncate group-hover:text-blue-600">{{ $product->product_name }}</h5>
                <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-blue-600 font-bold group-hover:text-blue-800">${{ number_format($product->price, 2) }}</span>
                    <span class="text-sm {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                        {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                    </span>
                </div>
                <form action="{{ route('cart.add', $product) }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium py-2 px-4 rounded-md transition-colors group-hover:bg-blue-700">
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Features Section -->
<div class="bg-gray-100 py-16">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <div>
                <i class="fas fa-shipping-fast fa-3x text-blue-500 mb-4"></i>
                <h4 class="text-xl font-bold">Fast Delivery</h4>
                <p class="text-gray-600">Free shipping on orders over $50</p>
            </div>
            <div>
                <i class="fas fa-lock fa-3x text-blue-500 mb-4"></i>
                <h4 class="text-xl font-bold">Secure Payment</h4>
                <p class="text-gray-600">100% secure payment processing</p>
            </div>
            <div>
                <i class="fas fa-headset fa-3x text-blue-500 mb-4"></i>
                <h4 class="text-xl font-bold">24/7 Support</h4>
                <p class="text-gray-600">Dedicated support team</p>
            </div>
        </div>
    </div>
</div>
@endsection

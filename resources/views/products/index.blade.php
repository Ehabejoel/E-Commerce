@extends('layouts.app')

@section('title', 'Products')

@section('content')
<div class="container mx-auto py-8 px-4">
    <!-- Search and Filters Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form action="{{ route('products.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search Input -->
                <div class="col-span-1 md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search products..." 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Price Range -->
                <div class="flex space-x-2">
                    <input type="number" name="min_price" value="{{ request('min_price') }}" 
                           placeholder="Min Price" step="0.01"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <input type="number" name="max_price" value="{{ request('max_price') }}" 
                           placeholder="Max Price" step="0.01"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <!-- Sort Dropdown -->
                <select name="sort" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A-Z)</option>
                    <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z-A)</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price (Low to High)</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price (High to Low)</option>
                </select>
            </div>

            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="in_stock" value="1" 
                           {{ request('in_stock') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    <span class="ml-2">In Stock Only</span>
                </label>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">
                    Apply Filters
                </button>
                
                @if(request()->anyFilled(['search', 'min_price', 'max_price', 'sort', 'in_stock']))
                    <a href="{{ route('products.index') }}" class="text-gray-600 hover:text-gray-900">
                        Clear Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Products Grid -->
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

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>

    @if($products->isEmpty())
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">No products found matching your criteria.</p>
        </div>
    @endif
</div>
@endsection

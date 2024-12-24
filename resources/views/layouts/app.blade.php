<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel E-Shop') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/your-code.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            .hero-section {
                background-size: cover;
                background-position: center;
                min-height: 60vh;
            }
            .product-card {
                height: 100%;
                display: flex;
                flex-direction: column;
            }
            .product-image {
                height: 200px;
                object-fit: cover;
                width: 100%;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <div class="flex items-center">
                            <a href="{{ url('/') }}" class="text-white text-xl font-bold">E-Shop</a>
                            <div class="hidden md:block ml-10">
                                <div class="flex items-baseline space-x-4">
                                    <a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Products</a>
                                    <a href="{{ route('cart.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium flex items-center">
                                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Cart
                                        @if(isset($cartCount) && $cartCount > 0)
                                            <span class="ml-1 bg-red-500 text-white px-2 py-1 rounded-full text-xs">{{ $cartCount }}</span>
                                        @endif
                                    </a>
                                    @auth
                                        <a href="{{ route('orders.index') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">My Orders</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block">
                            <div class="flex items-center">
                                @auth
                                    <a href="{{ route('profile.edit') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Profile</a>
                                    <form method="POST" action="{{ route('logout') }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                                    </form>
                                @else
                                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Login</a>
                                    <a href="{{ route('register') }}" class="ml-4 text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @if(session('success'))
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif
                
                {{ $slot ?? '' }}
                @yield('content')
            </main>
        </div>
    </body>
</html>

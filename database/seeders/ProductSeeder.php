<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'Laptop Pro X1',
                'description' => 'High-performance laptop for professionals',
                'price' => 1299.99,
                'stock' => '10', // Changed 'Stock' to 'stock'
                'image' => 'storage/products/laptop.jpg' // Ensure the path is correct
            ],
            [
                'product_name' => 'Smartphone Y2',
                'description' => 'Latest smartphone with advanced features',
                'price' => 699.99,
                'stock' => '15', // Changed 'Stock' to 'stock'
                'image' => 'storage/products/phone.jpg' // Ensure the path is correct
            ],
            [
                'product_name' => 'Wireless Headphones',
                'description' => 'Premium noise-canceling headphones',
                'price' => 199.99,
                'stock' => '20', // Changed 'Stock' to 'stock'
                'image' => 'storage/products/headphones.jpg' // Ensure the path is correct
            ],
            [
                'product_name' => 'Gaming Mouse Z3',
                'description' => 'Ergonomic gaming mouse with customizable buttons',
                'price' => 59.99,
                'stock' => '50', // Changed 'Stock' to 'stock'
                'image' => 'storage/products/gaming_mouse.jpg' // Ensure the path is correct
            ],
            [
                'product_name' => '4K Monitor Ultra',
                'description' => 'Ultra HD 4K monitor with vibrant colors',
                'price' => 399.99,
                'stock' => '30', // Changed 'Stock' to 'stock'
                'image' => 'storage/products/4k_monitor.jpg' // Ensure the path is correct
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

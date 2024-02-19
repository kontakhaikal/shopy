<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = collect([
            ['name' => 'Product 1', 'price' => 100, 'stock' => 10, 'picture' => '/img/adapter.png'],
            ['name' => 'Product 2', 'price' => 100, 'stock' => 10, 'picture' => '/img/charger.png'],
            ['name' => 'Product 3', 'price' => 100, 'stock' => 10, 'picture' => '/img/drive.webp'],
            ['name' => 'Product 4', 'price' => 100, 'stock' => 10, 'picture' => '/img/keyboard.png'],
            ['name' => 'Product 5', 'price' => 100, 'stock' => 10, 'picture' => '/img/mouse.webp'],
            ['name' => 'Product 6', 'price' => 100, 'stock' => 10, 'picture' => '/img/stand.png'],
        ]);

        $products->map(fn ($product) => Product::create($product))->each(fn ($product) => $product->save());
    }
}

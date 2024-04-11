<?php

namespace Database\Seeders;

use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 15; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'price' => rand(10, 1000),
            ]);
        }
    }
}

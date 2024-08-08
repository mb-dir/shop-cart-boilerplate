<?php

namespace Database\Seeders;

use App\Models\DeliveryType;
use App\Models\Order;
use App\Models\OrderStatus;
use App\Models\PaymentType;
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

        $orderStatuses = ['Unconfirmed', 'Confirmed'];
        foreach ($orderStatuses as $status) {
            OrderStatus::create(['name' => $status]);
        }

        $paymentTypes = ['Credit Card', 'PayPal', 'Cash on Delivery'];
        foreach ($paymentTypes as $type) {
            PaymentType::create(['name' => $type]);
        }

        $deliveryTypes = ['Pickup', 'Express', 'Standard'];
        foreach ($deliveryTypes as $type) {
            DeliveryType::create(['name' => $type]);
        }
    }
}

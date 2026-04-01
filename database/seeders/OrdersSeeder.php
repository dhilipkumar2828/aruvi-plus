<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::all();

        if ($products->isEmpty()) {
            return;
        }

        $customers = [
            ['name' => 'Ramesh Kumar', 'email' => 'ramesh@example.com'],
            ['name' => 'Karthik S.', 'email' => 'karthik@example.com'],
            ['name' => 'Anjali Devi', 'email' => 'anjali@example.com'],
            ['name' => 'Priya Menon', 'email' => 'priya@example.com'],
            ['name' => 'Arjun V.', 'email' => 'arjun@example.com'],
        ];

        $statuses = ['processing', 'shipped', 'delivered'];

        foreach (range(1, 8) as $index) {
            $product = $products->random();
            $customer = $customers[array_rand($customers)];
            $quantity = rand(1, 2);
            $status = $statuses[array_rand($statuses)];

            Order::updateOrCreate(
                ['order_number' => 'ORD-' . str_pad((string) (7200 + $index), 4, '0', STR_PAD_LEFT)],
                [
                    'customer_name' => $customer['name'],
                    'customer_email' => $customer['email'],
                    'product_name' => $product->name,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'amount' => (float) $product->price * $quantity,
                    'status' => $status,
                    'payment_status' => 'paid',
                ]
            );
        }
    }
}

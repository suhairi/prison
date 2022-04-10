<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Orders;
use App\Models\User;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bulanTahun = date('mY');
        $users = User::where('role', 'user')->where('status', 'active')->get();

        $users = $users->filter(function($item) {
                    if(!Str::startsWith($item->username, 77))
                        return $item;
                });

        foreach($users as $user) {
            // 1. table orders->save()
            // 2. table orders_products->attach()

            $products = [];

            for($i=1; $i<=12; $i++)
                $products[rand(1, 49)] = rand(1, 3);

            $order = Orders::create([
                        'user_id'       => $user->id,
                        'bulanTahun'    => $bulanTahun,
                    ]);

            foreach($products as $product_id => $value)
                $order->products()->attach($product_id, ['quantity' => $value]);

        }
    }

}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Str;

use App\Models\Orders;
use App\Models\User;
use App\Models\Products;

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
        $users = User::where('role', 'user')->where('status', 'active')->orderBy('name', 'asc')->get();

        // $users = $users->filter(function($item) {
        //             if(!Str::startsWith($item->username, 77))
        //                 return $item;
        //         });

        // $users = $users->filter(function($item) {
        //             if(!Str::startsWith($item->username, 85))
        //                 return $item;
        //         });        

        $count = 0;
        foreach($users as $user) {
            // 1. table orders->save()
            // 2. table orders_products->attach()
                        
            do {
                $products = [];
                $subtotal = 0;
                // $count++;
                for($i=1; $i<=9; $i++)
                    $products[rand(1, 49)] = rand(1, 2);

                foreach($products as $product_id => $qty) {
                    $product = Products::find($product_id);
                    // $this->command->info('Price * Quantity: ' . $product->price . ' * ' . $qty . ' = ' . $product->price * $qty);
                    $subtotal += $product->price * $qty;
                }

                if($subtotal == 100) {
                    $count++;
                    $this->command->info($count . '. ' . $user->name . ' --> Ordered');
                }


            } while ($subtotal != 100);

            $order = Orders::create([
                        'user_id'       => $user->id,
                        'bulanTahun'    => $bulanTahun,
                    ]);

            foreach($products as $product_id => $value)
                $order->products()->attach($product_id, ['quantity' => $value]);

        }

        $this->command->info('');
        $this->command->info('##########################');
        $this->command->info('#######  Completed  ######');
        $this->command->info('##########################');
        $this->command->info('');
    }

}

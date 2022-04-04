<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Products;
use App\Models\User;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => strtoupper('Suhairi Abdul Hamid'),
            'username'  => 'suhairi',
            'password'  => Hash::make('password1'),
            'role'      => 'admin',
            'status'    => 'active',
        ]);

        User::create([
            'name'      => strtoupper('Mohd Najib bin Ruslah'),
            'username'  => 'najib',
            'password'  => Hash::make('password1'),
            'role'      => 'admin',
            'status'    => 'active',
        ]);

        User::create([
            'name'      => strtoupper('Mohd Rohman bin Mohd Nor'),
            'username'  => 'rohman',
            'password'  => Hash::make('password1'),
            'role'      => 'admin',
            'status'    => 'active',
        ]);

        User::create([
            'name'      => strtoupper('Shirley a/k Jungot'),
            'username'  => '740224135582',
            'password'  => Hash::make('password1'),
            'role'      => 'hq',
            'status'    => 'active',
        ]);

        User::create([
            'name'      => strtoupper('Noor Sazlawati Bt Zakaria'),
            'username'  => '731015055450',
            'password'  => Hash::make('password1'),
            'role'      => 'hq',
            'status'    => 'active',
        ]);

            



        $this->call([
            ProductSeeder::class,
            UserSeeder::class,
        ]);
        
    }
}

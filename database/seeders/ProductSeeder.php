<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Products::create(['name' => 'GULA PASIR (1KG)', 'price' => 2.8, 'status' => 'active']);
        Products::create(['name' => 'SUSU TEPUNG', 'price' => 12, 'status' => 'active']);
        Products::create(['name' => 'KICAP BOTOL', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'SOS BOTOL', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'BISKUT GULA', 'price' => 5, 'status' => 'active']);
        Products::create(['name' => 'BISKUT CREAM', 'price' => 5, 'status' => 'active']);
        Products::create(['name' => 'KACANG GORENG', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'JEM PELBAGAI', 'price' => 4, 'status' => 'active']);
        Products::create(['name' => 'SERBUK TEH (K)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'SERBUK KOPI', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'NESCAFE (K)', 'price' => 6, 'status' => 'active']);
        Products::create(['name' => 'MILO (1KG)', 'price' => 20, 'status' => 'active']);
        Products::create(['name' => 'BAWANG GORENG', 'price' => 2.5, 'status' => 'active']);
        Products::create(['name' => 'MEE SEDAP ASLI (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI AYAM (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI KARI (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI TOMYAM (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI ASAM LAKSA (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI SOTO (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'MAGGI PAMA (2)', 'price' => 3, 'status' => 'active']);
        Products::create(['name' => 'SAMBAL BELACAN', 'price' => 5, 'status' => 'active']);
        Products::create(['name' => 'SAMBAL KAK NA', 'price' => 12, 'status' => 'active']);
        Products::create(['name' => 'KEROPOK (4)', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'NESTOM (250g)', 'price' => 5, 'status' => 'active']);
        Products::create(['name' => 'TUALA BESAR', 'price' => 12, 'status' => 'active']);
        Products::create(['name' => 'TUALA KECIL', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'SELUAR DALAM', 'price' => 5, 'status' => 'active']);
        Products::create(['name' => 'SELUAR PENDEK', 'price' => 12, 'status' => 'active']);
        Products::create(['name' => 'SELUAR TRACK', 'price' => 25, 'status' => 'active']);
        Products::create(['name' => 'STOKIN', 'price' => 4, 'status' => 'active']);
        Products::create(['name' => 'SARUNG TANGAN', 'price' => 8, 'status' => 'active']);
        Products::create(['name' => 'T-SHIRT', 'price' => 15, 'status' => 'active']);
        Products::create(['name' => 'BOXER', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'BEDAK BERUBAT', 'price' => 8, 'status' => 'active']);
        Products::create(['name' => 'BEDAK WANGI TALKUM', 'price' => 8, 'status' => 'active']);
        Products::create(['name' => 'MINYAK WANGI', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'MINYAK ANGIN', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'MINYAK RAMBUT', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'DEODORANT', 'price' => 8, 'status' => 'active']);
        Products::create(['name' => 'SABUN ANTIBAC (1)', 'price' => 2, 'status' => 'active']);
        Products::create(['name' => 'SABUN BERAS', 'price' => 4.5, 'status' => 'active']);
        Products::create(['name' => 'PENCUCI MUKA', 'price' => 10, 'status' => 'active']);
        Products::create(['name' => 'UBAT GIGI', 'price' => 3.5, 'status' => 'active']);
        Products::create(['name' => 'SHAMPOO', 'price' => 8, 'status' => 'active']);
        Products::create(['name' => 'SABUN BASUH BIO ZIP', 'price' => 13, 'status' => 'active']);
        Products::create(['name' => 'BEKAS SABUN', 'price' => 2, 'status' => 'active']);
        Products::create(['name' => 'BERUS KAIN', 'price' => 2, 'status' => 'active']);
        Products::create(['name' => 'BERUS GIGI', 'price' => 2.5, 'status' => 'active']);
        Products::create(['name' => 'GULA-GULA', 'price' => 0.10, 'status' => 'active']);
        
    }
}

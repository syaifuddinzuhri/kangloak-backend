<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Seller::create([
            'nik' => '3514100311000004',
            'name' => 'Seller',
            'email' => 'seller@gmail.com',
            'password' => 'passwordseller',
            'phone' => '085648989767',
            'address' => 'Prigen Pasuruan',
            'date_of_birth' => '2000-11-03',
        ]);
    }
}

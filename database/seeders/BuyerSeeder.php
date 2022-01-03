<?php

namespace Database\Seeders;

use App\Models\Buyer;
use Illuminate\Database\Seeder;

class BuyerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Buyer::create([
            'nik' => '3514100311000006',
            'name' => 'Buyer',
            'email' => 'buyer@gmail.com',
            'password' => 'passwordbuyer',
            'phone' => '08564876413',
            'address' => 'Malang',
            'date_of_birth' => '2000-02-11',
        ]);
    }
}

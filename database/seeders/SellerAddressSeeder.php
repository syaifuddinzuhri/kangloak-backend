<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SellerAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seller_addresses')->insert([
            'district'      => 'Malang',
            'city'          => 'Surabaya',
            'provincy'      =>  'Magelang',
            'postal_code'   => '12367',
            'address'   => 'JL. Mustika',
            'seller_id'     => 1
        ]);
        DB::table('seller_addresses')->insert([
            'district'      => 'Malang',
            'city'          => 'Surabaya',
            'provincy'      =>  'Magelang',
            'postal_code'   => '12367',
            'address'   => 'JL. Mawar',
            'seller_id'     => 1
        ]);
        DB::table('seller_addresses')->insert([
            'district'      => 'Malang',
            'city'          => 'Surabaya',
            'provincy'      =>  'Magelang',
            'postal_code'   => '12367',
            'address'   => 'JL. Melati',
            'seller_id'     => 1
        ]);
    }
}

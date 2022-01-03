<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JunkSellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('junk_sellers')->insert([
            'junk_id' =>  1,
            'seller_id' =>  1,
            'image' => 'http://placeimg.com/640/480/arch',
            'status' => 'READY',
            'seller_address_id' => 1,
            'description'   => 'Ini Testing Description'
        ]);
        DB::table('junk_sellers')->insert([
            'junk_id' =>  1,
            'seller_id' =>  1,
            'image' => 'http://placeimg.com/640/480/arch',
            'status' => 'READY',
            'seller_address_id' => 1,
            'description'   => 'Ini Testing Description'
        ]);
        DB::table('junk_sellers')->insert([
            'junk_id' =>  1,
            'seller_id' =>  1,
            'image' => 'http://placeimg.com/640/480/arch',
            'status' => 'READY',
            'seller_address_id' => 1,
            'description'   => 'Ini Testing Description'
        ]);
        DB::table('junk_sellers')->insert([
            'junk_id' =>  1,
            'seller_id' =>  1,
            'image' => 'http://placeimg.com/640/480/arch',
            'status' => 'READY',
            'seller_address_id' => 1,
            'description'   => 'Ini Testing Description'
        ]);
        DB::table('junk_sellers')->insert([
            'junk_id' =>  1,
            'seller_id' =>  1,
            'image' => 'http://placeimg.com/640/480/arch',
            'status' => 'READY',
            'seller_address_id' => 1,
            'description'   => 'Ini Testing Description'
        ]);
    }
}

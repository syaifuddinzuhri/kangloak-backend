<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JunkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('junks')->insert([
            'name'      => Str::random(10),
            'junk_category_id' =>  1,
            'weight' => 1,
            'price' => 1000
        ]);
        DB::table('junks')->insert([
            'name'      => Str::random(10),
            'junk_category_id' =>  2,
            'weight' => 1,
            'price' => 2000
        ]);
        DB::table('junks')->insert([
            'name'      => Str::random(10),
            'junk_category_id' =>  3,
            'weight' => 1,
            'price' => 3000
        ]);
        DB::table('junks')->insert([
            'name'      => Str::random(10),
            'junk_category_id' =>  4,
            'weight' => 1,
            'price' => 4000
        ]);
        DB::table('junks')->insert([
            'name'      => Str::random(10),
            'junk_category_id' =>  5,
            'weight' => 1,
            'price' => 5000
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JunkCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('junk_categories')->insert([
            'name'      => Str::random(10),
            'status'    => 1
        ]);
        DB::table('junk_categories')->insert([
            'name'      => Str::random(10),
            'status'    => 1
        ]);
        DB::table('junk_categories')->insert([
            'name'      => Str::random(10),
            'status'    => 1
        ]);
        DB::table('junk_categories')->insert([
            'name'      => Str::random(10),
            'status'    => 1
        ]);
        DB::table('junk_categories')->insert([
            'name'      => Str::random(10),
            'status'    => 1
        ]);
    }
}

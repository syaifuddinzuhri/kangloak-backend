<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_accounts')->insert([
            'name'      => 'BCA',
            'code'          => '172612576',
            'account_name'      =>  'Farel',
            'account_number'   => '12367',
            'status'     => 1,
            'logo'     => 'http://placeimg.com/640/480/arch',
            'qr_code'     => 'http://placeimg.com/640/480/arch',
        ]);
        DB::table('payment_accounts')->insert([
            'name'      => 'BRI',
            'code'          => '1276581',
            'account_name'      =>  'Zuhri',
            'account_number'   => '12367',
            'status'     => 1,
            'logo'     => 'http://placeimg.com/640/480/arch',
            'qr_code'     => 'http://placeimg.com/640/480/arch',
        ]);
        DB::table('payment_accounts')->insert([
            'name'      => 'Mandiri',
            'code'          => '127861782',
            'account_name'      =>  'Auful',
            'account_number'   => '12367',
            'status'     => 1,
            'logo'     => 'http://placeimg.com/640/480/arch',
            'qr_code'     => 'http://placeimg.com/640/480/arch',
        ]);
    }
}

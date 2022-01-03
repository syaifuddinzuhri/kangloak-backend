<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnKycInSellersAndBuyersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sellers', function (Blueprint $table) {
            $table->text('selfie_ktp')->nullable();
            $table->tinyInteger('is_verify_ktp')->default(0);
            $table->tinyInteger('is_verify_selfie_ktp')->default(0);
        });

        Schema::table('buyers', function (Blueprint $table) {
            $table->text('selfie_ktp')->nullable();
            $table->tinyInteger('is_verify_ktp')->default(0);
            $table->tinyInteger('is_verify_selfie_ktp')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sellers_and_buyers', function (Blueprint $table) {
            //
        });
    }
}

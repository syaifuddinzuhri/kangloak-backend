<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnJunkSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('junk_sellers', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_address_id');
            $table->foreign('seller_address_id')->references('id')->on('seller_addresses')->onDelete('NO ACTION')->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('junk_sellers', function (Blueprint $table) {
            //
        });
    }
}

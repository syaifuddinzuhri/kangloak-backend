<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJunkSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junk_sellers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('junk_id');
            $table->unsignedBigInteger('seller_id');
            $table->string('image')->nullable();
            $table->enum('status', ['READY', 'WAITING', 'ONGOING', 'FINISHED'])->default('READY');
            $table->foreign('junk_id')->references('id')->on('junks')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('junk_seller');
    }
}

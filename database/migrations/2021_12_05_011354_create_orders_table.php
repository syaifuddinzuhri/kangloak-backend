<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('junk_seller_id');
            $table->unsignedBigInteger('buyer_id');
            $table->double('weight')->default(0);
            $table->double('total')->default(0);
            $table->enum('status', ['WAITING', 'ONGOING', 'FINISHED']);
            $table->foreign('junk_seller_id')->references('id')->on('junk_sellers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('orders');
    }
}

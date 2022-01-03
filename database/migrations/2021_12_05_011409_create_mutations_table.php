<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutations', function (Blueprint $table) {
            $table->id();
            $table->integer('amount')->nullable();
            $table->enum('status', ['DEPOSIT', 'WITHDRAWAL', 'ORDER'])->nullable();
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreignId('seller_id')->nullable()->constrained('sellers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreignId('buyer_id')->nullable()->constrained('buyers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('mutations');
    }
}

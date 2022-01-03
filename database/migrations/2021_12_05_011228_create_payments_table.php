<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_account_id');
            $table->unsignedBigInteger('buyer_id');
            $table->bigInteger('nominal_fee')->nullable();
            $table->double('nominal')->nullable();
            $table->double('nominal_pay')->nullable();
            $table->enum('status', ['WAITING', 'REFUND','PAID'])->nullable()->default('WAITING');
            $table->string('payment_slip')->nullable();
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('payment_account_id')->references('id')->on('payment_accounts')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('payments');
    }
}

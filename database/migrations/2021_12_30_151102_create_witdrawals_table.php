<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWitdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('bank_account_id');
            $table->bigInteger('nominal_fee')->nullable();
            $table->double('nominal')->nullable();
            $table->double('nominal_pay')->nullable();
            $table->enum('status', ['WAITING', 'FAILED','SUCCESS'])->nullable()->default('WAITING');
            $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('buyer_id')->references('id')->on('buyers')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('witdrawals');
    }
}

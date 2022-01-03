<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique()->nullable();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('ktp')->nullable();
            $table->double('balance')->nullable()->default(0);
            $table->string('token')->nullable();
            $table->text('firebase_uid')->nullable();
            $table->text('google_pic')->nullable();
            $table->tinyInteger('is_verify')->default(0);
            $table->tinyInteger('is_banned')->default(0);
            $table->timestamp('banned_at')->nullable();
            $table->timestamp('verify_at')->nullable();
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
        Schema::dropIfExists('sellers');
    }
}

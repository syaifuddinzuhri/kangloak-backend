<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJunksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('junk_category_id');
            $table->string('name')->nullable();
            $table->string('photo')->nullable();
            $table->double('weight')->default(0);
            $table->double('price')->default(0);
            $table->foreign('junk_category_id')->references('id')->on('junk_categories')->onDelete('NO ACTION')->onUpdate('NO ACTION');
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
        Schema::dropIfExists('junks');
    }
}

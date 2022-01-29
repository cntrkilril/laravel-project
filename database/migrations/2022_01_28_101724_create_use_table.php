<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('use', function (Blueprint $table) {
            $table->foreignId('thing_id')->references('id')->on('things');
            $table->foreignId('place_id')->references('id')->on('places');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->integer('amount');
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
        Schema::dropIfExists('use');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->index();
            $table->string('name', 64);
            $table->date('date');
            $table->string('type', 32);
            $table->integer('season')->nullable();
            $table->integer('episode')->nullable();
            $table->integer('minutes');
            $table->string('description', 512);
            $table->float('classification');
            $table->string('genre', 256);
            $table->string('studio', 64);
            $table->string('image', 256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content');
    }
}

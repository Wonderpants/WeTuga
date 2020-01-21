<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_list', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->index();
            $table->bigInteger('content_id');
            $table->bigInteger('list_id');

            $table->foreign('content_id')->references('id')->on('content');
            $table->foreign('list_id')->references('id')->on('list');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_list');
    }
}

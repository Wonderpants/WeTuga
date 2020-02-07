<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateHistoricTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement()->index();
            $table->bigInteger('user_id');
            $table->bigInteger('content_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('content')->references('id')->on('content');
            $table->timestamp('seen_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historic');
    }
}

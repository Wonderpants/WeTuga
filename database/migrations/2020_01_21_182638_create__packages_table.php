<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigInteger('id')->autoIncrement();
            $table->string('name', 16)->index();
            $table->float('price');
            $table->integer('duration');
            $table->integer('quality');
        });
        DB::table('packages')->insert(
          array(
              'name' => 'Default',
              'price' => 0,
              'duration' => -1,
              'quality' => 480
          )
        );
        DB::table('packages')->insert(
          array(
              'name' => 'Basic',
              'price' => 5,
              'duration' => 3,
              'quality' => 720
          )
        );
        DB::table('packages')->insert(
          array(
              'name' => 'Premium',
              'price' => 10,
              'duration' => 9,
              'quality' => 1080
          )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_packages');
    }
}

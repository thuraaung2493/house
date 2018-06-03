<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('house_id');
            $table->string('building_year')->nullable();
            $table->integer('bathrooms');
            $table->integer('bedrooms');
            $table->boolean('parking')->default(false);
            $table->boolean('water')->default(false);
            $table->boolean('exercise_room')->default(false);
            $table->timestamps();

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('house_details');
    }
}

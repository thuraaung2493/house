<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('house_type_id');
            $table->string('title');
            $table->string('period')->default('month');
            $table->integer('price');
            $table->integer('area');
            $table->string('rooms');
            $table->text('description');
            $table->string('features');
            $table->boolean('featured_house')->default(false);
            $table->boolean('is_approved')->default(false);
            $table->timestamps();

            $table->foreign('house_type_id')->references('id')->on('house_types')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}

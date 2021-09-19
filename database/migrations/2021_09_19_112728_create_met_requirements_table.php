<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('met_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('part_detail_id');
            $table->unsignedBigInteger('user_id');
            $table->json('final_values');
            $table->timestamps();

            $table->foreign('part_detail_id')->references('id')->on('part_details');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('met_requirements');
    }
}

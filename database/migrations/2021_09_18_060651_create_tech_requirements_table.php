<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tech_requirements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('part_detail_id');
            $table->unsignedBigInteger('section_id');
            $table->unsignedSmallInteger('sequence');
            $table->json('parameters');
            $table->string('section_name');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('part_detail_id')->references('id')->on('part_details');
            $table->foreign('section_id')->references('id')->on('sections');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tech_requirements');
    }
}

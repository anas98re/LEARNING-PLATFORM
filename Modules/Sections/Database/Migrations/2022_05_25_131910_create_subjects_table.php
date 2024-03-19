<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover');
            $table->bigInteger('points');
            $table->string('introductory_video');
            $table->text('description');
            $table->text('requirements');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('sub_section_id')->index();
            $table->foreign('sub_section_id')->references('id')->on('sub_sections')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('subjects');
    }
};

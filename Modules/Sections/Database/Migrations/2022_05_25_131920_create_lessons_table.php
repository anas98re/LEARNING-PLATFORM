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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('video');
            $table->boolean('isFree');
            $table->string('cover');
            $table->text('what_we_will_learn');
            $table->bigInteger('points');
            $table->bigInteger('duration');
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('unit_id')->references('id')->on('units')->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('lessons');
    }
};

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
        Schema::create('student_languages', function (Blueprint $table) {
            $table->id();
            $table->enum('level', ['good', 'so_so','weak'])->nullable();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('language_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')
                ->onUpdate('cascade');
            $table->foreign('language_id')->references('id')->on('languages')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('student_languages');
    }
};
